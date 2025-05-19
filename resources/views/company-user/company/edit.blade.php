@extends('company-user.master')

@section('title','Edit Company')

@section('body')


    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Edit Company</li>
                </ol>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="media-body">
                        <p class="mb-0">{{session('message')}}</p>
                    </div>
                    <div class="row">

                        <form action="{{ route('company-user.company.update', $company->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') <!-- Add the method to indicate the update action -->

                            <div class="col-xl-8">
                                <div class="card h-auto">
                                    <div class="card-body">
                                        <!-- Hidden User ID -->
                                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                                        <!-- Company Name -->
                                        <div class="mb-3">
                                            <label class="form-label">Company Name</label>
                                            <input type="text" name="name" class="form-control" placeholder="Company Name" value="{{ old('name', $company->name) }}">
                                            @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Industry -->
                                        <div class="mb-3">
                                            <label class="form-label w-100">Industry</label>
                                            <select class="form-control solid default-select" name="industry">
                                                <option disabled>Select Industry</option>
                                                <option value="IT" {{ old('industry', $company->industry) == 'IT' ? 'selected' : '' }}>Information Technology</option>
                                                <option value="Healthcare" {{ old('industry', $company->industry) == 'Healthcare' ? 'selected' : '' }}>Healthcare</option>
                                                <option value="Finance" {{ old('industry', $company->industry) == 'Finance' ? 'selected' : '' }}>Finance</option>
                                                <option value="Education" {{ old('industry', $company->industry) == 'Education' ? 'selected' : '' }}>Education</option>
                                                <option value="Manufacturing" {{ old('industry', $company->industry) == 'Manufacturing' ? 'selected' : '' }}>Manufacturing</option>
                                                <option value="Retail" {{ old('industry', $company->industry) == 'Retail' ? 'selected' : '' }}>Retail</option>
                                                <option value="Construction" {{ old('industry', $company->industry) == 'Construction' ? 'selected' : '' }}>Construction</option>
                                                <option value="Media" {{ old('industry', $company->industry) == 'Media' ? 'selected' : '' }}>Media</option>
                                                <option value="Hospitality" {{ old('industry', $company->industry) == 'Hospitality' ? 'selected' : '' }}>Hospitality</option>
                                                <option value="Transportation" {{ old('industry', $company->industry) == 'Transportation' ? 'selected' : '' }}>Transportation</option>
                                                <option value="Agriculture" {{ old('industry', $company->industry) == 'Agriculture' ? 'selected' : '' }}>Agriculture</option>
                                                <option value="Automotive" {{ old('industry', $company->industry) == 'Automotive' ? 'selected' : '' }}>Automotive</option>
                                                <option value="Aerospace" {{ old('industry', $company->industry) == 'Aerospace' ? 'selected' : '' }}>Aerospace</option>
                                                <option value="Energy" {{ old('industry', $company->industry) == 'Energy' ? 'selected' : '' }}>Energy</option>
                                                <option value="Entertainment" {{ old('industry', $company->industry) == 'Entertainment' ? 'selected' : '' }}>Entertainment</option>
                                                <option value="Telecommunications" {{ old('industry', $company->industry) == 'Telecommunications' ? 'selected' : '' }}>Telecommunications</option>
                                                <option value="Pharmaceuticals" {{ old('industry', $company->industry) == 'Pharmaceuticals' ? 'selected' : '' }}>Pharmaceuticals</option>
                                                <option value="Real Estate" {{ old('industry', $company->industry) == 'Real Estate' ? 'selected' : '' }}>Real Estate</option>
                                                <option value="Food & Beverages" {{ old('industry', $company->industry) == 'Food & Beverages' ? 'selected' : '' }}>Food & Beverages</option>
                                                <option value="Nonprofit" {{ old('industry', $company->industry) == 'Nonprofit' ? 'selected' : '' }}>Nonprofit</option>
                                                <option value="Consulting" {{ old('industry', $company->industry) == 'Consulting' ? 'selected' : '' }}>Consulting</option>
                                                <option value="Government" {{ old('industry', $company->industry) == 'Government' ? 'selected' : '' }}>Government</option>
                                                <option value="Legal" {{ old('industry', $company->industry) == 'Legal' ? 'selected' : '' }}>Legal</option>
                                                <option value="Logistics" {{ old('industry', $company->industry) == 'Logistics' ? 'selected' : '' }}>Logistics</option>
                                                <option value="Mining" {{ old('industry', $company->industry) == 'Mining' ? 'selected' : '' }}>Mining</option>
                                                <option value="Fashion" {{ old('industry', $company->industry) == 'Fashion' ? 'selected' : '' }}>Fashion</option>
                                                <option value="Sports" {{ old('industry', $company->industry) == 'Sports' ? 'selected' : '' }}>Sports</option>
                                                <option value="Utilities" {{ old('industry', $company->industry) == 'Utilities' ? 'selected' : '' }}>Utilities</option>
                                                <option value="Other" {{ old('industry', $company->industry) == 'Other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                            @error('industry')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Location -->
                                        <div class="mb-3">
                                            <label class="form-label">Location</label>
                                            <input type="text" name="location" class="form-control" placeholder="Location" value="{{ old('location', $company->location) }}">
                                            @error('location')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Description -->
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="about" id="ckeditor">{{ old('about', $company->about) }}</textarea>
                                            @error('about')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Status -->
                                        <div class="mb-3">
                                            <label class="form-label w-100">Status</label>
                                            <select class="form-control solid default-select" name="status">
                                                <option disabled>Select Status</option>
                                                <option value="1" {{ old('status', $company->status) == '1' ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ old('status', $company->status) == '0' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            @error('status')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Image -->
                                        <div class="cm-content-body publish-content form excerpt">
                                            <label for="formFileLg" class="form-label">Image</label>
                                            <div class="card-body">
                                                <div class="avatar-upload d-flex align-items-center">
                                                    <div class="position-relative">
                                                        <div class="avatar-preview">
                                                            <div id="imagePreview" style="background-image: url('{{ $company->image ? asset($company->image) : 'https://mophy.dexignzone.com/xhtml/page-error-404.html' }}');"></div>
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


                                        <!-- Submit Button -->
                                        <div class="mb-3">
                                            <button class="btn btn-primary btn-sm me-2" type="submit">
                                                Update Company
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
