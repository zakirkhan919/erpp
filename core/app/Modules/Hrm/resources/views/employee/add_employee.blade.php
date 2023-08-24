@extends('admin.common.master')
@section('title')
    <title>Employee Add</title>
@endsection

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <!-- CONTAINER -->
            <div class="main-container container-fluid">
                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Employee Add</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('employee') }}">Employee</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Employee Add</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->
                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Employee Information Add</h3>
                            </div>
                            <form action="{{ route('submit-employee') }}" method="post" id="employee-add"
                                enctype="multipart/form-data" name="employee-add">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="name">Name <span
                                                        class="text-red">*</span></label>
                                                <input type="text" value="{{ old('name') }}"
                                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                                    name="name" placeholder="Name">
                                                @error('name')
                                                    <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="fathers_name">Father's Name <span
                                                        class="text-red">*</span></label>
                                                <input type="text" value="{{ old('fathers_name') }}"
                                                    class="form-control @error('fathers_name') is-invalid @enderror"
                                                    id="fathers_name" name="fathers_name" placeholder="Father's Name">
                                                @error('fathers_name')
                                                    <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="mothers_name">Mother's Name <span
                                                    class="text-red">*</span></label>
                                            <input type="text" value="{{ old('mothers_name') }}"
                                                class="form-control @error('mothers_name') is-invalid @enderror"
                                                id="mothers_name" name="mothers_name" placeholder="Mother's Name">
                                            @error('mothers_name')
                                                <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="date_of_birth">Date of Birth <span
                                                    class="text-red">*</span></label>
                                            <input type="date" value="{{ old('date_of_birth') }}"
                                                class="form-control @error('date_of_birth') is-invalid @enderror"
                                                id="date_of_birth" name="date_of_birth">
                                            @error('date_of_birth')
                                                <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="photo">Photo</label>
                                            <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                                id="photo" name="photo">
                                            @error('photo')
                                                <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="gender">Gender <span
                                                    class="text-red">*</span></label>
                                            <select class="form-control @error('gender') is-invalid @enderror"
                                                id="gender" name="gender">
                                                <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>
                                                    Male</option>
                                                <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>
                                                    Female</option>
                                                <option value="other" {{ old('gender') === 'other' ? 'selected' : '' }}>
                                                    Other</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="phone">Phone</label>
                                            <input type="text" value="{{ old('phone') }}"
                                                class="form-control @error('phone') is-invalid @enderror" id="phone"
                                                name="phone" placeholder="Phone">
                                            @error('phone')
                                                <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" value="{{ old('email') }}"
                                                class="form-control @error('email') is-invalid @enderror" id="email"
                                                name="email" placeholder="Email">
                                            @error('email')
                                                <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <!-- Department -->
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="department_id">Department <span
                                                    class="text-red">*</span></label>
                                            <select class="form-control @error('department_id') is-invalid @enderror"
                                                id="department_id" name="department_id">
                                                <option value="">Select Department</option>
                                                <!-- Loop through departments to generate options -->
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}"
                                                        {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                                        {{ $department->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('department_id')
                                                <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Designation -->
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="designation_id">Designation <span
                                                    class="text-red">*</span></label>
                                            <select class="form-control @error('designation_id') is-invalid @enderror"
                                                id="designation_id" name="designation_id">
                                                <option value="">Select Designation</option>
                                                <!-- Loop through designations to generate options -->
                                                @foreach ($designations as $designation)
                                                    <option value="{{ $designation->id }}"
                                                        {{ old('designation_id') == $designation->id ? 'selected' : '' }}>
                                                        {{ $designation->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('designation_id')
                                                <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <!-- Joining Date -->
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="joining_date">Joining Date <span
                                                    class="text-red">*</span></label>
                                            <input type="date" value="{{ old('joining_date') }}"
                                                class="form-control @error('joining_date') is-invalid @enderror"
                                                id="joining_date" name="joining_date">
                                            @error('joining_date')
                                                <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Joining Salary -->
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="joining_salary">Joining Salary <span
                                                    class="text-red">*</span></label>
                                            <input type="text" value="{{ old('joining_salary') }}"
                                                class="form-control @error('joining_salary') is-invalid @enderror"
                                                id="joining_salary" name="joining_salary" placeholder="Joining Salary">
                                            @error('joining_salary')
                                                <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <!-- Medical Allowance -->
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="medical_allowance">Medical Allowance</label>
                                            <input type="text" value="{{ old('medical_allowance') }}"
                                                class="form-control @error('medical_allowance') is-invalid @enderror"
                                                id="medical_allowance" name="medical_allowance"
                                                placeholder="Medical Allowance">
                                            @error('medical_allowance')
                                                <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Provident Fund -->
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="provident_fund">Provident Fund</label>
                                            <input type="text" value="{{ old('provident_fund') }}"
                                                class="form-control @error('provident_fund') is-invalid @enderror"
                                                id="provident_fund" name="provident_fund" placeholder="Provident Fund">
                                            @error('provident_fund')
                                                <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">

                                    <!-- House Rent -->
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="house_rent">House Rent</label>
                                            <input type="text" value="{{ old('house_rent') }}"
                                                class="form-control @error('house_rent') is-invalid @enderror"
                                                id="house_rent" name="house_rent" placeholder="House Rent">
                                            @error('house_rent')
                                                <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Incentive -->
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="incentive">Incentive</label>
                                            <input type="text" value="{{ old('incentive') }}"
                                                class="form-control @error('incentive') is-invalid @enderror"
                                                id="incentive" name="incentive" placeholder="Incentive">
                                            @error('incentive')
                                                <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">

                                    <!-- Insurance -->
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="insurance">Insurance</label>
                                            <input type="text" value="{{ old('insurance') }}"
                                                class="form-control @error('insurance') is-invalid @enderror"
                                                id="insurance" name="insurance" placeholder="Insurance">
                                            @error('insurance')
                                                <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Tax -->
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="tax">Tax</label>
                                            <input type="text" value="{{ old('tax') }}"
                                                class="form-control @error('tax') is-invalid @enderror" id="tax"
                                                name="tax" placeholder="Tax">
                                            @error('tax')
                                                <div class="invalid-feedback mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    </div>

                                    <div class="float-left" style="float: left;">
                                        <button class="btn btn-danger mt-4 mb-2">Cancel</button>
                                    </div>
                                    <div class="float-right" style="float: right;">
                                        <button type="submit" class="btn btn-primary mt-4 mb-2" type="submit">
                                            Submit </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
