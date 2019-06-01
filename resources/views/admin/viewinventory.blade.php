@extends('layouts.app')

@section('content')
    <div class="container-fluid mx-1 py-0">
        <h3 class="text-center pb-3 mb-0">Ingredient Consumption</h3>
        <div class="row px-3">
            <div class="col-md-9 pr-0">
                <div class="container-fluid lodging-tabs px-0">
                    <ul class="nav nav-tabs pt-0" style="">
                        <li class="ingredientCategories nav-item" id="allCategories">
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
                        <li class="ingredientCategories nav-item" id="{{$ingredientCategory}}">
                            <a class="nav-link categories" id="this-{{$ingredientCategory}}" style="color:#505050; cursor:pointer;">{{$ingredientName}}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="container py-0 scrollbar-near-moon-wide" id="inventoryLibrary" style="min-height:71.5vh; max-height:71.5vh; overflow-y:auto;">
                    <table data-order='[[ 0, "asc" ]]' class="table table-sm dataTable stripe" cellspacing="0" id="inventoryTable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Quantity Consumed</th>
                                <th>Last Consumed</th>
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
                                <td class="text-right pr-5">{{$ingredientCount}}</td>
                                <td class="pl-3">{{$ingredient->ingredientName}}</td>
                                <td class="pl-3">{{$displayName}}</td>
                                <td class="text-right pr-5">{{$ingredient->quantity}}</td>                
                                <td class="pl-3">{{\Carbon\Carbon::parse($ingredient->updated_at)->toDayDateTimeString()}}</td>                             
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-2 float-right mx-5 pl-4 pt-4 mt-3" style="position:fixed; right:0;">
                <nav class="nav nav-pills nav-stacked mb-5" style="display:block;">
                    <a class="nav-item nav-link inventory-reports-tabs text-center active" id="dailyInventory">Daily</a>
                    <a class="nav-item nav-link inventory-reports-tabs text-center" id="monthlyInventory">Monthly</a>
                    <a class="nav-item nav-link inventory-reports-tabs text-center" id="customInventory">Custom</a>
                </nav>
                {{--Daily--}}
                <div class="inventory-inputs row px-3" id="dailyInventoryInput">
                    <div class="form-group col-md-9 px-0 mx-1">
                        <div class="input-group input-group-sm">
                            {{-- @if(isset($displayfrom))
                            <input class="form-control lodgingReportDateInputs" id="lodgingReportDate" type="date" name="lodgingReportDate" maxlength="15" value="{{$displayfrom}}" required>
                            @else --}}
                            <input class="form-control lodgingReportDateInputs" id="lodgingReportDate" type="date" name="lodgingReportDate" maxlength="15" value="<?php echo date("Y-m-d");?>" required>
                            {{-- @endif --}}
                        </div>
                    </div>
                    <div class="col-md-2 px-0 mx-1">
                        <button class="btn btn-sm btn-success load-inventory" id="loadDailyInventory" type="submit">
                            <i class="fa fa-calendar-check" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                {{--Monthly--}}
                <div class="inventory-inputs row px-3" id="monthlyInventoryInput" style="display:none;">
                    <div class="form-group col-md-5 px-0 mr-1">
                        <div class="input-group input-group-sm">
                            <select class="form-control" name="selectMonth" id="selectMonth">
                                <option value="01">Jan</option>
                                <option value="02">Feb</option>
                                <option value="03">Mar</option>
                                <option value="04">Apr</option>
                                <option value="05">May</option>
                                <option value="06" selected>Jun</option>
                                <option value="07">Jul</option>
                                <option value="08">Aug</option>
                                <option value="09">Sep</option>
                                <option value="10">Oct</option>
                                <option value="11">Nov</option>
                                <option value="12">Dec</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-4 px-0 ">
                        <div class="input-group input-group-sm">
                            <input class="form-control" type="number" name="selectYear" id="selectYear" min="2018" max="" value="2019" required>
                        </div>
                    </div>
                    <div class="col-md-2 px-0 ml-2">
                        <button class="btn btn-sm btn-success load-inventory" id="loadMonthlyInventory" type="submit">
                            <i class="fa fa-calendar-check" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                {{--Custom--}}
                <div class="inventory-inputs px-1" id="customInventoryInput" style="display:none;">
                    <div class="form-group row px-0 mx-0">
                        <label for="displayFrom" class="col-md-3 mb-0 mt-2 p-0">From:</label>
                        <div class="input-group input-group-sm col-md-9 px-0 mx-0">
                            {{-- @if(isset($displayfrom))
                            <input class="form-control lodgingReportDateInputs" type="date" name="displayFrom" maxlength="15" placeholder="" value="{{$displayfrom}}" required>
                            @else --}}
                            <input class="form-control lodgingReportDateInputs" type="date" name="displayFrom" id="fromDate" maxlength="15" value="<?php echo date("Y-m-d");?>" required>
                            {{-- @endif --}}
                        </div>
                    </div>
                    <div class="form-group row px-0 mx-0">
                        <label for="displayTo" class="col-md-3 mb-0 mt-2 p-0">To:</label>
                        <div class="input-group input-group-sm col-md-9 px-0 mx-0">
                            {{-- @if(isset($displayto))
                            <input class="form-control lodgingReportDateInputs" type="date" name="displayTo" maxlength="15" placeholder="" value="{{$displayto}}" required>
                            @else --}}
                            @php
                                $dateToday = \Carbon\Carbon::now();
                            @endphp
                            <input class="form-control lodgingReportDateInputs" type="date" name="displayTo" id="toDate" maxlength="15" value="<?php echo date("Y-m-d", strtotime($dateToday . "+1 days"));?>" required>
                            {{-- @endif --}}
                        </div>
                    </div>
                    <div class="px-0 mx-0">
                        <button class="btn btn-sm btn-block btn-success load-inventory" id="loadCustomInventory" type="submit">
                            Load
                        </button>
                    </div>
                </div>
            <div>
        </div>
    </div>
@endsection