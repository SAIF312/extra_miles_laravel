@extends('admin.layouts.app')
@section ('title')
    Dashboard
@endsection
@section ('header')
    Dashboard
@endsection
@section('content')
 <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="row layout-top-spacing" style="min-height: 26vh;">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-card-four" style="background: #28A745">
                            <div class="widget-content">
                                <div class="w-content">
                                    <div class="w-info" >
                                        <p class="" style="color:#fff"><i class="fa fa-users"></i> &nbsp; Total Users</p>
                                        {{-- <h6 class="value" style="color:#fff"><i class="fa fa-home"></i> &nbsp;  Customers</h6> --}}
                                        <h6 class="value">&nbsp;</h6>
                                        <p class="" style="color:#fff"> $users </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-card-four" style="background: #1D66FF">
                            <div class="widget-content">
                                <div class="w-content">
                                    <div class="w-info" >
                                        <p class="" style="color:#fff"><i class="fa fa-window-restore"></i> &nbsp; Total Subscriptions</p>
                                        {{-- <h6 class="value" style="color:#fff"><i class="fa fa-home"></i> &nbsp; Subscriptions</h6> --}}
                                        <h6 class="value">&nbsp;</h6>
                                        <p class="" style="color:#fff">$subscription </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-card-four" style="background: #00ADEE">
                            <div class="widget-content">
                                <div class="w-content">
                                    <div class="w-info" >
                                        <p class="" style="color:#fff"><i class="fa fa-adjust"></i> &nbsp; Total Packages</p>
                                        {{-- <h6 class="value" style="color:#fff"><i class="fa fa-home"></i> &nbsp; Total Admins</h6> --}}
                                        <h6 class="value">&nbsp;</h6>
                                        <p class="" style="color:#fff"> $package </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-card-four" style="background:  #E72D45">
                            <div class="widget-content">
                                <div class="w-content">
                                    <div class="w-info" >
                                        <p class="" style="color:#fff"><i class="fa fa-shopping-bag"></i> &nbsp; Total Payments</p>
                                        {{-- <h6 class="value" style="color:#fff"><i class="fa fa-home"></i> &nbsp; Total Scans</h6> --}}
                                        <h6 class="value">&nbsp;</h6>
                                        <p class="" style="color:#fff"> $payment</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                        {{-- <div id="chartColumn" class="col-xl-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>QR Scan Logs</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area">
                                    <div id="s-col" class=""></div>

                                    <div class="code-section-container">

                                    </div>
                                </div>
                            </div>
                        </div> --}}

        </div>




        <!--  END CONTENT PART  -->
@endsection
@section('javascript')
       <script>
            var sCol = {

                chart: {
                    height: 350,
                    type: 'bar',
                    toolbar: {
                      show: false,
                    }
                },

                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                // colors: ['#888ea8', '#1b55e2'],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },


                series: [{
                    name: 'Valid',
                    data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
                }, {
                    name: 'Invalid',
                    data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
                }],
                xaxis: {
                    // categories : [76, 85, 101, 98, 87, 105, 91, 114, 94],
                    categories: [
                        '{{ \Carbon\Carbon::now()->subDays(6)->format('d-m-Y') }}',
                        '{{ \Carbon\Carbon::now()->subDays(5)->format('d-m-Y') }}',
                        '{{ \Carbon\Carbon::now()->subDays(4)->format('d-m-Y') }}',
                        '{{ \Carbon\Carbon::now()->subDays(3)->format('d-m-Y') }}',
                        '{{ \Carbon\Carbon::now()->subDays(2)->format('d-m-Y') }}',
                        '{{ \Carbon\Carbon::now()->subDays(1)->format('d-m-Y') }}',
                        '{{ \Carbon\Carbon::now()->format('d-m-Y') }}'
                    ],
                },

                yaxis: {
                    title: {
                        text: 'QR Scan Logs'
                    }
                },
                fill: {
                    opacity: 1

                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return  val
                        }
                    }
                }
            }

            var chart = new ApexCharts(
                document.querySelector("#s-col"),
                sCol
            );

            chart.render();

        </script>
@endsection
