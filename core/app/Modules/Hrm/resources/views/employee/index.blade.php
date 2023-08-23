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

    @section('js')
    @include('vendor.sweetalert2.sweetalert2_js')
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <script>
        $(function() {
            $('#list').DataTable({
                bAutoWidth: false,
                processing: true,
                serverSide: true,
                iDisplayLength: 10,
                ajax: {
                    url: "/get-product",
                    method: 'post',
                    data: function(d) {
                        d._token = $('input[name="_token"]').val();
                    }
                },
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'gender', name: 'gender' },
                    { data: 'phone', name: 'phone' },
                    { data: 'email', name: 'email' },
                    { data: 'department', name: 'department' },
                    { data: 'designation', name: 'designation' },
                    { data: 'joining_date', name: 'joining_date' },
                    { data: 'joining_salary', name: 'joining_salary' },
                    { data: 'medical_allowance', name: 'medical_allowance' },
                    { data: 'provident_fund', name: 'provident_fund' },
                    { data: 'house_rent', name: 'house_rent' },
                    { data: 'incentive', name: 'incentive' },
                    { data: 'insurance', name: 'insurance' },
                    { data: 'tax', name: 'tax' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
                "aaSorting": []
            });
        });

        // Rest of your JS code

    </script>
    @endsection
