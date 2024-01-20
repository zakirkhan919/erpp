<div class="card-body">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="name">Role Name <span class='required-star'></span></label>
                <input id="name" type="text" required class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', optional($permission)->name) }}" autofocus>

            </div>
        </div>

    </div>
    <div id="userAccess">
        <div class="row">
            <div class="col-md-12 text-center text-white">
                <div>
                    <h2>Select Permission</h2>
                </div>
            </div>
        </div>
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-md-12">
                <input type="checkbox" onclick="checkAll()" id="selectAll"> <strong style="font-size: 16px;">Select Permission</strong>
            </div>
        </div>
        <div class="row" id="accessRow">
            <div class="col-md-4">
                <div class="group">
                    <input type="checkbox" id="administration" class="group-head" onclick="onClickGroupHeads()"> <strong>User</strong>
                    <ul ref="administration" style="margin-left: 19px">
                        <li><input type="checkbox" class="access" value="user/view_users" name="access[]" @if($permission !=null) @if (array_search("user/view_users", $access)> -1) checked @endif @endif> User View</li>
                        <li><input type="checkbox" class="access" value="user/add_user" name="access[]" @if($permission !=null) @if (array_search("user/add_user", $access)> -1) checked @endif @endif> User Add</li>
                        <li><input type="checkbox" class="access" value="user/edit_user" name="access[]" @if($permission !=null) @if (array_search("user/edit_user", $access)> -1) checked @endif @endif> User Update</li>
                        <li><input type="checkbox" class="access" value="user/delete_user" name="access[]" @if($permission !=null) @if (array_search("user/delete_user", $access)> -1) checked @endif @endif> User Remove</li>

                        <li><input type="checkbox" class="access" value="user/view_role_permissions" name="access[]" @if($permission !=null) @if (array_search("user/view_role_permissions", $access)> -1) checked @endif @endif> Role Permission View</li>
                        <li><input type="checkbox" class="access" value="user/add_role_permission" name="access[]" @if($permission !=null) @if (array_search("user/add_role_permission", $access)> -1) checked @endif @endif> Role Permission Add</li>
                        <li><input type="checkbox" class="access" value="user/edit_role_permission" name="access[]" @if($permission !=null) @if (array_search("user/edit_role_permission", $access)> -1) checked @endif @endif> Role Permission Update</li>
                        <li><input type="checkbox" class="access" value="user/delete_role_permission" name="access[]" @if($permission !=null) @if (array_search("user/delete_role_permission", $access)> -1) checked @endif @endif> Role Permission Remove</li>
                    </ul>
                </div>
                {{-- <div class="group">
                    <input type="checkbox" id="members" class="group-head" onclick="onClickGroupHeads()"> <strong>Member Data</strong>
                    <ul ref="members" style="margin-left: 19px">
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("members", $access)> -1) checked @endif @endif class="access" value="members" name="access[]"> Member Data View</li>
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("member/add", $access)> -1) checked @endif @endif class="access" value="member/add" name="access[]"> Member Data Add</li>
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("member/edit/*", $access)> -1) checked @endif @endif class="access" value="member/edit/*" name="access[]"> Member Data Edit</li>
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("member/delete", $access)> -1) checked @endif @endif class="access" value="member/delete" name="access[]"> Member Data Remove</li>
                    </ul>
                </div> --}}
                {{-- <div class="group">

                    <li><input type="checkbox" @if($permission !=null) @if (array_search("committe", $access)> -1) checked @endif @endif class="access" value="committe" name="access[]"> Committee Member Data</li>
                    <li><input type="checkbox" @if($permission !=null) @if (array_search("kholipa", $access)> -1) checked @endif @endif class="access" value="kholipa" name="access[]"> Kholifa Member Data</li>


                </div> --}}
            </div>
            <div class="col-md-4">
                <div class="group">
                    <input type="checkbox" id="creditInfo" class="group-head" onclick="onClickGroupHeads()"> <strong>Credit Earn</strong>
                    <ul ref="creditInfo" style="margin-left: 19px">
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("amount/credit", $access)> -1) checked @endif @endif class="access" value="amount/credit" name="access[]"> Credit Earn View</li>
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("amount/credit/add", $access)> -1) checked @endif @endif class="access" value="amount/credit/add" name="access[]">Credit Earn Add</li>
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("amount/credit/edit/*", $access)> -1) checked @endif @endif class="access" value="amount/credit/edit/*" name="access[]"> Credit Earn Edit</li>
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("amount/credit/delete", $access)> -1) checked @endif @endif class="access" value="amount/credit/delete" name="access[]"> Credit Earn Remove</li>
                    </ul>
                </div>
                <div class="group">
                    <input type="checkbox" id="spendInfo" class="group-head" onclick="onClickGroupHeads()"> <strong>Credit Cost</strong>
                    <ul ref="spendInfo" style="margin-left: 19px">
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("amount/spend", $access)> -1) checked @endif @endif class="access" value="amount/spend" name="access[]"> Credit Cost View</li>
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("amount/spend/add", $access)> -1) checked @endif @endif class="access" value="amount/spend/add" name="access[]">Credit Cost Add</li>
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("amount/spend/edit/*", $access)> -1) checked @endif @endif class="access" value="amount/spend/edit/*" name="access[]"> Credit Cost Edit</li>
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("amount/spend/delete", $access)> -1) checked @endif @endif class="access" value="amount/spend/delete" name="access[]"> Credit Cost Remove</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                {{-- <div class="group">
                    <input type="checkbox" id="complains" class="group-head" onclick="onClickGroupHeads()"> <strong>অভিযোগ Data</strong>
                    <ul ref="complains" style="margin-left: 19px">
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("complains", $access)> -1) checked @endif @endif class="access" value="complains" name="access[]"> অভিযোগ Data View</li>
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("complain/add", $access)> -1) checked @endif @endif class="access" value="complain/add" name="access[]">অভিযোগ Data যোগ</li>
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("complain/edit/*", $access)> -1) checked @endif @endif class="access" value="complain/edit/*" name="access[]"> অভিযোগ Data Edit</li>
                    </ul>
                </div> --}}
                <div class="group">
                    <input type="checkbox" id="report" class="group-head" onclick="onClickGroupHeads()"> Report
                    <ul ref="report" style="margin-left: 19px">
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("financial", $access)> -1) checked @endif @endif class="access" value="financial" name="access[]">Financial Report View</li>
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("member/report", $access)> -1) checked @endif @endif class="access" value="member/report" name="access[]">Member Report View</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="float-left" style="float: left;">
            <button class="btn btn-secondary mt-4 mb-0">Cancel</button>
        </div>
        <div class="float-right" style="float: right;">
            <button class="btn btn-primary mt-4 mb-0" type="submit">
                Sumit</button>
        </div>
    </div>

    <style>
        .group ul li,
        .group {
            color: #000 !important;
            list-style: none;
        }
    </style>
