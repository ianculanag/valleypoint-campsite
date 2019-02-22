@extends('layouts.app')

@section('content')
    <h1>Lodging Monitoring</h1>
    @if(count($units) > 0)
    <h2>Rooms</h2>
        @foreach($units as $unit)
            {{--insert frontend here--}}
            @if($unit->unitType == 'room')
            <div class="card">
                    <h3><a href="/units/{{$unit->id}}">{{$unit->unitNumber}}<a></h3>
                    <p>Capacity: {{$unit->capacity}}</p>
                    <p>Status: {{$unit->status}}</p>
                    <p>Type: {{$unit->unitType}}</p>
            </div>
            @endif
        @endforeach
        <h2>tent</h2>
        @foreach($units as $unit)
        {{--insert frontend here--}}
        @if($unit->unitType == 'tent')
        <div class="card">
                <h3><a href="/units/{{$unit->id}}">{{$unit->unitNumber}}<a></h3>
                <p>Capacity: {{$unit->capacity}}</p>
                <p>Status: {{$unit->status}}</p>
                <p>Type: {{$unit->unitType}}</p>
        </div>
        @endif
    @endforeach
        {{--$units->links()--}}
    @else
        <p>No units found</p>
    @endif
@endsection
 