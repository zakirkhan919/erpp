<div class="card-body">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="first_name">প্রথম নাম <span class='required-star'>*</span></label>
                <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('name', optional($user)->first_name) }}" autofocus>

            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="last_name">শেষ নাম <span class='required-star'></span></label>
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
                <label for="phone">ফোন <span class='required-star'></span></label>
                <input id="phone" type="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('name', optional($user)->phone) }}" autofocus>

            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="type">ব্যবহারকারী টাইপ <span class='required-star'>*</span></label>
                <select name="type" id="type" class="form-control">
                    <option value="" disabled selected>ব্যবহারকারী টাইপ নির্বাচন</option>
                    <option value="এডমিন" @if(optional($user)->type == "admin") selected @endif>এডমিন</option>
                    <option value="ম্যানেজার" @if(optional($user)->type == "manager") selected @endif>ম্যানেজার</option>
                    <option value="অপারেটর" @if(optional($user)->type == "user") selected @endif>অপারেটর</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="role">ভূমিকা <span class='required-star'>*</span></label>
                <select name="role_id" id="role_id" class="form-control">
                    <option value="" disabled selected>ভূমিকা নির্বাচন</option>
                    @foreach($permissions as $permission)
                        <option value="{{$permission->id}}" @if(optional($user)->role_id == $permission->id) selected @endif>{{$permission->name}}</option>
                    @endforeach
                </select>

            </div>
        </div>
        <div class="col-md-4 @if($user) d-none @endif">
            <div class="form-group">
                <label for="password">পাসওয়ার্ড  <span class='required-star'>*</span></label>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password', optional($user)->password) }}" autofocus>

            </div>
        </div>
        <div class="col-md-4 @if($user) d-none @endif">
            <div class="form-group">
                <label for="confirm_password">কন্ফার্ম পাসওয়ার্ড <span class='required-star'>*</span></label>
                <input id="confirm_password" type="password" class="form-control{{ $errors->has('confirm_password') ? ' is-invalid' : '' }}" name="confirm_password" value="{{ old('confirm_password', optional($user)->confimr_password) }}" autofocus>

            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="image">ছবি</label>

                <div class="input-group mb-1">
                    <div class="custom-file">
                        <input type="file" value="{{ optional($user)->image }}" name="image" id="image" class="form-control-file{{ $errors->has('image') ? ' is-invalid' : '' }}" accept="image/jpeg, image/png" onchange="imageUpload(this, 'show_photo')">
                        
                    </div>
                </div>

                



                {{--Show image--}}
                {{-- @if(App\Libraries\CommonFunction::getImageFromURL(optional($user)->image, '', 'show_photo')) --}}
                {{-- <div class="mb-1">
                    {!! App\Libraries\CommonFunction::getImageFromURL(optional($user)->image, '', 'show_photo') !!}
                </div> --}}
                {{-- @endif --}}
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
                        @endif selected>সক্রিয়</option>
                    <option value="0" @if (optional($user)->status == "0")
                        selected
                        @endif>নিষ্ক্রিয়</option>
                </select>

            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="float-left" style="float: left;">
            <button class="btn btn-secondary mt-4 mb-0">বাতিল</button>
        </div>
        <div class="float-right" style="float: right;">
            <button class="btn btn-primary mt-4 mb-0" type="submit">
                সংযুক্তি</button>
        </div>
    </div>