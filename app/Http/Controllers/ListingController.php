<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use URL;
use App\Listing;
use App\listing_item;
use App\Transaction;
use App\Item;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $searchWord = \Request::get('search');
        if(Auth::user()->isAdmin){
            $title = 'Listing Index';
            $listings = Listing::join('users', function($join){
                $join->on('listing.owner_id', '=', 'users.id_no');
            })
            ->when($searchWord, function ($query) use ($searchWord) {
                return $query->where('listing.owner_id','like','%'.$searchWord.'%')
                ->orWhere('users.name', 'ilike','%'.$searchWord.'%');
            })
            ->select('listing.id','listing.owner_id','users.name')
            ->paginate(5)->appends(Input::except('page'));
            return view('listing.index',compact('listings','title','searchWord'));
        }
        else{
            $title = 'My Listings';
            $userid = Auth::user()->id_no;
            $listings = Listing::join('users', function($join){
                $join->on('listing.owner_id', '=', 'users.id_no');
            })
            ->when($searchWord, function ($query) use ($searchWord) {
                return $query->where('listing.owner_id','like','%'.$searchWord.'%')
                ->orWhere('users.name', 'ilike','%'.$searchWord.'%');
            })
            ->select('listing.id','listing.owner_id','users.name')
            ->where('listing.owner_id',$userid)
            ->paginate(5)->appends(Input::except('page'));
            return view('listing.index',compact('listings','title','searchWord'));
        }
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
        $listing->owner_id = $request->owner_id;
        $listing->save();
        
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
     
        if(Auth::user()->isAdmin)
            $listing = listing::findOrfail($id);
        else
            $listing = listing::where('owner_id','=',Auth::user()->id_no)->findOrfail($id);

        $searchWord = \Request::get('search');
        if ($searchWord == "")
            $listing_items = DB::table('listing_items')->paginate(5)->appends(Input::except('page'));
        else{
            $searchWord = (int) $searchWord;
            $listing_items = DB::table('listing_items')->where('item_id','like','%'.$searchWord.'%')->paginate(5)->appends(Input::except('page'));
        }
        return view('listing.show',compact('searchWord','title','listing','listing_items'));
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

        $listing = listing::findOrfail($id);
        return view('listing.edit',compact('title','listing'));
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
        $listing = listing::findOrfail($id);
        $listing->owner_id = $request->owner_id;
        $listing->save();

        return redirect('listing');
    }

    public function DeleteMsg($id,Request $request)
    {
        $notif = 'toastr["info"]("listing # '.$id.' was successfully deleted from the system")';
        $msg = '<script>
        bootbox.confirm({
            title: "Delete listing #'.$id.' from the system",
            message: "Warning! Are you sure you want to remove this listing?",
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
                        url: "/listing/'.$id.'/delete"
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
     	$listing = listing::findOrfail($id);
     	$listing->delete();
    }

    public function addItemMsg($id,Request $request)
    {
        $item = Item::findOrFail($id);
        $notif = 'toastr["success"]("'.$item->name.' successfully added to listing.","Success")';

        $form = "<form id='addToListing'><input type='hidden' name='item_id' value='".$id."'>Listing:<input class='bootbox-input bootbox-input-number form-control' name='listing_id' id='listing_id' type='text'/><br/>QTY:<input class='bootbox-input bootbox-input-number form-control' type='number' name='qty' value='1' min='1'/></form>";

        $msg = '<script>bootbox.confirm({
            message: "'.$form.'",
            title: "Add Item to Listing",
            buttons: {
                cancel: {
                    label: "Cancel",
                },
                confirm: {
                    label: "Add to Listing",
                    className: "btn-success"
                }
            },
            callback: function (result) {
                if(result)
                    '.$notif.'
                    $.ajax({
                        type: "GET",
                        url: "/listing/addItem/process",
                        data: $("#addToListing").serialize()
                    });    
            }
            })</script>';
          
        if($request->ajax()){
            return $msg;
        }
    }

    public function addItem(Request $request){
        //get the id_no of user logged in
        $userid = Auth::user()->id_no;
        $itemID = Input::get('item_id');
        $listing_id = Input::get('listing_id');
        if(is_null($listing_id)){
            $listing_id = DB::table('listing')->insertGetId(
                ['owner_id' => $userid] 
            );                
        }

        $countQtyItem = DB::table('listing_items')->where('listing_id',$listing_id)->where('item_id', $itemID)->count();
        
        if($countQtyItem == 0){
                DB::table('listing_items')->insert([
                ['listing_id' => $listing_id, 'item_id' => $itemID, 'qty' => $request->qty]
                ]);
            }
        else{
            DB::table('listing_items')->where('listing_id',$listing_id)->where('item_id', $itemID)->increment('qty',$request->qty);
        }
    }

    public function addToCart($listing_id, Request $request){
        //get the id_no of user logged in
        $userid = Auth::user()->id_no;
        //get the current time and date (needs to fix timezone)
        $date = date('Y-m-d H:i:s');

        $transaction_id = DB::table('transactions')->insertGetId(
            ['listing_id' => $listing_id, 'submitted_at' => $date]
        );
        DB::table('listings')
            ->where('id', $listing_id)
            ->where('owner_id',$userid)
            ->update(['status' => 'Pending']);

        \Session::flash('success','<b>Success</b></br>Your items have been reserved!'); //<--FLASH MESSAGE

        return redirect('/home');
    }
}