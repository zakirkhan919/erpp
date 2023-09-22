@extends('admin.common.master')
@section('title')
    <title>Add Attendance</title>
@endsection
@section('css')

@endsection
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Add Attendance</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard </a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Roaster</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Attendance</h3>
                            </div>
                            @if (\Session::has('success1'))
                                            <div class="alert alert-success">
                                                <ul>
                                                    <li>{!! \Session::get('success1') !!}</li>
                                                </ul>
                                            </div>
                                        @endif
                            <form id="attendanceSearch">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="">Employee name <span class="text-danger">*</span></label>
                                                <select name="employee_id" id="" class="form-control">
                                                    <option value="all">All</option>
                                                    @foreach ($employes as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="">Date <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" placeholder="Write Occasion" name="date">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="float-left" style="float: left;">
                                        <button class="btn btn-danger mt-4 mb-2">Cencel</button>
                                    </div>
                                    <div class="float-right" style="float: right;">
                                        <button type="submit" class="btn btn-primary mt-4 mb-2">
                                            Submit </button>
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <div id="responsive-datatable_wrapper"
                                    class="dataTables_wrapper dt-bootstrap5 no-footer">

                                    <div class="row">

                                        <div class="col-sm-12">
                                            <div id="tableData">

                                                @include('Hrm::attendance.attendence_table')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('js')
        <script>
            $('#attendanceSearch').on('submit', function(e) {
                            e.preventDefault();
                            $.ajax({
                                url: "{{ route('employee_list') }}",
                                type: "POST",
                                data: $(attendanceSearch).serialize(),
                                success: function(response) {
                                    console.log(response);
                                    $('#tableData').html(response);
                                },
                                error: function(response) {
                                    
                                },
                            });
                        });
        </script>
    @endsection
