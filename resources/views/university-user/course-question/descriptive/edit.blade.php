@extends('university-user.master')

@section('title','Edit Course Descriptive Question')

@section('body')


    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Edit Descriptive Question</li>
                </ol>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="media-body">
                        <p class="mb-0">{{session('message')}}</p>
                    </div>
                    <div class="row">
                        <form action="{{ route('university-user.course-descriptive-question.update', $descriptive->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="col-xl-8">
                                <div class="card h-auto">
                                    <div class="card-body">
                                        <input type="hidden" name="university_id" value="{{ $universityId }}">

                                        <!-- Course Name -->
                                        <div class="mb-3">
                                            <label class="form-label">Course Name</label>
                                            <select class="form-control default-select h-auto wide" name="course_id" required>
                                                <option value="" disabled>Select Course Name</option>
                                                @foreach($courses as $course)
                                                    <option value="{{ $course->id }}" {{ $descriptive->course_id == $course->id ? 'selected' : '' }}>
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
                                            <input type="text" name="title" class="form-control" value="{{ old('title', $descriptive->title) }}" placeholder="Enter title" required>
                                            @error('title')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Question Type -->
                                        <div class="mb-3">
                                            <label class="form-label w-100">Question Type</label>
                                            <select class="form-control solid default-select" name="question_type" required>
                                                <option value="" disabled>Select Question Type</option>
                                                <option value="2" {{ $descriptive->question_type == 2 ? 'selected' : '' }}>Descriptive</option>
                                            </select>
                                            @error('question_type')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Difficulty Level -->
                                        <div class="mb-3">
                                            <label class="form-label w-100">Difficulty Level</label>
                                            <select class="form-control solid default-select" name="difficulty_level" required>
                                                <option value="" disabled>Select Difficulty Level</option>
                                                <option value="1" {{ $descriptive->difficulty_level == 1 ? 'selected' : '' }}>Beginner</option>
                                                <option value="2" {{ $descriptive->difficulty_level == 2 ? 'selected' : '' }}>Intermediate</option>
                                                <option value="3" {{ $descriptive->difficulty_level == 3 ? 'selected' : '' }}>Advanced</option>
                                            </select>
                                            @error('difficulty_level')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Duration -->
                                        <div class="mb-3">
                                            <label class="form-label">Duration (in minutes)</label>
                                            <input type="number" name="duration" class="form-control" value="{{ old('duration', $descriptive->duration) }}" required>
                                            @error('duration')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Questions -->
                                        <div id="questions-container">
                                            @foreach($descriptive->questions as $index => $question)
                                                <div class="question-component mb-4">
                                                    <input type="hidden" name="questions[{{ $index }}][id]" value="{{ $question->id }}">

                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h5>Question {{ $index + 1 }}</h5>
                                                        <button type="button" class="btn btn-danger btn-sm remove-question-btn">Remove</button>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Question</label>
                                                        <textarea name="questions[{{ $index }}][question]" class="form-control rich-editor">{{ old("questions.$index.question", $question->question) }}</textarea>
                                                    </div>
                                                    <!-- Correct Answer Field -->
                                                    <div class="mb-3">
                                                        <label class="form-label">Correct Answer</label>
                                                        <textarea name="questions[{{ $index }}][correct_answer]" class="form-control rich-editor">{{ $question->correct_answer }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Status</label>
                                                        <select name="questions[{{ $index }}][status]" class="form-control">
                                                            <option value="" disabled>Select Status</option>
                                                            <option value="1" {{ old("questions.$index.status", $question->status) == 1 ? 'selected' : '' }}>Active</option>
                                                            <option value="0" {{ old("questions.$index.status", $question->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <!-- Button to Add New Question -->
                                        <div class="mb-3">
                                            <button type="button" id="add-question-btn" class="btn btn-secondary btn-sm">Add Question</button>
                                        </div>

                                        <!-- Status -->
                                        <div class="mb-3">
                                            <label class="form-label w-100">Status</label>
                                            <select class="form-control solid default-select" name="status" required>
                                                <option value="" disabled>Select Status</option>
                                                <option value="1" {{ $descriptive->status == 1 ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ $descriptive->status == 0 ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            @error('status')
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

                        <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                let questionIndex = document.querySelectorAll('.question-component').length;
                                let editors = []; // Array to store editor instances

                                // Function to initialize CKEditor
                                const initializeCKEditor = async (editorElement) => {
                                    try {
                                        const editor = await ClassicEditor.create(editorElement, {
                                            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
                                            placeholder: editorElement.getAttribute('placeholder') || 'Type here...'
                                        });
                                        editors.push(editor);
                                        return editor;
                                    } catch (error) {
                                        console.error('CKEditor Error:', error);
                                    }
                                };

                                // Initialize CKEditor for existing editors
                                document.querySelectorAll('.rich-editor').forEach(editor => {
                                    initializeCKEditor(editor);
                                });

                                // Add a new question component
                                document.getElementById('add-question-btn').addEventListener('click', function () {
                                    const questionsContainer = document.getElementById('questions-container');

                                    // Create the new question component
                                    const questionComponent = document.createElement('div');
                                    questionComponent.className = 'question-component mb-4';

                                    questionComponent.innerHTML = `
            <div class="d-flex justify-content-between align-items-center">
                <h5>Question ${questionIndex + 1}</h5>
                <button type="button" class="btn btn-danger btn-sm remove-question-btn">Remove</button>
            </div>
            <div class="mb-3">
                <label class="form-label">Question</label>
                <textarea name="questions[${questionIndex}][question]" class="form-control rich-editor" placeholder="Enter the question"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Correct Answer</label>
                <textarea name="questions[${questionIndex}][correct_answer]" class="form-control rich-editor" placeholder="Enter the correct answer"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="questions[${questionIndex}][status]" class="form-control">
                    <option disabled selected>Select Status</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        `;

                                    // Append the new question to the container
                                    questionsContainer.appendChild(questionComponent);

                                    // Initialize CKEditor for both question and answer fields
                                    const newEditors = questionComponent.querySelectorAll('.rich-editor');
                                    newEditors.forEach(editor => {
                                        initializeCKEditor(editor);
                                    });

                                    // Add event listener for the remove button
                                    const removeButton = questionComponent.querySelector('.remove-question-btn');
                                    removeButton.addEventListener('click', function () {
                                        // Find and destroy the CKEditor instances for this component
                                        const editorsToRemove = questionComponent.querySelectorAll('.rich-editor');
                                        editorsToRemove.forEach(editorElement => {
                                            const editorInstance = editors.find(e => e.sourceElement === editorElement);
                                            if (editorInstance) {
                                                editorInstance.destroy();
                                                editors = editors.filter(e => e !== editorInstance);
                                            }
                                        });

                                        // Remove the component
                                        questionComponent.remove();

                                        // Update question numbers
                                        updateQuestionNumbers();
                                    });

                                    questionIndex++;
                                });

                                // Function to update question numbers
                                function updateQuestionNumbers() {
                                    const questionComponents = document.querySelectorAll('.question-component');
                                    questionComponents.forEach((component, index) => {
                                        const questionNumber = component.querySelector('h5');
                                        questionNumber.textContent = `Question ${index + 1}`;
                                    });
                                }

                                // Add event listeners for the remove button in existing questions
                                document.querySelectorAll('.remove-question-btn').forEach(removeButton => {
                                    removeButton.addEventListener('click', function () {
                                        const component = this.closest('.question-component');

                                        // Find and destroy the CKEditor instances for this component
                                        const editorsToRemove = component.querySelectorAll('.rich-editor');
                                        editorsToRemove.forEach(editorElement => {
                                            const editorInstance = editors.find(e => e.sourceElement === editorElement);
                                            if (editorInstance) {
                                                editorInstance.destroy();
                                                editors = editors.filter(e => e !== editorInstance);
                                            }
                                        });

                                        component.remove();
                                        updateQuestionNumbers();
                                    });
                                });

                                // Handle form submission to save data
                                document.getElementById('question-form').addEventListener('submit', function (event) {
                                    event.preventDefault();

                                    // Sync CKEditor data to the corresponding textareas
                                    editors.forEach(editor => {
                                        editor.updateSourceElement();
                                    });

                                    // Submit the form via AJAX or proceed with the default submission
                                    const form = event.target;
                                    const formData = new FormData(form);

                                    fetch(form.action, {
                                        method: form.method,
                                        body: formData,
                                    })
                                        .then(response => {
                                            if (!response.ok) {
                                                throw new Error('Network response was not ok');
                                            }
                                            return response.json();
                                        })
                                        .then(data => {
                                            console.log('Form submitted successfully:', data);
                                            alert('Questions updated successfully!');
                                        })
                                        .catch(error => {
                                            console.error('Error submitting the form:', error);
                                            alert('There was an error updating the questions.');
                                        });
                                });
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
