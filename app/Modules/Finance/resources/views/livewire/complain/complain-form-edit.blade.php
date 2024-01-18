<div>
    <div>
        <form wire:submit.prevent="save">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group" wire:ignore>

                        <label for="exampleInputType" class="form-label">সদস্যের নাম<span
                                class="text-danger">*</span></label>
                        <select class="form-control @error('member_id') is-invalid @enderror"
                            data-placeholder="সিলেক্ট করুন" wire:model='member_id' id="select2">
                            <option label="সিলেক্ট করুন"></option>
                            @foreach ($members as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('member_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label for="exampleInputName" class="form-label">নাম<span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            id="exampleInputName" placeholder="নাম" wire:model.lazy='name'>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label for="exampleInputNumber" class="form-label">মোবাইল নম্বর<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('number') is-invalid @enderror"
                            id="exampleInputNumber" placeholder="মোবাইল নম্বর" wire:model.lazy='number'>
                        @error('number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputDescription" class="form-label">অভিযোগ বিস্তারিত <span
                                class="text-danger">*</span></label>
                        <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="exampleInputDescription"
                            placeholder="অভিযোগ বিস্তারিত" wire:model='description'></textarea>

                    </div>
                </div>
            </div>
            <div class="float-left" style="float: left;">
                <button class="btn btn-danger mt-4 mb-0" type="button">বাতিল</button>
            </div>
            <div class="float-right" style="float: right;">
                <button class="btn btn-primary mt-4 mb-0" type="submit">
                    সংযুক্তি <span wire:loading wire:target='save'> সংরক্ষণ হচ্ছে ...</span></button>
            </div>
        </form>
    </div>

</div>

@push('scripts3')
    <script>
        $(document).ready(function() {
            $('#select2').select2();
            $('#select2').on('change', function(e) {
                var data = $('#select2').select2("val");
                @this.set('member_id', data);
            });
        });
    </script>
@endpush
