@section('js')
<script src="{{asset('assets/admin/validation/jquery.validate.min.js')}}"></script>
@include('vendor.sweetalert2.sweetalert2_js')
<script>
    function roastersubmit(){
    $("#frmCheckout").validate({
        rules: {
            employee_id: {
                required: true,
            },
            form_date:{
                required:true,
            },
            to_date:{
                required: true,
            },
            shift:{
                required:true,
            },
            start_time:{
                required:true,
            },
            end_time:{
                required:true,
            },
            status:{
                required:true,
            },
            
        },
        onfocusout: function(element) {
            this.element(element); // triggers validation
        },
        onkeyup: function(element, event) {
            this.element(element); // triggers validation
        },
        messages: {
            employee_id: {
                required: "Please Select employee",
            },
            form_date: {
                required: "Please enter your from date",
            },
            to_date:{
                required: "Enter your to date",
                
            },
            start_time:{
                required: "Enter your start time",
            },
            end_time:{
                required: "Enter your end time",
            },
            status:{
                required: "Select status",
            },
        },
    });
}
</script>
@endsection
