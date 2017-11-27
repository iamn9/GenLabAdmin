<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;
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
        $title = 'Item Index';

        $searchWord = \Request::get('search');
        $items = Item::where('name','like','%'.$searchWord.'%')->orWhere('description','like','%'.$searchWord.'%')->orderBy('name')->paginate(5)->appends(Input::except('page'));

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
        $title = 'Create Item';
        
        return view('item.create', compact('title'));
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
        $title = 'Show Item';

        if($request->ajax())
        {
            return URL::to('item/'.$id);
        }

        $item = Item::findOrfail($id);
        return view('item.show',compact('title','item'));
    }

    public function showModal($id, Request $request){
        $item = Item::findOrfail($id);
        // $msg = Ajaxis::BtDisplay("Item Info",
        // [
        //     ['key' => 'ID', 'value' => $item->id],
        //     ['key' => 'Name', 'value' => $item->name],
        //     ['key' => 'Description', 'value' => $item->description],
        // ]);
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
        $title = 'Edit Item';
        if($request->ajax())
        {
            return URL::to('item/'. $id . '/edit');
        }

        $item = Item::findOrfail($id);
        return view('item.edit',compact('title','item'));
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
        $item = Item::findOrFail($id);
        $notif = 'toastr["info"]("'.$item->name.' was successfully deleted from the system")';
        $msg = '<script>
        bootbox.confirm({
            title: "<b>Delete '.$item->name.'</b> from the system",
            message: "Warning! Are you sure you want to delete this Item?",
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
                        url: "/item/'.$id.'/delete"
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
     	$item = Item::findOrfail($id);
     	$item->delete();
        return URL::to('item');
    }
}
