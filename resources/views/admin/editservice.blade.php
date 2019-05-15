@extends('layouts.app')

@section('content')
    <div class="container pb-5">
        <div class="pt-3 pb-3 text-center">
            <a href="{{ URL::previous() }}">
                <span style="float:left;">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    <strong>Back</strong>
                </span>
            </a>
        </div> 
        @foreach ($services as $service)       
        <form method="POST" action="/update-service">
            @csrf
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">     
            <input style="display:none" class="form-control" type="text" name="serviceID" value="{{$service->serviceID}}">
            <div class="col-md-6 offset-md-3">
                <div class="card col-md-10 offset-md-1 py-4 ">
                    <div class="card-body">
                        <div class="pb-4 text-center">
                            <h3>Service Details</h3>
                        </div>
                        <div class="form-group row">
                            <label for="serviceType" class="col-md-4 col-form-label">Service type</label>
                            <select class="custom-select d-block w-100 col-md-7 ml-3" id="serviceType" name="serviceType" required="required">
                                @if($service->serviceType == 'package')
                                    <option value="package" selected>Package</option>
                                    <option value="service">Service</option>
                                    <option value="damage">Damage</option>
                                    <option value="extra">Extra</option>
                                @elseif($service->serviceType == 'service')
                                    <option value="package">Package</option>
                                    <option value="service" selected>Service</option>
                                    <option value="damage">Damage</option>
                                    <option value="extra">Extra</option>
                                @elseif($service->serviceType == 'damage')
                                    <option value="package">Package</option>
                                    <option value="service">Service</option>
                                    <option value="damage" selected>Damage</option>
                                    <option value="extra">Extra</option>
                                @elseif($service->serviceType == 'extra')
                                    <option value="package">Package</option>
                                    <option value="service">Service</option>
                                    <option value="damage">Damage</option>
                                    <option value="extra" selected>Extra</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="serviceName" class="col-md-4 col-form-label">Service name</label>
                            <input type="text" required="required" class="form-control col-md-7 ml-3" name="serviceName" placeholder="" minlength=5 maxlength=20 value="{{$service->serviceName}}">
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label">Price</label>
                            <div class="input-group col-md-8">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="number" step="50" required="required" class="form-control" name="price" placeholder="" min=50 max=99999 value="{{$service->price}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="leanPrice" class="col-md-4 col-form-label">Price (lean)</label>
                            <div class="input-group col-md-8">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="number" step="50" required="required" class="form-control" name="leanPrice" placeholder="" min=50 max=99999 value="{{$service->leanPrice}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="peakPrice" class="col-md-4 col-form-label">Price (peak)</label>
                            <div class="input-group pb-3 col-md-8">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="number" step="50" required="required" class="form-control" name="peakPrice" placeholder="" min=50 max=99999 value="{{$service->peakPrice}}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-block btn-success mt-4">Update</button>
                    </div>
                </div>
            </div>
        </form>
        @endforeach
    </div>
@endsection