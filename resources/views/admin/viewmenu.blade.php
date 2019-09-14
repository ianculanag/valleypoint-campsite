@extends('layouts.app')

@section('content')
<div class="container-fluid pb-5 px-4">
    <h3 class="text-center pb-4"> Restaurant Menu </h3>
    <div class="row">
        <div class="col-md-8">
            <div class="container row py-0 mx-0 px-0">
                <div class="col-md-9 mb-2 px-0">
                    <a class="btn btn-sm btn-success mb-2" href="/add-category">Add Category</a>
                    <a class="btn btn-sm btn-success mb-2" href="/add-menu-item">Add Menu Item</a>
                </div>
            </div>
            @if(session("deleteMessage"))
               <div class="alert alert-success">
           {{session('deleteMessage')}}
               </div>
            @endif
            <div class="row">
                <div class="col-md-3 pr-0 rounded-0">
                    <div class="list-group rounded-0">
                        <a id="allProducts" class='rounded-left rounded-0 list-group-item product-categories active py-2' style="color:black; cursor:pointer">All</a>
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
                        <a id="{{$category}}" class='rounded-left rounded-0 list-group-item product-categories py-2' style="color:black; cursor:pointer">{{$displayName}}</a>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-9 card m-0 ml-0 border-left-0 rounded-0 px-3" style="max-height:68vh;"> 
                    <div class="container px-2 pt-3 pb-1 scrollbar-near-moon-wide" id="productsLibrary" style="max-height:65vh; overflow-y:auto;">
                        <table class="table table-sm dataTable compact" cellspacing="0" id="productsTable">
                            <thead>
                                <tr>
                                    <th style="width:10%">No.</th>
                                    <th>Product Name</th>
                                    <th style="width:15%">Price</th>
                                    <th style="width:21%">Price (guest)</th>
                                </tr>
                            </thead>
                            <tbody id="displayProductCategory">
                                @php
                                    $productCount = 0;
                                @endphp

                                @foreach($products as $product)

                                @php
                                    $productCount++;
                                @endphp
                                    <tr id="{{$product->id}}" class="menuItemList" style="cursor:pointer">
                                    <td class="text-right pr-5">{{$productCount}}</td>
                                    <td class="pl-3">{{$product->productName}}</td>
                                    <td class="pl-3">{{$product->price}}</td>
                                    <td class="text-right pr-5">{{$product->guestPrice}}</td>   
                                    <!-- <td class="text-right pr-5 hide">{{$product->id}}</td>                                     -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>   
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 order-md-12 mb-3 mx-0" >
            <div class="card p-0 m-0" style="min-height:70.5vh; max-height:70.5vh;">
                <h5 class="text-muted text-center pt-4 pb-2" id="productName">Recipe</h5>
                <div class="card-body px-3 py-0 m-0 scrollbar-near-moon" style="overflow-y:auto;">
                    <table class="table my-1" style="font-size:.88em;">
                        <thead>
                            <tr>
                                <th scope="col" style="width:80%;">Description</th>
                                <th scope="col">Qty.</th>
                            </tr>
                        </thead>
                    </table>
                    <table class="table table-borderless my-1" style="font-size:.88em;">
                        <tbody id="recipe">
                            <tr id="emptyEntryHolder">
                                <td class="py-2" style="text-align:center" colspan="2">Click on a menu item to view recipe</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white border-0 px-0 mx-2">
                    <div class="col-md-12 mb-1 px-1">
                        {{-- <button type="button" href="" class="btn btn-primary btn-block" style="text-align:center;" id="editRecipe" disabled>
                            Edit Recipe
                        </button> --}}
                               <a href="/delete-item/{{$product->id}}">
                        <button type = "button" class="btn btn-sm btn-danger" style="text-align:center; width: 24.5em; height: 3em">Delete</button>
                              </a>
                        <!-- <button type="button" href="/delete-item/{{$product->id}}" class="btn btn-danger btn-block" style="text-align:center;">
                            Delete Item
                        </button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection