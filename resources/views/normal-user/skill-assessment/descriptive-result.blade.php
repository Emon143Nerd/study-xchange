@extends('normal-user.master')

@section('right-sidebar')
    <!-- sidebar is not available -->
@endsection

@section('title','Skill Assessment Result')

@section('body')

{{--    <main class="col col-xl-9 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">--}}

{{--        <main class="bg-white rounded-xl shadow-sm p-6 mb-8">--}}
{{--            <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Assessment Results</h1>--}}

{{--            <div class="mb-8 text-center">--}}
{{--                <div class="inline-block p-4 bg-blue-100 rounded-full mb-4">--}}
{{--                    <i class='bx bx-badge-check text-6xl text-blue-600'></i>--}}
{{--                </div>--}}
{{--                <h2 class="text-2xl font-semibold text-gray-800 mb-2">--}}
{{--                    {{ $result->skill_name ?? 'Pending' }}--}}
{{--                </h2>--}}
{{--                <p class="text-gray-600">--}}
{{--                    Completed on {{ $result->created_at ? $result->created_at->format('F d, Y') : 'Pending' }}--}}
{{--                </p>--}}
{{--            </div>--}}

{{--            <div class="mb-8">--}}
{{--                <div class="flex justify-between items-center mb-2">--}}
{{--                    <span class="text-lg font-semibold text-gray-800">Your Score</span>--}}
{{--                    <span class="text-2xl font-bold text-blue-600">--}}
{{--                {{ $result->score !== null ? $result->score : 'Pending' }}--}}
{{--            </span>--}}
{{--                </div>--}}
{{--                <div class="h-4 bg-gray-200 rounded-full">--}}
{{--                    <div class="h-full w-[{{ $result->score ?? 0 }}%] bg-blue-500 rounded-full"></div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="grid gap-6 md:grid-cols-2 mb-8">--}}
{{--                <div class="bg-gray-50 p-4 rounded-lg">--}}
{{--                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Performance Breakdown</h3>--}}
{{--                    <ul class="space-y-2">--}}
{{--                        <li class="flex justify-between">--}}
{{--                            <span class="text-gray-600">Correct Answers</span>--}}
{{--                            <span class="font-semibold text-gray-800">--}}
{{--                        {{ $result->correct_answers !== null ? $result->correct_answers : 'Pending' }}--}}
{{--                    </span>--}}
{{--                        </li>--}}
{{--                        <li class="flex justify-between">--}}
{{--                            <span class="text-gray-600">Wrong Answers</span>--}}
{{--                            <span class="font-semibold text-gray-800">--}}
{{--                        {{ $result->wrong_answers !== null ? $result->wrong_answers : 'Pending' }}--}}
{{--                    </span>--}}
{{--                        </li>--}}
{{--                        <li class="flex justify-between">--}}
{{--                            <span class="text-gray-600">Completion Time</span>--}}
{{--                            <span class="font-semibold text-gray-800">--}}
{{--                        {{ $result->completed_time !== null ? gmdate('H:i:s', $result->completed_time) : 'Pending' }}--}}
{{--                    </span>--}}
{{--                        </li>--}}
{{--                        <li class="flex justify-between">--}}
{{--                            <span class="text-gray-600">Accuracy</span>--}}
{{--                            <span class="font-semibold text-gray-800">--}}
{{--                        {{ $result->accuracy !== null ? $result->accuracy . '%' : 'Pending' }}--}}
{{--                    </span>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}

{{--                <div class="bg-blue-50 p-4 rounded-lg">--}}
{{--                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Feedback</h3>--}}
{{--                    <p class="text-gray-600">--}}
{{--                        {{ $result->feedback ?? 'Pending' }}--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="mt-8">--}}
{{--                <h2 class="text-xl font-semibold mb-4">Detailed Questions and Answers</h2>--}}

{{--                @foreach($result->assessmentAnswers as $index => $answer)--}}
{{--                    <div class="mb-8 p-4 rounded-lg {{ $answer->is_correct ? 'bg-green-50' : 'bg-red-50' }}">--}}
{{--                        <h3 class="font-semibold mb-2">Question {{ $index + 1 }}:</h3>--}}
{{--                        <p class="text-gray-800">{{ $answer->question->question ?? 'Question not found' }}</p>--}}

{{--                        <div class="ml-4 mt-2">--}}
{{--                            <p class="mb-2">--}}
{{--                                <span class="font-medium">Your Answer:</span>--}}
{{--                                <span class="{{ $answer->is_correct ? 'text-green-600' : 'text-red-600' }}">--}}
{{--                        {{ $answer->answer }}--}}
{{--                    </span>--}}
{{--                            </p>--}}

{{--                            @if(!$answer->is_correct)--}}
{{--                                <p class="text-green-600">--}}
{{--                                    <span class="font-medium">Correct Answer:</span>--}}
{{--                                    {{ $answer->question->correct_answer ?? 'Not provided' }}--}}
{{--                                </p>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}


{{--            <div class="flex flex-wrap gap-4 justify-center">--}}

{{--                <a href="{{ route('normal-user.skill-assessment.index') }}" class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">--}}
{{--                    Skill Assessment--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </main>--}}

{{--    </main>--}}


    <main class="col col-xl-9 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
        <main class="bg-white rounded-xl shadow-sm p-6 mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Assessment Results</h1>

            {{-- Score Overview Section --}}
            <div class="mb-8 text-center">
                <div class="inline-block p-4 bg-blue-100 rounded-full mb-4">
                    <i class='bx bx-badge-check text-6xl text-blue-600'></i>
                </div>
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">
                    {{ $result->skill_name ?? 'Pending' }}
                </h2>
                <p class="text-gray-600">
                    Completed on {{ $result->created_at ? $result->created_at->format('F d, Y') : 'Pending' }}
                </p>
            </div>

            {{-- Score Progress Bar Section --}}
            <div class="mb-8">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-lg font-semibold text-gray-800">Your Score</span>
                    <span class="text-2xl font-bold text-blue-600">
                        {{ $result->score !== null ? $result->score : 'Pending' }}
                    </span>
                </div>
                <div class="h-4 bg-gray-200 rounded-full">
                    <div class="h-full w-[{{ $result->score ?? 0 }}%] bg-blue-500 rounded-full"></div>
                </div>
            </div>

            {{-- Performance Statistics Section --}}
            <div class="grid gap-6 md:grid-cols-2 mb-8">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Performance Breakdown</h3>
                    <ul class="space-y-2">
                        <li class="flex justify-between">
                            <span class="text-gray-600">Correct Answers</span>
                            <span class="font-semibold text-gray-800">
                                {{ $result->correct_answers !== null ? $result->correct_answers : 'Pending' }}
                            </span>
                        </li>
                        <li class="flex justify-between">
                            <span class="text-gray-600">Wrong Answers</span>
                            <span class="font-semibold text-gray-800">
                                {{ $result->wrong_answers !== null ? $result->wrong_answers : 'Pending' }}
                            </span>
                        </li>
                        <li class="flex justify-between">
                            <span class="text-gray-600">Completion Time</span>
                            <span class="font-semibold text-gray-800">
                                {{ $result->completed_time !== null ? gmdate('H:i:s', $result->completed_time) : 'Pending' }}
                            </span>
                        </li>
                        <li class="flex justify-between">
                            <span class="text-gray-600">Accuracy</span>
                            <span class="font-semibold text-gray-800">
                                {{ $result->accuracy !== null ? $result->accuracy . '%' : 'Pending' }}
                            </span>
                        </li>
                    </ul>
                </div>

                <div class="bg-blue-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Feedback</h3>
                    <p class="text-gray-600">
                        {{ $result->feedback ?? 'Pending feedback from assessor.' }}
                    </p>
                </div>
            </div>

            {{-- Detailed Answers Section --}}
            <div class="mt-8">
                <h2 class="text-xl font-semibold mb-4">Detailed Answers</h2>

                @forelse($result->assessmentAnswers as $index => $answer)
                    <div class="mb-8 p-4 rounded-lg {{ $answer->is_correct ? 'bg-green-50' : 'bg-red-50' }}">
                        <h3 class="font-semibold mb-2">Question {{ $index + 1 }}:</h3>

                        @if($answer->descriptiveQuestion)
                            <p class="text-gray-800 mb-4">{!! strip_tags($answer->descriptiveQuestion->question) !!}</p>

                            <div class="ml-4">
                                <div class="mb-4">
                                    <p class="font-medium text-gray-700 mb-2">Your Answer:</p>
                                    <div class="p-3 bg-white rounded-lg {{ $answer->is_correct ? 'border-green-200' : 'border-red-200' }} border">
                                        <p class="text-gray-800">{{ $answer->answer }}</p>
                                    </div>
                                </div>

                                @if(!$answer->is_correct && $answer->descriptiveQuestion->correct_answer)
                                    <div class="mb-4">
                                        <p class="font-medium text-gray-700 mb-2">Correct Answer:</p>
                                        <div class="p-3 bg-white rounded-lg border-green-200 border">
                                            <p class="text-gray-800">{!! strip_tags($answer->descriptiveQuestion->correct_answer) !!}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @else
                            <p class="text-gray-600">Question not found</p>
                        @endif
                    </div>
                @empty
                    <div class="text-center p-6 bg-gray-50 rounded-lg">
                        <p class="text-gray-600">No answers available for this assessment.</p>
                    </div>
                @endforelse
            </div>

            {{-- Navigation Buttons --}}
            <div class="flex justify-between">
                <a href="{{ route('normal-user.skill-assessment.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">Back</a>
                {{--                <button class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">Next</button>--}}
            </div>
        </main>
    </main>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

@endsection
