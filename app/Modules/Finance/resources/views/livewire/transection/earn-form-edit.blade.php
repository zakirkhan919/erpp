<div>
    <div>
        <form wire:submit.prevent="save">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group ">
                        <label for="exampleInputDescription" class="form-label">নগদ গ্রহন এর বিস্তারিত লিখুন<span class="text-danger">*</span></label>
                        <textarea type="text" class="form-control @error('description') is-invalid @enderror"
                            id="exampleInputDescription" placeholder="নগদ গ্রহন এর বিস্তারিত লিখুন" wire:model.lazy='description'></textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group ">
                        <label for="exampleInputAmount" class="form-label">টাকা এর পরিমান<span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('amount') is-invalid @enderror"
                            id="exampleInputAmount" placeholder="টাকা এর পরিমান" wire:model.lazy='amount'>
                        @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group ">
                        <label for="exampleInputdate" class="form-label">তারিখ সিলেক্ট করুন<span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror"
                            id="exampleInputdate" placeholder="তারিখ সিলেক্ট করুন" wire:model.lazy='date'>
                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="float-left" style="float: left;">
                <button class="btn btn-secondary mt-4 mb-0" type="button">বাতিল</button>
            </div>
            <div class="float-right" style="float: right;">
                <button class="btn btn-primary mt-4 mb-0" type="submit">
                        সংযুক্তি <span wire:loading wire:target='save'> সংরক্ষণ হচ্ছে ...</span></button>
            </div>
        </form>
    </div>

</div>

