@extends('university-user.master')

@section('title','Add Admission Circular')

@section('body')


    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Add Admission Circular</li>
                </ol>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="media-body">
                        <p class="mb-0">{{session('message')}}</p>
                    </div>
                    <div class="row">

                        <form action="{{ route('university-user.admission-circular.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-xl-8">
                                <div class="card h-auto">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label">University Name</label>
                                            <select class="form-control default-select h-auto wide" name="university_id">
                                                <option value="" disabled selected>Select University Name</option>
                                                @foreach($universities as $university)
                                                    <option value="{{ $university->id }}" {{ old('university_id') == $university->id ? 'selected' : '' }}>
                                                        {{ $university->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('university_id')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Subject Category</label>
                                            <select class="form-control default-select h-auto wide" name="subject_category_id">
                                                <option value="" disabled selected>Select Subject Category</option>
                                                @foreach($subjectCategories as $subjectCategory)
                                                    <option value="{{ $subjectCategory->id }}" {{ old('subject_category_id') == $subjectCategory->id ? 'selected' : '' }}>
                                                        {{ $subjectCategory->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('subject_category_id')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Circular Title</label>
                                            <input type="text" name="title" class="form-control" placeholder="Circular Title" value="{{ old('title') }}">
                                            @error('title')
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
                                            <label class="form-label">Total Fees</label>
                                            <input type="text" name="total_fees" class="form-control" placeholder="Total Fees" value="{{ old('total_fees') }}">
                                            @error('total_fees')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Minimum GPA Requirement</label>
                                            <input type="text" name="min_gpa_req" class="form-control" placeholder="Minimum GPA Requirement" value="{{ old('min_gpa_req') }}">
                                            @error('min_gpa_req')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
{{--                                        <div class="col-xl-3">--}}
{{--                                            <div class="card">--}}
{{--                                                <div class="card-body">--}}
{{--                                                    <label class="form-label">Start Date</label>--}}
{{--                                                    <input name="start_date" placeholder="Start Date" class="datepicker-default form-control" id="datepicker">--}}
{{--                                                    @error('start_date')--}}
{{--                                                    <div class="text-danger mt-2">{{ $message }}</div>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-xl-3">--}}
{{--                                            <div class="card">--}}
{{--                                                <div class="card-body">--}}
{{--                                                    <label class="form-label">End Date</label>--}}
{{--                                                    <input name="end_date" placeholder="End Date" class="datepicker-default form-control" id="datepicker">--}}
{{--                                                    @error('end_date')--}}
{{--                                                    <div class="text-danger mt-2">{{ $message }}</div>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div class="col-xl-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <label class="form-label">Start Date</label>
                                                    <input
                                                        type="date"
                                                        name="start_date"
                                                        class="form-control"
                                                        value="{{ old('start_date') }}"
                                                        min="{{ date('Y-m-d') }}"
                                                    >
                                                    @error('start_date')
                                                    <div class="text-danger mt-2">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <label class="form-label">End Date</label>
                                                    <input
                                                        type="date"
                                                        name="end_date"
                                                        class="form-control"
                                                        value="{{ old('end_date') }}"
                                                        min="{{ date('Y-m-d') }}"
                                                    >
                                                    @error('end_date')
                                                    <div class="text-danger mt-2">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
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
                                            <label for="formFileLg" class="form-label">Large file input</label>
                                            <input class="form-control form-control-lg" name="attachment" id="formFileLg" type="file">
                                            @error('attachment')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
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
