@extends('normal-user.master')

@section('right-sidebar')
    <!-- sidebar is not available -->
@endsection

@section('title','Skill Assessment Result')

@section('body')

    <main class="col col-xl-9 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">

        <div class="container mx-auto px-4 py-8">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h1 class="text-2xl font-bold mb-6">Assessment Result</h1>

                {{-- Result Summary --}}
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-blue-800">Score</h3>
                        <p class="text-3xl font-bold text-blue-600">{{ $result->score }}</p>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-green-800">Correct Answers</h3>
                        <p class="text-3xl font-bold text-green-600">{{ $result->correct_answers }}</p>
                    </div>
                    <div class="bg-red-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-red-800">Wrong Answers</h3>
                        <p class="text-3xl font-bold text-red-600">{{ $result->wrong_answers }}</p>
                    </div>
                    <div class="bg-purple-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-purple-800">Accuracy</h3>
                        <p class="text-3xl font-bold text-purple-600">{{ number_format($result->accuracy, 2) }}%</p>
                    </div>
                </div>

                {{-- Detailed Results --}}
                <div class="mt-8">
                    <h2 class="text-xl font-semibold mb-4">Detailed Analysis</h2>
                    @foreach($quiz->quizQuestions as $index => $question)
                        @php
                            $userAnswer = $result->assessmentAnswers->where('question_id', $question->id)->first();
                        @endphp
                        <div class="mb-8 p-4 rounded-lg {{ $userAnswer && $userAnswer->is_correct ? 'bg-green-50' : 'bg-red-50' }}">
                            <h3 class="font-semibold mb-2">Question {{ $index + 1 }}: {!! strip_tags($question->question) !!}</h3>

                            <div class="ml-4">
                                <p class="mb-2">
                                    <span class="font-medium">Your Answer:</span>
                                    <span class="{{ $userAnswer && $userAnswer->is_correct ? 'text-green-600' : 'text-red-600' }}">
                    {{ $userAnswer ? $userAnswer->answer : 'No Answer' }}
                </span>
                                </p>

                                @if($userAnswer && !$userAnswer->is_correct)
                                    <p class="text-green-600">
                                        <span class="font-medium">Correct Answer:</span>
                                        {{ $question->correct_answer }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach

                </div>

                {{-- Navigation Buttons --}}
                <div class="flex justify-between">
                    <a href="{{ route('normal-user.skill-assessment.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">Back</a>
                    {{--                <button class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">Next</button>--}}
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

@endsection
