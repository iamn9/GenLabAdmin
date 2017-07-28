<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Transaction;
use App\Cart;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            if (Auth::user()->isAdmin){
                $count_unactivatedUsers = DB::table('users')->where('isActivated','0')->count();
                $count_newOrders = DB::table('carts')->where('status','Pending')->count();
                $count_completed = DB::table('carts')->where('status','Completed')->count();
                $transactions = DB::table('transactions')->join('carts','transactions.cart_id' ,'=', 'carts.id')->join('users','carts.borrower_id','=','users.id_no')->limit(5)->get();
                return view('admin_dashboard',compact('transactions','count_unactivatedUsers','count_newOrders','count_completed'));
            }
            else{
                if(Auth::user()->isActivated){
                    $userid = Auth::user()->id_no;
                    $cart = DB::table('carts')->where('borrower_id','=', $userid)->where('status', '!=', 'Completed')->where('status', '!=', 'Draft')->first();
                    return view('user_dashboard', compact('user', 'cart'));
                }
                else
                    return view('user_dashboard'); //replace with welcome page if code is final
            }
    }
}
