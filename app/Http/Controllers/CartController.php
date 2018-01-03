<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use URL;
use App\Cart;
use App\Cart_item;
use App\Transaction;
use App\Item;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Cart Index';
        $searchWord = \Request::get('search');
        if(Auth::user()->isAdmin){
            $carts = Cart::join('users', function($join){
                $join->on('carts.borrower_id', '=', 'users.id_no');
            })
            ->when($searchWord, function ($query) use ($searchWord) {
                return $query->where('carts.borrower_id','like','%'.$searchWord.'%')
                ->orWhere('users.name', 'ilike','%'.$searchWord.'%');
            })
            ->select('carts.id','carts.borrower_id','carts.status', 'carts.remarks', 'users.name')
            ->paginate(5)->appends(Input::except('page'));
            return view('cart.index',compact('carts','title','searchWord'));
        }
        else{
            $searchInt = (int) $searchWord;
            $userid = Auth::user()->id_no;
            $cart_id = Cart::where('borrower_id','=', $userid)->where('status','Draft')->value('id');
            $cart_items = Cart_item::join('items', function($join){
                $join->on('cart_items.item_id', '=', 'items.id');
            })
            ->where('cart_id','=',$cart_id)
            ->when($searchWord, function ($query) {
                return $query->where('name','ilike','%'.$searchWord.'%')->orWhere('item_id','=',$searchInt);
            })
            ->select('cart_items.*','items.name')
            ->orderBy('items.name')
            ->paginate(10)->appends(Input::except('page'));
            $remarks = Cart::where('id',$cart_id)->value('remarks');
            return view('cart.user_active',compact('title','searchWord','cart_id','cart_items', 'students','remarks'));
        }
    }

    public function index_draft(){
        $title = 'Carts on Draft';
        $searchWord = \Request::get('search');
        if(Auth::user()->isAdmin){
            $carts = Cart::join('users', function($join){
                $join->on('carts.borrower_id', '=', 'users.id_no');
            })
            ->when($searchWord, function ($query) use ($searchWord) {
                return $query->where('carts.borrower_id','like','%'.$searchWord.'%')
                ->orWhere('users.name', 'ilike','%'.$searchWord.'%');
            })
            ->where('status','=','Draft')
            ->select('carts.id','carts.borrower_id','carts.status', 'carts.remarks','users.name')
            ->paginate(5)->appends(Input::except('page'));
            return view('cart.index',compact('carts','title','searchWord'));
        }
        else
            return redirect('home');
    }

    public function index_pending(){
        $title = 'Pending Carts';
        $searchWord = \Request::get('search');
        if(Auth::user()->isAdmin){
            $carts = Cart::join('users', function($join){
                $join->on('carts.borrower_id', '=', 'users.id_no');
            })
            ->when($searchWord, function ($query) use ($searchWord) {
                return $query->where('carts.borrower_id','like','%'.$searchWord.'%')
                ->orWhere('users.name', 'ilike','%'.$searchWord.'%');
            })
            ->where('status','=','Pending')
            ->select('carts.id','carts.borrower_id','carts.status', 'carts.remarks', 'users.name')
            ->paginate(5)->appends(Input::except('page'));
            return view('cart.index',compact('carts','title','searchWord'));
        }
        else
            return redirect('home');
    }

    public function index_prepared(){
        $title = 'Prepared Carts';
        $searchWord = \Request::get('search');
        if(Auth::user()->isAdmin){
            $carts = Cart::join('users', function($join){
                $join->on('carts.borrower_id', '=', 'users.id_no');
            })
            ->when($searchWord, function ($query) use ($searchWord) {
                return $query->where('carts.borrower_id','like','%'.$searchWord.'%')
                ->orWhere('users.name', 'ilike','%'.$searchWord.'%');
            })
            ->where('status','=','Prepared')
            ->select('carts.id','carts.borrower_id','carts.status', 'carts.remarks', 'users.name')
            ->paginate(5)->appends(Input::except('page'));
            return view('cart.index',compact('carts','title','searchWord'));
        }
        else
            return redirect('home');
    }

    public function index_released(){
        $title = 'Released Carts';
        $searchWord = \Request::get('search');
        if(Auth::user()->isAdmin){
            $carts = Cart::join('users', function($join){
                $join->on('carts.borrower_id', '=', 'users.id_no');
            })
            ->when($searchWord, function ($query) use ($searchWord) {
                return $query->where('carts.borrower_id','like','%'.$searchWord.'%')
                ->orWhere('users.name', 'ilike','%'.$searchWord.'%');
            })
            ->where('status','=','Released')
            ->select('carts.id','carts.borrower_id','carts.status', 'carts.remarks', 'users.name')
            ->paginate(5)->appends(Input::except('page'));
            return view('cart.index',compact('carts','title','searchWord'));
        }
        else
            return redirect('home');
    }

    public function index_completed(){
        $title = 'Completed Carts';
        $searchWord = \Request::get('search');
        if(Auth::user()->isAdmin){
            $carts = Cart::join('users', function($join){
                $join->on('carts.borrower_id', '=', 'users.id_no');
            })
            ->when($searchWord, function ($query) use ($searchWord) {
                return $query->where('carts.borrower_id','like','%'.$searchWord.'%')
                ->orWhere('users.name', 'ilike','%'.$searchWord.'%');
            })
            ->where('status','=','Completed')
            ->select('carts.id','carts.borrower_id','carts.status', 'carts.remarks', 'users.name')
            ->paginate(5)->appends(Input::except('page'));
            return view('cart.index',compact('carts','title','searchWord'));
        }
        else
            return redirect('home');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create Cart';
        
        return view('cart.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'borrower_id' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            \Session::flash('error','<b>Error: </b><br>Make sure to fill in the required fields.');
            return redirect('cart/create');
        }
        
        $cart = new Cart();
        $cart->borrower_id = $request->borrower_id;
        $cart->status = $request->status;
        $cart->remarks = $request->remarks;
        $cart->save();
        
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
        $title = 'Show Cart';

        if($request->ajax())
        {
            return URL::to('cart/'.$id);
        }

        $searchWord = \Request::get('search');
        
        $cart_items = Cart_item::join('items', function($join){
                $join->on('cart_items.item_id', '=', 'items.id');
            })
            ->when($searchWord, function ($query) {
                return $query->where('name','ilike','%'.$searchWord.'%')->orWhere('item_id','=',$searchInt);
            })
            ->select('items.name','cart_items.*')
            ->where('cart_id',$id)
            ->orderBy('items.name')
            ->paginate(10)->appends(Input::except('page'));

        if(Auth::user()->isAdmin){
            $cart = Cart::findOrfail($id);
            return view('cart.admin_show',compact('searchWord','title','cart','cart_items'));
        }else{
            $cart = Cart::where('borrower_id','=',Auth::user()->id_no)->findOrfail($id);
            return view('cart.user_show',compact('searchWord','title','cart','cart_items'));
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
        $title = 'Edit - cart';
        if($request->ajax())
        {
            return URL::to('cart/'. $id . '/edit');
        }

        $cart = Cart::findOrfail($id);
        return view('cart.edit',compact('title','cart'));
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
        $cart->remarks = $request->remarks;
        $cart->save();

        return redirect('cart');
    }

    public function DeleteMsg($id,Request $request)
    {
        $notif = 'toastr["info"]("Cart # '.$id.' was successfully deleted from the system")';
        $msg = '<script>
        bootbox.confirm({
            title: "Delete Cart #'.$id.' from the system",
            message: "Warning! Are you sure you want to remove this Cart?",
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
                        url: "/cart/'.$id.'/delete"
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
     	$cart = Cart::findOrfail($id);
     	$cart->delete();
    }

    public function addItemMsg($id,Request $request)
    {
        $item = Item::findOrFail($id);
        $notif = 'toastr["success"]("'.$item->name.' successfully added to cart.","Success")';
        $msg = '<script>bootbox.prompt({ 
            title: "Add <b>qty of '.$item->name.'</b> to cart",
            inputType: "number",
            value: "1",
            buttons: {
                confirm: {
                    label: "Add to Cart",
                    className: "btn-success"
                },
                cancel: {
                    label: "Cancel"
                }
            },
            callback: function(result){
                if (result>=1){
                    '.$notif.'
                    $.ajax({
                        type: "GET",
                        url: "/cart/add/'.$id.'?qty="+result
                    });          
                }
            }
          })</script>';
          
        if($request->ajax()){
            return $msg;
        }
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
            }
            $countQtyItem = DB::table('cart_items')->where('cart_id',$cart_id)->where('item_id', $itemID)->count();

            if($countQtyItem == 0){
                    DB::table('cart_items')->insert([
                    ['cart_id' => $cart_id, 'item_id' => $itemID, 'qty' => $request->qty]
                    ]);
                }

            else{
                DB::table('cart_items')->where('cart_id',$cart_id)->where('item_id', $itemID)->increment('qty',$request->qty);
            }
    }

    public function checkout($cart_id, Request $request){
        //get the id_no of user logged in
        $userid = Auth::user()->id_no;
        //get the current time and date (needs to fix timezone)
        $date = date('Y-m-d H:i:s');

        $item_count = Cart_item::where('cart_id',$cart_id)->count();
        if($item_count == 0){
            return redirect('cart');
        }

        $transaction_id = DB::table('transactions')->insertGetId(
            ['cart_id' => $cart_id, 'submitted_at' => $date]
        );
        DB::table('carts')
            ->where('id', $cart_id)
            ->where('borrower_id',$userid)
            ->update(['status' => 'Pending', 'remarks'=> $request->remarks]);
        return redirect('/home');
    }
}