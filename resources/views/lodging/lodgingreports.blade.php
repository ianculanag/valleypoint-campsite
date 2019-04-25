@extends('layouts.app')

@section('content')
    <div class="container pb-5">
        <!--div class="pt-3 pb-3 text-center">
            <a href="/glamping">
                <span style="float:left;">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    <strong>Back</strong>
                </span>
            </a>
        </div--> 
        <div class="container">

            <div class="card col-md-10 offset-md-1 py-4 ">
                <div class="row">
                    <div class="col-md-8 col-sm-4">
                        <img src={{asset('logo.jpg')}} class="float-left" style="height:7.5em; width:9.75em;" aria-hidden="true"></img>
                    </div>
                    <div class="col-md-4 col-sm-8 px-5 pt-3">
                        <h6>Valleypoint Campsite</h6>
                        <h6>{{\Carbon\Carbon::now()->format('F j, o')}}</h6>
                    </div>
                </div>
                <div class="card-body">
                    <h6> Today's Figures </h6>
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-sm table-bordered" style="font-size:.90em;">
                                <thread>
                                    <tr>
                                        <th colspan="2"> Glamping Accommodation </th>
                                    </tr>
                                <thread>
                                <tbody>
                                    <tr>
                                        <td> Occupied tents </td>
                                        <td> </td>
                                    </tr>
                                    <tr>
                                        <td> Unoccupied tents </td>
                                        <td> </td>
                                    </tr>
                                    <tr>
                                        <td> Checked-in guests </td>
                                        <td> </td>
                                    </tr>
                                    <tr>
                                        <td> Arrivals </td>
                                        <td> </td>
                                    </tr>
                                    <tr>
                                        <td> Departures </td>
                                        <td> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-sm table-bordered" style="font-size:.90em;">
                                <thread>
                                    <tr>
                                        <th colspan="2"> Backpacker Accommodation </th>
                                    </tr>
                                <thread>
                                <tbody>
                                    <tr>
                                        <td> Occupied rooms </td>
                                        <td> </td>
                                    </tr>
                                    <tr>
                                        <td> Unoccupied rooms </td>
                                        <td> </td>
                                    </tr>
                                    <tr>
                                        <td> Checked-in guests </td>
                                        <td> </td>
                                    </tr>
                                    <tr>
                                        <td> Arrivals </td>
                                        <td> </td>
                                    </tr>
                                    <tr>
                                        <td> Departures </td>
                                        <td> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div>
                        <h6> Today's Guest Arrivals </h6>
                        <table class="table table-sm table-bordered" style="font-size:.90em;">
                            <thread>
                                <tr>
                                    <th class="text-center" colspan="6"> Glamping Accommodation </th>
                                </tr>
                            <thread>
                            <tbody>
                                <tr>
                                    <td class="text-center"> Tent no. </td>
                                    <td class="text-center"> Guest name </td>
                                    <td class="text-center"> Package availed </td>
                                    <td class="text-center"> Status </td>
                                </tr>
                                <tr>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-sm table-bordered" style="font-size:.90em;">
                            <thread>
                                <tr>
                                    <th class="text-center" colspan="6"> Backpacker Accommodation </th>
                                </tr>
                            <thread>
                            <tbody>
                                <tr>
                                    <td class="text-center"> Room no. </td>
                                    <td class="text-center"> Guest name </td>
                                    <td class="text-center"> No. of pax </td>
                                    <td class="text-center"> Status </td>
                                </tr>
                                <tr>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <h6> Today's Transactions </h6>
                        <table class="table table-sm table-bordered" style="font-size:.90em;">
                            <!--thread>
                                <tr>
                                    <th class="text-center" colspan="6"> Glamping Accommodation </th>
                                </tr>
                            <thread-->
                            <tbody>
                                <tr>
                                    <td class="text-center"> Guest name </td>
                                    <td class="text-center"> Accommodation </td>
                                    <td class="text-center"> Package availed </td>
                                    <td class="text-center"> Quantity </td>
                                    <td class="text-center"> Amount paid </td>
                                    <td class="text-center"> Balance </td>
                                </tr>
                                <tr>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection