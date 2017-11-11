<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;
use Amranidev\Ajaxis\Ajaxis;
use URL;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Index - item';

        $searchWord = \Request::get('search');
        $items = Item::where('name','ilike','%'.$searchWord.'%')->orWhere('description','ilike','%'.$searchWord.'%')->orderBy('name')->paginate(5)->appends(Input::except('page'));

        if(Auth::check() && Auth::user()->isAdmin)
            return view('item.index',compact('items','title','searchWord')); 
        else
            return view('item.user_index',compact('items','title','searchWord')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - item';
        
        return view('item.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new Item();

        
        $item->name = $request->name;

        
        $item->description = $request->description;

        
        
        $item->save();

        $pusher = App::make('pusher');

        //default pusher notification.
        //by default channel=test-channel,event=test-event
        //Here is a pusher notification example when you create a new resource in storage.
        //you can modify anything you want or use it wherever.
        $pusher->trigger('test-channel',
                         'test-event',
                        ['message' => 'A new item has been created !!']);

        return redirect('item');
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
        $title = 'Show - item';

        if($request->ajax())
        {
            return URL::to('item/'.$id);
        }

        $item = Item::findOrfail($id);
        return view('item.show',compact('title','item'));
    }

    public function showModal($id, Request $request){
        $item = Item::findOrfail($id);
        $msg = Ajaxis::BtDisplay("Item Info",
        [
            ['key' => 'ID', 'value' => $item->id],
            ['key' => 'Name', 'value' => $item->name],
            ['key' => 'Description', 'value' => $item->description],
        ]);
        if($request->ajax())
        {
            return $msg;
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - item';
        if($request->ajax())
        {
            return URL::to('item/'. $id . '/edit');
        }

        $item = Item::findOrfail($id);
        return view('item.edit',compact('title','item'  ));
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
        $item = Item::findOrfail($id);
    	
        $item->name = $request->name;
        
        $item->description = $request->description;
        
        
        $item->save();

        return redirect('item');
    }

    public function DeleteMsg($id,Request $request)
    {
        $msg = Ajaxis::BtDeleting('Warning!!','Would you like to remove This?','/item/'. $id . '/delete');

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
     	$item = Item::findOrfail($id);
     	$item->delete();
        return URL::to('item');
    }
}
