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
        /*$users = User::sortable()->paginate(5);
        return view('admin.viewusers',compact('users'))->with('users', $users);*/
    }

    /**
     * Add user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addUser(Request $request)
    {
        $this->validate($request, [
            'contactNumber' => 'required|min:11|max:11',
            'firstName' => 'required|max:30',
            'lastName' => 'required|max:30'
        ]);

        $user = new User;
        $guest->lastName = $request->input('lastName');
        $guest->firstName = $request->input('firstName');
        $guest->contactNumber = $request->input('contactNumber');
        $guest->save(); 

        return redirect('/view-users');
    }

    /**
     * Show the add user form
     *
     * @return \Illuminate\Http\Response
     */
    public function showAddUserForm()
    {
        $users = DB::table('users')
        ->get(); 

        return view('admin.adduser')->with('users', $users);
    }
}
