@extends('admin.common.master')
@include('admin.common.dashboard_css')
@section('title')
    <title>NeuronERP dashboard</title>
@endsection
@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">
                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Dashboard</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home </a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard </li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->
                {{-- <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                        <div class="row">
                            <div id="flotback-chart" class="flot-background"></div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="mt-2">
                                                <h6 class="">মোট সদস্য</h6>
                                                <h2 class="mb-0 number-font"></h2>
                                            </div>
                                            <div class="ms-auto">
                                                <div class="chart-wrapper mt-1">
                                                    <canvas id="saleschart" class="h-8 w-9 chart-dropshadow"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <!--                                                <span class="text-muted fs-12"><span class="text-secondary"><i-->
                                        <!--                                                            class="fe fe-arrow-up-circle  text-secondary"></i> 5%</span>-->
                                        <!--                                                    Last week</span>-->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="mt-2">
                                                <h6 class="">ইনকাম</h6>
                                                <h2 class="mb-0 number-font"></h2>
                                            </div>
                                            <div class="ms-auto">
                                                <div class="chart-wrapper mt-1">
                                                    <canvas id="leadschart" class="h-8 w-9 chart-dropshadow"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <!--                                                <span class="text-muted fs-12"><span class="text-pink"><i-->
                                        <!--                                                            class="fe fe-arrow-down-circle text-pink"></i> 0.75%</span>-->
                                        <!--                                                    Last 6 days</span>-->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="mt-2">
                                                <h6 class="">খরচ </h6>
                                                <h2 class="mb-0 number-font"></h2>
                                            </div>
                                            <div class="ms-auto">
                                                <div class="chart-wrapper mt-1">
                                                    <canvas id="profitchart" class="h-8 w-9 chart-dropshadow"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <!--                                                <span class="text-muted fs-12"><span class="text-green"><i-->
                                        <!--                                                            class="fe fe-arrow-up-circle text-green"></i> 0.9%</span>-->
                                        <!--                                                    Last 9 days</span>-->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="mt-2">
                                                <h6 class="">সর্বমোট আয় </h6>
                                                <h2 class="mb-0 number-font"></h2>
                                            </div>
                                            <div class="ms-auto">
                                                <div class="chart-wrapper mt-1">
                                                    <canvas id="recentorders" class="h-8 w-9 chart-dropshadow"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <!--                                                <span class="text-muted fs-12"><span class="text-warning"><i-->
                                        <!--                                                            class="fe fe-arrow-up-circle text-warning"></i> 0.6%</span>-->
                                        <!--                                                    Last year</span>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- ROW-1 END -->

                <!-- ROW-2 -->
                {{-- <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">সাম্প্রতিক মেম্বার তথ্য </h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="list" class="table dt-responsive table-bordered table-striped nowrap" id="basic-datatable">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">নম্বর </th>
                                                <th class="wd-15p border-bottom-0">সদস্যের প্রকার </th>
                                                <th class="wd-15p border-bottom-0">নাম </th>
                                                <th class="wd-20p border-bottom-0">বাবা / রেফ</th>
                                                <th class="wd-20p border-bottom-0">জেলা</th>
                                                <th class="wd-20p border-bottom-0">থানা</th>
                                                <th class="wd-15p border-bottom-0">ইউনিয়ন* </th>
                                                <th class="wd-10p border-bottom-0">গ্রাম </th>
                                                <th class="wd-25p border-bottom-0">ডাকঘর </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($memberDatas as $key => $d)
                                                <tr>
                                                    <td>{{ $d->u_id }}</td>
                                                    <td>{{ $d->type->name }}</td>
                                                    <td>{{ $d->name }}</td>
                                                    <td>{{ $d->ref }}</td>
                                                    <td>{{ $d->district->bn_name }}</td>
                                                    <td>{{ $d->thana->bn_name }}</td>
                                                    <td>{{ $d->union->bn_name}}</td>
                                                    <td>{{ $d->village }}</td>
                                                    <td>{{ $d->postOffice }}</td>
                                                </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">সাম্প্রতিক নগদ আয় </h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="list" class="table dt-responsive table-bordered table-striped nowrap" id="basic-datatable">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">নম্বর </th>
                                                <th class="wd-15p border-bottom-0">বিবরণ </th>
                                                <th class="wd-15p border-bottom-0">টাকার পরিমান </th>
                                                <th class="wd-15p border-bottom-0">তারিখ </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($incomeDatas as $key => $d)
                                                <tr>
                                                    <td>{{ en_to_bn($key + 1) }}</td>
                                                    <td>{{ $d->description }}</td>
                                                    <td>{{ $d->amount }}</td>
                                                    <td>{{ $d->date }}</td>
                                                </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">সাম্প্রতিক নগদ খরচ </h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="list" class="table dt-responsive table-bordered table-striped nowrap" id="basic-datatable">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">নম্বর </th>
                                                <th class="wd-15p border-bottom-0">বিবরণ </th>
                                                <th class="wd-15p border-bottom-0">টাকার পরিমান </th>
                                                <th class="wd-15p border-bottom-0">তারিখ </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($expenseDatas as $key => $d)
                                                <tr>
                                                    <td>{{ en_to_bn($key + 1) }}</td>
                                                    <td>{{ $d->description }}</td>
                                                    <td>{{ $d->amount }}</td>
                                                    <td>{{ $d->date }}</td>
                                                </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- COL END -->
                </div> --}}
                <!-- ROW-2 END -->

                <!-- ROW-3 -->

                <!-- ROW-3 END -->

                <!-- ROW-4 -->

                <!-- ROW-4 END -->
            </div>
            <!-- CONTAINER END -->
        </div>
    </div>
    <!--app-content close-->
@endsection
@section('script-resource')
@endsection
