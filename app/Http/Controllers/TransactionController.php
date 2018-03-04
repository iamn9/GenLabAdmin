<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Accountability;
use App\Transaction;
use App\Cart;
use App\Cart_item;
use App\User;
use App\Item;
use URL;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'All Transactions';
        $searchWord = \Request::get('search');
        $transactions = Transaction::paginate(7);
        return view('transaction.index', compact('transactions', 'title', 'searchWord'));
    }

    /**
     * Display the specified resource.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $date = date('F j, Y g:i A');
        $title = 'Show Transaction';
        if ($request->ajax()) {
            return URL::to('transaction/' . $id);
        }

        $transaction = Transaction::findOrfail($id);
        $userid = Cart::where('id', '=', $transaction->cart_id)->value('borrower_id');
        $user = User::where('id_no', '=', $userid)->first();

        $carts = Cart::select('transactions.id as trans_id', 'cart_id', 'carts.id', 'remarks', 'submitted_at', 'prepared_at', 'completed_at', 'released_at', 'borrower_id', 'status')->join('transactions', function ($join) {
            $join->on('carts.id', '=', 'transactions.cart_id');
        })->where('borrower_id', '=', $userid)
            ->where('transactions.id', '=', $transaction->id)->get();

        $cart_items = Cart_item::join('items', function ($join) {
            $join->on('cart_items.item_id', '=', 'items.id');
        })->where('cart_id', '=', $transaction->cart_id)->orderBy('cart_id')->get();

        $nameAdmin = Auth::user()->name;

        if (!Auth::user()->isAdmin)
            return view('transaction.user_show', compact('title', 'carts', 'cart_items', 'user', 'date', 'nameAdmin'));
        else
            return view('transaction.admin_show', compact('title', 'carts', 'cart_items', 'user', 'date', 'nameAdmin'));
    }

    public function DeleteMsg($id, Request $request)
    {
        $notif = 'toastr["info"]("Transaction #' . $id . ' was successfully deleted from the system")';
        $msg = '<script>
        bootbox.confirm({
            title: "Delete Transaction #' . $id . ' from the System",
            message: "Warning! Are you sure you want to remove this Transaction?",
            buttons: {
                confirm: {
                    label: "Delete",
                    className: "btn-danger"
                },
                cancel: {
                    label: "Cancel",
                }
            },
            callback: function (result) {
                if (result){
                    $("#" + ' . $id . ').remove();
                    ' . $notif . '
                    $.ajax({
                        type: "GET",
                        url: "/transaction/' . $id . '/delete"
                    });          
                }
            }
        });
        </script>';

        if ($request->ajax()) {
            return $msg;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::findOrfail($id);
        $transaction->delete();

        return URL::to('transaction');
    }

    public function undo_submission($id, Request $Request)
    {
        $cart_id = Transaction::where('id', $id)->value('cart_id');

        Cart::where('id', $cart_id)->update(['status' => 'Draft']);
        Transaction::where('id', $id)->update(['submitted_at' => null]);

        return redirect()->back();
    }

    public function prepare($id, Request $Request)
    {
        $date = date("Y-m-d H:i:s");
        $cart_id = Transaction::where('id', $id)->value('cart_id');

        Cart::where('id', $cart_id)->update(['status' => 'Prepared']);
        Transaction::where('id', $id)->update(['prepared_at' => $date]);

        \Session::flash('success', 'Cart prepared');

        return redirect()->back();
    }

    public function undo_prepare($id, Request $Request)
    {
        $cart_id = Transaction::where('id', $id)->value('cart_id');

        Transaction::where('id', $id)->update(['prepared_at' => null, 'released_at' => null]);
        Cart::where('id', $cart_id)->update(['status' => 'Pending']);

        \Session::flash('info', 'Cart undone.');
        return redirect()->back();
    }

    public function release($id, Request $Request)
    {
        $date = date("Y-m-d H:i:s");
        $cart_id = Transaction::where('id', $id)->value('cart_id');

        Cart::where('id', $cart_id)->update(['status' => 'Released']);
        Transaction::where('id', $id)->update(['released_at' => $date]);

        \Session::flash('success', 'Cart released to User.');
        return redirect()->back();
    }

    public function undo_release($id, Request $Request)
    {
        $cart_id = Transaction::where('id', $id)->value('cart_id');

        Transaction::where('id', $id)->update(['released_at' => null]);
        Cart::where('id', $cart_id)->update(['status' => 'Prepared']);

        \Session::flash('info', 'Cart undone.');
        return redirect()->back();
    }

    public function complete($id, Request $request)
    {
        $date = date('F j, Y g:i A');
        $cart_id = Transaction::findOrFail($id)->value('cart_id');
        Cart::where('id', $cart_id)->update(['status' => 'Completed']);
        Transaction::where('id', $id)->update(['completed_at' => $date]);

        \Session::flash('success', 'Cart has been returned.');
        return redirect()->back();
    }

    public function undo_complete($id, Request $Request)
    {
        $cart_id = Transaction::where('id', $id)->value('cart_id');

        Cart::where('id', $cart_id)->update(['status' => 'Released']);
        Transaction::where('id', $id)->update(['completed_at' => null]);
        Accountability::where('trans_id', $id)->delete();

        \Session::flash('info', 'Cart undone.');
        return redirect()->back();
    }

    public function confirm_complete($id, Request $request)
    {
        $transaction = Transaction::findOrfail($id);
        $cart = Cart::findOrFail($transaction->cart_id);
        if ($cart->getTotalFee() == 0) {
            return redirect('transaction/' . $id . '/complete');
        }

        $date = date('F j, Y g:i A');
        $title = 'Show Transaction';
        if ($request->ajax()) {
            return URL::to('transaction/' . $id);
        }

        $userid = Cart::where('id', '=', $transaction->cart_id)->value('borrower_id');
        $user = User::where('id_no', '=', $userid)->first();

        $carts = Cart::select('transactions.id as trans_id', 'cart_id', 'carts.id', 'remarks', 'submitted_at', 'prepared_at', 'completed_at', 'released_at', 'borrower_id', 'status')->join('transactions', function ($join) {
            $join->on('carts.id', '=', 'transactions.cart_id');
        })->where('borrower_id', '=', $userid)
            ->where('transactions.id', '=', $transaction->id)->get();

        $cart_items = Cart_item::join('items', function ($join) {
            $join->on('cart_items.item_id', '=', 'items.id');
        })->where('cart_id', '=', $transaction->cart_id)->orderBy('cart_id')->get();

        $nameAdmin = Auth::user()->name;

        return view('transaction.confirm_complete', compact('title', 'carts', 'cart_items', 'user', 'date', 'nameAdmin'));
    }

    public function user_history_info($id, Request $Request)
    {
        $date = date('F j, Y');
        $title = 'Transaction History';
        $userid = Accountability::where('id', '=', $id)->value('borrower_id');
        $user = User::where('id_no', '=', $userid)->get();
        $carts = Cart::select('transactions.id as trans_id', 'cart_id', 'carts.id', 'submitted_at', 'completed_at', 'released_at', 'borrower_id', 'status')->join('transactions', function ($join) {
            $join->on('carts.id', '=', 'transactions.cart_id');
        })->where('cart_id', '=', $id)->get();
        $cart_items = Cart_item::join('items', function ($join) {
            $join->on('cart_items.item_id', '=', 'items.id');
        })->where('cart_id', '=', $id)->orderBy('cart_id')->get();
        return view('transaction.show', compact('title', 'carts', 'cart_items', 'user', 'date', 'name'));
    }

    public function user_history(Request $request)
    {
        $title = 'Transaction History';
        $userid = Auth::user()->id_no;
        $user = User::where('id_no', '=', $userid)->first();
        $transactions = Cart::select('transactions.id as trans_id', 'cart_id', 'carts.id', 'submitted_at', 'prepared_at', 'released_at', 'completed_at', 'borrower_id', 'status')->join('transactions', function ($join) {
            $join->on('carts.id', '=', 'transactions.cart_id');
        })->where('borrower_id', '=', $userid)->where('completed_at', '!=', null)->orderBy('cart_id', 'desc')->get();
        return view('transaction.user_history', compact('transactions', 'title'));
    }

    public function user_active(Request $request)
    {
        $searchWord = "";
        $date = date('F j, Y');
        $title = 'Active Transactions';
        $userid = Auth::user()->id_no;
        $carts = Cart::select('transactions.id as trans_id', 'cart_id', 'carts.id', 'borrower_id', 'submitted_at', 'completed_at', 'status')->join('transactions', function ($join) {
            $join->on('carts.id', '=', 'transactions.cart_id');
        })->where('borrower_id', '=', $userid)->where('completed_at', '=', null)->get();
        return view('transaction.user_active', compact('title', 'carts', 'searchWord'));
    }
}
