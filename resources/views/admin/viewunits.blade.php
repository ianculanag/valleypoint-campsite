@extends('layouts.app')

@section('content')
<div class="container pb-5">
    <div class="pt-1 pb-0">
        {{-- <a href="{{ URL::previous() }}">
            <span style="float:left;">
                <i class="fa fa-chevron-left" aria-hidden="true"></i>
                <strong>Back</strong>
            </span>
        </a> --}}
        @if (isset($header)) 
            <h3 class="text-center">{{$header}}</h3>
        @else
            <h3 class="text-center">Units</h3>
        @endif
    </div>
    <div class="col-md-12">
        <a class="btn btn-sm btn-success mb-2" href="/add-unit">Add unit</a>
        <table data-order='[[ 0, "asc" ]]' id="unitsTable" class="table table-sm dataTable stripe compact" cellspacing="0">
            <thead>
                <tr>                   
                    <th>ID</th>
                    <th>Unit Type</th>
                    <th>Unit Number</th>
                    <th>Capacity</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody>
                    @if(count($units) > 0)
                    @foreach($units as $unit)
                <tr>          
                    <td>{{$unit->id}}</td>
                    <td>{{$unit->unitType}}</td>
                    <td>{{$unit->unitNumber}}</td>
                    <td>{{$unit->capacity}}</td>
                    <td>
                        <a href="edit-unit/{{$unit->id}}">
                            <button class="btn btn-sm btn-info">Edit</button>
                        <a>
                        <a id="{{$unit->id}}" class="delete-unit-modal" data-toggle="modal" data-target="#deleteUnitModal">
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </a>
                        {{--<a id="{{$unit->id}}" class="delete-unit-modal" href="/confirm-unit-deletion/{{$unit->id}}">
                            <button class="btn btn-sm btn-danger">Del</button>--}}
                        </a>
                    </td>
                </tr>
                    @endforeach
                    @endif
            </tbody>
        </table>
    </div>
</div>

<!-- Delete unit modal -->
<div class="modal fade" id="deleteUnitModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
        <form id="deleteUnitForm" class="form" method="POST">
            @csrf
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">   
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Unit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="deleteUnitModalBody">
                </div>
                <div class="modal-footer">
                    <a href="" id="confirmUnitDeletion"><button type="submit" class="btn btn-danger" style="width:5em;">Yes</button></a>
                    <button type="button" class="btn btn-primary" style="width:5em;" data-dismiss="modal">No</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection