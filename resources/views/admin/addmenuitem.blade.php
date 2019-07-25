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
        <form method="POST" action="/add-menu-item">
            @csrf
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">                   

            <div class="col-md-6 offset-md-3">
                <div class="card col-md-10 offset-md-1 py-4 ">
                    <div class="card-body">
                        <div class="pb-3 text-center">
                            <h3>Add Menu Item</h3>
                        </div>
                        <div class="form-group">
                            <input type="text" required="required" class="form-control" name="name" placeholder="Name" maxlength=25>
                        </div>
                        <div class="form-group pb-3">
                            <select class="custom-select d-block w-100" id="state" required="required" name="category" placeholder="Category">
                                <option value="appetizers">Appetizers</option>
                                <option value="bread">Bread</option>
                                <option value="breakfast">Breakfast</option>
                                <option value="groupMeals">Group Meals</option>
                                <option value="noodles">Noodles</option>
                                <option value="riceBowls">Rice Bowls</option>
                                <option value="soups">Soups</option>
                                <option value="specialRiceMeals">Special Rice Meals</option>
                                <option value="Extras">Extras</option>
                                <option value="Beverages">Beverages</option>
                                <option value="Liquors">Liquors</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="number" required="required" class="form-control" name="price" placeholder="Price" minlength=4 maxlength=25>
                        </div>
                        <div class="form-group">
                            <input type="number" required="required" class="form-control" name="priceGuest" placeholder="Price Guest" minlength=4 maxlength=25>
                        </div>
                        
                       
                        <button type="submit" class="btn btn-block btn-success mt-4">Add</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection