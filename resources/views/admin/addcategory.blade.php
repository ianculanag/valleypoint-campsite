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
        <form method="POST" action="/category-added">
            @csrf
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">                   

            <div class="col-md-6 offset-md-3">
                <div class="card col-md-10 offset-md-1 py-4 ">
                    <div class="card-body">
                        <div class="pb-3 text-center">
                            <h3>Add Category</h3>
                        </div>
                        <div class="form-group">
                            <input type="text" required="required" class="form-control" name="category" placeholder="Category" maxlength=25>
                        </div>
                       
                        <button type="submit" class="btn btn-block btn-success mt-4">Add</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection