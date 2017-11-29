<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaction;
use App\Cart;
use App\Cart_item;
use App\User;
use URL;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Transaction Index';
        $searchWord = \Request::get('search');
        if($searchWord == "")            
            $transactions = Transaction::orderBy('submitted_at')->paginate(5)->appends(Input::except('page'));
        else{
            $searchWord = (int) $searchWord;
            $transactions = Transaction::where('cart_id','=',$searchWord)->orderBy('submitted_at')->paginate(5)->appends(Input::except('page'));
        }
        return view('transaction.index',compact('transactions','title','searchWord'));
    }

    /**
     * Display the specified resource.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        $date = date('F j, Y g:i A');
        $title = 'Show Transaction';
        if($request->ajax())
        {
            return URL::to('transaction/'.$id);
        }

        $transaction = Transaction::findOrfail($id);
        $userid = Cart::where('id', '=', $transaction->cart_id)->value('borrower_id');
        $user = User::where('id_no', '=', $userid)->first();

        $carts = Cart::select('transactions.id', 'cart_id', 'carts.id', 'remarks', 'submitted_at', 'prepared_at','completed_at', 'released_at', 'borrower_id', 'status')->join('transactions', function($join){
            $join->on('carts.id', '=', 'transactions.cart_id');
        })->where('borrower_id','=', $userid)
        ->where('transactions.id','=', $transaction->id)
        ->paginate(5)->appends(Input::except('page')); 

        $cart_items = Cart_item::join('items', function($join){
                $join->on('cart_items.item_id', '=', 'items.id');
            })->where('cart_id','=',$transaction->cart_id)->orderBy('cart_id')->paginate(5)->appends(Input::except('page'));

        $nameAdmin = Auth::user()->name;

        return view('transaction.admin_show',compact('title','carts','cart_items', 'user', 'date','nameAdmin')); 
    }

    public function DeleteMsg($id,Request $request)
    {
        $notif = 'toastr["info"]("Transaction #'.$id.' was successfully deleted from the system")';
        $msg = '<script>
        bootbox.confirm({
            title: "Delete Transaction #'.$id.' from the System",
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
                    $("#" + '.$id.').remove();
                    '.$notif.'
                    $.ajax({
                        type: "GET",
                        url: "/transaction/'.$id.'/delete"
                    });          
                }
            }
        });
        </script>';

        if($request->ajax())
        {
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

    public function index_pending(){ 
        $title = 'Pending Transactions'; 
        $searchWord = \Request::get('search'); 
        if($searchWord == "")           
            $transactions = Transaction::whereNotNull('submitted_at')->whereNull('prepared_at')->whereNull('released_at')->whereNull('completed_at')->orderBy('submitted_at')->paginate(5)->appends(Input::except('page'));
        else{ 
            $searchWord = (int) $searchWord;
            $transactions = Transaction::where('cart_id','like','%'.$searchWord.'%')->whereNotNull('submitted_at')->whereNull('prepared_at')->whereNull('released_at')->whereNull('completed_at')->orderBy('submitted_at')->paginate(5)->appends(Input::except('page')); 
        }
        return view('transaction.index_pending',compact('transactions','title','searchWord')); 
    } 
 
    public function index_prepared(){ 
        $title = 'Prepared Carts'; 
        $searchWord = \Request::get('search'); 
        $transactions = Transaction::whereNotNull('submitted_at')->whereNotNull('prepared_at')->whereNull('released_at')->whereNull('completed_at')->orderBy('prepared_at')->paginate(5)->appends(Input::except('page')); 
        return view('transaction.index_prepared',compact('transactions','title','searchWord')); 
    } 

    public function index_released(){ 
        $title = 'Released Carts'; 
        $searchWord = \Request::get('search'); 
        $transactions = Transaction::whereNotNull('submitted_at')->whereNotNull('prepared_at')->whereNotNull('released_at')->whereNull('completed_at')->orderBy('released_at')->paginate(5)->appends(Input::except('page')); 
        return view('transaction.index_released',compact('transactions','title','searchWord')); 
    } 
 
    public function index_completed(){ 
        $title = 'Completed Transactions'; 
        $searchWord = \Request::get('search'); 
        $transactions = Transaction::whereNotNull('submitted_at')->whereNotNull('prepared_at')->whereNotNull('released_at')->whereNotNull('completed_at')->orderBy('completed_at')->paginate(5)->appends(Input::except('page')); 
        return view('transaction.index_completed',compact('transactions','title','searchWord')); 
    } 
 
    public function undo_submission($id, Request $Request){
        $cart_id = Transaction::where('id',$id)->value('cart_id'); 

        Cart::where('id', $cart_id)->update(['status' => 'Draft']); 
        Transaction::where('id',$id)->update(['submitted_at' => null]);

        return redirect('transaction/pending'); 
    }

    public function prepare($id, Request $Request){ 
        $date = date('F j, Y g:i A'); 
        $cart_id = Transaction::where('id',$id)->value('cart_id'); 
 
        Cart::where('id', $cart_id)->update(['status' => 'Prepared']); 
        Transaction::where('id',$id)->update(['prepared_at' => $date]); 
        \Session::flash('success','Cart prepared');

        return redirect('transaction/pending'); 
    }

    public function undo_prepare($id, Request $Request){
        $cart_id = Transaction::where('id',$id)->value('cart_id'); 

        Cart::where('id', $cart_id)->update(['status' => 'Pending']); 
        Transaction::where('id',$id)->update(['prepared_at' => null]);
        \Session::flash('info','Cart undone.');
        return redirect('transaction/pending'); 
    }

    public function release($id, Request $Request){ 
        $date = date('F j, Y g:i A'); 
        $cart_id = Transaction::where('id',$id)->value('cart_id'); 
 
        Cart::where('id', $cart_id)->update(['status' => 'Released']); 
        Transaction::where('id',$id)->update(['released_at' => $date]); 
        \Session::flash('success','Cart released to User.');      
        return redirect('transaction/prepared'); 
    } 

    public function undo_release($id, Request $Request){
        $cart_id = Transaction::where('id',$id)->value('cart_id'); 

        Transaction::where('id',$id)->update(['released_at' => null]); 
        Cart::where('id', $cart_id)->update(['status' => 'Prepared']); 
        \Session::flash('info','Cart undone.');
        return redirect('transaction/prepared');
    }
 
    public function complete($id, Request $Request){ 
        $date = date('F j, Y g:i A'); 
        $cart_id = Transaction::where('id',$id)->value('cart_id'); 
 
        Cart::where('id', $cart_id)->update(['status' => 'Completed']); 
        Transaction::where('id',$id)->update(['completed_at' => $date]); 
        \Session::flash('success','Cart has been returned.');
        return redirect('transaction/released'); 
    } 

    public function undo_complete($id, Request $Request){
        $cart_id = Transaction::where('id',$id)->value('cart_id'); 

        Cart::where('id', $cart_id)->update(['status' => 'Released']); 
        Transaction::where('id',$id)->update(['completed_at' => null]); 
        \Session::flash('info','Cart undone.');
        return redirect('transaction/released'); 
    }

    public function user_show($id){
        $date = date('F j, Y');
        $title = 'Show Transaction'; 
        $userid = Auth::user()->id_no;
        $user = User::where('id_no', '=', $userid)->first();
        $carts = Cart::select('transactions.id as trans_id', 'cart_id', 'carts.id', 'submitted_at', 'completed_at', 'released_at', 'prepared_at', 'borrower_id', 'status')->join('transactions', function($join){
            $join->on('carts.id', '=', 'transactions.cart_id');
        })->where('cart_id', '=', $id)->paginate(5)->appends(Input::except('page')); 
        $cart_items = Cart_item::join('items', function($join){
                $join->on('cart_items.item_id', '=', 'items.id');
            })->where('cart_id','=',$id)->orderBy('cart_id')->paginate(5)->appends(Input::except('page'));
        return view('transaction.user_show',compact('title','carts','cart_items', 'user', 'date')); 
    }

    public function user_index(Request $request){ 
        $title = 'Transaction History'; 
        $userid = Auth::user()->id_no; 
        $user = User::where('id_no', '=', $userid)->first();
        $transactions = Cart::select('transactions.id as trans_id', 'cart_id', 'carts.id', 'submitted_at', 'prepared_at', 'released_at', 'completed_at', 'borrower_id', 'status')->join('transactions', function($join){
            $join->on('carts.id', '=', 'transactions.cart_id');
        })->where('borrower_id', '=', $userid)->orderBy('cart_id','desc')->paginate(5)->appends(Input::except('page')); 
        return view('transaction.user_index',compact('transactions','title')); 
    }
}
