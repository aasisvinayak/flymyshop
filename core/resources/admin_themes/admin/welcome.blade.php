


@extends('admin-layouts.admin')
@section('title')
    Dashboard
@stop

@section('content')



    <div class="col-md-8">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Shortcuts</h3>
            </div>
            <div class="panel-body">
                <div class="row">

                    <div class="col-md-6">
                        <a href="/admin/users" class="btn btn-success btn-lg" role="button"><span
                                    class="glyphicon glyphicon-user"></span> <br/>Users</a>
                        <a href="/admin/products" class="btn btn-info btn-lg" role="button"><span
                                    class="glyphicon glyphicon-gift"></span> <br/>Products</a>
                        <a href="/admin/categories" class="btn btn-primary btn-lg" role="button"><span
                                    class="glyphicon glyphicon-list"></span> <br/>Categories</a>
                        <a href="/admin/stocks" class="btn btn-primary btn-lg" role="button"><span
                                    class="glyphicon glyphicon-folder-close"></span> <br/>Stock</a>
                    </div>

                    <div class="col-md-6">
                        <a href="/admin/reports" class="btn btn-danger btn-lg" role="button"><span
                                    class="glyphicon glyphicon-pushpin"></span> <br/>Reports</a>
                        <a href="/admin/orders" class="btn btn-warning btn-lg" role="button"><span
                                    class="glyphicon glyphicon-usd"></span> <br/>Sales</a>
                        <a href="/admin/settings" class="btn btn-primary btn-lg" role="button"><span
                                    class="glyphicon glyphicon-wrench"></span> <br/>Settings</a>
                        <a href="/admin/payments" class="btn btn-primary btn-lg" role="button"><span
                                    class="glyphicon glyphicon-thumbs-up"></span> <br/>Payments</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <style>
        section {
            padding: 5%;
        }

        /*ignore anything above this line*/
        .ao {
            position: relative;
        }
        .ao .ao-date {
            min-height: 80px;
            position: relative;
            font-size: 40px;
            line-height: 40px;
            text-align: center;
            font-weight: bold;
            background: #78bde7;
            padding: 20px 15px 20px;
            color: rgba(255,255,255,0.9);
            text-shadow: 1px 1px 0px rgba(0,0,0,0.1);
        }
        .ao .ao-date span.changeby {
            display: block;
            font-size: 16px;
        }
        .ao .ao-date:after {
            content: " ";
            border-right: 20px solid transparent;
            border-left: 20px solid transparent;
            position: absolute;
            bottom: -20px;
            left: 20%;
            border-top: 20px solid #78bde7;
        }
        .ao .ao-volume {
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
            background: #efefef;
            color: #666;
        }

    </style>

    <div class="col-md-8">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Sales</h3>
            </div>
            <div class="panel-body">
                <div class="row">


                    <div  class="col-md-3">

                        <section id="labels">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6 col-md-3">
                                        <div class="ao">
                                            <div class="ao-date">
                                                Today
                                            </div>

                                            <div class="ao-volume">

                                                {{$stats['revenueToday']}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>


                    </div>

                    <div  class="col-md-3">

                        </div>

                    <div  class="col-md-3">

                        <section id="labels">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6 col-md-3">
                                        <div class="ao">
                                            <div class="ao-date">
                                                All Time
                                            </div>

                                            <div class="ao-volume">
                                                {{$stats['revenueAllTime']}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>


                    </div>




                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Orders</h3>
            </div>
            <div class="panel-body">
                <div class="row">


                    <div  class="col-md-3">

                        <section id="labels">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6 col-md-3">
                                        <div class="ao">
                                            <div class="ao-date">
                                                Today
                                            </div>

                                            <div class="ao-volume">

                                                {{$stats['invoiceCountToday']}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>


                    </div>

                    <div  class="col-md-3">

                    </div>

                    <div  class="col-md-3">

                        <section id="labels">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6 col-md-3">
                                        <div class="ao">
                                            <div class="ao-date">
                                                All Time
                                            </div>

                                            <div class="ao-volume">
                                                {{$stats['invoiceCountAllTime']}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>


                    </div>




                </div>
            </div>
        </div>
    </div>



    <div class="col-md-8">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Stats</h3>
            </div>
            <div class="panel-body">
                <div class="row">





                    <script src="https://code.highcharts.com/highcharts.js"></script>
                    <script src="https://code.highcharts.com/modules/exporting.js"></script>

                    <div id="stats" style="min-width: 310px; height: 400px; margin: 0 auto"></div>


                    <script>
                        $(function () {

                            {{$graphY}}

                            var month_array=[
                            @foreach($monthNames as $monthName)
                                '{{$monthName}}',
                            @endforeach
                            ];

                           $('#stats').highcharts({
                                chart: {
                                    type: 'column'
                                },
                                title: {
                                    text: 'Sales Stats'
                                },
                                subtitle: {
                                    text: 'Flymyshop Snapshot'
                                },
                                xAxis: {
                                    categories:  month_array,
                                    crosshair: true
                                },
                                yAxis: {
                                    min: 0,
                                    title: {
                                        text: 'Value'
                                    }
                                },
                                tooltip: {
                                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                    '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
                                    footerFormat: '</table>',
                                    shared: true,
                                    useHTML: true
                                },
                                plotOptions: {
                                    column: {
                                        pointPadding: 0.2,
                                        borderWidth: 0
                                    }
                                },
                                series: [{
                                    name: 'Revenue',
                                    data: value_array

                                },
                                ]
                            });
                        });
                    </script>


                </div>
            </div>
        </div>
    </div>


@stop