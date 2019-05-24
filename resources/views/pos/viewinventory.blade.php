@extends('layouts.app')

@section('content')
    <div class="container-fluid mx-1 py-0">
        <h3 class="text-center pb-3">Inventory Library</h3>
        <div class="row px-3">
            <div class="col-md-9">
            {{--<div class="row px-3">
                <div class="container ml-4" style="position:absolute;">
                    <div class="form-group row mb-0 float-right">
                        <label for="staticEmail" class="col-md-4 col-form-label" style="padding-left:0; padding-right:.5;"> View: </label>
                        <div class="col-md-8 p-0" style="width:8em;;">
                            <select class="form-control">
                                <option> Today </option>
                                <option> This Week </option>
                                <option> This Month </option>
                            </select>
                        </div>
                    </div>
                </div>--}}
                    <div class="container-fluid lodging-tabs px-0">
                        <ul class="nav nav-tabs pt-0" style="">
                            <li class="nav-item">
                                <a class="nav-link active" href="">All</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color:#505050;" href="">Meat & Poultry</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color:#505050;" href="">Produce</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color:#505050;" href="">Grocery & Dry</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color:#505050;" href="">Beer & Liquor</a>
                            </li>
                        </ul>
                    </div>
                {{--</div>--}}
                <div class="container py-1 scrollbar-near-moon-wide" id="inventoryLibrary" style="min-height:70vh; max-height:70vh; overflow-y:auto;">
                    <table data-order='[[ 0, "asc" ]]' class="table table-sm dataTable stripe" cellspacing="0" id="inventoryTable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Last used</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $ingredientCount = 0;
                            @endphp

                            @foreach($ingredients as $ingredient)

                            @php
                                $ingredientCount++;
                            @endphp
                            <tr>
                                <td>{{$ingredientCount}}</td>
                                <td>{{$ingredient->ingredientName}}</td>
                                <td class="text-right">{{$ingredient->quantity}}</td>                
                                <td class="text-right">{{$ingredient->updated_at}}</td>                             
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-2 float-right mx-5 pl-4 pt-5 mt-3" style="position:fixed; right:0;">
                <nav class="nav nav-pills nav-stacked mb-5 pb-5" style="display:block;">
                    <a class="nav-item nav-link reports-tabs text-center active" style="background-color:#060f0ed4;" href="#">Daily</a>
                    <a class="nav-item nav-link reports-tabs text-center" style="color:#505050" href="">Weekly</a>
                    <a class="nav-item nav-link reports-tabs text-center" style="color:#505050" href="">Monthly</a>
                    <a class="nav-item nav-link reports-tabs text-center" style="color:#505050" href="">Custom</a>
                </nav>
                <form method="POST" action="/reload-weekly-lodging-report">
                    @csrf
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <div class="row px-3">
                        <div class="form-group col-md-9 px-0 mx-1">
                            <div class="input-group input-group-sm">
                                @if(isset($displayfrom))
                                <input class="form-control lodgingReportDateInputs" id="lodgingReportDate" type="date" name="lodgingReportDate" maxlength="15" placeholder="" value="{{$displayfrom}}" required>
                                @else
                                <input class="form-control lodgingReportDateInputs" id="lodgingReportDate" type="date" name="lodgingReportDate" maxlength="15" placeholder="" value="<?php echo date("Y-m-d");?>" required>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2 px-0 mx-1">
                            <button class="btn btn-sm btn-success" type="submit">
                                <i class="fa fa-calendar-check" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </form>
            <div>
        </div>
    </div>
@endsection