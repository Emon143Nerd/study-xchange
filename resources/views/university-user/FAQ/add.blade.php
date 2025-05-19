@extends('university-user.master')

@section('title','Add FAQ')

@section('body')


    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Add University FAQ</li>
                </ol>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="media-body">
                        <p class="mb-0">{{session('message')}}</p>
                    </div>
                    <div class="row">

                        <form action="{{ route('university-user.FAQ.store') }}" method="POST" enctype="multipart/form-data">
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
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
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
                                            <label class="form-label">Question</label>
                                            <input type="text" name="question" class="form-control" placeholder="Question" value="{{ old('question') }}">
                                            @error('question')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="answer" id="ckeditor">{{ old('answer') }}</textarea>
                                            @error('answer')
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
                                        <div class="mb-3">
                                            <button class="btn btn-primary btn-sm me-2" type="submit" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                Create FAQ's
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
