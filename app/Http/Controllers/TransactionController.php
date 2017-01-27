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

/**
 * Class TransactionController.
 *
 * @author  The scaffold-interface created at 2016-12-19 04:15:40am
 * @link  https://github.com/amranidev/scaffold-interface
 */
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
        $transactions = Transaction::where('cart_id','like','%'.$searchWord.'%')->orderBy('submitted_at')->paginate(5)->appends(Input::except('page'));
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

        
        $transaction->disbursed_at = $request->disbursed_at;

        
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
        
        $transaction->disbursed_at = $request->disbursed_at;
        
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

     public function userHistory(Request $request){ 
        $userid = Auth::user()->id_no;
        $title = 'Index - transaction';
        $searchWord = \Request::get('search');
        $transactions = Transaction::where('cart_id','like','%'.$searchWord.'%')->orderBy('submitted_at')->paginate(5)->appends(Input::except('page'));
        return view('transaction.index',compact('transactions','title','searchWord'));
    }


    public function index_pending(){ 
        $title = 'Pending Transactions'; 
        $searchWord = \Request::get('search'); 
        $transactions = Transaction::where('cart_id','like','%'.$searchWord.'%')->whereNotNull('submitted_at')->whereNull('disbursed_at')->whereNull('completed_at')->orderBy('submitted_at')->paginate(5)->appends(Input::except('page')); 
        return view('transaction.index_pending',compact('transactions','title','searchWord')); 
    } 
 
    public function index_disbursed(){ 
        $title = 'Disbursed Transactions'; 
        $searchWord = \Request::get('search'); 
        $transactions = Transaction::where('cart_id','like','%'.$searchWord.'%')->whereNotNull('submitted_at')->whereNotNull('disbursed_at')->whereNull('completed_at')->orderBy('submitted_at')->paginate(5)->appends(Input::except('page')); 
        return view('transaction.index_disbursed',compact('transactions','title','searchWord')); 
    } 
 
    public function index_completed(){ 
        $title = 'Completed Transactions'; 
        $searchWord = \Request::get('search'); 
        $transactions = Transaction::where('cart_id','like','%'.$searchWord.'%')->whereNotNull('submitted_at')->whereNotNull('disbursed_at')->whereNotNull('completed_at')->orderBy('submitted_at')->paginate(5)->appends(Input::except('page')); 
        return view('transaction.index_completed',compact('transactions','title','searchWord')); 
    } 
 
    public function disburse($id, Request $Request){ 
        $date = date('Y-m-d H:i:s'); 
        $cart_id = DB::table('transactions')->value('cart_id'); 
 
        DB::table('carts') 
            ->where('id', $cart_id) 
            ->update(['status' => 'Disbursed']); 
         
        DB::table('transactions') 
            ->where('id',$id) 
            ->update(['disbursed_at' => $date]); 
 
        return redirect('transaction/pending'); 
    } 
 
    public function complete($id, Request $Request){ 
        $date = date('Y-m-d H:i:s'); 
        $cart_id = DB::table('transactions')->value('cart_id'); 
 
        DB::table('carts') 
            ->where('id', $cart_id) 
            ->update(['status' => 'Completed']); 
         
        DB::table('transactions') 
            ->where('id',$id) 
            ->update(['completed_at' => $date]); 
 
        return redirect('transaction/completed'); 
    } 
}
