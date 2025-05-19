@extends('university-user.master')

@section('title','Edit Course Quiz Question')

@section('body')


    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Edit Quiz Question</li>
                </ol>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="media-body">
                        <p class="mb-0">{{session('message')}}</p>
                    </div>
                    <div class="row">

{{--                        <form action="{{ route('university-user.course-quiz-question.update', $quiz->id) }}" method="POST" enctype="multipart/form-data">--}}
{{--                            @csrf--}}

{{--                            <div class="col-xl-8">--}}
{{--                                <div class="card h-auto">--}}
{{--                                    <div class="card-body">--}}
{{--                                        <input type="hidden" name="university_id" value="{{ $universityId }}">--}}

{{--                                        <!-- Course Name -->--}}
{{--                                        <div class="mb-3">--}}
{{--                                            <label class="form-label">Course Name</label>--}}
{{--                                            <select class="form-control default-select h-auto wide" name="course_id" required>--}}
{{--                                                <option value="" disabled>Select Course Name</option>--}}
{{--                                                @foreach($courses as $course)--}}
{{--                                                    <option value="{{ $course->id }}" {{ $quiz->course_id == $course->id ? 'selected' : '' }}>--}}
{{--                                                        {{ $course->title }}--}}
{{--                                                    </option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                            @error('course_id')--}}
{{--                                            <div class="alert alert-danger mt-2">{{ $message }}</div>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}

{{--                                        <!-- Question Type -->--}}
{{--                                        <div class="mb-3">--}}
{{--                                            <label class="form-label w-100">Question Type</label>--}}
{{--                                            <select class="form-control solid default-select" name="question_type" required>--}}
{{--                                                <option value="" disabled>Select Question Type</option>--}}
{{--                                                <option value="1" {{ $quiz->question_type == 1 ? 'selected' : '' }}>Quizzes</option>--}}
{{--                                            </select>--}}
{{--                                            @error('question_type')--}}
{{--                                            <div class="text-danger">{{ $message }}</div>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}

{{--                                        <!-- Difficulty Level -->--}}
{{--                                        <div class="mb-3">--}}
{{--                                            <label class="form-label w-100">Difficulty Level</label>--}}
{{--                                            <select class="form-control solid default-select" name="difficulty_level" required>--}}
{{--                                                <option value="" disabled>Select Difficulty Level</option>--}}
{{--                                                <option value="1" {{ $quiz->difficulty_level == 1 ? 'selected' : '' }}>Beginner</option>--}}
{{--                                                <option value="2" {{ $quiz->difficulty_level == 2 ? 'selected' : '' }}>Intermediate</option>--}}
{{--                                                <option value="3" {{ $quiz->difficulty_level == 3 ? 'selected' : '' }}>Advanced</option>--}}
{{--                                            </select>--}}
{{--                                            @error('difficulty_level')--}}
{{--                                            <div class="text-danger">{{ $message }}</div>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}

{{--                                        <!-- Duration -->--}}
{{--                                        <div class="mb-3">--}}
{{--                                            <label class="form-label">Duration (in minutes)</label>--}}
{{--                                            <input type="number" name="duration" class="form-control" value="{{ old('duration', $quiz->duration) }}" required>--}}
{{--                                            @error('duration')--}}
{{--                                            <div class="text-danger">{{ $message }}</div>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}

{{--                                        <!-- Questions -->--}}
{{--                                        <div id="questions-container">--}}
{{--                                            @foreach($quiz->questions as $index => $question)--}}
{{--                                                <div class="question-component mb-4">--}}
{{--                                                    <input type="hidden" name="questions[{{ $index }}][id]" value="{{ $question->id }}">--}}

{{--                                                    <div class="d-flex justify-content-between align-items-center">--}}
{{--                                                        <h5>Question {{ $index + 1 }}</h5>--}}
{{--                                                        <button type="button" class="btn btn-danger btn-sm remove-question-btn">Remove</button>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <label class="form-label">Question</label>--}}
{{--                                                        <textarea name="questions[{{ $index }}][question]" class="form-control rich-editor">{{ old("questions.$index.question", $question->question) }}</textarea>--}}
{{--                                                    </div>--}}
{{--                                                    @for($i = 1; $i <= 4; $i++)--}}
{{--                                                        <div class="mb-3">--}}
{{--                                                            <label class="form-label">Option {{ $i }}</label>--}}
{{--                                                            <input type="text" name="questions[{{ $index }}][option{{ $i }}]"--}}
{{--                                                                   class="form-control"--}}
{{--                                                                   value="{{ old("questions.$index.option$i", $question->{"option$i"}) }}">--}}
{{--                                                        </div>--}}
{{--                                                    @endfor--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <label class="form-label">Correct Answer</label>--}}
{{--                                                        <select name="questions[{{ $index }}][correct_answer]" class="form-control">--}}
{{--                                                            <option value="" disabled>Select the correct answer</option>--}}
{{--                                                            @for($i = 1; $i <= 4; $i++)--}}
{{--                                                                <option value="Option {{ $i }}"--}}
{{--                                                                    {{ old("questions.$index.correct_answer", $question->correct_answer) == "Option $i" ? 'selected' : '' }}>--}}
{{--                                                                    Option {{ $i }}--}}
{{--                                                                </option>--}}
{{--                                                            @endfor--}}
{{--                                                        </select>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <label class="form-label">Status</label>--}}
{{--                                                        <select name="questions[{{ $index }}][status]" class="form-control">--}}
{{--                                                            <option value="" disabled>Select Status</option>--}}
{{--                                                            <option value="1" {{ old("questions.$index.status", $question->status) == 1 ? 'selected' : '' }}>Active</option>--}}
{{--                                                            <option value="0" {{ old("questions.$index.status", $question->status) == 0 ? 'selected' : '' }}>Inactive</option>--}}
{{--                                                        </select>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            @endforeach--}}
{{--                                        </div>--}}

{{--                                        <!-- Button to Add New Question -->--}}
{{--                                        <div class="mb-3">--}}
{{--                                            <button type="button" id="add-question-btn" class="btn btn-secondary btn-sm">Add Question</button>--}}
{{--                                        </div>--}}

{{--                                        <!-- Status -->--}}
{{--                                        <div class="mb-3">--}}
{{--                                            <label class="form-label w-100">Status</label>--}}
{{--                                            <select class="form-control solid default-select" name="status" required>--}}
{{--                                                <option value="" disabled>Select Status</option>--}}
{{--                                                <option value="1" {{ $quiz->status == 1 ? 'selected' : '' }}>Active</option>--}}
{{--                                                <option value="0" {{ $quiz->status == 0 ? 'selected' : '' }}>Inactive</option>--}}
{{--                                            </select>--}}
{{--                                            @error('status')--}}
{{--                                            <div class="text-danger">{{ $message }}</div>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}

{{--                                        <!-- Submit Button -->--}}
{{--                                        <div class="mb-3">--}}
{{--                                            <button type="submit" class="btn btn-primary">Update Question</button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}

{{--                        <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>--}}
{{--                        <script>--}}
{{--                            document.addEventListener('DOMContentLoaded', function () {--}}
{{--                                const addQuestionBtn = document.getElementById('add-question-btn');--}}
{{--                                const questionsContainer = document.getElementById('questions-container');--}}

{{--                                // Function to initialize CKEditor--}}
{{--                                const initializeCKEditor = (editorElement) => {--}}
{{--                                    ClassicEditor.create(editorElement)--}}
{{--                                        .catch(error => {--}}
{{--                                            console.error('CKEditor Error:', error);--}}
{{--                                        });--}}
{{--                                };--}}

{{--                                // Initialize CKEditor for existing editors--}}
{{--                                document.querySelectorAll('.rich-editor').forEach(editor => {--}}
{{--                                    initializeCKEditor(editor);--}}
{{--                                });--}}

{{--                                // Function to add a new question block--}}
{{--                                const addQuestionBlock = () => {--}}
{{--                                    const questionIndex = questionsContainer.children.length;--}}
{{--                                    const questionBlock = `--}}
{{--                <div class="question-component mb-4">--}}
{{--                    <input type="hidden" name="questions[${questionIndex}][id]" value="">--}}

{{--                    <div class="d-flex justify-content-between align-items-center">--}}
{{--                        <h5>Question ${questionIndex + 1}</h5>--}}
{{--                        <button type="button" class="btn btn-danger btn-sm remove-question-btn">Remove</button>--}}
{{--                    </div>--}}
{{--                    <div class="mb-3">--}}
{{--                        <label class="form-label">Question</label>--}}
{{--                        <textarea name="questions[${questionIndex}][question]" class="form-control rich-editor"></textarea>--}}
{{--                    </div>--}}
{{--                    ${Array(4).fill(0).map((_, i) => `--}}
{{--                        <div class="mb-3">--}}
{{--                            <label class="form-label">Option ${i + 1}</label>--}}
{{--                            <input type="text" name="questions[${questionIndex}][option${i + 1}]" class="form-control">--}}
{{--                        </div>--}}
{{--                    `).join('')}--}}
{{--                    <div class="mb-3">--}}
{{--                        <label class="form-label">Correct Answer</label>--}}
{{--                        <select name="questions[${questionIndex}][correct_answer]" class="form-control">--}}
{{--                            <option value="" disabled selected>Select the correct answer</option>--}}
{{--                            ${Array(4).fill(0).map((_, i) => `--}}
{{--                                <option value="Option ${i + 1}">Option ${i + 1}</option>--}}
{{--                            `).join('')}--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div class="mb-3">--}}
{{--                        <label class="form-label">Status</label>--}}
{{--                        <select name="questions[${questionIndex}][status]" class="form-control">--}}
{{--                            <option value="" disabled selected>Select Status</option>--}}
{{--                            <option value="1">Active</option>--}}
{{--                            <option value="0">Inactive</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>`;--}}

{{--                                    questionsContainer.insertAdjacentHTML('beforeend', questionBlock);--}}

{{--                                    // Initialize CKEditor for the newly added textarea--}}
{{--                                    const newTextArea = questionsContainer.querySelector(`.question-component:last-child .rich-editor`);--}}
{{--                                    initializeCKEditor(newTextArea);--}}

{{--                                    attachRemoveEvent(); // Reattach event listeners for the new block--}}
{{--                                };--}}

{{--                                // Function to attach remove event to "Remove" buttons--}}
{{--                                const attachRemoveEvent = () => {--}}
{{--                                    const removeQuestionBtns = document.querySelectorAll('.remove-question-btn');--}}
{{--                                    removeQuestionBtns.forEach(btn => {--}}
{{--                                        btn.onclick = function () {--}}
{{--                                            const questionComponent = btn.closest('.question-component');--}}
{{--                                            const questionIdInput = questionComponent.querySelector('input[name*="[id]"]');--}}
{{--                                            if (questionIdInput) {--}}
{{--                                                questionIdInput.value = ''; // Set to empty or handle a different identifier--}}
{{--                                            }--}}
{{--                                            questionComponent.remove();--}}
{{--                                            updateQuestionNumbers();--}}
{{--                                        };--}}
{{--                                    });--}}
{{--                                };--}}

{{--                                // Function to update question numbers after removal--}}
{{--                                const updateQuestionNumbers = () => {--}}
{{--                                    const questionComponents = questionsContainer.children;--}}
{{--                                    Array.from(questionComponents).forEach((component, index) => {--}}
{{--                                        component.querySelector('h5').textContent = `Question ${index + 1}`;--}}
{{--                                        const inputs = component.querySelectorAll('input, textarea, select');--}}
{{--                                        inputs.forEach(input => {--}}
{{--                                            const name = input.name.replace(/\d+/, index);--}}
{{--                                            input.name = name;--}}
{{--                                        });--}}
{{--                                    });--}}
{{--                                };--}}

{{--                                // Attach event listeners--}}
{{--                                addQuestionBtn.onclick = addQuestionBlock;--}}
{{--                                attachRemoveEvent(); // Attach initial event listeners for existing questions--}}
{{--                            });--}}
{{--                        </script>--}}


                        <form action="{{ route('university-user.course-quiz-question.update', $quiz->id) }}" method="POST" enctype="multipart/form-data">
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
                                                    <option value="{{ $course->id }}" {{ $quiz->course_id == $course->id ? 'selected' : '' }}>
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
                                            <input type="text" name="title" class="form-control" value="{{ old('title', $quiz->title) }}" placeholder="Enter title" required>
                                            @error('title')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Question Type -->
                                        <div class="mb-3">
                                            <label class="form-label w-100">Question Type</label>
                                            <select class="form-control solid default-select" name="question_type" required>
                                                <option value="" disabled>Select Question Type</option>
                                                <option value="1" {{ $quiz->question_type == 1 ? 'selected' : '' }}>Quizzes</option>
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
                                                <option value="1" {{ $quiz->difficulty_level == 1 ? 'selected' : '' }}>Beginner</option>
                                                <option value="2" {{ $quiz->difficulty_level == 2 ? 'selected' : '' }}>Intermediate</option>
                                                <option value="3" {{ $quiz->difficulty_level == 3 ? 'selected' : '' }}>Advanced</option>
                                            </select>
                                            @error('difficulty_level')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Duration -->
                                        <div class="mb-3">
                                            <label class="form-label">Duration (in minutes)</label>
                                            <input type="number" name="duration" class="form-control" value="{{ old('duration', $quiz->duration) }}" required>
                                            @error('duration')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Questions -->
                                        <div id="questions-container">
                                            @foreach($quiz->questions as $index => $question)
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
                                                    @for($i = 1; $i <= 4; $i++)
                                                        <div class="mb-3">
                                                            <label class="form-label">Option {{ $i }}</label>
                                                            <input type="text" name="questions[{{ $index }}][option{{ $i }}]"
                                                                   class="form-control"
                                                                   value="{{ old("questions.$index.option$i", $question->{"option$i"}) }}">
                                                        </div>
                                                    @endfor
                                                    <div class="mb-3">
                                                        <label class="form-label">Correct Answer</label>
                                                        <select name="questions[{{ $index }}][correct_answer]" class="form-control">
                                                            <option value="" disabled>Select the correct answer</option>
                                                            @for($i = 1; $i <= 4; $i++)
                                                                <option value=" Option {{ $i }}"
                                                                    {{ old("questions.$index.correct_answer", $question->correct_answer) == "Option $i" ? 'selected' : '' }}>
                                                                    Option {{ $i }}
                                                                </option>
                                                            @endfor
                                                        </select>
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
                                                <option value="1" {{ $quiz->status == 1 ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ $quiz->status == 0 ? 'selected' : '' }}>Inactive</option>
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
                                const addQuestionBtn = document.getElementById('add-question-btn');
                                const questionsContainer = document.getElementById('questions-container');

                                const form = document.querySelector('form');

                                // Add a hidden input to store deleted question IDs
                                const deletedQuestionsInput = document.createElement('input');
                                deletedQuestionsInput.type = 'hidden';
                                deletedQuestionsInput.name = 'deleted_questions';
                                deletedQuestionsInput.value = '';
                                form.appendChild(deletedQuestionsInput);

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

                                // Function to add a new question block
                                const addQuestionBlock = () => {
                                    const questionIndex = questionsContainer.children.length;
                                    const questionBlock = `
                <div class="question-component mb-4">
                    <input type="hidden" name="questions[${questionIndex}][id]" value="">

                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Question ${questionIndex + 1}</h5>
                        <button type="button" class="btn btn-danger btn-sm remove-question-btn">Remove</button>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Question</label>
                        <textarea name="questions[${questionIndex}][question]" class="form-control rich-editor"></textarea>
                    </div>
                    ${Array(4).fill(0).map((_, i) => `
                        <div class="mb-3">
                            <label class="form-label">Option ${i + 1}</label>
                            <input type="text" name="questions[${questionIndex}][option${i + 1}]" class="form-control">
                        </div>
                    `).join('')}
                    <div class="mb-3">
                        <label class="form-label">Correct Answer</label>
                        <select name="questions[${questionIndex}][correct_answer]" class="form-control">
                            <option value="" disabled selected>Select the correct answer</option>
                            ${Array(4).fill(0).map((_, i) => `
                                <option value="Option ${i + 1}">Option ${i + 1}</option>
                            `).join('')}
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="questions[${questionIndex}][status]" class="form-control">
                            <option value="" disabled selected>Select Status</option>
                            <option value=" 1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>`;

                                    questionsContainer.insertAdjacentHTML('beforeend', questionBlock);

                                    // Initialize CKEditor for the newly added textarea
                                    const newTextArea = questionsContainer.querySelector('.question-component:last-child .rich-editor');
                                    initializeCKEditor(newTextArea);

                                    attachRemoveEvent(); // Reattach event listeners for the new block
                                };

                                // Function to attach remove event to "Remove" buttons
                                const attachRemoveEvent = () => {
                                    const removeQuestionBtns = document.querySelectorAll('.remove-question-btn');
                                    removeQuestionBtns.forEach(btn => {
                                        btn.onclick = function () {
                                            const questionComponent = btn.closest('.question-component');
                                            const questionIdInput = questionComponent.querySelector('input[name*="[id]"]');

                                            // If this is an existing question (has an ID), add it to deleted_questions
                                            if (questionIdInput && questionIdInput.value) {
                                                let deletedIds = deletedQuestionsInput.value ?
                                                    deletedQuestionsInput.value.split(',') : [];
                                                deletedIds.push(questionIdInput.value);
                                                deletedQuestionsInput.value = deletedIds.join(',');
                                            }

                                            questionComponent.remove();
                                            updateQuestionNumbers();
                                        };
                                    });
                                };

                                // Function to update question numbers after removal
                                const updateQuestionNumbers = () => {
                                    const questionComponents = questionsContainer.children;
                                    Array.from(questionComponents).forEach((component, index) => {
                                        component.querySelector('h5').textContent = `Question ${index + 1}`;
                                        const inputs = component.querySelectorAll('input, textarea, select');
                                        inputs.forEach(input => {
                                            const name = input.name.replace(/\d+/, index);
                                            input.name = name;
                                        });
                                    });
                                };

                                // Attach event listeners
                                addQuestionBtn.onclick = addQuestionBlock;
                                attachRemoveEvent(); // Attach initial event listeners for existing questions
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
