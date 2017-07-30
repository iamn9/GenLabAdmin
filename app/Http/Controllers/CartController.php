<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Amranidev\Ajaxis\Ajaxis;
use URL;
use App\Cart;
use App\Cart_item;
use App\Transaction;

/**
 * Class CartController.
 *
 * @author  The scaffold-interface created at 2016-12-13 01:15:11am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Index - cart';
        $searchWord = \Request::get('search');

        if(Auth::user()->isAdmin){
            $carts = DB::table('carts')->where('borrower_id','like','%'.$searchWord.'%')->where('status', '=', 'Pending')->paginate(5)->appends(Input::except('page'));
            return view('cart.index',compact('carts','title','searchWord'));
        }
        else{
            $userid = Auth::user()->id_no;
            $cart_id = DB::table('carts')->where('borrower_id','=', $userid)->where('status','Draft')->value('id');
            $students = DB::table('users')->where('isAdmin', '=', '0')->where('isActivated', '=', '1')->get();
            $cart_items = $cart_items = DB::table('cart_items')->join('items', function($join){
                $join->on('cart_items.item_id', '=', 'items.id');
            })->where('cart_id','=',$cart_id)->where('name','like','%'.$searchWord.'%')->where('item_id','like','%'.$searchWord.'%')->select('cart_items.*','items.name')->orderBy('cart_id')->paginate(5)->appends(Input::except('page'));
            return view('cart.user',compact('title','searchWord','cart_id','cart_items', 'students'));
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - cart';
        
        return view('cart.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cart = new Cart();
        $cart->borrower_id = $request->borrower_id;
        $cart->status = $request->status;
        $cart->save();
        $pusher = App::make('pusher');

        //default pusher notification.
        //by default channel=test-channel,event=test-event
        //Here is a pusher notification example when you create a new resource in storage.
        //you can modify anything you want or use it wherever.
        $pusher->trigger('test-channel',
                         'test-event',
                        ['message' => 'A new cart has been created !!']);

        return redirect('cart');
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
        $title = 'Show - cart';

        if($request->ajax())
        {
            return URL::to('cart/'.$id);
        }
        if(Auth::user()->isAdmin){
            $cart = Cart::findOrfail($id);
            $searchWord = \Request::get('search');
            $cart_items = DB::table('cart_items')->where('cart_id','=', $id)->paginate(5)->appends(Input::except('page'));  
            $transaction = DB::table('transactions')->where('cart_id', '=', $id)->first();
            $groupmembers = DB::table('group_members')->where('cart_id', '=', $id)->get();
            return view('cart.show',compact('searchWord','title','cart','cart_items', 'transaction', 'groupmembers'));
        }
        else
            return redirect('cart');
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - cart';
        if($request->ajax())
        {
            return URL::to('cart/'. $id . '/edit');
        }

        $cart = Cart::findOrfail($id);
        return view('cart.edit',compact('title','cart'  ));
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
        $cart = Cart::findOrfail($id);
    	
        $cart->borrower_id = $request->borrower_id;
        
        $cart->status = $request->status;
        
        
        $cart->save();

        return redirect('cart');
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
        $msg = Ajaxis::BtDeleting('Warning!!','Would you like to remove This?','/cart/'. $id . '/delete');

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
     	$cart = Cart::findOrfail($id);
     	$cart->delete();
    }

    public function addItemMsg($id,Request $request)
    {
        $msg = Ajaxis::BtDeleting('Add Item','Would you like to add this item to your cart?','/cart/add/'. $id);

        if($request->ajax())
        {
            return $msg;
        }
    }

    public function addItem($itemID, Request $request){
            $defStatus = '0';
            $subject = '';
            //get the id_no of user logged in
            $userid = Auth::user()->id_no;

            //get the cart of user where status is draft
            $cart_id = DB::table('carts')->where('borrower_id','=', $userid)->where('status','Draft')->value('id');


            if(is_null($cart_id)){
                $cart_id = DB::table('carts')->insertGetId(
                    ['borrower_id' => $userid, 'status' => 'Draft', 'subject' => $subject]
                );                
            }
            $countQtyItem = DB::table('cart_items')->where('cart_id',$cart_id)->where('item_id', $itemID)->count();

            if($countQtyItem == 0){
                    DB::table('cart_items')->insert([
                    ['cart_id' => $cart_id, 'item_id' => $itemID, 'qty' => 1, 'status' => $defStatus]
                    ]);
                }

            else{
                DB::table('cart_items')->where('cart_id',$cart_id)->where('item_id', $itemID)->increment('qty');
            }
    }

    public function checkout($cart_id, Request $request){
        $subject = $request->get('subject');
        $groupmembers = $request->get('groupmembers');
        //get the id_no of user logged in
        $userid = Auth::user()->id_no;
        //get the current time and date (needs to fix timezone)
        $date = date('Y-m-d H:i:s');

        //before checkout, check if user has active transaction either pending, or released, if the user has, display error message

        $transaction_id = DB::table('transactions')->insertGetId(
            ['cart_id' => $cart_id, 'submitted_at' => $date]
        );
        DB::table('carts')
            ->where('id', $cart_id)
            ->where('borrower_id',$userid)
            ->update(['status' => 'Pending', 'subject' => $subject]);

        $dataSet = [];
        foreach ($groupmembers as $member) {
            $dataSet[] = [
                'cart_id'    => $cart_id,
                'user_id'       => $member,
            ];
            }

        DB::table('group_members')->insert($dataSet);
        
        return redirect('/home');
    }
}