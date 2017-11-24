<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\listing_item;
use URL;

class Listing_itemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Index - listing_item';
        $searchWord = \Request::get('search');
        $listing_items = Listing_item::where('id','like','%'.$searchWord.'%')->orWhere('owner_id','like','%'.$searchWord.'%')->paginate(5)->appends(Input::except('page'));

        return view('listing_item.index',compact('listing_items','title','searchWord'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - listing_item';
        
        return view('listing_item.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $listing_item = new listing_item();
        $listing_item->listing_id = $request->listing_id;
        $listing_item->item_id = $request->item_id;
        $listing_item->qty = $request->qty;
        $listing_item->save();

        return redirect('listing_item');
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
        $title = 'Show - listing_item';

        if($request->ajax())
        {
            return URL::to('listing_item/'.$id);
        }

        $listing_item = listing_item::findOrfail($id);
        return view('listing_item.show',compact('title','listing_item'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - listing_item';
        if($request->ajax())
        {
            return URL::to('listing_item/'. $id . '/edit');
        }

        
        $listing_item = listing_item::findOrfail($id);
        return view('listing_item.edit',compact('title','listing_item'));
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
        $listing_item = listing_item::findOrfail($id);
    	
        //$listing_item->listing_id = $request->listing_id;
        
        //$listing_item->item_id = $request->item_id;
        
        $listing_item->qty = $request->qty;
        
        $listing_item->save();

        $item = \App\Item::findOrFail($listing_item->item_id);

        \Session::flash('info','<b>Info: </b>Qty of '.$item->name.' successfully Updated.'); //<--FLASH MESSAGE

        return redirect('listing');
    }

    public function DeleteMsg($id,Request $request)
    {
        $listing_item = listing_item::findOrFail($id);
        $item = \App\Item::findOrFail($listing_item->item_id);
        $notif = 'toastr["info"]("'.$item->name.' was successfully removed from listing")';
        $msg = '<script>bootbox.confirm({
            title: "<b>Remove Item from listing</b>",
            message: "Warning! Are you sure you want to remove all of the <b>'.$item->name.'</b> from the listing?",
            buttons: {
                confirm: {
                    label: "Remove",
                    className: "btn-danger"
                },
                cancel: {
                    label: "No",
                }
            },
            callback: function (result) {
                if (result){
                    $("#" + '.$id.').remove();
                    '.$notif.'
                    $.ajax({
                        type: "GET",
                        url: "/listing_item/'. $id . '/delete"
                    });
                }
            }
        })</script>';
        if($request->ajax()){
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
     	$listing_item = listing_item::findOrfail($id);
        $listing = $listing_item->listing_id;
     	$listing_item->delete();
    }
}
