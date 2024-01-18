<div>
    
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#districtselect').select2();
            $('#districtselect').on('change', function(e) {
                var data = $('#districtselect').select2("val");
                @this.set('district', data);
            });
            $('#thanaselect').select2();
            $('#thanaselect').on('change', function(e) {
                var data = $('#thanaselect').select2("val");
                @this.set('thana', data);
            });
        });
    </script>
@endpush
