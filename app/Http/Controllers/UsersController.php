<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;

class UsersController extends Controller
{
    /**
     * Display all users.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewUsers()
    {
        $users = DB::table('users')
        ->get();

        return view('admin.viewusers')->with('users', $users);
    }
}
