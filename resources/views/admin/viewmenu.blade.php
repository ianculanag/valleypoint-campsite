@extends('layouts.app')

@section('content')
<div class="container-fluid pb-5 px-5">
    <h3 class="text-center pb-4"> Restaurant Menu </h3>
    <div class="row">
        <div class="col-md-8">
            <div class="container row py-0 mx-0 px-0">
                <div class="col-md-3 offset-9 px-0 float-right">
                    <div class="form-group my-1 row">
                        <label class="col-sm-2  pl-3 pt-1" for="queueNumber"><span class="fa fa-search text-secondary"></span></label>
                        <div class="input-group input-group-sm px-0 mx-0 col-sm-10">
                            <input class="form-control" type="text" name="searchFoodItem" id="searchFoodItem" min="1" max="50" placeholder="" value="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 pr-0 rounded-0">
                    <div class="list-group rounded-0">
                        <a href="#" id="allProducts" class='rounded-left rounded-0 list-group-item makeorder active' style="color:black">All</a>
                        @foreach($categories as $category)
                        @php
                            $displayNameSplit = preg_split('/(?=[A-Z])/', ucfirst($category)); 
                            $displayName = '';

                            for($index = 0; $index < count($displayNameSplit); $index++) {
                                if(($index) + 1 == count($displayNameSplit)) {
                                    $displayName .= $displayNameSplit[$index];
                                } else {
                                    $displayName .= $displayNameSplit[$index].' ';                                        
                                }
                            }

                            if(!(substr($displayName, -1) == 's')) {
                                $displayName .= 's';
                            }
                        @endphp
                        <a href="#" id="{{$category}}" class='rounded-left rounded-0 list-group-item makeorder' style="color:black">{{$displayName}}</a>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-9 card m-0 ml-0 border-left-0 rounded-0 px-3" style="max-height:59.9vh;"> 
                    <div class="row p-3 scrollbar-near-moon" id="menu" style="overflow-y:auto;">
                    @foreach ($products as $product)
                    <a class="px-1 mx-1">       
                        <div class="card px-0 mx-1 menu-item" style="width:9.785rem; height:5.5em; cursor:pointer" id="{{$product->id}}">
                            <div class="card-body text-center pt-2">
                                <h6 class="card-text">
                                    {{$product->productName}}
                                </h6>
                                <p>₱ {{number_format((float)($product->price), 2, '.', '')}}</p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                    </div>    
                </div>
            </div>
        </div>
        <div class="col-md-4 order-md-12 mb-3 mx-0" >
            <div class="card p-0 m-0" style="min-height:66vh; max-height:66vh;">
                <h5 class="text-muted text-center pt-4 pb-2" id="productName">Product Recipe</h5>
                <div class="card-body p-0 m-0 scrollbar-near-moon" style="overflow-y:auto;">
                    <table class="table table-striped" style="font-size:.88em;">
                        <thead>
                            <tr>
                                <th scope="col" style="width:80%;">Description</th>
                                <th scope="col">Qty.</th>
                            </tr>
                        </thead>
                        <tbody id="orderSlip">
                            <tr id="emptyEntryHolder">
                                <td class="py-2" style="text-align:center" colspan="2">Add ingredients to the recipe</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white border-0 px-0 mx-2">
                    <div class="col-md-12 mb-1 px-1">
                        <button type="button" class="btn btn-primary btn-block" style="text-align:center;" id="editRecipe" disabled>
                            Edit Recipe
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection