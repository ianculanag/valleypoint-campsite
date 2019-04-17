@extends('layouts.app')

@section('content')
    <div class="col-md-12 text-center lodging-tabs pb-5">
        <nav class="nav nav-pills centered-pills">
            <a class="nav-item nav-link" style="color:#505050" href="/glamping">Physical View</a>
            <a class="nav-item nav-link active" style="background-color:#505050" href="/calendar">Calendar View</a>
        </nav>
    </div>
    <div class="container lodging-tabs">
        <ul class="nav nav-tabs w-100 pt-0">
            <li class="nav-item">
                <a class="nav-link active" href="/glamping/">Glamping</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color:#505050;" href="/transient-backpacker">Backpacker</a>
            </li>
        </ul>
    </div>    
    <div class="container" style="padding-top:1em;">
        <table class="table table-sm table-bordered">
        <thead>
            <tr>
            <th scope="col">Unit No.</th>            
            @if(count($dates) > 0)
            @foreach($dates as $date)
                <th scope="col" colspan="2">{{\Carbon\Carbon::parse($date)->format('M j')}}</th>
            @endforeach
            @endif
            </tr>
        </thead>
        <tbody>
            <!--tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td></td>
            </tr-->
            @if(count($units) > 0)
            @foreach($units as $unit)
                <tr>
                <td scope="row">{{$unit->unitNumber}}</td>
                @foreach($dates as $date)
                <td scope="col" id="{{$unit->unitNumber}}{{(string)$date}}AM"></td>                
                <td scope="col" id="{{$unit->unitNumber}}{{(string)$date}}PM"></td>
                @endforeach
                </tr>
            @endforeach
            @endif
        </tbody>
        </table>                  
    </div>
@endsection
 