<div class="card-body">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="name">Role name <span class='required-star'></span></label>
                <input id="name" type="text" required class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', optional($permission)->name) }}" autofocus>
            </div>
        </div>
    </div>
    <div id="userAccess">
        <div class="row">
            <div class="col-md-12 text-center text-white">
                <div>
                    <h2>All Select</h2>
                </div>
            </div>
        </div>
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-md-12">
                <input type="checkbox" onclick="checkAll()" id="selectAll"> <strong style="font-size: 16px;">All Select</strong>
            </div>
        </div>
        <div class="row" id="accessRow">
            <div class="col-md-4">
                <div class="group">
                    <input type="checkbox" id="administration" class="group-head" onclick="onClickGroupHeads()"> <strong>User</strong>
                    <ul ref="administration" style="margin-left: 19px">
                        <li><input type="checkbox" class="access" value="user/view_users" name="access[]" @if($permission !=null) @if (array_search("user/view_users", $access)> -1) checked @endif @endif> View users</li>
                        <li><input type="checkbox" class="access" value="user/add_user" name="access[]" @if($permission !=null) @if (array_search("user/add_user", $access)> -1) checked @endif @endif> Add user</li>
                        <li><input type="checkbox" class="access" value="user/edit_user" name="access[]" @if($permission !=null) @if (array_search("user/edit_user", $access)> -1) checked @endif @endif> update user</li>
                        <li><input type="checkbox" class="access" value="user/delete_user" name="access[]" @if($permission !=null) @if (array_search("user/delete_user", $access)> -1) checked @endif @endif> Delete User</li>

                        <li><input type="checkbox" class="access" value="user/view_role_permissions" name="access[]" @if($permission !=null) @if (array_search("user/view_role_permissions", $access)> -1) checked @endif @endif> View Role Permission</li>
                        <li><input type="checkbox" class="access" value="user/add_role_permission" name="access[]" @if($permission !=null) @if (array_search("user/add_role_permission", $access)> -1) checked @endif @endif> Add role permission</li>
                        <li><input type="checkbox" class="access" value="user/edit_role_permission" name="access[]" @if($permission !=null) @if (array_search("user/edit_role_permission", $access)> -1) checked @endif @endif> Update role permission</li>
                        <li><input type="checkbox" class="access" value="user/delete_role_permission" name="access[]" @if($permission !=null) @if (array_search("user/delete_role_permission", $access)> -1) checked @endif @endif> Delete role permission</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="group">
                    <input type="checkbox" id="creditInfo" class="group-head" onclick="onClickGroupHeads()"> <strong>Seles</strong>
                    <ul ref="creditInfo" style="margin-left: 19px">
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("seller", $access)> -1) checked @endif @endif class="access" value="seller" name="access[]"> Seller</li>
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("customer", $access)> -1) checked @endif @endif class="access" value="Customer" name="access[]">Customer</li>
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("sell", $access)> -1) checked @endif @endif class="access" value="sell" name="access[]"> Sell</li>
                    </ul>
                </div>
                <div class="group">
                    <input type="checkbox" id="spendInfo" class="group-head" onclick="onClickGroupHeads()"> <strong>Product</strong>
                    <ul ref="spendInfo" style="margin-left: 19px">
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("product", $access)> -1) checked @endif @endif class="access" value="Product" name="access[]"> Product</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="group">
                    <input type="checkbox" id="complains" class="group-head" onclick="onClickGroupHeads()"> <strong>Purchase</strong>
                    <ul ref="complains" style="margin-left: 19px">
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("purchase", $access)> -1) checked @endif @endif class="access" value="product" name="access[]"> purchase</li>
                    </ul>
                </div>
                <div class="group">
                    <input type="checkbox" id="report" class="group-head" onclick="onClickGroupHeads()"> Holiday
                    <ul ref="report" style="margin-left: 19px">
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("holiday", $access)> -1) checked @endif @endif class="access" value="Holiday" name="access[]">Holiday</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="group">
                    <input type="checkbox" id="employee" class="group-head" onclick="onClickGroupHeads()"> <strong>Employee</strong>
                    <ul ref="employee" style="margin-left: 19px">
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("department", $access)> -1) checked @endif @endif class="access" value="department" name="access[]"> Department</li>
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("designation", $access)> -1) checked @endif @endif class="access" value="designation" name="access[]"> Designation</li>
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("employee", $access)> -1) checked @endif @endif class="access" value="employee" name="access[]"> Employee</li>
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("bank_detail", $access)> -1) checked @endif @endif class="access" value="bank_detail" name="access[]"> Bank Detail</li>
                    </ul>
                </div>
                <div class="group">
                    <input type="checkbox" id="report" class="group-head" onclick="onClickGroupHeads()"> Roaster
                    <ul ref="report" style="margin-left: 19px">
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("roaster", $access)> -1) checked @endif @endif class="access" value="roaster" name="access[]">Roaster</li>
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("roaster-swap", $access)> -1) checked @endif @endif class="access" value="roaster-swap" name="access[]">Roaster Swap</li>
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("roaster-report", $access)> -1) checked @endif @endif class="access" value="roaster-report" name="access[]">Roaster Report</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="group">
                    <input type="checkbox" id="employee" class="group-head" onclick="onClickGroupHeads()"> <strong>Attendence</strong>
                    <ul ref="employee" style="margin-left: 19px">
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("attendance", $access)> -1) checked @endif @endif class="access" value="attendance" name="access[]"> Attendance</li>
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("view-attendance", $access)> -1) checked @endif @endif class="access" value="view-attendance" name="access[]"> View Attendance</li>
                    </ul>
                </div>
                <div class="group">
                    <input type="checkbox" id="report" class="group-head" onclick="onClickGroupHeads()"> Sallery
                    <ul ref="report" style="margin-left: 19px">
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("miscellaneous", $access)> -1) checked @endif @endif class="access" value="miscellaneous" name="access[]">Miscellaneous</li>
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("provident_fund", $access)> -1) checked @endif @endif class="access" value="provident_fund" name="access[]">Provident Fund</li>
                        <li><input type="checkbox" @if($permission !=null) @if (array_search("add-salary", $access)> -1) checked @endif @endif class="access" value="add-salary" name="access[]">Add Salary</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="float-left" style="float: left;">
            <button class="btn btn-secondary mt-4 mb-0">Cencel</button>
        </div>
        <div class="float-right" style="float: right;">
            <button class="btn btn-primary mt-4 mb-0" type="submit">
                Submit</button>
        </div>
    </div>

    <style>
        .group ul li,
        .group {
            color: #000 !important;
            list-style: none;
        }
    </style>