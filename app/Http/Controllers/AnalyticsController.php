<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use URL;
use App\Cart_item;
use App\Item;
class AnalyticsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {

    //    return view('analytics.show_most_borrowed');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $news = new News();
        $news->content = $request->content;
        $news->reporter_id = Auth::user()->id_no;
        $news->date_posted =  date('Y-m-d H:i:s');
        $news->save();

        return redirect('news');
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
      
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
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
       
    }

    public function DeleteMsg($id,Request $request)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     	
    }

    public function most_borrowed(){

        //select items.name, SUM(qty) as Total from cart_items join items on items.id = cart_items.item_id group by item_id ORDER BY Total DESC LIMIT 10;
    
           $mostBorrowed = Cart_item::leftjoin('items', 'cart_items.item_id', '=', 'items.id')
                    ->select(DB::raw('items.name, SUM(cart_items.qty) as total'))
                    ->orderBy('total', 'DESC')
                    ->groupBy('items.name')
                    ->limit(5)
                    ->get();
            $borrowedArr = json_encode($mostBorrowed);
          return view('analytics.most_borrowed', compact('mostBorrowed','borrowedArr'));        
    }
   
}
