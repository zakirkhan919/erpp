@extends('admin.common.master')
@section('title')
    <title>Accounts</title>
@endsection

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Accounts information</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard </a></li>

                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="list"
                                        class="table table-bordered text-nowrap key-buttons border-bottom">
                                        <thead>
                                            <tr>


                                                <th class="border-bottom-0">Total Purchased amount</th>
                                                <th class="border-bottom-0">Total Sold amount</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <td>
                                                {{ $totalPurchasedSum }}
                                            </td>
                                            <td>
                                                {{ $totalSoldSum }}
                                            </td>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection



