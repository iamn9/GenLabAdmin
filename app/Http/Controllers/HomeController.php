<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $news = \App\News::orderBy('news.date_posted','desc')->limit(5)->get();
        if (Auth::user()->isAdmin){
            $accountabilities = \App\Accountability::where('date_paid', NULL)->get();
            $transactions = \App\Transaction::where('prepared_at', NULL)->get();
            $users = DB::table('users')->where('isActivated','0')->get();
            return view('admin_dashboard',compact('users','transactions','accountabilities'));
        }
        else  
        {
            $cur_user = (Auth::user()->id_no);
            $count_pendingCarts = DB::table('carts')->where('borrower_id',$cur_user)->where('status','Pending')->count();
            $count_unreturnedCarts = DB::table('carts')->where('borrower_id',$cur_user)->where('status','Released')->count();
            $count_readyCarts = DB::table('carts')->where('borrower_id',$cur_user)->where('status','Prepared')->count();
            $transactions = DB::table('transactions')->join('carts','transactions.cart_id' ,'=', 'carts.id')->join('users','carts.borrower_id','=','users.id_no')->where('users.id_no','=', $cur_user)->orderBy('transactions.submitted_at', 'desc')->limit(5)->get();
            return view('user_dashboard', compact('transactions','news','count_pendingCarts','count_unreturnedCarts','count_readyCarts'));
        }
    }
}