<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 90px;
        height: 30px;
    }

    .switch input {
        display: none;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ca2222;
        -webkit-transition: .4s;
        transition: .4s;
        border-radius: 34px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 24px;
        width: 26px;
        left: 4px;
        bottom: 3.5px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked+.slider {
        background-color: #2ab934;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(55px);
    }

    /*------ ADDED CSS ---------*/
    .slider:after {
        content: 'Leave';
        color: white;
        display: block;
        position: absolute;
        transform: translate(-50%, -50%);
        top: 45%;
        left: 65%;
        font-size: 12px;
        font-family: Verdana, sans-serif;
    }

    input:checked+.slider:after {
        content: 'Present';
        left: 35%;
    }

    input:checked+#present {
        display: block;
    }

    /*--------- END --------*/
</style>
<form action="{{ route('submit_attendance') }}" method="POST">
    @csrf
<table class="table table-bordered text-nowrap border-bottom dataTable no-footer" id="responsive-datatable" role="grid"
    aria-describedby="responsive-datatable_info">
    <thead>
        <tr role="row">

            <th class="wd-15p border-bottom-0 sorting sorting_asc" tabindex="0" aria-controls="responsive-datatable"
                rowspan="1" colspan="1" aria-sort="ascending"
                aria-label="First name: activate to sort column descending">Id</th>
            <th class="wd-15p border-bottom-0 sorting sorting_asc" tabindex="0" aria-controls="responsive-datatable"
                rowspan="1" colspan="1" aria-sort="ascending"
                aria-label="First name: activate to sort column descending">Employee name</th>
            <th class="wd-15p border-bottom-0 sorting" tabindex="0" aria-controls="responsive-datatable"
                rowspan="1" colspan="1" aria-label="Last name: activate to sort column ascending">Roaster Time
            </th>
            <th class="wd-20p border-bottom-0 sorting" tabindex="0" aria-controls="responsive-datatable"
                rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">status</th>
            <th class="wd-20p border-bottom-0 sorting" tabindex="0" aria-controls="responsive-datatable"
                rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending"
                style="width: 400px;"></th>

        </tr>
    </thead>
        <tbody>

            @foreach ($data as $item)
                <tr class="odd">
                    <input type="hidden" name="attendance[]" value="">
                    <input type="hidden" name="roaster_id[]" value="{{ $item->id }}">
                    <input type="hidden" name="date[]" value="{{ $item->date }}">
                    <td>{{ $item->employee->id }}</td>
                    <td class="sorting_1">{{ $item->employee->name }}</td>
                    <td>{{ $item->start_time }}-{{ $item->end_time }}</td>
                    <td><label class="switch">
                            <input type="checkbox" id="togBtn" name="status[]" value="0" onchange="CheckboxChnage(this)">
                            <div class="slider round"></div>
                        </label>
                    </td>
                    <td style="width: 400px;">
                        <div id="leave">
                            <div class="row">
                                <div class="col-md-6">
                                    <select name="leave_type[]" id="" class="form-control">
                                        <option value="">Select Type</option>
                                        <option value="Sick">Sick</option>
                                        <option value="Casual">Casual</option>
                                        <option value="Maternity">Maternity</option>
                                        <option value="Unipaid">Unipaid</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <textarea name="reason[]" class="form-control" id="" rows="2" placeholder="Type Reason*"></textarea>
                                </div>
                            </div>
                        </div>
                        <div id="present" style="display: none;">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="time" name="start_time[]" id="start_time" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <input type="time" name="end_time[]" id="end_time" class="form-control">
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach


        </tbody>
        
    </table>
    <input type="submit" name="attendenceSubmit" value="submit" id="" class="btn btn-primary">
</form>
