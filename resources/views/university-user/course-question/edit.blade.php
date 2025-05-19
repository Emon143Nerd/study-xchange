@extends('university-user.master')

@section('title','Edit Course Question')

@section('body')


    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Edit Course Question</li>
                </ol>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="media-body">
                        <p class="mb-0">{{session('message')}}</p>
                    </div>
                    <div class="row">

                        <form action="{{ route('university-user.course-question.update', $courseQuestion->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-xl-8">
                                <div class="card h-auto">
                                    <div class="card-body">
                                        <input type="hidden" name="university_id" value="{{ $universityId }}">

                                        <!-- Course Name -->
                                        <div class="mb-3">
                                            <label class="form-label">Course Name</label>
                                            <select class="form-control default-select h-auto wide" name="course_id">
                                                <option value="" disabled>Select Course Name</option>
                                                @foreach($courses as $course)
                                                    <option value="{{ $course->id }}" {{ old('course_id', $courseQuestion->course_id) == $course->id ? 'selected' : '' }}>
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
                                                <option disabled>Select Question Type</option>
                                                <option value="1" {{ old('question_type', $courseQuestion->question_type) == '1' ? 'selected' : '' }}>Quizzes</option>
                                                <option value="2" {{ old('question_type', $courseQuestion->question_type) == '2' ? 'selected' : '' }}>Descriptive Questions</option>
                                            </select>
                                            @error('question_type')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Difficulty Level -->
                                        <div class="mb-3">
                                            <label class="form-label w-100">Difficulty Level</label>
                                            <select class="form-control solid default-select" name="difficulty_level">
                                                <option disabled>Select Difficulty Level</option>
                                                <option value="1" {{ old('difficulty_level', $courseQuestion->difficulty_level) == '1' ? 'selected' : '' }}>Beginner</option>
                                                <option value="2" {{ old('difficulty_level', $courseQuestion->difficulty_level) == '2' ? 'selected' : '' }}>Intermediate</option>
                                                <option value="3" {{ old('difficulty_level', $courseQuestion->difficulty_level) == '3' ? 'selected' : '' }}>Advanced</option>
                                            </select>
                                            @error('difficulty_level')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Question -->
                                        <div class="mb-3">
                                            <label class="form-label">Question</label>
                                            <textarea name="question" id="ckeditor">{{ old('question', $courseQuestion->question) }}</textarea>
                                            @error('question')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Answer -->
                                        <div class="mb-3">
                                            <label class="form-label">Answer</label>
                                            <textarea name="answer" class="form-control" rows="4">{{ old('answer', $courseQuestion->answer) }}</textarea>
                                            @error('answer')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Explanation -->
                                        <div class="mb-3">
                                            <label class="form-label">Explanation (Optional)</label>
                                            <textarea name="explanation" class="form-control" rows="4">{{ old('explanation', $courseQuestion->explanation) }}</textarea>
                                            @error('explanation')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <!-- Duration -->
                                        <div class="mb-3">
                                            <label class="form-label">Duration (In Minutes)</label>
                                            <input type="number" name="duration" class="form-control" placeholder="Enter duration in minutes" value="{{ old('duration', $courseQuestion->duration) }}">
                                            @error('duration')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Status -->
                                        <div class="mb-3">
                                            <label class="form-label w-100">Status</label>
                                            <select class="form-control solid default-select" name="status">
                                                <option disabled>Select Status</option>
                                                <option value="1" {{ old('status', $courseQuestion->status) == '1' ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ old('status', $courseQuestion->status) == '0' ? 'selected' : '' }}>Inactive</option>
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
                                            <button type="submit" class="btn btn-primary">Update Question</button>
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
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script>
        // Initialize Quill editors
        const answerEditor = new Quill('#editor-container', {
            theme: 'snow',
            placeholder: 'Write your answer here...',
            modules: {
                toolbar: [
                    [{ header: [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ list: 'ordered' }, { list: 'bullet' }],
                    ['link', 'image']
                ]
            }
        });

        const explanationEditor = new Quill('#explanation-editor-container', {
            theme: 'snow',
            placeholder: 'Write your explanation here...',
            modules: {
                toolbar: [
                    [{ header: [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ list: 'ordered' }, { list: 'bullet' }],
                    ['link', 'image']
                ]
            }
        });

        // Validate and handle form submission
        const form = document.querySelector('form'); // Use a more general selector, not #details-form
        form.onsubmit = function (event) {
            let isValid = true;

            // Get content from editors
            const answerContent = answerEditor.root.innerHTML.trim();
            const explanationContent = explanationEditor.root.innerHTML.trim();

            // Check if content is empty (including cases with only <p><br></p>)
            if (answerContent === '' || answerContent === '<p><br></p>') {
                document.querySelector('#answer-error').style.display = 'block';
                isValid = false;
            } else {
                document.querySelector('#answer-error').style.display = 'none';
                document.querySelector('#answer').value = answerContent; // Populate the hidden input
            }

            if (explanationContent === '' || explanationContent === '<p><br></p>') {
                document.querySelector('#explanation-error').style.display = 'block';
                isValid = false;
            } else {
                document.querySelector('#explanation-error').style.display = 'none';
                document.querySelector('#explanation').value = explanationContent; // Populate the hidden input
            }

            // Prevent form submission if validation fails
            if (!isValid) {
                event.preventDefault();
            }
        };
    </script>

    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <style>
        #editor-container, #explanation-editor-container {
            height: 200px;
        }
        .error-message {
            color: red;
            font-size: 14px;
            display: none;
        }
    </style>
@endsection
