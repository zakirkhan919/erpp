@extends('admin.common.master')
@section('title')
    <title>Holiday</title>
@endsection

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Holiday information</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard </a></li>
                            <li class="breadcrumb-item active" aria-current="page">Holiday info </li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header justify-content-end">
                                <a href="{{ route('add_holiday') }}">
                                    <button class="btn btn-primary text-right"><i class="fe fe-plus me-2"></i>Add
                                        Holiday</button>
                                </a>
                            </div>
                            <div class="row">
                                <div class="col-xl-3">
                                    <div class="card">
                                        <div class="list-group list-group-transparent mb-0 mail-inbox pb-3">

                                            <a href="javascript:void(0)" id="JANUARY" onclick="monthSelect(this.id)"
                                                class="list-group-item d-flex align-items-center active mx-4">
                                                January
                                            </a>
                                            <a href="javascript:void(0)" id="FEBRUARY" onclick="monthSelect(this.id)"
                                                class="list-group-item d-flex align-items-center active mx-4">
                                                February
                                            </a>
                                            <a href="javascript:void(0)" id="MARCH" onclick="monthSelect(this.id)"
                                                class="list-group-item d-flex align-items-center active mx-4">
                                                March
                                            </a>
                                            <a href="javascript:void(0)" id="APRIL" onclick="monthSelect(this.id)"
                                                class="list-group-item d-flex align-items-center active mx-4">
                                                April
                                            </a>
                                            <a href="javascript:void(0)" id="MAY" onclick="monthSelect(this.id)"
                                                class="list-group-item d-flex align-items-center active mx-4">
                                                May
                                            </a>
                                            <a href="javascript:void(0)" id="JUNE" onclick="monthSelect(this.id)"
                                                class="list-group-item d-flex align-items-center active mx-4">
                                                June
                                            </a>
                                            <a href="javascript:void(0)" id="JULY" onclick="monthSelect(this.id)"
                                                class="list-group-item d-flex align-items-center active mx-4">
                                                July
                                            </a>
                                            <a href="javascript:void(0)" id="AUGUST" onclick="monthSelect(this.id)"
                                                class="list-group-item d-flex align-items-center active mx-4">
                                                August
                                            </a>
                                            <a href="javascript:void(0)" id="SEPTEMBER" onclick="monthSelect(this.id)"
                                                class="list-group-item d-flex align-items-center active mx-4">
                                                September
                                            </a>
                                            <a href="javascript:void(0)" id="OCTOBER" onclick="monthSelect(this.id)"
                                                class="list-group-item d-flex align-items-center active mx-4">
                                                October
                                            </a>
                                            <a href="javascript:void(0)" id="NOVEMBER" onclick="monthSelect(this.id)"
                                                class="list-group-item d-flex align-items-center active mx-4">
                                                November
                                            </a>
                                            <a href="javascript:void(0)" id="DECEMBER" onclick="monthSelect(this.id)"
                                                class="list-group-item d-flex align-items-center active mx-4">
                                                December
                                            </a>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-9">
                                    <div class="card">
                                        <div class="card-body p-6">
                                            <div class="inbox-body">
                                                <div class="table-responsive">
                                                    <h4>Weekend Holiday: <span class="text-danger">
                                                            @foreach ($fixedHoliday as $item)
                                                                {{ $item->day }}
                                                            @endforeach
                                                        </span> </h4>
                                                    <p>(If you want to update weekend holiday, please add new weekend
                                                        holiday, previous weekend holiday will be changed)</p>
                                                    <div id="maintable">
                                                        <table class="table table-inbox table-hover text-nowrap mb-0">
                                                            <thead>
                                                                <tr class="">
                                                                    <td class="inbox-small-cells">Sl</td>
                                                                    <td class="inbox-small-cells">Day</td>
                                                                    <td
                                                                        class="view-message dont-show fw-semibold clickable-row">
                                                                        Occasion</td>
                                                                    <td class="view-message clickable-row">Description</td>
                                                                    <td
                                                                        class="view-message text-center fw-semibold clickable-row">
                                                                        Action</td>
                                                                </tr>

                                                            </thead>
                                                            <tbody>
                                                                @foreach ($occasionHoliday as $key => $item)
                                                                    <tr>
                                                                        <td>{{ $key + 1 }}</td>
                                                                        <td>{{ \Carbon\Carbon::parse($item->date)->format('d/m/Y') }}({{ \Carbon\Carbon::parse($item->date)->format('l') }})
                                                                        </td>
                                                                        <td>{{ $item->occasion }}</td>
                                                                        <td>{{ $item->description }}</td>
                                                                        <td>
                                                                            <button class="btn btn-info" type="button"
                                                                                onclick="occasionEdit({{$item->id}})">Edit</button>
                                                                                <button class="btn btn-danger" type="button" onclick="occasionDelete({{ $item->id }})">Delete</button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div id="ajaxtable">

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
            </div>
        </div>
        <div class="modal fade" id="OccasionModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Occasion Holiday</h5>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="editForm"></div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-bs-dismiss="modal">Cencel</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('js')
        @include('vendor.sweetalert2.sweetalert2_js')
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <script>
            function monthSelect(data) {
                $.ajax({
                    url: "/get-holiday",
                    method: 'POST',
                    data: {
                        data: data,
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#maintable').hide();
                        $('#ajaxtable').html(data);
                    }
                })
            }

            function occasionEdit(data) {
                $('#OccasionModal').modal('show');
                $.ajax({
                    url: "/get-occasion-data",
                    method: 'POST',
                    data: {
                        data: data,
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: 'json',
                    success: function(data) {
                        // $('#maintable').hide();
                        
                        $('#editForm').html(data);
                    }
                })
            }

            function occasionDelete(data)
            {
                $.ajax({
                    url: "/delete-occasion-data",
                    method: 'POST',
                    data: {
                        data: data,
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: 'json',
                    success: function(data) {
                        // $('#maintable').hide();
                        location.reload();
                    }
                })
            }
        </script>
    @endsection
