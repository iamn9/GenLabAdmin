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
use App\Item;
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
            $accountabilities = Accountability::whereNotNull('id')->whereNotNull('borrower_id')->whereNotNull('transaction_id')->orderBy('date_borrowed', 'DESC')->paginate(5)->appends(Input::except('page'));
        else{
			if(strcasecmp($searchWord,'Completed') == 0){
				$accountabilities = Accountability::whereNotNull('date_borrowed')->whereNotNull('date_returned')->orderBy('date_borrowed', 'desc')->paginate(5)->appends(Input::except('page'));				
			}elseif(strcasecmp($searchWord,'Released') == 0){
				$accountabilities = Accountability::whereNotNull('date_borrowed')->whereNull('date_returned')->orderBy('date_borrowed', 'desc')->paginate(5)->appends(Input::except('page'));				
			}else{
				$searchWord = (int) $searchWord;			
				$accountabilities = Accountability::where('transaction_id','=',$searchWord)->orWhere('borrower_id', '=', $searchWord)->orderBy('date_borrowed')->paginate(5)->appends(Input::except('page'));
			}            
        }
        return view('accountability.index',compact('accountabilities','title','searchWord'));
    }
	
	public function user_accountabilities()
    {
        $title = 'Accountabilities';
		$searchWord = \Request::get('search');       
	   
        if($searchWord == "")            
            $accountabilities = Accountability::whereNotNull('date_borrowed')->whereNull('date_returned')->orderBy('date_borrowed', 'DESC')->paginate(5)->appends(Input::except('page'));
			
        else{
            $searchWord = (int) $searchWord;
            $transactions = Transaction::where('cart_id','=',$searchWord)->orderBy('submitted_at')->paginate(5)->appends(Input::except('page'));
        }
        return view('accountability.user_accountabilities',compact('accountabilities','title','searchWord'));
		
	}
	
	public static function get_elapsed_time($date_borrowed){								
		return Carbon::parse($date_borrowed)->diffForHumans(null, true);
	}
	
	public static function get_amount_payable($date_borrowed, $item_id){
		
		$firsthour = Item::where('id', '=', $item_id)->value('firsthour');
		
		if($firsthour == 0){
			return $firsthour;
		}
		
		$current = Carbon::now();
		$elapsed_hours = Carbon::parse($date_borrowed)->diffInHours($current);
		
		//if($elapsed_hours < 1){
		//	return 0.0;
		//}
		
		$firsthour = Item::where('id', '=', $item_id)->value('firsthour');
		$succeeding_hours = Item::where('id', '=', $item_id)->value('succeeding');
		$total_fee = $succeeding_hours*$elapsed_hours + $firsthour;
		return $total_fee;
	}
	
	public static function get_item_name($item_id){		
		return Item::where('id', '=', $item_id)->value('name');				
	}

	public static function get_qty($transaction_id){
		
		$cart_id = Transaction::where('id', '=', $transaction_id)->value('cart_id');
		$qty = Cart_item::where('cart_id', '=', $cart_id)->value('qty');
		return $qty;		
	}
			
	public static function get_description($id){			
		return Item::where('id', '=', $id)->value('description');		
	}
	
	public static function get_time_consumed($date_borrowed, $date_returned){		
		$elapsed_time = Carbon::parse($date_borrowed)->diffInHours(Carbon::parse($date_returned));		
		if($elapsed_time < 2)
			return $elapsed_time.' hour';
		
		return $elapsed_time.' hours';
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
			$accountabilities = Accountability::whereNotNull('id')->whereNull('date_returned')->whereNotNull('date_borrowed')->orderBy('date_borrowed', 'DESC')->paginate(5)->appends(Input::except('page'));
		else{ 
			$searchWord = (int) $searchWord;			
			$accountabilities = Accountability::where('transaction_id','=',$searchWord)->orWhere('borrower_id', '=', $searchWord)->whereNull('date_returned')->whereNotNull('date_borrowed')->orderBy('date_borrowed')->paginate(5)->appends(Input::except('page'));
		}
        return view('accountability.index_pending',compact('accountabilities','title','searchWord')); 
    } 
 
    public function index_completed(){ 
        $title = 'Completed - accountabilities'; 
        $searchWord = \Request::get('search');         
		if($searchWord == "")           
			$accountabilities = Accountability::whereNotNull('id')->whereNotNull('date_returned')->whereNotNull('date_borrowed')->orderBy('date_returned', 'desc')->paginate(5)->appends(Input::except('page'));
		else{ 
			$searchWord = (int) $searchWord;			
			$accountabilities = Accountability::where('transaction_id','=',$searchWord)->orWhere('borrower_id', '=', $searchWord)->whereNotNull('date_returned')->whereNotNull('date_borrowed')->orderBy('date_borrowed')->paginate(5)->appends(Input::except('page'));
		}
        return view('accountability.index_completed',compact('accountabilities','title','searchWord')); 
				
    } 
	
	public function user_accountability_info($id, Request $Request){		
        $date = date('F j, Y');
        $title = 'Accountability Info'; 
				
		$userid = Accountability::where('id', '=', $id)->value('borrower_id');		
        $user = User::where('id_no', '=' , $userid)->get();				
		$accountability_trans_id = Accountability::where('id', '=', $id)->value('transaction_id');
		
        $carts = Cart::select('transactions.id as trans_id', 'cart_id', 'carts.id', 'submitted_at', 'completed_at', 'released_at', 'borrower_id', 'status')->join('transactions', function($join){
            $join->on('carts.id', '=', 'transactions.cart_id');
        })->where('transactions.id', '=', $accountability_trans_id)->paginate(5)->appends(Input::except('page')); 
		        		
		$cart_items = Accountability::where('id', '=', $id)->get();
		
        return view('accountability.user_accountability_show',compact('title','carts','cart_items', 'user', 'date', 'total_fee')); 
    }
	
	 public function accountability_info($id, Request $Request){		
        $date = date('F j, Y');
        $title = 'Accountability Info'; 
				
		$userid = Accountability::where('id', '=', $id)->value('borrower_id');		
        $user = User::where('id_no', '=' , $userid)->get();				
		$accountability_trans_id = Accountability::where('id', '=', $id)->value('transaction_id');
		
        $carts = Cart::select('transactions.id as trans_id', 'cart_id', 'carts.id', 'submitted_at', 'completed_at', 'released_at', 'borrower_id', 'status')->join('transactions', function($join){
            $join->on('carts.id', '=', 'transactions.cart_id');
        })->where('transactions.id', '=', $accountability_trans_id)->paginate(5)->appends(Input::except('page')); 
		        		
		$cart_items = Accountability::where('id', '=', $id)->get();
		$nameAdmin = Auth::user()->name;		
		
        return view('accountability.accountability_show',compact('title','carts','cart_items', 'user', 'date', 'nameAdmin', 'total_fee')); 
    }

}
