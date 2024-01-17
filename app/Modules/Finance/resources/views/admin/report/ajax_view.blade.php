<div class="table-responsive">
    <button class="btn btn-primary" style="float: right;" onclick="printDiv('printableArea')"><i class="fa fa-print" aria-hidden="true"></i> প্রিন্ট</button>
    <div id="printableArea">
        <table id="list" class="table dt-responsive table-bordered table-striped nowrap" id="basic-datatable">
                                        
            <thead>
                <tr>
                    <th class="wd-15p border-bottom-0">নম্বর </th>
                    <th class="wd-15p border-bottom-0">বিবরণ </th>
                    <th class="wd-15p border-bottom-0">টাকার পরিমান </th>
                    <th class="wd-15p border-bottom-0">তারিখ </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $d)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $d->description }}</td>
                        <td>{{ en_to_bn($d->amount) }}</td>
                        <td>{{ en_to_bn($d->date) }}</td>
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