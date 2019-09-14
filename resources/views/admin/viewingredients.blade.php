@extends('layouts.app')

@section('content')
    <div class="container px-4 py-0">
        <h3 class="text-center pb-2 mb-0">Ingredients</h3>
        <div class="container-fluid row">
            <a class="btn btn-sm btn-success mb-2" href="/add-category">Add category</a>
            <a class="btn btn-sm btn-success mb-2 ml-2" href="/add-ingredient">Add ingredient</a>
        </div>
        <div class="container-fluid lodging-tabs px-0">
            <ul class="nav nav-tabs pt-0" style="">
                <li class="ingredient-categories nav-item" id="allCategories">
                    <a class="categories nav-link active" id="all-categories" style="color:#505050; cursor:pointer;">All</a>
                </li>
                @foreach ($ingredientCategories as $ingredientCategory)

                @php
                    $ingredientNameSplit = preg_split('/(?=[A-Z])/', ucfirst($ingredientCategory)); 
                    $ingredientName = '';

                    for($index = 0; $index < count($ingredientNameSplit); $index++) {
                        if(($index) + 1 == count($ingredientNameSplit)) {
                            $ingredientName .= $ingredientNameSplit[$index];
                        } else {
                            $ingredientName .= $ingredientNameSplit[$index].' ';                                        
                        }
                    }
                @endphp
                <li class="ingredient-categories nav-item" id="{{$ingredientCategory}}">
                    <a class="nav-link categories" id="this-{{$ingredientCategory}}" style="color:#505050; cursor:pointer;">{{$ingredientName}}</a>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="container py-0 scrollbar-near-moon-wide" id="ingredientLibrary" style="min-height:66.5vh; max-height:66.5vh; overflow-y:auto;">
            <table data-order='[[ 1, "asc" ]]' class="table table-sm dataTable compact stripe" cellspacing="0" id="ingredientTable">
                <thead>
                    <tr>
                        <th style='width:10%'>No.</th>
                        <th style='width:50%' class="pl-3">Description</th>
                        <th style='width:25%' class="pl-3">Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="displayIngredientCategory">
                    @php
                        $ingredientCount = 0;
                    @endphp

                    @foreach($ingredients as $ingredient)

                    @php
                        $ingredientCount++;
                    @endphp

                    @php
                        $displayNameSplit = preg_split('/(?=[A-Z])/', ucfirst($ingredient->ingredientCategory)); 
                        $displayName = '';

                        for($index = 0; $index < count($displayNameSplit); $index++) {
                            if(($index) + 1 == count($displayNameSplit)) {
                                $displayName .= $displayNameSplit[$index];
                            } else {
                                $displayName .= $displayNameSplit[$index].' ';                                        
                            }
                        }
                    @endphp

                    <tr>
                        <td class="text-center pr-5">{{$ingredientCount}}</td>
                        <td class="pl-3">{{$ingredient->ingredientName}}</td>
                        <td class="pl-3">{{$displayName}}</td> 
                        <td>
                            {{-- <a href="edit-ingredient/{{$ingredient->id}}">
                                <button class="btn btn-sm btn-info">Edit</button>
                            </a> --}}
                            <a id="{{$ingredient->id}}" class="delete-ingredient-modal" data-toggle="modal" data-target="#deleteIngredientModal">
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </a>
                        </td>                           
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Delete ingredient modal -->
    <div class="modal fade" id="deleteIngredientModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
            <form id="deleteIngredientForm" class="form" method="POST">
                @csrf
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">   
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Ingredient</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="deleteIngredientModalBody">
                    </div>
                    <div class="modal-footer">
                        <a href="" id="confirmIngredientDeletion">
                            <button type="submit" class="btn btn-danger" style="width:5em;">Yes</button>
                        </a>
                        <button type="button" class="btn btn-primary" style="width:5em;" data-dismiss="modal">No</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection