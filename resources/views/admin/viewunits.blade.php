@extends('layouts.app')

@section('content')
    <div class="py-4 text-center">
        <h3 class="text-center">Units</h3>
    </div>
    <div class="col-md-12">
        <table id="unitsTable" class="table table-striped table-sm unitsTable" cellspacing="0">
            <thead>
                <tr>                   
                    <th scope="col" class="text-center">@sortablelink('id')</th>
                    <th scope="col">@sortablelink('unitType')</th>
                    <th scope="col">@sortablelink('unitNumber')</th>
                    <th scope="col">@sortablelink('capacity')</th>
                    <th scope="col" colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                    @if(count($units) > 0)
                    @foreach($units as $unit)
                <tr>          
                    <td class="text-center">{{$unit->id}}</td>
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
        {!! $units->appends(\Request::except('page'))->render() !!}
    </div>
@endsection