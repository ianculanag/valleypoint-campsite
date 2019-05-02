@extends('layouts.app')

@section('content')
<div class="container pb-5">
<div class="pt-3 pb-3">
        <a href="">
            <span style="float:left;">
                <i class="fa fa-chevron-left" aria-hidden="true"></i>
                <strong>Back</strong>
            </span>
        </a>
        <h3 class="text-center">Sales Report</h3>
    </div>
    <div class="col-md-12">
        <table id="guestsTable" data-order='[[ 0, "asc" ]]' class="table table-sm dataTable stripe compact" cellspacing="0">
          <thead>
            <tr class="">
              <th>Item Name</th>
              <th>Item Price</th>
              <th>Quantity Sold</th>
              <th>Total Price</th>
              
            </tr>
          </thead>
          <tbody>
          </tbody>
    </table>
</div>
</div>
@endsection