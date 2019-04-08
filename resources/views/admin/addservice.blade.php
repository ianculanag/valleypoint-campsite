@extends('layouts.app')

@section('content')
    <div class="container" style="position:fixed;">
        <div class="pt-3 pb-3 text-center">
            <a href="/view-services">
                <span style="float:left;">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    <strong>Back</strong>
                </span>
            </a>
        </div>        
        <form method="POST" action="/service-added">
            @csrf
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">                   

            <div class="col-md-4 offset-md-4 text-center">
                <div class="pt-3 pb-4 text-center">
                    <h3>Add Service</h3>
                </div>
                <div class="form-group">
                    <select class="custom-select d-block w-100" id="serviceType" name="serviceType" required="required">
                        <option value="package">Package</option>
                        <option value="service">Service</option>
                        <option value="damage">Damage</option>
                        <option value="extra">Extra</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" required="required" class="form-control" name="serviceName" placeholder="Service Name" minlength=5 maxlength=20>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">₱</span>
                        </div>
                        <input type="number" step="50" required="required" class="form-control" name="price" placeholder="Price" min=50 max=99999>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">₱</span>
                        </div>
                        <input type="number" step="50" required="required" class="form-control" name="leanPrice" placeholder="Lean Season Price" min=50 max=99999>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group pb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">₱</span>
                        </div>
                        <input type="number" step="50" required="required" class="form-control" name="peakPrice" placeholder="Peak Season Price" min=50 max=99999>
                    </div>
                </div>
                <button type="submit" class="btn btn-block btn-success mt-4">Submit</button>
            </div>
        </form>
    </div>
@endsection