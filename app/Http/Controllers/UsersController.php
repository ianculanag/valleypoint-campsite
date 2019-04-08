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
        /*$data = $request->validate([
            'name' => 'required|max:25',
            'username' => 'required|max:15',
            'password' => 'required|min:6|max:25',
            'contactNumber' => 'required|min:11|max:11',
            'email' => 'required|email|min:10|max:25',
            'role' => 'required',
        ]);

        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'contactNumber' => $data['contactNumber'],
            'email' => $data['email'],
        ]);*/


        $this->validate($request, [
            'name' => 'required|max:25',
            'username' => 'required|max:15',
            'password' => 'required|min:6|max:25',
            'contactNumber' => 'required|min:11|max:11',
            'email' => 'required|email|min:10|max:25',
            'role' => 'required'
        ]);

        $user = new Users;
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->password = $request->input('password');
        $user->contactNumber = $request->input('contactNumber');
        $user->email = $request->input('email');
        $user->save();

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
