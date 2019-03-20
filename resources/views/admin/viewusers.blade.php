@extends('layouts.app')

@section('content')
    <div class="py-4 text-center">
        <h3 class="text-center">Users</h3>
    </div>
    <div class="col-md-12">
        <table id="usersTable" class="table table-striped table-sm usersTable" cellspacing="0">
            <thead>
                <tr>                   
                    <th scope="col" class="text-center">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Contact No.</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col" colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                    @if(count($users) > 0)
                    @foreach($users as $user)
                <tr>          
                    <td class="text-center">{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->username}}</td>
                    <td>{{$user->contactNumber}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role}}</td>
                    <td><button class="btn btn-sm btn-info">Edit</button>
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
                    @endforeach
                    @endif
            </tbody>
        </table>
    </div>
@endsection