<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cart;
use App\Cart_item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Amranidev\Ajaxis\Ajaxis;
use URL;

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
        if(Auth::user()->isAdmin){
            $carts = Cart::paginate(6);
            return view('cart.index',compact('carts','title'));
        }
        else{
            $userid = Auth::user()->id_no;
            $cart_id = DB::table('carts')->where('borrower_id','=', $userid)->where('status','Draft')->value('id');
            $cart_items = DB::table('cart_items')->where('cart_id','=', $cart_id)->get();
            return view('cart.user',compact('cart','title','cart_items'));
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

        $cart = Cart::findOrfail($id);
        $cart_items = DB::table('cart_items')->where('cart_id','=', $id)->get();
        //$cart_items = Cart_Item::where('cart_id','>', $id); 
        return view('cart.show',compact('title','cart','cart_items'));
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

    public function addItem($itemID, Request $request){
            //get the id_no of user logged in
            $userid = Auth::user()->id_no;

            //get the cart of user where status is draft
            $cart_id = DB::table('carts')->where('borrower_id','=', $userid)->where('status','Draft')->value('id');


            if(is_null($cart_id)){
                $cart_id = DB::table('carts')->insertGetId(
                    ['borrower_id' => $userid, 'status' => 'Draft']
                );
                DB::table('cart_items')->insert([
                    ['cart_id' => $cart_id, 'item_id' => $itemID, 'qty' => 1]
                ]);
                return redirect('/home');
            }
            else{
                DB::table('cart_items')->insert(
                    ['cart_id' => $cart_id, 'item_id' => $itemID, 'qty' => 1]
                );
                return redirect('/item');   
            }
    }
}