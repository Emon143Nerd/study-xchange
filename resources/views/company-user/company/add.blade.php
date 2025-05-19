@extends('company-user.master')

@section('title','Add Company')

@section('body')


    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Add Company</li>
                </ol>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="media-body">
                        <p class="mb-0">{{session('message')}}</p>
                    </div>
                    <div class="row">

                        <form action="{{ route('company-user.company.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-xl-8">
                                <div class="card h-auto">
                                    <div class="card-body">
                                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                        <div class="mb-3">
                                            <label class="form-label">Company Name</label>
                                            <input type="text" name="name" class="form-control" placeholder="Company Name" value="{{ old('name') }}">
                                            @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label w-100">Industry</label>
                                            <select class="form-control solid default-select" name="industry">
                                                <option disabled selected>Select Industry</option>
                                                <option value="IT" {{ old('industry') == 'IT' ? 'selected' : '' }}>Information Technology</option>
                                                <option value="Healthcare" {{ old('industry') == 'Healthcare' ? 'selected' : '' }}>Healthcare</option>
                                                <option value="Finance" {{ old('industry') == 'Finance' ? 'selected' : '' }}>Finance</option>
                                                <option value="Education" {{ old('industry') == 'Education' ? 'selected' : '' }}>Education</option>
                                                <option value="Manufacturing" {{ old('industry') == 'Manufacturing' ? 'selected' : '' }}>Manufacturing</option>
                                                <option value="Retail" {{ old('industry') == 'Retail' ? 'selected' : '' }}>Retail</option>
                                                <option value="Construction" {{ old('industry') == 'Construction' ? 'selected' : '' }}>Construction</option>
                                                <option value="Media" {{ old('industry') == 'Media' ? 'selected' : '' }}>Media</option>
                                                <option value="Hospitality" {{ old('industry') == 'Hospitality' ? 'selected' : '' }}>Hospitality</option>
                                                <option value="Transportation" {{ old('industry') == 'Transportation' ? 'selected' : '' }}>Transportation</option>
                                                <option value="Agriculture" {{ old('industry') == 'Agriculture' ? 'selected' : '' }}>Agriculture</option>
                                                <option value="Automotive" {{ old('industry') == 'Automotive' ? 'selected' : '' }}>Automotive</option>
                                                <option value="Aerospace" {{ old('industry') == 'Aerospace' ? 'selected' : '' }}>Aerospace</option>
                                                <option value="Energy" {{ old('industry') == 'Energy' ? 'selected' : '' }}>Energy</option>
                                                <option value="Entertainment" {{ old('industry') == 'Entertainment' ? 'selected' : '' }}>Entertainment</option>
                                                <option value="Telecommunications" {{ old('industry') == 'Telecommunications' ? 'selected' : '' }}>Telecommunications</option>
                                                <option value="Pharmaceuticals" {{ old('industry') == 'Pharmaceuticals' ? 'selected' : '' }}>Pharmaceuticals</option>
                                                <option value="Real Estate" {{ old('industry') == 'Real Estate' ? 'selected' : '' }}>Real Estate</option>
                                                <option value="Food & Beverages" {{ old('industry') == 'Food & Beverages' ? 'selected' : '' }}>Food & Beverages</option>
                                                <option value="Nonprofit" {{ old('industry') == 'Nonprofit' ? 'selected' : '' }}>Nonprofit</option>
                                                <option value="Consulting" {{ old('industry') == 'Consulting' ? 'selected' : '' }}>Consulting</option>
                                                <option value="Government" {{ old('industry') == 'Government' ? 'selected' : '' }}>Government</option>
                                                <option value="Legal" {{ old('industry') == 'Legal' ? 'selected' : '' }}>Legal</option>
                                                <option value="Logistics" {{ old('industry') == 'Logistics' ? 'selected' : '' }}>Logistics</option>
                                                <option value="Mining" {{ old('industry') == 'Mining' ? 'selected' : '' }}>Mining</option>
                                                <option value="Fashion" {{ old('industry') == 'Fashion' ? 'selected' : '' }}>Fashion</option>
                                                <option value="Sports" {{ old('industry') == 'Sports' ? 'selected' : '' }}>Sports</option>
                                                <option value="Utilities" {{ old('industry') == 'Utilities' ? 'selected' : '' }}>Utilities</option>
                                                <option value="Other" {{ old('industry') == 'Other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                            @error('industry')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Location</label>
                                            <input type="text" name="location" class="form-control" placeholder="Location" value="{{ old('location') }}">
                                            @error('location')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="about" id="ckeditor">{{ old('about') }}</textarea>
                                            @error('about')
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
                                            <label for="formFileLg" class="form-label">Image</label>
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
                                                Create Circular
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
