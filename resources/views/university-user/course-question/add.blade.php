@extends('university-user.master')

@section('title','Add Course Question')

@section('body')


    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Add Course Question</li>
                </ol>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="media-body">
                        <p class="mb-0">{{session('message')}}</p>
                    </div>
                    <div class="row">

                        <form action="{{ route('university-user.course-question.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-xl-8">
                                <div class="card h-auto">
                                    <div class="card-body">
                                        <input type="hidden" name="university_id" value="{{ $universityId }}">

                                        <!-- Course Name -->
                                        <div class="mb-3">
                                            <label class="form-label">Course Name</label>
                                            <select class="form-control default-select h-auto wide" name="course_id">
                                                <option value="" disabled selected>Select Course Name</option>
                                                @foreach($courses as $course)
                                                    <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                                        {{ $course->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('course_id')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Question Type -->
                                        <div class="mb-3">
                                            <label class="form-label w-100">Question Type</label>
                                            <select class="form-control solid default-select" name="question_type">
                                                <option disabled selected>Select Question Type</option>
                                                <option value="1" {{ old('question_type') == '1' ? 'selected' : '' }}>Quizzes</option>
                                                <option value="2" {{ old('question_type') == '2' ? 'selected' : '' }}>Descriptive Questions</option>
                                            </select>
                                            @error('question_type')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Difficulty Level -->
                                        <div class="mb-3">
                                            <label class="form-label w-100">Difficulty Level</label>
                                            <select class="form-control solid default-select" name="difficulty_level">
                                                <option disabled selected>Select Difficulty Level</option>
                                                <option value="1" {{ old('difficulty_level') == '1' ? 'selected' : '' }}>Beginner</option>
                                                <option value="2" {{ old('difficulty_level') == '2' ? 'selected' : '' }}>Intermediate</option>
                                                <option value="3" {{ old('difficulty_level') == '3' ? 'selected' : '' }}>Advanced</option>
                                            </select>
                                            @error('difficulty_level')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Question</label>
                                            <textarea name="question" id="ckeditor">{{ old('question') }}</textarea>
                                            @error('question')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Answer -->
                                        <div class="mb-3">
                                            <label class="form-label">Answer</label>
                                            <textarea name="answer" class="form-control" rows="4">{{ old('answer') }}</textarea>
                                            @error('answer')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Explanation -->
                                        <div class="mb-3">
                                            <label class="form-label">Explanation (Optional)</label>
                                            <textarea name="explanation" class="form-control" rows="4">{{ old('explanation') }}</textarea>
                                            @error('explanation')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Status -->
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

                                        <!-- Image -->
                                        <div class="mb-3">
                                            <label class="form-label">Image (Optional)</label>
                                            <input type="file" name="image" class="form-control">
                                            @error('image')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <!-- Submit Button -->
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary">Create Question</button>
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
