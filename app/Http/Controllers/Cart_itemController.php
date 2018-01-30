<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cart_item;
use URL;

class Cart_itemController extends Controller
{
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

        return redirect('cart_item');
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
        $cart_item->qty = $request->qty;
        $cart_item->save();

        $item = \App\Item::findOrFail($cart_item->item_id);

        \Session::flash('info','<b>Info: </b>Qty of '.$item->name.' successfully Updated.'); //<--FLASH MESSAGE

        return redirect()->back();
    }

    public function DeleteMsg($id,Request $request)
    {
        $cart_item = Cart_item::findOrFail($id);
        $item = \App\Item::findOrFail($cart_item->item_id);
        $notif = 'toastr["info"]("'.$item->name.' was successfully removed from cart")';
        $msg = '<script>bootbox.confirm({
            title: "<b>Remove Item from cart</b>",
            message: "Warning! Are you sure you want to remove all of the <b>'.$item->name.'</b> from the cart?",
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
                        url: "/cart_item/'. $id . '/delete"
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
     	$cart_item = Cart_item::findOrfail($id);
        $cart = $cart_item->cart_id;
     	$cart_item->delete();
    }
}
