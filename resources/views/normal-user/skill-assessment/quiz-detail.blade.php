@extends('normal-user.master')

@section('right-sidebar')
    <!-- sidebar is not available -->
@endsection

@section('title','Quiz Assessment')

@section('body')

    <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
        <main class="bg-white rounded-xl shadow-sm p-6 mb-8">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">{{ $quiz->title }}</h1>
                <p class="text-gray-600">Duration: {{ $quiz->duration }} minutes</p>
                <p class="text-gray-600">Difficulty:
                    @if($quiz->difficulty_level === 1) Beginner
                    @elseif($quiz->difficulty_level === 2) Intermediate
                    @else Advanced
                    @endif
                </p>
            </div>

{{--            <form action="{{ route('normal-user.quiz.assessment.submit', $quiz->id) }}" method="POST">--}}
{{--                @csrf--}}
{{--                <input type="hidden" name="user_id" value="{{ auth()->id() }}">--}}
{{--                <input type="hidden" name="assessment_id" value="{{ $quiz->id }}">--}}
{{--                <input type="hidden" name="skill_name" value="{{ $quiz->Course->title }}">--}}
{{--                <input type="hidden" name="question_type" value="1">--}}

{{--            @foreach ($quiz->quizQuestions as $index => $question)--}}
{{--                    <div class="mb-8">--}}
{{--                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Question {{ $index + 1 }}: {!! strip_tags($question->question) !!}</h2>--}}
{{--                        <div class="space-y-3">--}}
{{--                            @foreach (['option1' => 'Option 1', 'option2' => 'Option 2', 'option3' => 'Option 3', 'option4' => 'Option 4'] as $optionKey => $optionLabel)--}}
{{--                                <label class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors cursor-pointer">--}}
{{--                                    <input type="radio" name="question_{{ $question->id }}" value="{{ $optionLabel }}" class="mr-3">--}}
{{--                                    <span>{{ $question->$optionKey }}</span>--}}
{{--                                </label>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}

{{--                <div class="flex justify-end">--}}
{{--                    <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">--}}
{{--                        Submit--}}
{{--                    </button>--}}
{{--                </div>--}}

{{--            </form>--}}

            <form action="{{ route('normal-user.quiz.assessment.submit', $quiz->id) }}" method="POST" id="quiz-assessment-form">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <input type="hidden" name="assessment_id" value="{{ $quiz->id }}">
                <input type="hidden" name="skill_name" value="{{ $quiz->Course->title }}">
                <input type="hidden" name="question_type" value="1">


                <!-- Timer Display -->
                <div id="timer" class="text-red-500 font-bold text-lg mb-6">Time Remaining: <span id="time-remaining"></span></div>

                @foreach ($quiz->quizQuestions as $index => $question)
                    <div class="mb-8">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Question {{ $index + 1 }}: {!! strip_tags($question->question) !!}</h2>
                        <div class="space-y-3">
                            @foreach (['option1' => 'Option 1', 'option2' => 'Option 2', 'option3' => 'Option 3', 'option4' => 'Option 4'] as $optionKey => $optionLabel)
                                <label class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors cursor-pointer">
                                    <input type="radio" name="question_{{ $question->id }}" value="{{ $optionLabel }}" class="mr-3">
                                    <span>{{ $question->$optionKey }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                        Submit
                    </button>
                </div>
            </form>

            <script>
                // Timer setup
                document.addEventListener('DOMContentLoaded', () => {
                    const form = document.getElementById('quiz-assessment-form');
                    const timerDisplay = document.getElementById('time-remaining');
                    const timeLimit = {{ $quiz->duration * 60 }}; // Duration in seconds
                    let remainingTime = timeLimit;

                    const updateTimer = () => {
                        const minutes = Math.floor(remainingTime / 60);
                        const seconds = remainingTime % 60;
                        timerDisplay.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
                        if (remainingTime <= 0) {
                            form.submit(); // Auto-submit the form
                        }
                        remainingTime--;
                    };

                    setInterval(updateTimer, 1000); // Update the timer every second
                    updateTimer(); // Initialize the timer
                });
            </script>

            <div class="flex justify-between">
                <a href="{{ route('normal-user.skill-assessment.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">Back</a>
            </div>

        </main>
    </main>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
@endsection
