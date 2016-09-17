@extends('admin-layouts.admin')
@section('title')
    Reports
@stop

@section('content')


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


    @include('admin-partials._report-block',array(
            $reportTitle="Sales Revenue",
            $today=$stats['revenueToday'],
            $thisMonth=$stats['revenueInMonth'],
            $thisYear=$stats['revenueInYear'],
            $allTime=$stats['revenueAllTime'],
       ))

    @include('admin-partials._report-block',array(
            $reportTitle="Orders",
            $today=$stats['invoiceCountToday'],
            $thisMonth=$stats['invoiceCountInMonth'],
            $thisYear=$stats['invoiceCountInYear'],
            $allTime=$stats['invoiceCountAllTime'],
        ))

    @include('admin-partials._report-block',array(
            $reportTitle="Products Sold",
            $today=$stats['productsSoldToday'],
            $thisMonth=$stats['productsSoldInMonth'],
            $thisYear=$stats['productsSoldInYear'],
            $allTime=$stats['productsSoldAllTime'],
        ))

    @include('admin-partials._report-block',array(
            $reportTitle="Users",
            $today=$stats['userCountToday'],
            $thisMonth=$stats['userCountInMonth'],
            $thisYear=$stats['userCountInYear'],
            $allTime=$stats['userCountAllTime'],
        ))



@stop