@extends('normal-user.master')

@section('right-sidebar')
    <!-- sidebar is not available -->
@endsection

@section('title','Resource Space Question Creation')

@section('body')


{{--    <!-- Main Content -->--}}
{{--    <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">--}}
{{--        <div class="container mt-4">--}}
{{--            <!-- Header Section -->--}}
{{--            <div class="mb-4 text-center">--}}
{{--                <h2 class="fw-bold">Create Joining Questions</h2>--}}
{{--                <p class="text-muted">Add up to 7 questions for users to join this resource space. The first question is mandatory.</p>--}}
{{--            </div>--}}

{{--            <!-- Question Form -->--}}
{{--            <form action="{{ route('normal-user.resource-space.saveQuestions', $resourceSpace->id) }}" method="POST" class="shadow p-4 rounded-4 bg-white">--}}
{{--                @csrf--}}
{{--                <div id="questions-container">--}}
{{--                    @for ($i = 1; $i <= 7; $i++)--}}
{{--                        <div class="mb-3 question-item">--}}
{{--                            <label for="question-{{ $i }}" class="form-label">Question {{ $i }}</label>--}}
{{--                            <input type="text" name="questions[]" id="question-{{ $i }}"--}}
{{--                                   class="form-control @if ($i === 1) border-primary @else border-secondary @endif"--}}
{{--                                   placeholder="Enter question {{ $i }}"--}}
{{--                                {{ $i === 1 ? 'required' : '' }}>--}}
{{--                        </div>--}}
{{--                    @endfor--}}
{{--                </div>--}}
{{--                <small class="text-muted">You can leave non-mandatory questions blank if not needed.</small>--}}

{{--                <!-- Submit Button -->--}}
{{--                <div class="mt-4 text-center">--}}
{{--                    <button type="submit" class="btn btn-primary px-5">Save Questions</button>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </main>--}}

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
<style>
    /* Question Form Styling */
    .question-form-container {
        max-width: 100%;
    }

    .form-card {
        border: 1px solid #e3f2fd;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        position: relative;
        overflow: hidden;
    }

    .form-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #007bff, #0056b3);
    }

    .form-header {
        border-bottom: 2px solid #e9ecef;
        padding-bottom: 15px;
    }

    .question-counter {
        margin-top: 15px;
    }

    /* Question Item Styling */
    .question-item {
        animation: slideInUp 0.3s ease-out;
        margin-bottom: 20px;
    }

    .question-card {
        background: white;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 20px;
        transition: all 0.3s ease;
        position: relative;
    }

    .question-card:hover {
        border-color: #007bff;
        box-shadow: 0 4px 15px rgba(0, 123, 255, 0.1);
    }

    .question-header {
        margin-bottom: 12px;
    }

    .question-number {
        color: #495057;
        font-weight: 600;
    }

    .remove-question-btn {
        background: none;
        border: none;
        color: #dc3545;
        font-size: 1.1rem;
        padding: 5px;
        border-radius: 50%;
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .remove-question-btn:hover {
        background-color: #dc3545;
        color: white;
        transform: scale(1.1);
    }

    /* Input Styling */
    .input-group-text {
        border: none;
        background: linear-gradient(135deg, #007bff, #0056b3);
    }

    .form-control {
        border-left: none;
        padding: 12px 15px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.15);
    }

    /* Add Question Button */
    .add-question-section {
        padding: 20px;
        background: #f8f9fa;
        border-radius: 12px;
        border: 2px dashed #dee2e6;
        transition: all 0.3s ease;
    }

    .add-question-section:hover {
        border-color: #007bff;
        background: #e3f2fd;
    }

    #add-question-btn {
        border: 2px solid #007bff;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    #add-question-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 123, 255, 0.3);
    }

    #add-question-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    /* Submit Section */
    .submit-section {
        background: #f8f9fa;
        margin: -20px -20px -20px -20px;
        padding: 25px;
        border-radius: 0 0 12px 12px;
    }

    /* Animations */
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
            transform: scale(1);
        }
        to {
            opacity: 0;
            transform: scale(0.8);
        }
    }

    .question-item.removing {
        animation: fadeOut 0.3s ease-out forwards;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .form-card {
            padding: 20px 15px;
        }

        .question-card {
            padding: 15px;
        }

        .question-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .remove-question-btn {
            align-self: flex-end;
            margin-top: -5px;
        }

        .submit-section .d-flex {
            flex-direction: column;
            gap: 15px;
        }

        .submit-section .btn {
            width: 100%;
        }
    }

    /* Badge Styling */
    .badge.bg-danger {
        font-size: 0.7rem;
        padding: 4px 8px;
    }

    .badge.bg-primary {
        background: linear-gradient(135deg, #007bff, #0056b3) !important;
    }
</style>

<!-- Main Content -->
<main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
    <div class="container mt-4">
        <!-- Header Section -->
        <div class="mb-4 text-center">
            <h2 class="fw-bold text-dark">Create Joining Questions</h2>
            <p class="text-muted">Add questions for users to join this resource space. You can add up to 7 questions.</p>
            <div class="question-counter">
                    <span class="badge bg-primary fs-6 px-3 py-2">
                        <i class="bi bi-question-circle me-1"></i>
                        Questions: <span id="question-count">1</span>/7
                    </span>
            </div>
        </div>

        <!-- Question Form -->
        <form action="{{ route('normal-user.resource-space.saveQuestions', $resourceSpace->id) }}" method="POST" class="question-form-container">
            @csrf
            <div class="form-card shadow-lg rounded-4 bg-white p-4 mb-4">
                <div class="form-header mb-4">
                    <h5 class="text-primary mb-2">
                        <i class="bi bi-clipboard-check me-2"></i>
                        Joining Questions
                    </h5>
                    <p class="text-muted small mb-0">The first question is mandatory. Additional questions are optional.</p>
                </div>

                <div id="questions-container">
                    <!-- First mandatory question -->
                    <div class="question-item mb-3" data-question-number="1">
                        <div class="question-card">
                            <div class="question-header d-flex align-items-center justify-content-between mb-2">
                                <label class="form-label fw-semibold text-dark mb-0">
                                    <span class="question-number">Question 1</span>
                                    <span class="badge bg-danger ms-2 small">Required</span>
                                </label>
                            </div>
                            <div class="input-group">
                                    <span class="input-group-text bg-primary text-white">
                                        <i class="bi bi-question-circle"></i>
                                    </span>
                                <input type="text"
                                       name="questions[]"
                                       class="form-control border-primary"
                                       placeholder="Enter your first question (required)"
                                       required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add Question Button -->
                <div class="add-question-section text-center mb-4">
                    <button type="button" id="add-question-btn" class="btn btn-outline-primary btn-lg px-4 py-2">
                        <i class="bi bi-plus-circle me-2"></i>
                        Add Another Question
                    </button>
                    <div class="mt-2">
                        <small class="text-muted" id="helper-text">You can add up to 6 more questions</small>
                    </div>
                </div>

                <!-- Submit Section -->
                <div class="submit-section">
                    <hr class="my-4">
                    <div class="d-flex justify-content-center gap-3">
                        <button type="button" class="btn btn-outline-secondary px-4" onclick="window.history.back()">
                            <i class="bi bi-arrow-left me-2"></i>
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary px-5 py-2">
                            <i class="bi bi-check-circle me-2"></i>
                            Save Questions
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>

<script>
    // Fixed JavaScript - corrected the counter issue
    let questionCounter = 1; // Start with 1 since we have the first question
    const maxQuestions = 7;

    document.addEventListener('DOMContentLoaded', function() {
        const questionsContainer = document.getElementById('questions-container');
        const addQuestionBtn = document.getElementById('add-question-btn');
        const questionCountSpan = document.getElementById('question-count');
        const helperText = document.getElementById('helper-text');

        // Add question function
        function addQuestion() {
            // Prevent adding if we're at max
            if (questionCounter >= maxQuestions) {
                return;
            }

            // Increment counter ONCE here only
            questionCounter++;

            const questionItem = document.createElement('div');
            questionItem.className = 'question-item mb-3';
            questionItem.setAttribute('data-question-number', questionCounter);

            questionItem.innerHTML = `
                    <div class="question-card">
                        <div class="question-header d-flex align-items-center justify-content-between mb-2">
                            <label class="form-label fw-semibold text-dark mb-0">
                                <span class="question-number">Question ${questionCounter}</span>
                                <span class="badge bg-secondary ms-2 small">Optional</span>
                            </label>
                            <button type="button" class="remove-question-btn" title="Remove question" onclick="removeQuestion(this)">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white">
                                <i class="bi bi-question-circle"></i>
                            </span>
                            <input type="text"
                                   name="questions[]"
                                   class="form-control"
                                   placeholder="Enter question ${questionCounter} (optional)">
                        </div>
                    </div>
                `;

            questionsContainer.appendChild(questionItem);
            updateUI();

            // Add animation
            questionItem.style.opacity = '0';
            questionItem.style.transform = 'translateY(30px)';
            setTimeout(() => {
                questionItem.style.transition = 'all 0.3s ease';
                questionItem.style.opacity = '1';
                questionItem.style.transform = 'translateY(0)';
            }, 10);
        }

        // Remove question function (global scope)
        window.removeQuestion = function(button) {
            const questionItem = button.closest('.question-item');
            const questionNumber = parseInt(questionItem.getAttribute('data-question-number'));

            // Don't allow removing the first question
            if (questionNumber === 1) {
                return;
            }

            questionItem.classList.add('removing');

            setTimeout(() => {
                questionItem.remove();
                // Decrement counter when removing
                questionCounter--;
                updateQuestionNumbers();
                updateUI();
            }, 300);
        };

        // Update question numbers after removal
        function updateQuestionNumbers() {
            const questionItems = questionsContainer.querySelectorAll('.question-item');

            questionItems.forEach((item, index) => {
                const number = index + 1;

                item.setAttribute('data-question-number', number);

                const questionNumber = item.querySelector('.question-number');
                const placeholder = item.querySelector('input');

                if (questionNumber) {
                    questionNumber.textContent = `Question ${number}`;
                }

                if (placeholder) {
                    if (number === 1) {
                        placeholder.placeholder = 'Enter your first question (required)';
                    } else {
                        placeholder.placeholder = `Enter question ${number} (optional)`;
                    }
                }
            });

            // Reset counter to match actual count
            questionCounter = questionItems.length;
        }

        // Update UI elements
        function updateUI() {
            questionCountSpan.textContent = questionCounter;

            // Update add button state
            if (questionCounter >= maxQuestions) {
                addQuestionBtn.disabled = true;
                addQuestionBtn.innerHTML = '<i class="bi bi-check-circle me-2"></i>Maximum Questions Reached';
                addQuestionBtn.classList.remove('btn-outline-primary');
                addQuestionBtn.classList.add('btn-outline-secondary');
            } else {
                addQuestionBtn.disabled = false;
                addQuestionBtn.innerHTML = '<i class="bi bi-plus-circle me-2"></i>Add Another Question';
                addQuestionBtn.classList.remove('btn-outline-secondary');
                addQuestionBtn.classList.add('btn-outline-primary');
            }

            // Update helper text
            const remaining = maxQuestions - questionCounter;
            if (remaining > 0) {
                helperText.textContent = `You can add ${remaining} more question${remaining !== 1 ? 's' : ''}`;
            } else {
                helperText.textContent = 'You have reached the maximum number of questions';
            }
        }

        // Single event listener for add button
        addQuestionBtn.addEventListener('click', addQuestion);

        // Form validation
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            const firstQuestion = questionsContainer.querySelector('input[name="questions[]"]');
            if (!firstQuestion || !firstQuestion.value.trim()) {
                e.preventDefault();
                alert('The first question is required!');
                firstQuestion.focus();
                return false;
            }
        });

        // Initialize UI
        updateUI();
    });
</script>


@endsection
