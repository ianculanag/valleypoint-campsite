@extends('layouts.app')

@section('content')
<h1>Point-of-Sales</h1>
<div class="container-fluid col-md-9 mx-1 pb-5 pt-1">
    <div class="row">
        <div class="container lodging-tabs">
            <ul class="nav nav-tabs pt-0" style="width:93%" >
                <li class="nav-item">
                    <a class="nav-link active" href="">View Tables</a>
                    <li class="nav-item">
                        <a class="nav-link" style="color:#505050"; href="/make-order">New order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color:#505050"; href="/cashier-shift-report">View Sales</a>
                    </li>
                </li>
            </ul>
        </div>
        <div class="container-center">
            <div class="row">
                @for($index = 1; $index <=12; $index++) 
                <a data-toggle="modal" data-target="#exampleModal" style="cursor:pointer">
                     
                <div class="card mx-2" style="width:16rem; height:7.5em; background-image:url({{asset('table.png')}}); background-size:cover; background-repeat:no-repeat;">
                        <div class="card-body">
                            <h5 class="card-title">Table {{$index}}
                                <span class="badge badge-success float-right" style="font-size:.55em;">Available</span>
                            </h5>
                            <p class="card-text">Status: </p>
                            <p class="card-text">Amount: </p>
                         </div>
                    </div> 
                </a>
                @endfor 
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Orders of table #1</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <table class="table table-sm table-bordered" style="text-align:center">
                    <tr>
                        <th>Order</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                    <tr>
                       <td>Tapsilog</td>
                       <td>3</td>
                       <td>150</td> 
                    </tr>
                    <tr>
                        <td>Sisig</td>
                        <td>2</td>
                        <td>250</td> 
                         </tr>  
                </table>
                <a href="/make-order">
                <button type="button" class="btn btn-primary" style="float:right; background-color:blue">Add new order</button> 
                </a>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
@endsection
