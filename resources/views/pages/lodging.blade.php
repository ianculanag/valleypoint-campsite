@extends('layouts.app')

@section('content')
    <h1>Lodging Monitoring</h1>
    @if(count($units) > 0)
        @foreach($units as $unit)
            {{--insert frontend here--}}
            <div class="card">
                <h3><a href="/units/{{$unit->id}}">{{$unit->unitNumber}}<a></h3>
                <p>Capacity: {{$unit->capacity}}</p>
                <p>Status: {{$unit->status}}</p>
            </div>
        @endforeach
        {{--$units->links()--}}
    @else
        <p>No units found</p>
    @endif
@endsection
 