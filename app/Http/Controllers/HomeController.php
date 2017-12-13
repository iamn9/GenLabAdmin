<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Transaction;
use App\Cart;
use App\User;
use App\News;

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
        $news = News::join('users', function ($join) {
            $join->on('news.reporter_id', '=', 'users.id_no');})->select('news.content', 'users.name','news.date_posted')->orderBy('news.date_posted','desc')->limit(5)->get();
        if (Auth::user()->isAdmin){
            $count_unactivatedUsers = DB::table('users')->where('isActivated','0')->count();
            $count_newOrders = DB::table('carts')->where('status','Pending')->count();
            $count_completed = DB::table('carts')->where('status','Completed')->count();
            $transactions = DB::table('transactions')->join('carts','transactions.cart_id' ,'=', 'carts.id')->join('users','carts.borrower_id','=','users.id_no')->orderBy('transactions.submitted_at', 'desc')->limit(5)->get();
            return view('admin_dashboard',compact('transactions','count_unactivatedUsers','count_newOrders','count_completed','news'));
        }
            else  
            {
                $cur_user = (Auth::user()->id_no);
                $transactions = DB::table('transactions')->join('carts','transactions.cart_id' ,'=', 'carts.id')->join('users','carts.borrower_id','=','users.id_no')->where('users.id_no','=', $cur_user)->limit(5)->get();
                return view('user_dashboard', compact('transactions','news'));
            }
    }
}