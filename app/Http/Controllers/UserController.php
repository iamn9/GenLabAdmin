<?php

namespace App\Http\Controllers;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Users Index";
        if (Auth::user()->isAdmin) {
            $searchWord = \Request::get('search');
            $users = \App\User::where('name', 'like', '%' . $searchWord . '%')
            ->orWhere('email', 'like', '%' . $searchWord . '%')
            ->orWhere('id_no', 'like', '%' . $searchWord . '%')
            ->orderBy('name')->get();
            return view('users.index', compact('title', 'users', 'searchWord'));
        } else {
            return redirect('home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create User';
        return view('users.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'id_no' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            \Session::flash('error', '<b>Error: </b><br>Make sure to fill in the required fields.');
            return redirect('user/create');
        }

        $user = new \App\User();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->id_no = $request->id_no;
        $user->password = Hash::make($request->password);
        if ($request->isAdmin == 'on')
            $user->isAdmin = 1;
        else
            $user->isAdmin = 0;
        if ($request->isActivated == 'on')
            $user->isActivated = 1;
        else
            $user->isActivated = 0;
        $user->save();

        return redirect('users');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = \App\User::findOrfail($id);
        $title = 'Edit User';
        return view('users.edit', compact('user', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = \App\User::findOrfail($request->user_id);

        $user->email = $request->email;
        $user->name = $request->name;
        $user->id_no = $request->id_no;
        if ($request->password != "")
            $user->password = Hash::make($request->password);
        if ($request->isAdmin == 'on')
            $user->isAdmin = 1;
        else
            $user->isAdmin = 0;
        if ($request->isActivated == 'on')
            $user->isActivated = 1;
        else
            $user->isActivated = 0;
        $user->save();

        return redirect('users');
    }

    public function DeleteMsg($id, Request $request)
    {
        $user = \App\User::findOrfail($id);
        $notif = 'toastr["info"]("User <b>' . $user->name . '</b> was successfully deleted from the system")';
        $msg = '<script>
        bootbox.confirm({
            title: "Delete User <b>' . $user->name . '</b> from the system",
            message: "Warning! Are you sure you want to remove this User?",
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
                    $("#" + ' . $id . ').remove();
                    ' . $notif . '
                    $.ajax({
                        type: "GET",
                        url: "/users/delete/' . $id . '"
                    });          
                }
            }
        });
        </script>';
        if ($request->ajax()) {
            return $msg;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = \App\User::findOrfail($id);

        $user->delete();

        return redirect('users');
    }

    public function showUnactivated()
    {
        $title = 'Unactivated Users';

        if (Auth::user()->isAdmin) {
            $searchWord = \Request::get('search');
            $users = \App\User::where(function ($query) {
                $query->where('isActivated', 0);
            })->where(function ($query) use ($searchWord) {
                $query->where('name', 'like', '%' . $searchWord . '%')
                    ->orWhere('email', 'like', '%' . $searchWord . '%')
                    ->orWhere('id_no', 'like', '%' . $searchWord . '%');
            })->get();

            return view('users.index', compact('title', 'users', 'searchWord'));
        } else {
            return redirect('home');
        }
    }

    public function showAdmins()
    {
        $title = 'Admin Accounts';
        if (Auth::user()->isAdmin) {
            $searchWord = \Request::get('search');
            $users = \App\User::where(function ($query) {
                $query->where('isAdmin', 1);
            })->where(function ($query) use ($searchWord) {
                $query->where('name', 'like', '%' . $searchWord . '%')
                    ->orWhere('email', 'like', '%' . $searchWord . '%')
                    ->orWhere('id_no', 'like', '%' . $searchWord . '%');
            })->get();
            return view('users.index', compact('title', 'users', 'searchWord'));
        } else {
            return redirect('home');
        }
    }

    public function showUsers()
    {
        $title = 'User Accounts';
        if (Auth::user()->isAdmin) {
            $searchWord = \Request::get('search');
            $users = \App\User::where(function ($query) {
                $query->where('isAdmin', 0);
            })->where(function ($query) use ($searchWord) {
                $query->where('name', 'like', '%' . $searchWord . '%')
                    ->orWhere('email', 'like', '%' . $searchWord . '%')
                    ->orWhere('id_no', 'like', '%' . $searchWord . '%');
            })->get();
            return view('users.index', compact('title', 'users', 'searchWord'));
        } else {
            return redirect('home');
        }
    }
}
