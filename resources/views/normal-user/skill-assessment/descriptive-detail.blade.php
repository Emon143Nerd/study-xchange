@extends('normal-user.master')

@section('right-sidebar')
    <!-- sidebar is not available -->
@endsection

@section('title','Descriptive Assessment')

@section('body')

    <main class="col col-xl-9 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
        <main class="bg-white rounded-xl shadow-sm p-6 mb-8">

{{--            <form action="{{ route('normal-user.descriptive.assessment.submit') }}" method="POST">--}}
{{--                @csrf--}}
{{--                <!-- Assessment Result Fields -->--}}
{{--                <input type="hidden" name="user_id" value="{{ auth()->id() }}">--}}
{{--                <input type="hidden" name="assessment_id" value="{{ $descriptive->id }}">--}}
{{--                <input type="hidden" name="skill_name" value="{{ $descriptive->Course->title }}">--}}
{{--                <input type="hidden" name="question_type" value="2">--}}

{{--                <div class="mb-6">--}}
{{--                    <h1 class="text-2xl font-bold text-gray-800">{{ $descriptive->title }}</h1>--}}
{{--                    <h6 class="text-xl font-bold text-gray-800 mb-4">{{ $descriptive->Course->title }}</h6>--}}
{{--                </div>--}}

{{--                <!-- Loop Through Questions -->--}}
{{--                @foreach($descriptive->descriptiveQuestions as $question)--}}
{{--                    <div class="mb-8">--}}
{{--                        <h2 class="text-lg font-semibold text-gray-800 mb-4">{!! strip_tags($question->question) !!}</h2>--}}
{{--                        <div class="mb-4">--}}
{{--                            <label for="answer_{{ $question->id }}" class="block text-sm font-medium text-gray-700 mb-2">--}}
{{--                                Your Answer:--}}
{{--                            </label>--}}
{{--                            <textarea id="answer_{{ $question->id }}"--}}
{{--                                      name="answers[{{ $question->id }}]"--}}
{{--                                      rows="4"--}}
{{--                                      class="w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"--}}
{{--                                      placeholder="Type your answer here..."></textarea>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}


{{--                <!-- Submit Button -->--}}
{{--                <div class="mb-6">--}}
{{--                    <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg">Submit Answers</button>--}}
{{--                </div>--}}
{{--            </form>--}}


            <form action="{{ route('normal-user.descriptive.assessment.submit') }}" method="POST" id="descriptive-assessment-form">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <input type="hidden" name="assessment_id" value="{{ $descriptive->id }}">
                <input type="hidden" name="skill_name" value="{{ $descriptive->Course->title }}">
                <input type="hidden" name="question_type" value="2">

                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">{{ $descriptive->title }}</h1>
                    <h6 class="text-xl font-bold text-gray-800 mb-4">{{ $descriptive->Course->title }}</h6>
                </div>

                <!-- Timer Display -->
                <div id="timer" class="text-red-500 font-bold text-lg mb-6">Time Remaining: <span id="time-remaining"></span></div>

                <!-- Loop Through Questions -->
                @foreach($descriptive->descriptiveQuestions as $question)
                    <div class="mb-8">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">{!! strip_tags($question->question) !!}</h2>
                        <div class="mb-4">
                            <label for="answer_{{ $question->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                                Your Answer:
                            </label>
                            <textarea id="answer_{{ $question->id }}"
                                      name="answers[{{ $question->id }}]"
                                      rows="4"
                                      class="w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Type your answer here..."></textarea>
                        </div>
                    </div>
                @endforeach
                <!-- Submit Button -->
                <div class="mb-6">
                    <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg">Submit Answers</button>
                </div>
            </form>


            <div class="flex justify-between">
                <a href="{{ route('normal-user.skill-assessment.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">Back</a>
            </div>
        </main>
    </main>
    <script>
        // Word count functionality
        const textarea = document.getElementById('answer');
        const wordCount = document.getElementById('word-count');

        textarea.addEventListener('input', function() {
            const words = this.value.trim().split(/\s+/).filter(word => word !== '');
            wordCount.textContent = `Words: ${words.length}`;
        });

        // Add any necessary JavaScript for timer, progress updates, etc.
    </script>
    <script>
        // Timer setup
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('descriptive-assessment-form');
            const timerDisplay = document.getElementById('time-remaining');
            const timeLimit = {{ $descriptive->duration * 60 }}; // Duration in seconds
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
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
@endsection
