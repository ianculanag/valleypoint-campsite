<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use App\Shifts;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.addusers');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);*/

        // Add user to db
        $staff = new Staff;
        $staff->username = $request->input('username');
        $staff->password = $request->input('password');
        $staff->lastName = $request->input('lastName');
        $staff->firstName = $request->input('firstName');
        $staff->role = $request->input('role');
        $staff->contactNumber = $request->input('contactNumber');
        $staff->email = $request->input('email');
        $staff->save();

        $shift = new Shifts;
        $shift->shiftStart = '2008-11-09 15:45:21';
        $shift->shiftEnd = '2008-11-09 15:45:21';
        $shift->cashStart = '3520.50';
        $shift->staffID = $staff->id;
                
        $shift->save();

        return $request; 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
