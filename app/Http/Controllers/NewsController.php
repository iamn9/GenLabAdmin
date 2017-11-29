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
        $title = 'News Index';
        $searchWord = \Request::get('search');
        $news = News::join('users', function($join){
            $join->on('news.reporter_id', '=', 'users.id_no');
        })
        ->when($searchWord, function ($query) use ($searchWord) {
            return $query
            ->where('users.name', 'ilike','%'.$searchWord.'%')
            ->orWhere('news.content', 'ilike','%'.$searchWord.'%');
        })
        ->select('news.id','news.date_posted','news.content','users.name', 'news.type', 'news.title')
        ->orderBy('news.date_posted','desc')
        ->paginate(5)->appends(Input::except('page'));

        if(Auth::check() && Auth::user()->isAdmin)
            return view('news.index',compact('news','searchWord', 'title')); 
        else
            return view('news.user_index',compact('news','searchWord','title')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create News Post';
        return view('news.create',compact('title'));
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
        $news->title =  $request->title;
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
        $title = 'Show News';
        $news = News::join('users', function($join){
            $join->on('news.reporter_id', '=', 'users.id_no');
        })->select('news.id','news.date_posted','news.content','users.name','news.title')->findOrfail($id);

        return view('news.show',compact('title','news'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit News';
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
        $news = News::findOrfail($id);
        $news->content = $request->content;
        $news->title =  $request->title;
        $news->save();

        return redirect('news');
    }

    public function DeleteMsg($id,Request $request)
    {
        $news = News::findOrFail($id);
        $notif = 'toastr["info"](" News #'.$news->id.' was successfully deleted from the system")';
        $msg = '<script>
        bootbox.confirm({
            title: "<b>Delete News #'.$news->id.'</b> from system",
            message: "Warning! Are you sure you want to delete this news?",
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
                        url: "/news/'.$id.'/delete"
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
