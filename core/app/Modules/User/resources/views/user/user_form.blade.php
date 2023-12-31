<div class="card-body">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="first_name">First Name <span class='required-star'>*</span></label>
                <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('name', optional($user)->first_name) }}" autofocus>

            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="last_name">Last Name <span class='required-star'></span></label>
                <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('name', optional($user)->last_name) }}" autofocus>

            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="email">ইমেইল <span class='required-star'>*</span></label>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email', optional($user)->email) }}" autofocus>

            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-4">
            <div class="form-group">
                <label for="phone">Phone <span class='required-star'></span></label>
                <input id="phone" type="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('name', optional($user)->phone) }}" autofocus>

            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="type">User Type <span class='required-star'>*</span></label>
                <select name="type" id="type" class="form-control">
                    <option value="" disabled selected>Select User Type</option>
                    <option value="Admin" @if(optional($user)->type == "admin") selected @endif>Admin</option>
                    <option value="Manager" @if(optional($user)->type == "manager") selected @endif>Manager</option>
                    <option value="Operator" @if(optional($user)->type == "user") selected @endif>Operator</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="role">Role <span class='required-star'>*</span></label>
                <select name="role_id" id="role_id" class="form-control">
                    <option value="" disabled selected>Select Role</option>
                    @foreach($permissions as $permission)
                        <option value="{{$permission->id}}" @if(optional($user)->role_id == $permission->id) selected @endif>{{$permission->name}}</option>
                    @endforeach
                </select>

            </div>
        </div>
        <div class="col-md-4 @if($user) d-none @endif">
            <div class="form-group">
                <label for="password">Password  <span class='required-star'>*</span></label>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password', optional($user)->password) }}" autofocus>

            </div>
        </div>
        <div class="col-md-4 @if($user) d-none @endif">
            <div class="form-group">
                <label for="confirm_password">Confirm Password <span class='required-star'>*</span></label>
                <input id="confirm_password" type="password" class="form-control{{ $errors->has('confirm_password') ? ' is-invalid' : '' }}" name="confirm_password" value="{{ old('confirm_password', optional($user)->confimr_password) }}" autofocus>

            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="image">Picture</label>
                <div class="input-group mb-1">
                    <div class="custom-file">
                        <input type="file" value="{{ optional($user)->image }}" name="image" id="image" class="form-control-file{{ $errors->has('image') ? ' is-invalid' : '' }}" accept="image/jpeg, image/png" onchange="imageUpload(this, 'show_photo')">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            {{-- {{status}}--}}
            <div class="form-group">
                <label for="status"> Status <span class='required-star'></span></label>
                <select id="status" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" autofocus>
                    <option value="" selected disabled>Select Status</option>
                    <option value="1" @if (optional($user)->status == "1")
                        selected
                        @endif selected>Active</option>
                    <option value="0" @if (optional($user)->status == "0")
                        selected
                        @endif>Inactive</option>
                </select>

            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="float-left" style="float: left;">
            <button class="btn btn-secondary mt-4 mb-0">Cencel</button>
        </div>
        <div class="float-right" style="float: right;">
            <button class="btn btn-primary mt-4 mb-0" type="submit">Submit</button>
        </div>
    </div>