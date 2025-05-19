@extends('university-user.master')

@section('title','Add University')

@section('body')


    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Add University Detail</li>
                </ol>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="media-body">
                        <p class="mb-0">{{session('message')}}</p>
                    </div>
                    <div class="row">

                        <form action="{{ route('university-user.university.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-xl-8">
                                <div class="card h-auto">
                                    <div class="card-body">
                                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}">
                                            @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">University Type</label>
                                            <select name="university_type" class="form-control">
                                                <option disabled selected>Select University Type</option>
                                                <option value="public" {{ old('university_type') == 'public' ? 'selected' : '' }}>Public</option>
                                                <option value="private" {{ old('university_type') == 'private' ? 'selected' : '' }}>Private</option>
                                            </select>
                                            @error('university_type')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" id="ckeditor">{{ old('description') }}</textarea>
                                            @error('description')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Rank</label>
                                            <input type="number" name="rank" class="form-control" placeholder="University Rank" value="{{ old('rank') }}">
                                            @error('rank')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Tuition Fees</label>
                                            <input type="text" name="tuition_fees" class="form-control" placeholder="Tuition Fees" value="{{ old('tuition_fees') }}">
                                            @error('tuition_fees')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Campus Facilities</label>
                                            <textarea name="campus_facilities" class="form-control" rows="3" placeholder="Campus Facilities">{{ old('campus_facilities') }}</textarea>
                                            @error('campus_facilities')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Scholarships</label>
                                            <textarea name="scholarships" class="form-control" rows="3" placeholder="Scholarships Details">{{ old('scholarships') }}</textarea>
                                            @error('scholarships')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Placement Records</label>
                                            <textarea name="placement_records" class="form-control" rows="3" placeholder="Placement Records">{{ old('placement_records') }}</textarea>
                                            @error('placement_records')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Residence Facilities</label>
                                            <textarea name="residence_facilities" class="form-control" rows="3" placeholder="Residence Facilities">{{ old('residence_facilities') }}</textarea>
                                            @error('residence_facilities')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Food Facilities</label>
                                            <textarea name="food_facilities" class="form-control" rows="3" placeholder="Food Facilities">{{ old('food_facilities') }}</textarea>
                                            @error('food_facilities')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Average Living Cost</label>
                                            <input type="text" name="avg_living_cost" class="form-control" placeholder="Average Living Cost" value="{{ old('avg_living_cost') }}">
                                            @error('avg_living_cost')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label w-100">Status</label>
                                            <select class="form-control solid default-select" name="status">
                                                <option disabled selected>Select Status</option>
                                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            @error('status')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="cm-content-body publish-content form excerpt">
                                            <div class="card-body">
                                                <div class="avatar-upload d-flex align-items-center">
                                                    <div class="position-relative">
                                                        <div class="avatar-preview">
                                                            <div id="imagePreview" style="background-image: url(https://mophy.dexignzone.com/xhtml/page-error-404.html);"></div>
                                                        </div>
                                                        <div class="change-btn d-flex align-items-center flex-wrap">
                                                            <input type='file' name="image" class="form-control d-none" id="imageUpload" accept=".png, .jpg, .jpeg">
                                                            <label for="imageUpload" class="btn btn-primary light btn-sm ms-0">Select Image</label>
                                                            @error('image')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary btn-sm me-2" type="submit" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                Create University
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->

@endsection
