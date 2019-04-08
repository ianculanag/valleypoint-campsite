@extends('layouts.app')

@section('content')
<div class="container" style="position:fixed;">
    <div class="pt-3 pb-3">
        <a href="#">
            <span style="float:left;">
                <i class="fa fa-chevron-left" aria-hidden="true"></i>
                <strong>Back</strong>
            </span>
        </a>
        <h3 class="text-center">Services</h3>
    </div>
    <div class="col-md-12">
        <table id="usersTable" data-order='[[ 1, "asc" ]]' class="table table-sm dataTable stripe compact" cellspacing="0">
            <thead>
                <tr>                   
                    <th>ID</th>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Price (lean)</th>
                    <th>Price (peak)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                    @if(count($services) > 0)
                    @foreach($services as $service)
                <tr>          
                    <td>{{$service->id}}</td>
                    <td>{{$service->serviceType}}</td>
                    <td>{{$service->serviceName}}</td>
                    <td>{{$service->price}}</td>
                    <td>{{$service->leanPrice}}</td>
                    <td>{{$service->peakPrice}}</td>
                    <td><button class="btn btn-sm btn-info">Edit</button>
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
                    @endforeach
                    @endif
            </tbody>
        </table>
    </div>
</div> 
@endsection