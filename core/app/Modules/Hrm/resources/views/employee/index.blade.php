@extends('admin.common.master')
@section('title')
    <title>Employee</title>
@endsection

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Employee information</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard </a></li>
                            <li class="breadcrumb-item active" aria-current="page">Employee info </li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header justify-content-end">
                                <a href="{{ route('employees.create') }}">
                                    <button class="btn btn-primary text-right"><i class="fe fe-plus me-2"></i>Add
                                        Employee</button>
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="list"
                                        class="table table-bordered text-nowrap key-buttons border-bottom">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">Name</th>
                                                <th class="border-bottom-0">Gender</th>
                                                <th class="border-bottom-0">Phone</th>
                                                <th class="border-bottom-0">Email</th>
                                                <th class="border-bottom-0">Department</th>
                                                <th class="border-bottom-0">Designation</th>
                                                <th class="border-bottom-0">Joining Date</th>
                                                <th class="border-bottom-0">Joining Salary</th>
                                                <th class="border-bottom-0">Medical Allowance</th>
                                                <th class="border-bottom-0">Provident Fund</th>
                                                <th class="border-bottom-0">House Rent</th>
                                                <th class="border-bottom-0">Incentive</th>
                                                <th class="border-bottom-0">Insurance</th>
                                                <th class="border-bottom-0">Tax</th>
                                                <th class="border-bottom-0">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

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

