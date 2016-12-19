<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cart_item;
use Amranidev\Ajaxis\Ajaxis;
use URL;

/**
 * Class Cart_itemController.
 *
 * @author  The scaffold-interface created at 2016-12-13 02:19:43am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Cart_itemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Index - cart_item';
        $searchWord = \Request::get('search');
        $cart_items = Cart_item::where('id','like','%'.$searchWord.'%')->orWhere('item_id','like','%'.$searchWord.'%')->paginate(5)->appends(Input::except('page'));

        return view('cart_item.index',compact('cart_items','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - cart_item';
        
        return view('cart_item.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cart_item = new Cart_item();

        
        $cart_item->cart_id = $request->cart_id;

        
        $cart_item->item_id = $request->item_id;

        
        $cart_item->qty = $request->qty;

        
        
        $cart_item->save();

        $pusher = App::make('pusher');

        //default pusher notification.
        //by default channel=test-channel,event=test-event
        //Here is a pusher notification example when you create a new resource in storage.
        //you can modify anything you want or use it wherever.
        $pusher->trigger('test-channel',
                         'test-event',
                        ['message' => 'A new cart_item has been created !!']);

        return redirect('cart_item');
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
        $title = 'Show - cart_item';

        if($request->ajax())
        {
            return URL::to('cart_item/'.$id);
        }

        $cart_item = Cart_item::findOrfail($id);
        return view('cart_item.show',compact('title','cart_item'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - cart_item';
        if($request->ajax())
        {
            return URL::to('cart_item/'. $id . '/edit');
        }

        
        $cart_item = Cart_item::findOrfail($id);
        return view('cart_item.edit',compact('title','cart_item'  ));
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
        $cart_item = Cart_item::findOrfail($id);
    	
        $cart_item->cart_id = $request->cart_id;
        
        $cart_item->item_id = $request->item_id;
        
        $cart_item->qty = $request->qty;
        
        
        $cart_item->save();

        return redirect('cart_item');
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
        $msg = Ajaxis::BtDeleting('Warning!!','Would you like to remove This?','/cart_item/'. $id . '/delete');

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
     	$cart_item = Cart_item::findOrfail($id);
        $cart = $cart_item->cart_id;
     	$cart_item->delete();
    }
}
