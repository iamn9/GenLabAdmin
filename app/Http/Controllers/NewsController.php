<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News;
use URL;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {

         $searchWord = \Request::get('search');
         /*
         $news = News::where('news','like','%'.$searchWord.'%')->orWhere('reporter_id','like','%'.$searchWord.'%')->orderBy('date_posted')->paginate(5)->appends(Input::except('page'));*/
         $news = News::join('users', function($join){
                $join->on('news.reporter_id', '=', 'users.id_no');
            })
            ->when($searchWord, function ($query) use ($searchWord) {
                return $query->where('news.id','ilike','%'.$searchWord.'%')
                ->orWhere('users.name', 'ilike','%'.$searchWord.'%')
                ->orWhere('news.news', 'ilike','%'.$searchWord.'%');
            })
            ->select('news.id','news.date_posted','news.news','users.name')
            ->orderBy('news.date_posted','desc')
            ->paginate(5)->appends(Input::except('page'));

       /* $news = News::join('users', function ($join) {
            $join->on('news.reporter_id', '=', 'users.id_no');})
            ->select('news.news', 'users.name','news.date_posted')
            ->orderBy('news.date_posted','asc')->paginate(5)->appends(Input::except('page'));
        */
       /* $news = News::join('users', function($join){
                $join->on('news.reporter_id', '=', 'users.id_no');
            })
            ->when($searchWord, function ($query) use ($searchWord) {
                return $query->where('news.reporter_id','ilike','%'.$searchWord.'%')
                ->orWhere('users.name', 'ilike','%'.$searchWord.'%');
            })
            ->select('news.id','news.reporter_id','news.news','users.name', 'news.date_posted')
            ->paginate(5)->appends(Input::except('page'));
        */

        if(Auth::check() && Auth::user()->isAdmin)
            return view('news.index',compact('news','searchWord')); 
        else
            return view('news.user_index',compact('news','searchWord')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - news';
        
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
        //may pa bug
        $news = new News();
        $news->news = $request->news;
        $news->reporter_id = $request->reporter_id;
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
        $title = 'Show - news';

        if($request->ajax()){
            return URL::to('news/'.$id);
        }

        $news = News::findOrfail($id);
        return view('news.show',compact('title','news'));
    }

    public function showModal($id, Request $request){
        $news = News::findOrfail($id);
        // $msg = Ajaxis::BtDisplay("Item Info",
        // [
        //     ['key' => 'ID', 'value' => $item->id],
        //     ['key' => 'Name', 'value' => $item->name],
        //     ['key' => 'Description', 'value' => $item->description],
        // ]);
        if($request->ajax())
        {
            return $msg;
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
        $title = 'Edit - news';
        if($request->ajax())
        {
            return URL::to('news/'. $id . '/edit');
        }

        $news = News::findOrfail($id);
        return view('news.edit',compact('title','news'  ));
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
        $create = News::findOrfail($id);
    	$create->news = $request->news;
        $create->reporter_id = $request->reporter_id;
        $create->save();

        return redirect('news');
    }

    public function DeleteMsg($id,Request $request)
    {
        $news = News::findOrFail($id);
        $notif = 'toastr["info"](" News no. '.$news->id.' was successfully deleted from the system")';
        $msg = '<script>
        bootbox.confirm({
            title: "<b>Delete '.$news->id.'</b> from the system",
            message: "Warning! Are you sure you want to delete this Item?",
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
                        url: "/item/'.$id.'/delete"
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
     	$news = News::findOrfail($id);
     	$news->delete();
        return URL::to('news');
    }
}
