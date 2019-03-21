@extends('layouts.app')

@section('content')
    <div class="py-4 text-center">
        <h3 class="text-center">Units</h3>
    </div>
    <div class="col-md-12">
        <table data-order='[[ 1, "asc" ]]' id="unitsTable" class="table table-sm dataTable stripe compact" cellspacing="0">
            <thead>
                <tr>                   
                    <th>ID</th>
                    <th>Unit Type</th>
                    <th data-class-name="priority">Unit Number</th>
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