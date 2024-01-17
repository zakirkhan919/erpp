<div class="table-responsive">
    <button class="btn btn-primary" style="float: right;" onclick="printDiv('printableArea')"><i class="fa fa-print" aria-hidden="true"></i> প্রিন্ট</button>
    <div id="printableArea">
    <table id="list" class="table dt-responsive table-bordered table-striped nowrap" id="basic-datatable">
        <thead>
            <tr>
                <th class="wd-15p border-bottom-0">নম্বর </th>
                <th class="wd-15p border-bottom-0">ছবি </th>
                <th class="wd-15p border-bottom-0">সদস্যের প্রকার </th>
                <th class="wd-15p border-bottom-0">নাম </th>
                <th class="wd-20p border-bottom-0">বাবা / রেফ</th>
                <th class="wd-20p border-bottom-0">জেলা</th>
                <th class="wd-20p border-bottom-0">থানা</th>
                <th class="wd-15p border-bottom-0">ইউনিয়ন* </th>
                <th class="wd-10p border-bottom-0">গ্রাম </th>
                <th class="wd-25p border-bottom-0">ডাকঘর </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $d)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td><img width="50" height="50" class="rounded-circle" src="{{ asset($d->image) }}"
                        alt="Member Image"></td>
                    <td>{{ $d->type->name }}</td>
                    <td>{{ $d->name }}</td>
                    <td>{{ $d->ref }}</td>
                    <td>{{ $d->district->bn_name }}</td>
                    <td>{{ $d->thana->bn_name }}</td>
                    <td>{{ $d->union->bn_name}}</td>
                    <td>{{ $d->village }}</td>
                    <td>{{ $d->postOffice }}</td>
                </tr>
            @endforeach
            
        </tbody>
    </table>
    </div>
</div>

    <script>
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();
    
     document.body.innerHTML = originalContents;
     location.reload();
}
</script>