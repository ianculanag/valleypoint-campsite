@extends('layouts.app')

@section('content')
    <div class="container-fluid mx-1 pb-5 pt-1">
        <h3 class="px-3 pb-3">Inventory Library</h3>
        <div class="container-fluid lodging-tabs">
            <ul class="nav nav-tabs pt-0" style="">
                <li class="nav-item">
                    <a class="nav-link active" href="">Meat & Poultry</a>
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
        <div class="card p-3 mx-4 mt-4" id="inventoryLibrary">
            <table data-order='[[ 0, "asc" ]]' class="table table-sm dataTable stripe compact" cellspacing="0" id="inventoryTable">
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
                        <td class="text-right">{{$ingredient->Quantity}}</td>                
                        <td>{{$ingredient->updated_at}}</td>                             
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection