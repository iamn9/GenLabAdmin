<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
            $accountabilities = Accountability::whereNotNull('id')->whereNotNull('borrower_id')->whereNotNull('borrower_name')->whereNotNull('transaction_id')->orderBy('due_date')->paginate(5)->appends(Input::except('page'));
        else{
            $searchWord = (int) $searchWord;
            $transactions = Transaction::where('cart_id','=',$searchWord)->orderBy('submitted_at')->paginate(5)->appends(Input::except('page'));
        }
        return view('accountability.index',compact('accountabilities','title','searchWord'));
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
     * Remove the specified resource from storage.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     
    public function destroy($id)
    {
     	$transaction = Transaction::findOrfail($id);
     	$transaction->delete();
        return URL::to('transaction');
    }
	*	It would be great to utilize this function.
	*/

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

}
