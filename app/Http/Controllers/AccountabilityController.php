<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Accountability;
use URL;

class AccountabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Accountability Index';
		$searchWord = \Request::get('search');       
	         
        if (Auth::user()->isAdmin){
            $title = 'Accountability Index';
            $accountabilities = Accountability::paginate(5);
            return view('accountability.admin_index',compact('accountabilities','title','searchWord'));
        }
        else{
            $title = 'My Accountabilities';
            $accountabilities = Accountability::where('date_paid', NULL)->paginate(5);
            return view('accountability.user_index',compact('accountabilities','title','searchWord'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     *
     */
    public function destroy($id)
    {
     	$accountability = Accountability::findOrfail($id);
     	$accountability->delete();
        return URL::to('accountability/pending');
    }

    public function index_pending(){ 
        $title = 'Unpaid Accountabilities';
		$searchWord = \Request::get('search');       
	         
        $accountabilities = Accountability::where('date_paid',NULL)->paginate(5);
        return view('accountability.index_pending',compact('accountabilities','title','searchWord'));
    } 
 
    public function index_completed(){ 
        $title = 'Paid Accountabilities';
		$searchWord = \Request::get('search');       
	         
        $accountabilities = Accountability::where('date_paid','!=',NULL)->paginate(5);
        return view('accountability.index_completed',compact('accountabilities','title','searchWord'));
    } 

    public function DeleteMsg($id,Request $request)
    {
        $notif = 'toastr["info"]("Accountability #'.$id.' was successfully deleted from the system")';
        $msg = '<script>
        bootbox.confirm({
            title: "Delete Accountability #'.$id.' from the System",
            message: "Warning! Are you sure you want to remove this Accountability?",
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
                        url: "/accountability/'.$id.'/delete"
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

    public function payItem($id, Request $request){
        $date = date('F j, Y g:i A');   
        Accountability::where('id',$id)->update(['date_paid' => $date]); 
        
        \Session::flash('success','Accountability has been settled.');
        return redirect('accountability/pending');
    }

    public function undo_payment($id, Request $request){
        Accountability::where('id',$id)->update(['date_paid' => NULL]); 

        \Session::flash('info','Accountability #'.$id.' not yet settled.');
        return redirect('accountability/completed');
    }

    public function paidCart($id, Request $request){
        $date = date('F j, Y g:i A');
        $cart_id = \App\Transaction::findOrFail($id)->value('cart_id');
        $cart_items = \App\Cart_item::where('cart_id',$cart_id)->get();

        foreach($cart_items as $cart_item){
            $accountability = new Accountability();
            $accountability->trans_id = $id;
            $accountability->cart_id = $cart_id;
            $accountability->item_id = $cart_item->item_id;
            $accountability->date_incurred = date('F j, Y g:i A');
            $accountability->date_paid = date('F j, Y g:i A');
            $accountability->amount = $cart_item->getFee();
            if($cart_item->getFee() != 0)
                $accountability->save();
        }

        \App\Cart::where('id', $cart_id)->update(['status' => 'Completed']); 
        \App\Transaction::where('id',$id)->update(['completed_at' => $date]); 
                                
        \Session::flash('success','Accountability was paid.');
        return redirect('transaction/released'); 
    }

    public function recordBill($id, Request $request){
        $date = date('F j, Y g:i A');
        $cart_id = \App\Transaction::findOrFail($id)->value('cart_id');
        $cart_items = \App\Cart_item::where('cart_id',$cart_id)->get();

        foreach($cart_items as $cart_item){
            $accountability = new Accountability();
            $accountability->trans_id = $id;
            $accountability->cart_id = $cart_id;
            $accountability->item_id = $cart_item->item_id;
            $accountability->date_incurred = date('F j, Y g:i A');
            $accountability->amount = $cart_item->getFee();
            if($cart_item->getFee() != 0)
                $accountability->save();
        }

        \App\Cart::where('id', $cart_id)->update(['status' => 'Completed']); 
        \App\Transaction::where('id',$id)->update(['completed_at' => $date]); 
                                
        \Session::flash('success','Bill set as accountability.');
        return redirect('transaction/released'); 
    }
}
