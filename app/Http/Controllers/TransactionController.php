<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaction;
use Amranidev\Ajaxis\Ajaxis;
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
        $title = 'Index - transaction';
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

        $pusher = App::make('pusher');

        //default pusher notification.
        //by default channel=test-channel,event=test-event
        //Here is a pusher notification example when you create a new resource in storage.
        //you can modify anything you want or use it wherever.
        $pusher->trigger('test-channel',
                         'test-event',
                        ['message' => 'A new transaction has been created !!']);

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
        $title = 'Show - transaction';

        if($request->ajax())
        {
            return URL::to('transaction/'.$id);
        }

        $transaction = Transaction::findOrfail($id);
        //return view('transaction.show',compact('title','transaction'));
        $cart_items = DB::table('cart_items')->where('cart_id',$transaction->cart_id)->get(); 
        //$user= DB::table('carts')->join('users','carts.borrower_id','=','users.id_no')->join(select('') 
        return view('transaction.show',compact('title','transaction','cart_items'));
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

    /**
     * Delete confirmation message by Ajaxis.
     *
     * @link      https://github.com/amranidev/ajaxis
     * @param    \Illuminate\Http\Request  $request
     * @return  String
     */
    public function DeleteMsg($id,Request $request)
    {
        $msg = Ajaxis::BtDeleting('Warning!!','Would you like to remove This?','/transaction/'. $id . '/delete');

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
        $user = DB::table('users')->where('id_no', '=', $userid)->first();
        $transactions = DB::table('carts')->select('transactions.id as trans_id', 'cart_id', 'carts.id', 'submitted_at', 'completed_at', 'released_at', 'borrower_id', 'status')->join('transactions', function($join){
            $join->on('carts.id', '=', 'transactions.cart_id');
        })->where('borrower_id', '=', $userid)->where('status', '=', 'Completed')->paginate(5)->appends(Input::except('page')); 
        return view('transaction.user_history',compact('transactions','title')); 
    }


    public function index_pending(){ 
        $title = 'Pending Transactions'; 
        $searchWord = \Request::get('search'); 
        $transactions = Transaction::where('cart_id','like','%'.$searchWord.'%')->whereNotNull('submitted_at')->whereNull('prepared_at')->whereNull('released_at')->whereNull('completed_at')->orderBy('submitted_at')->paginate(5)->appends(Input::except('page')); 
        return view('transaction.index_pending',compact('transactions','title','searchWord')); 
    } 
 
    public function index_prepared(){ 
        $title = 'Prepared Carts'; 
        $searchWord = \Request::get('search'); 
        $transactions = Transaction::where('cart_id','like','%'.$searchWord.'%')->whereNotNull('submitted_at')->whereNotNull('prepared_at')->whereNull('released_at')->whereNull('completed_at')->orderBy('prepared_at')->paginate(5)->appends(Input::except('page')); 
        return view('transaction.index_prepared',compact('transactions','title','searchWord')); 
    } 

    public function index_released(){ 
        $title = 'Released Carts'; 
        $searchWord = \Request::get('search'); 
        $transactions = Transaction::where('cart_id','like','%'.$searchWord.'%')->whereNotNull('submitted_at')->whereNotNull('prepared_at')->whereNotNull('released_at')->whereNull('completed_at')->orderBy('released_at')->paginate(5)->appends(Input::except('page')); 
        return view('transaction.index_released',compact('transactions','title','searchWord')); 
    } 
 
    public function index_completed(){ 
        $title = 'Completed Transactions'; 
        $searchWord = \Request::get('search'); 
        $transactions = Transaction::where('cart_id','like','%'.$searchWord.'%')->whereNotNull('submitted_at')->whereNotNull('prepared_at')->whereNotNull('released_at')->whereNotNull('completed_at')->orderBy('completed_at')->paginate(5)->appends(Input::except('page')); 
        return view('transaction.index_completed',compact('transactions','title','searchWord')); 
    } 
 
    public function undo_submission($id, Request $Request){
        $cart_id = DB::table('transactions')->where('id',$id)->value('cart_id'); 

        DB::table('carts') 
            ->where('id', $cart_id) 
            ->update(['status' => 'Draft']); 
        DB::table('transactions') 
            ->where('id',$id) 
            ->update(['submitted_at' => null]);

        return redirect('transaction/pending'); 
    }

    public function prepare($id, Request $Request){ 
        $date = date('Y-m-d H:i:s'); 
        $cart_id = DB::table('transactions')->where('id',$id)->value('cart_id'); 
 
        DB::table('carts') 
            ->where('id', $cart_id) 
            ->update(['status' => 'Prepared']); 
         
        DB::table('transactions') 
            ->where('id',$id) 
            ->update(['prepared_at' => $date]); 
       
        return redirect('transaction/pending'); 
    }

    public function undo_prepare($id, Request $Request){
        $cart_id = DB::table('transactions')->where('id',$id)->value('cart_id'); 

        DB::table('carts') 
            ->where('id', $cart_id) 
            ->update(['status' => 'Pending']); 
        DB::table('transactions') 
            ->where('id',$id) 
            ->update(['prepared_at' => null]);

        return redirect('transaction/pending'); 
    }

    public function release($id, Request $Request){ 
        $date = date('Y-m-d'); 
        $cart_id = DB::table('transactions')->where('id',$id)->value('cart_id'); 
 
        DB::table('carts') 
            ->where('id', $cart_id) 
            ->update(['status' => 'Released']); 
         
        DB::table('transactions') 
            ->where('id',$id) 
            ->update(['released_at' => $date]); 
       
        return redirect('transaction/prepared'); 
    } 

    public function undo_release($id, Request $Request){
        $cart_id = DB::table('transactions')->where('id',$id)->value('cart_id'); 

       DB::table('transactions') 
            ->where('id',$id) 
            ->update(['released_at' => null]); 

        DB::table('carts') 
            ->where('id', $cart_id) 
            ->update(['status' => 'Prepared']); 

        return redirect('transaction/prepared');
    }
 
    public function complete($id, Request $Request){ 
        $date = date('Y-m-d H:i:s'); 
        $cart_id = DB::table('transactions')->where('id',$id)->value('cart_id'); 
 
        DB::table('carts') 
            ->where('id', $cart_id) 
            ->update(['status' => 'Completed']); 
         
        DB::table('transactions') 
            ->where('id',$id) 
            ->update(['completed_at' => $date]); 
 
        return redirect('transaction/released'); 
    } 

    public function undo_complete($id, Request $Request){
        $cart_id = DB::table('transactions')->where('id',$id)->value('cart_id'); 

        DB::table('transactions') 
            ->where('id',$id) 
            ->update(['completed_at' => null]); 

        DB::table('carts') 
            ->where('id', $cart_id) 
            ->update(['status' => 'Released']); 

        return redirect('transaction/released'); 
    }

    public function user_active(){ 
        $date = date('Y-m-d');
        $title = 'Active Transaction'; 
        $userid = Auth::user()->id_no; 
        $cart_id = DB::table('carts')->where('borrower_id','=', $userid)->where('status', '!=', 'Completed')->where('status', '!=', 'Draft')->value('id');
        $user = DB::table('users')->where('id_no', '=', $userid)->first();
        $carts = DB::table('carts')->select('transactions.id as trans_id', 'cart_id', 'carts.id', 'submitted_at', 'completed_at', 'released_at', 'borrower_id', 'status')->join('transactions', function($join){
            $join->on('carts.id', '=', 'transactions.cart_id');
        })->where('borrower_id','=', $userid)->where('status', '!=', 'Completed')->where('status', '!=', 'Draft')->paginate(5)->appends(Input::except('page')); 
        $cart_items = DB::table('cart_items')->join('items', function($join){
                $join->on('cart_items.item_id', '=', 'items.id');
            })->where('cart_id','=',$cart_id)->orderBy('cart_id')->paginate(5)->appends(Input::except('page'));
        return view('transaction.user_show',compact('title','carts','cart_items', 'user', 'date')); 
    } 
    public function user_history_info($id, Request $Request){
        $date = date('Y-m-d');
        $title = 'Transaction History'; 
        $userid = Auth::user()->id_no;
        $user = DB::table('users')->where('id_no', '=', $userid)->first();
        $carts = DB::table('carts')->select('transactions.id as trans_id', 'cart_id', 'carts.id', 'submitted_at', 'completed_at', 'released_at', 'borrower_id', 'status')->join('transactions', function($join){
            $join->on('carts.id', '=', 'transactions.cart_id');
        })->where('cart_id', '=', $id)->paginate(5)->appends(Input::except('page')); 
        $cart_items = DB::table('cart_items')->join('items', function($join){
                $join->on('cart_items.item_id', '=', 'items.id');
            })->where('cart_id','=',$id)->orderBy('cart_id')->paginate(5)->appends(Input::except('page'));
        return view('transaction.user_show',compact('title','carts','cart_items', 'user', 'date')); 
    }
}
