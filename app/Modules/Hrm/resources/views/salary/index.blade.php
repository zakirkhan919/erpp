@extends('admin.common.master')
@section('title')
    <title>Salaries</title>
@endsection

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <!-- CONTAINER -->
            <div class="main-container container-fluid">
                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Salary Information</h1>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->
                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header justify-content-end">
                                <a href="{{ route('add_salary') }}">
                                    <button class="btn btn-primary text-right"><i class="fe fe-plus me-2"></i>Add Salaries</button>
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="list" class="table table-bordered text-nowrap key-buttons border-bottom">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Regular Salary</th>
                                                <th>month</th>
                                                <th>year</th>
                                                <th>salary given date</th>
                                                <th>Medical Allowance</th>
                                                <th>provident fund</th>
                                                <th>house rent</th>
                                                <th>incentive</th>
                                                <th>insurance</th>
                                                <th>tax</th>
                                                <th>total</th>
                                                <th>roaster hours</th>
                                                <th>working hours</th>
                                                <th>advance</th>
                                                <th>fine</th>
                                                <th>present</th>
                                                <th>absent</th>
                                                <th>net pay</th>
                                                <th>miscellaneous deduction</th>
                                                <th>miscellaneous Addition</th>
                                                <th>payment status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
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
                    url: "/get-salary",
                    method: 'post',
                    data: function(d) {
                        d._token = $('input[name="_token"]').val();
                    }
                },
                columns: [{
                        data: 'employee_name',
                        name: 'employee_name'
                    },
                    //
                    {
                        data: 'regular_salary',
                        name: 'regular_salary'
                    },
                    {
                        data: 'month',
                        name: 'month'
                    },

                    {
                        data: 'year',
                        name: 'year',

                    },
                    {
                        data: 'salary_given_date',
                        name: 'salary_given_date'
                    },

                    {
                        data: 'medical_allowance',
                        name: 'medical_allowance',

                    },
                    {
                        data: 'provident_found',
                        name: 'provident_found'
                    },

                    {
                        data: 'house_rent',
                        name: 'house_rent',

                    },
                    {
                        data: 'incentive',
                        name: 'incentive'
                    },

                    {
                        data: 'insurance',
                        name: 'insurance',

                    },
                    {
                        data: 'tax',
                        name: 'tax'
                    },
                    {
                        data: 'total',
                        name: 'total'
                    },

                    {
                        data: 'roaster_hours',
                        name: 'roaster_hours',

                    },
                    {
                        data: 'working_hours',
                        name: 'working_hours'
                    },

                    {
                        data: 'advance',
                        name: 'advance',

                    },
                    {
                        data: 'fine',
                        name: 'fine'
                    },

                    {
                        data: 'present',
                        name: 'present',

                    },
                    {
                        data: 'absent',
                        name: 'absent'
                    },

                    {
                        data: 'net_pay',
                        name: 'net_pay',

                    },
                    {
                        data: 'miscellaneous_deduction',
                        name: 'miscellaneous_deduction'
                    },

                    {
                        data: 'miscellaneous_addition',
                        name: 'miscellaneous_addition',

                    },
                    {
                        data: 'payment_status',
                        name: 'payment_status'
                    },


                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],


                "aaSorting": []
            });
        });

        function deletesalary(id, e) {
            e.preventDefault();
            swal.fire({
                title: "Are you sure?",
                text: "Are you delete this?!",
                icon: "warning",
                showCloseButton: true,
                // showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: `Delete `,
                cancelButtonText: `Cencel  `,
                // dangerMode: true,
            }).then((result) => {
                if (result.value == true) {
                    swal.fire({
                        title: 'Deleted!',
                        text: 'Seccessfully deleted!',
                        icon: 'success'
                    }).then(function() {
                        location.reload();
                        try {
                            $.ajax({
                                url: "salary-delete",
                                method: 'POST',
                                data: {
                                    id: id,
                                    "_token": "{{ csrf_token() }}"
                                },
                                dataType: 'json',
                                success: function(data) {
                                    console.log("AJAX call successful", data);
                                },
                                error: function(xhr, status, error) {
                                    if (xhr.status === 500) {
                                        console.error("Internal Server Error:", error);
                                        console.log(xhr.responseText);
                                    } else if (xhr.status === 404) {
                                        console.error("Resource Not Found:", error);
                                        console.log(xhr.responseText);
                                    } else {
                                        console.error("AJAX error:", error);
                                        console.log(xhr.responseText);
                                    }
                                }
                            });
                        } catch (exception) {
                            console.error("Exception:", exception);
                        }



                    })
                } else if (result.value == false) {
                    swal.fire("cencel", "Not deleted :)", "error");
                }
            })
        }
    </script>
@endsection
