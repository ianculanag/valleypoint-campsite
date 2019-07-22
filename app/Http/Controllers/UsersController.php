<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use DB;

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
        ->orderBy('id', 'ASC')
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
    public function addNewUser(Request $request)
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
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'contactNumber' => 'required',
            'email' => 'required|email',
            'role' => 'required'
        ]);

        $user = new User;
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->password = Hash::make($request->input['password']);
        $user->contactNumber = $request->input('contactNumber');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->save();

        return redirect('/view-users');
    }

    public function viewUserInfo($userId){
        $userInfo = DB::table('users')
        ->select('username', 'name', 'role', 'contactNumber', 'email')
        ->where('id', '=', $userId)
        ->get();
        return view('admin.editUser')->with('userInfo', $userInfo);
    }

    /**
     * Show the add user form
     *
     * @return \Illuminate\Http\Response
     */
    public function showAddNewUserForm()
    {
        $users = DB::table('users')
        ->get(); 

        return view('admin.adduser')->with('users', $users);
    }
}
