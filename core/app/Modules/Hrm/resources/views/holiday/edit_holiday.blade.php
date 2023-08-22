<form action="{{ route('update-occasion-holiday') }}" method="post">
    @csrf
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <div class="form-group">
                    <label for="">Holidays Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" placeholder="" name="date" value="{{ $data->date }}">
                </div>
            </div>
            <div class="col-sm-6 col-md-6">
                <div class="form-group">
                    <label for="">Occasion <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Write Occasion" name="occasion" value="{{ $data->occasion}}">
                </div>
            </div>
            <div class="col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" class="form-control" id="" cols="30" rows="10" placeholder="Write Description(optional)"></textarea>
                </div>
            </div>
        </div>
        <div class="float-left" style="float: left;">
            <button class="btn btn-danger mt-4 mb-2">Cencel</button>
        </div>
        <div class="float-right" style="float: right;">
            <button type="submit" class="btn btn-primary mt-4 mb-2" type="submit">
                Submit </button>
        </div>
    </div>
</form>