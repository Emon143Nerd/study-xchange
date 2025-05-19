@extends('university-user.master')

@section('title','Edit Admission Circular')

@section('body')


    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Edit University FAQ</li>
                </ol>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <p class="alert-success">{{session('message')}}</p>
                    <div class="row">

                        <form action="{{ route('university-user.FAQ.update',['id'=>$universityFAQ->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-xl-8">
                                <div class="card h-auto">
                                    <div class="card-body">

                                        <!-- University Selection -->
                                        <div class="mb-3">
                                            <label class="form-label">University Name</label>
                                            <select class="form-control default-select h-auto wide" name="university_id" required>
                                                <option value="" disabled>Select University</option>
                                                @foreach($universities as $university)
                                                    <option value="{{ $university->id }}" {{ old('university_id', $universityFAQ->university_id) == $university->id ? 'selected' : '' }}>
                                                        {{ $university->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('university_id')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Subject Category Selection -->
                                        <div class="mb-3">
                                            <label class="form-label">Subject Category</label>
                                            <select class="form-control default-select h-auto wide" name="subject_category_id" required>
                                                <option value="" disabled>Select Subject Category</option>
                                                @foreach($subjectCategories as $subjectCategory)
                                                    <option value="{{ $subjectCategory->id }}" {{ old('subject_category_id', $universityFAQ->subject_category_id) == $subjectCategory->id ? 'selected' : '' }}>
                                                        {{ $subjectCategory->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('subject_category_id')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Circular Title -->
                                        <div class="mb-3">
                                            <label class="form-label">Question</label>
                                            <input type="text" name="question" class="form-control" placeholder="Question" value="{{ old('question', $universityFAQ->question) }}" required>
                                            @error('question')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Description -->
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="answer" id="ckeditor" class="form-control" rows="4" required>{{ old('answer', $universityFAQ->answer) }}</textarea>
                                            @error('answer')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Status -->
                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <select class="form-control solid default-select" name="status" required>
                                                <option disabled>Select Status</option>
                                                <option value="1" {{ old('status', $universityFAQ->status) == '1' ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ old('status', $universityFAQ->status) == '0' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            @error('status')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="mb-3">
                                            <button class="btn btn-primary" type="submit">Update FAQ</button>
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
