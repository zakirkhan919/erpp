<div>
    <div>
        <form wire:submit.prevent="save">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputType" class="form-label">সদস্যের প্রকার<span
                                class="text-danger">*</span></label>
                        <select class="form-control @error('type_id') is-invalid @enderror"
                            data-placeholder="সিলেক্ট করুন" wire:model='type_id'>
                            <option label="সিলেক্ট করুন"></option>
                            @foreach ($types as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('type_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
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
                    <div class="form-group">
                        <label for="exampleInputBaba" class="form-label">বাবা / স্বামীর নাম<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control  @error('ref') is-invalid @enderror"
                            id="exampleInputBaba" placeholder="বাবা / রেফ" wire:model='ref'>
                        @error('ref')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputRefarence" class="form-label">রেফারেন্স <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="exampleInputRefarence" placeholder="রেফারেন্স"
                            wire:model='reference'>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputCountry" class="form-label">দেশ <span
                                class="text-danger">*</span></label>

                        <select class="form-control @error('country') is-invalid @enderror"
                            data-placeholder="একটি সিলেক্ট করুন" wire:model='country'>
                            <option label="একটি সিলেক্ট করুন"></option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->bn_name }}</option>
                            @endforeach
                        </select>
                        @error('country')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputdistrict" class="form-label">জেলা<span
                                class="text-danger">*</span></label>
                        <select class="form-control @error('district') is-invalid @enderror"
                            data-placeholder="একটি সিলেক্ট করুন" wire:model='district'>
                            <option label="একটি সিলেক্ট করুন"></option>
                            @foreach ($districts as $item)
                                <option value="{{ $item->id }}">{{ $item->bn_name }}</option>
                            @endforeach
                        </select>
                        @error('district')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputThana" class="form-label">থানা<span class="text-danger">*</span></label>
                        <select class="form-control @error('thana') is-invalid @enderror"
                            data-placeholder="একটি সিলেক্ট করুন" wire:model='thana' {{ $thanas ? '' : 'disabled' }}>
                            <option label="একটি সিলেক্ট করুন"></option>
                            @if ($thanas)
                                @foreach ($thanas as $item)
                                    <option value="{{ $item->id }}">{{ $item->bn_name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('thana')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label for="exampleInputunion" class="form-label">ডাকঘর<span
                                class="text-danger">*</span></label>
                        <select class="form-control @error('postOffice') is-invalid @enderror" data-placeholder="Choose one"
                        wire:model='postOffice' {{ $postoffice ? '' : 'disabled' }}>
                            <option label="Choose one"></option>
                            @if ($postoffice)
                                @foreach ($postoffice as $item)
                                    <option value="{{ $item->id }}">{{ $item->bn_name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('postOffice')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group ">
                        <label for="exampleInputunion" class="form-label">ইউনিয়ন<span
                                class="text-danger">*</span></label>
                        <select class="form-control @error('union_id') is-invalid @enderror" data-placeholder="Choose one"
                            wire:model='union_id'>
                            <option label="একটি সিলেক্ট করুন"></option>
                            @if ($unions)
                                @foreach ($unions as $item)
                                    <option value="{{ $item->id }}">{{ $item->bn_name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('union_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group ">
                        <label for="exampleInputVillage" class="form-label">গ্রাম<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('village') is-invalid @enderror"
                            id="exampleInputVillage" wire:model.lazy='village' placeholder="গ্রাম">
                        @error('village')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group ">
                        <label for="exampleInputphone" class="form-label">ফোন<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                            id="exampleInputphone" wire:model.lazy='phone' placeholder="ফোন">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInpuNID" class="form-label">এন আই ডি</label>
                        <input type="text" class="form-control  @error('nid') is-invalid @enderror"
                            id="exampleInpuNID" placeholder="এন আই ডি নাম্বার" wire:model='nid'>
                        @error('nid')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputBloodGroup" class="form-label">রক্তের গ্রুপ</label>
                        <input type="text" class="form-control  @error('blood_group') is-invalid @enderror"
                            id="exampleInputBloodGroup" placeholder="রেফারেন্স" wire:model='blood_group'>
                        @error('blood_group')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label class="form-label">অবস্থা</label>
                        <select class="form-control" wire:model='status'>
                            <option value="1">সক্রিয়</option>
                            <option value="0">নিষ্ক্রিয়</option>

                        </select>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="formFile" class="form-label mt-0">সদস্যের ছবি</label>
                        <input class="form-control" type="file" id="formFile" wire:model='image'>
                    </div>
                </div>
                <div class="col-md-2">
                    @if ($image)
                        <img width="150" height="150" class="rounded-circle"
                            src="{{ $image->temporaryUrl() }}" alt="Member Image">
                    @else
                        @if($imageShow)
                        <img width="150" height="150" class="rounded-circle" src="{{ asset($imageShow) }}"
                            alt="Member Image">
                        @else
                        <img width="150" height="150px" src="{{ asset("assets/admin/images/dami.png") }}"
                        alt="Member Image">
                        @endif
                    @endif
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

@push('scripts3')
    <script>
        $(document).ready(function() {
            $('#select2').select2();
            $('#select2').on('change', function(e) {
                var data = $('#select2').select2("val");
                @this.set('selected', data);
            });
        });
    </script>
@endpush
