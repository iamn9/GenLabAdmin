<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Listing;
use Amranidev\Ajaxis\Ajaxis;
use URL;

/**
 * Class ListingController.
 *
 * @author  The scaffold-interface created at 2016-12-12 06:48:47am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Index - listing';
        $listings = Listing::paginate(6);
        return view('listing.index',compact('listings','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - listing';
        
        return view('listing.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $listing = new Listing();

        
        $listing->name = $request->name;

        
        $listing->description = $request->description;

        
        
        $listing->save();

        $pusher = App::make('pusher');

        //default pusher notification.
        //by default channel=test-channel,event=test-event
        //Here is a pusher notification example when you create a new resource in storage.
        //you can modify anything you want or use it wherever.
        $pusher->trigger('test-channel',
                         'test-event',
                        ['message' => 'A new listing has been created !!']);

        return redirect('listing');
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
        $title = 'Show - listing';

        if($request->ajax())
        {
            return URL::to('listing/'.$id);
        }

        $listing = Listing::findOrfail($id);
        return view('listing.show',compact('title','listing'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - listing';
        if($request->ajax())
        {
            return URL::to('listing/'. $id . '/edit');
        }

        
        $listing = Listing::findOrfail($id);
        return view('listing.edit',compact('title','listing'  ));
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
        $listing = Listing::findOrfail($id);
    	
        $listing->name = $request->name;
        
        $listing->description = $request->description;
        
        
        $listing->save();

        return redirect('listing');
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
        $msg = Ajaxis::BtDeleting('Warning!!','Would you like to remove This?','/listing/'. $id . '/delete');

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
     	$listing = Listing::findOrfail($id);
     	$listing->delete();
        return URL::to('listing');
    }
}
