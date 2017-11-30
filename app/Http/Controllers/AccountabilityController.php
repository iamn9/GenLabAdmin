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
use URL;

class AccountabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Accountability Index';
		$searchWord = \Request::get('search');       
	   
        if($searchWord == "")            
            $accountabilities = Accountability::whereNotNull('id')->whereNull('borrower_id')->whereNull('borrower_name')->whereNull('date_borrowed')->orderBy('due_date')->paginate(5)->appends(Input::except('page'));
        else{
            $searchWord = (int) $searchWord;
            $transactions = Transaction::where('cart_id','=',$searchWord)->orderBy('submitted_at')->paginate(5)->appends(Input::except('page'));
        }
        return view('accountability.index',compact('accountabilities','title','searchWord'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - transaction';
        return view('transaction.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transaction = new Transaction();
        $transaction->cart_id = $request->cart_id;
        $transaction->submitted_at = $request->submitted_at;
        $transaction->released_at = $request->released_at;
        $transaction->completed_at = $request->completed_at;
        $transaction->save();
        return redirect('transaction');
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
        $title = 'Show - transaction';
        if($request->ajax())
        {
            return URL::to('transaction/'.$id);
        }

        $transaction = Transaction::findOrfail($id);
        $userid = Cart::where('id', '=', $transaction->cart_id)->value('borrower_id');
        $user = User::where('id_no', '=', $userid)->first();

        $carts = Cart::select('transactions.id', 'cart_id', 'carts.id', 'remarks', 'submitted_at', 'completed_at', 'released_at', 'borrower_id', 'status')->join('transactions', function($join){
            $join->on('carts.id', '=', 'transactions.cart_id');
        })->where('borrower_id','=', $userid)
        ->where('transactions.id','=', $transaction->id)
        ->paginate(5)->appends(Input::except('page')); 

        $cart_items = Cart_item::join('items', function($join){
                $join->on('cart_items.item_id', '=', 'items.id');
            })->where('cart_id','=',$transaction->cart_id)->orderBy('cart_id')->paginate(5)->appends(Input::except('page'));

        $nameAdmin = Auth::user()->name;

        return view('transaction.show',compact('title','carts','cart_items', 'user', 'date','nameAdmin')); 
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - transaction';
        if($request->ajax())
        {
            return URL::to('transaction/'. $id . '/edit');
        }

        $transaction = Transaction::findOrfail($id);
        return view('transaction.edit',compact('title','transaction'  ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $transaction = Transaction::findOrfail($id);
        $transaction->cart_id = $request->cart_id;
        $transaction->submitted_at = $request->submitted_at;
        $transaction->released_at = $request->released_at;
        $transaction->completed_at = $request->completed_at;
        $transaction->save();

        return redirect('transaction');
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

     public function user_history(Request $request){ 
        $title = 'Transaction History'; 
        $userid = Auth::user()->id_no; 
        $user = User::where('id_no', '=', $userid)->first();
        $transactions = Cart::select('transactions.id as trans_id', 'cart_id', 'carts.id', 'submitted_at', 'completed_at', 'released_at', 'borrower_id', 'status')->join('transactions', function($join){
            $join->on('carts.id', '=', 'transactions.cart_id');
        })->where('borrower_id', '=', $userid)->where('status', '=', 'Completed')->paginate(5)->appends(Input::except('page')); 
        return view('transaction.user_history',compact('transactions','title')); 
    }


    public function index_pending(){ 
        $title = 'Pending - accountabilities'; 
        $searchWord = \Request::get('search'); 
        if($searchWord == "")           
            $accountabilities = Accountability::whereNotNull('id')->whereNull('borrower_id')->whereNull('borrower_name')->whereNull('date_borrowed')->orderBy('due_date')->paginate(5)->appends(Input::except('page'));
        else{ 
            $searchWord = (int) $searchWord;
            $transactions = Transaction::where('cart_id','like','%'.$searchWord.'%')->whereNotNull('submitted_at')->whereNull('prepared_at')->whereNull('released_at')->whereNull('completed_at')->orderBy('submitted_at')->paginate(5)->appends(Input::except('page')); 
        }
        return view('accountability.index_pending',compact('accountabilities','title','searchWord')); 
    } 
 
    public function index_completed(){ 
        $title = 'Completed - accountabilities'; 
        $searchWord = \Request::get('search'); 
        $accountabilities = Accountability::whereNotNull('id')->whereNull('borrower_id')->whereNull('borrower_name')->whereNull('date_borrowed')->orderBy('due_date')->paginate(5)->appends(Input::except('page'));
        return view('accountability.index_completed',compact('accountabilities','title','searchWord')); 
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

    public function user_active(){ 
        $date = date('F j, Y');
        $title = 'Active Transaction'; 
        $userid = Auth::user()->id_no; 
        $cart_id = Cart::where('borrower_id','=', $userid)->where('status', '!=', 'Completed')->where('status', '!=', 'Draft')->value('id');
        if (!$cart_id)
        return redirect('/cart');
        $user = User::where('id_no', '=', $userid)->first();
        $carts = Cart::select('transactions.id as trans_id', 'cart_id', 'remarks', 'carts.id', 'submitted_at', 'completed_at', 'released_at', 'borrower_id', 'status')->join('transactions', function($join){
            $join->on('carts.id', '=', 'transactions.cart_id');
        })
        ->where('borrower_id','=', $userid)->where('status', '!=', 'Completed')->where('status', '!=', 'Draft')->paginate(5)->appends(Input::except('page')); 
        $cart_items = Cart_item::join('items', function($join){
                $join->on('cart_items.item_id', '=', 'items.id');
            })->where('cart_id','=',$cart_id)->orderBy('cart_id')->paginate(5)->appends(Input::except('page'));
        return view('transaction.user_show',compact('title','carts','cart_items', 'user', 'date')); 
    } 
    public function user_history_info($id, Request $Request){
        $date = date('F j, Y');
        $title = 'Transaction History'; 
        $userid = Auth::user()->id_no;
        $user = User::where('id_no', '=', $userid)->first();
        $carts = Cart::select('transactions.id as trans_id', 'cart_id', 'carts.id', 'submitted_at', 'completed_at', 'released_at', 'borrower_id', 'status')->join('transactions', function($join){
            $join->on('carts.id', '=', 'transactions.cart_id');
        })->where('cart_id', '=', $id)->paginate(5)->appends(Input::except('page')); 
        $cart_items = Cart_item::join('items', function($join){
                $join->on('cart_items.item_id', '=', 'items.id');
            })->where('cart_id','=',$id)->orderBy('cart_id')->paginate(5)->appends(Input::except('page'));
        return view('transaction.user_show',compact('title','carts','cart_items', 'user', 'date')); 
    }
}
