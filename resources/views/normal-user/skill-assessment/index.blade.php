@extends('normal-user.master')

@section('right-sidebar')
    <!-- sidebar is not available -->
@endsection

@section('title','Skill Assessment List')

@section('body')

    <!-- Main Content -->
    <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
        <!-- timeline -->
        <div class="timeline-container lg:flex 2xl:gap-16 gap-12 mx-auto" id="js-oversized">
            <!-- Main Content -->
            <div class="col-span-">
{{--                <!-- Search Bar -->--}}
{{--                <div class="relative mb-6">--}}
{{--                    <input type="text"--}}
{{--                           class="w-full bg-white text-gray-800 pl-12 pr-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 shadow-sm"--}}
{{--                           placeholder="Search assessments...">--}}
{{--                    <i class='bx bx-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400'></i>--}}
{{--                </div>--}}

{{--                <!-- Search Bar -->--}}
{{--                <div class="relative mb-6">--}}
{{--                    <form method="GET" action="{{route('normal-user.skill-assessment.index')}}">--}}
{{--                        <input type="text"--}}
{{--                               name="search"--}}
{{--                               value="{{ request('search') }}"--}}
{{--                               class="w-full bg-white text-gray-800 pl-12 pr-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 shadow-sm"--}}
{{--                               placeholder="Search assessments...">--}}
{{--                        <i class='bx bx-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400'></i>--}}
{{--                    </form>--}}
{{--                </div>--}}


                <form action="{{ route('normal-user.skill-assessment.index') }}" method="GET" class="relative mb-6 flex items-center space-x-4">
                    <!-- Search Input -->
                    <div class="relative flex-grow">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               class="w-full bg-white text-gray-800 pl-12 pr-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 shadow-sm"
                               placeholder="Search assessments...">
                        <i class='bx bx-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400'></i>
                    </div>

                    <!-- Question Type Dropdown -->
                    <select name="type"
                            class="bg-white text-gray-800 px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 shadow-sm">
                        <option value="">All Types</option>
                        <option value="quiz" {{ request('type') == 'quiz' ? 'selected' : '' }}>Quiz</option>
                        <option value="descriptive" {{ request('type') == 'descriptive' ? 'selected' : '' }}>Descriptive</option>
                    </select>

                    <!-- Search Button -->
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded-xl shadow-md hover:bg-blue-600">
                        Search
                    </button>
                </form>




                <!-- Assessment Cards -->

                <div class="grid grid-cols-1 gap-6">
                    @foreach ($allQuestions as $question)
                        @if ($question->type === 'quiz')
                            <!-- Quiz Questions -->
                            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:border-blue-500 transition-all duration-300" style="width: 600px;">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="p-3 bg-blue-50 rounded-lg">
                                        <i class='bx bx-task text-2xl text-blue-500'></i>
                                    </div>

                                    <span class="text-emerald-600 text-sm bg-emerald-50 px-3 py-1 rounded-full">
                        {{ $question->difficulty_level === 1 ? 'Beginner' : ($question->difficulty_level === 2 ? 'Intermediate' : 'Advanced') }}
                    </span>
                                </div>
                                <div class="text-sm text-gray-500 mb-4">
                                    <i class='bx bx-buildings mr-2'></i>
                                    <strong>University:</strong> {{ $question->university_name }}
                                </div>

                                <div class="flex justify-between text-sm text-gray-500 mb-4">
                    <span class="flex items-center">
                        <i class='bx bx-clipboard mr-2'></i>
                        {{ $question->quiz_title }}
                    </span>
                                </div>
                                <strong>Quiz</strong>

                                <div class="flex justify-between text-sm text-gray-500 mb-4">
                    <span class="flex items-center">
                        <i class='bx bx-time-five mr-2'></i>
                        {{ $question->duration }} mins
                    </span>
                                    <span class="flex items-center">
                        <i class='bx bx-book mr-2'></i>
                        <span class="font-bold">{{ $question->course_name }} Course</span>
                    </span>
                                    <span class="flex items-center">
                        <i class='bx bx-list-ol mr-2'></i>
                        {{ $question->question_count }} Questions
                    </span>
                                </div>

                                <button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-xl transition-colors">
                                    <a href="{{ route('normal-user.quiz.detail', ['id' => $question->id]) }}">Start Assessment</a>
                                </button>
                            </div>
                        @elseif ($question->type === 'descriptive')
                            <!-- Descriptive Questions -->
                            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:border-blue-500 transition-all duration-300" style="width: 600px;">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="p-3 bg-purple-50 rounded-lg">
                                        <i class='bx bx-edit text-2xl text-purple-500'></i>
                                    </div>

                                    <span class="text-emerald-600 text-sm bg-emerald-50 px-3 py-1 rounded-full">
                        {{ $question->difficulty_level === 1 ? 'Beginner' : ($question->difficulty_level === 2 ? 'Intermediate' : 'Advanced') }}
                    </span>
                                </div>
                                <div class="text-sm text-gray-500 mb-4">
                                    <i class='bx bx-buildings mr-2'></i>
                                    <strong>University:</strong> {{ $question->university_name }}
                                </div>

                                <div class="flex justify-between text-sm text-gray-500 mb-4">
                    <span class="flex items-center">
                        <i class='bx bx-clipboard mr-2'></i>
                        {{ $question->descriptive_title }}
                    </span>
                                </div>
                                <strong>Descriptive</strong>

                                <div class="flex justify-between text-sm text-gray-500 mb-4">
                    <span class="flex items-center">
                        <i class='bx bx-time-five mr-2'></i>
                        {{ $question->duration }} mins
                    </span>
                                    <span class="flex items-center">
                        <i class='bx bx-book mr-2'></i>
                        <span class="font-bold">{{ $question->course_name }} Course</span>
                    </span>
                                    <span class="flex items-center">
                        <i class='bx bx-list-ol mr-2'></i>
                        {{ $question->question_count }} Questions
                    </span>
                                </div>

                                <button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-xl transition-colors">
                                    <a href="{{ route('normal-user.descriptive.detail', ['id' => $question->id]) }}">Start Assessment</a>
                                </button>
                            </div>
                        @endif
                    @endforeach
                </div>









                <!-- Loading State -->
                <div class="text-center mt-6">
                    <div class="inline-block animate-spin rounded-full h-8 w-8 border-4 border-blue-500 border-t-transparent"></div>
                    <p class="text-gray-500 mt-2">Loading more assessments...</p>
                </div>
            </div>
        </div>
    </main>
    <!-- Main Content -->

    <aside class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-6 col-12">

            <!-- Right Sidebar -->
                <div class="sticky top-4">
                    <!-- Assessment Results Section -->
                    <div class="bg-white rounded-xl shadow-sm p-6 mt-6">
                        <h3 class="text-gray-800 font-semibold mb-4">Your Assessment Results</h3>
                        <div class="max-h-96 overflow-y-auto">
                            <table class="w-full text-left border-collapse">
                                <thead class="sticky top-0 bg-white">
                                <tr class="border-b">
                                    <th class="py-2 text-gray-600">Skill Name</th>
                                    <th class="py-2 text-gray-600">Title</th>
                                    <th class="py-2 text-gray-600">Score</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($assessmentResults as $result)
                                    <tr class="border-b hover:bg-gray-50 transition"
                                        onclick="window.location='{{ route('normal-user.assessment.detail', $result->id) }}'"
                                        style="cursor: pointer;">
                                        <td class="py-2 text-gray-800">{{ $result->skill_name }}</td>
                                        <td class="py-2 text-gray-800">
                                            {{ $result->quiz_title ?? $result->descriptive_title }}
                                        </td>
                                        <td class="py-2 text-gray-800">{{ $result->score }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-4 text-center text-gray-600">No assessments taken yet.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>

    </aside>


    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">


@endsection
