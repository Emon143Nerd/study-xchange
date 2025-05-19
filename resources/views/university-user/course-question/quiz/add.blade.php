@extends('university-user.master')

@section('title','Add Course Quiz Question')

@section('body')


    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Add Quiz Question</li>
                </ol>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="media-body">
                        <p class="mb-0">{{session('message')}}</p>
                    </div>
                    <div class="row">
                        <form action="{{ route('university-user.course-quiz-question.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

{{--                            @if(session('error'))--}}
{{--                                <div class="alert alert-danger">--}}
{{--                                    {{ session('error') }}--}}
{{--                                </div>--}}
{{--                            @endif--}}

{{--                            @if($errors->any())--}}
{{--                                <div class="alert alert-danger">--}}
{{--                                    <ul>--}}
{{--                                        @foreach($errors->all() as $error)--}}
{{--                                            <li>{{ $error }}</li>--}}
{{--                                        @endforeach--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            @endif--}}

{{--                            <!-- Debug information -->--}}
{{--                            @if(config('app.debug'))--}}
{{--                                <div class="alert alert-info">--}}
{{--                                    <strong>Debug Info:</strong>--}}
{{--                                    <pre>{{ print_r(session()->all(), true) }}</pre>--}}
{{--                                </div>--}}
{{--                            @endif--}}
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

                                        <!-- Title -->
                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Enter title" required>
                                            @error('title')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Question Type -->
                                        <div class="mb-3">
                                            <label class="form-label w-100">Question Type</label>
                                            <select class="form-control solid default-select" name="question_type">
                                                <option disabled selected>Select Question Type</option>
                                                <option value="1" {{ old('question_type') == '1' ? 'selected' : '' }}>Quizzes</option>
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

                                        <!-- Duration -->
                                        <div class="mb-3">
                                            <label class="form-label">Duration (in minutes)</label>
                                            <input type="number" name="duration" class="form-control" value="{{ old('duration') }}" placeholder="Enter duration in minutes" required>
                                            @error('duration')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div id="questions-container">
                                            <!-- Initial Question Component -->
                                            <div class="question-component mb-4">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5>Question 1</h5>
                                                    <button type="button" class="btn btn-danger btn-sm remove-question-btn">Remove</button>
                                                </div>
                                                <!-- Question Field -->
                                                <div class="mb-3">
                                                    <label class="form-label">Question</label>
                                                    <textarea name="questions[0][question]" class="form-control rich-editor" placeholder="Enter the question"></textarea>
                                                </div>
                                                <!-- Options Fields -->
                                                <div class="mb-3">
                                                    <label class="form-label">Option 1</label>
                                                    <input type="text" name="questions[0][option1]" class="form-control" placeholder="Enter option 1">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Option 2</label>
                                                    <input type="text" name="questions[0][option2]" class="form-control" placeholder="Enter option 2">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Option 3</label>
                                                    <input type="text" name="questions[0][option3]" class="form-control" placeholder="Enter option 3">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Option 4</label>
                                                    <input type="text" name="questions[0][option4]" class="form-control" placeholder="Enter option 4">
                                                </div>
                                                <!-- Correct Answer Field -->
                                                <div class="mb-3">
                                                    <label class="form-label">Correct Answer</label>
                                                    <select name="questions[0][correct_answer]" class="form-control">
                                                        <option disabled selected>Select the correct answer</option>
                                                        <option value="Option 1">Option 1</option>
                                                        <option value="Option 2">Option 2</option>
                                                        <option value="Option 3">Option 3</option>
                                                        <option value="Option 4">Option 4</option>
                                                    </select>
                                                </div>
                                                <!-- Status Field -->
                                                <div class="mb-3">
                                                    <label class="form-label">Status</label>
                                                    <select name="questions[0][status]" class="form-control">
                                                        <option disabled selected>Select Status</option>
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Button to Add New Question -->
                                        <div class="mb-3">
                                            <button type="button" id="add-question-btn" class="btn btn-secondary btn-sm">Add Question</button>
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

                                        <!-- Submit Button -->
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary">Create Question</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- JavaScript for dynamic question addition -->
                        <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                let questionIndex = 1;

                                // Function to initialize CKEditor
                                const initializeCKEditor = (editorElement) => {
                                    ClassicEditor.create(editorElement)
                                        .catch(error => {
                                            console.error('CKEditor Error:', error);
                                        });
                                };

                                // Initialize CKEditor for existing editors
                                document.querySelectorAll('.rich-editor').forEach(editor => {
                                    initializeCKEditor(editor);
                                });

                                // Add a new question component
                                document.getElementById('add-question-btn').addEventListener('click', function () {
                                    const questionsContainer = document.getElementById('questions-container');
                                    const newQuestionHTML = `
            <div class="question-component mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>Question ${questionIndex + 1}</h5>
                    <button type="button" class="btn btn-danger btn-sm remove-question-btn">Remove</button>
                </div>
                <div class="mb-3">
                    <label class="form-label">Question</label>
                    <textarea name="questions[${questionIndex}][question]" class="form-control rich-editor" placeholder="Enter the question"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Option 1</label>
                    <input type="text" name="questions[${questionIndex}][option1]" class="form-control" placeholder="Enter option 1">
                </div>
                <div class="mb-3">
                    <label class="form-label">Option 2</label>
                    <input type="text" name="questions[${questionIndex}][option2]" class="form-control" placeholder="Enter option 2">
                </div>
                <div class="mb-3">
                    <label class="form-label">Option 3</label>
                    <input type="text" name="questions[${questionIndex}][option3]" class="form-control" placeholder="Enter option 3">
                </div>
                <div class="mb-3">
                    <label class="form-label">Option 4</label>
                    <input type="text" name="questions[${questionIndex}][option4]" class="form-control" placeholder="Enter option 4">
                </div>
                <div class="mb-3">
                    <label class="form-label">Correct Answer</label>
                    <select name="questions[${questionIndex}][correct_answer]" class="form-control">
                        <option disabled selected>Select the correct answer</option>
                        <option value="Option 1">Option 1</option>
                        <option value="Option 2">Option 2</option>
                        <option value="Option 3">Option 3</option>
                        <option value="Option 4">Option 4</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="questions[${questionIndex}][status]" class="form-control">
                        <option disabled selected>Select Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
        `;

                                    // Append the new question to the container
                                    questionsContainer.insertAdjacentHTML('beforeend', newQuestionHTML);

                                    // Initialize CKEditor for the new question
                                    const newEditors = questionsContainer.querySelectorAll('.rich-editor');
                                    initializeCKEditor(newEditors[newEditors.length - 1]);

                                    // Add event listener for the remove button
                                    const removeButtons = questionsContainer.querySelectorAll('.remove-question-btn');
                                    removeButtons[removeButtons.length - 1].addEventListener('click', function () {
                                        this.closest('.question-component').remove();
                                    });

                                    questionIndex++;
                                });

                                // Add event listener for the remove button in the initial question
                                const initialRemoveButton = document.querySelector('.remove-question-btn');
                                if (initialRemoveButton) {
                                    initialRemoveButton.addEventListener('click', function () {
                                        this.closest('.question-component').remove();
                                    });
                                }
                            });
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->

@endsection
