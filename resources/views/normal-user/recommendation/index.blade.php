@extends('normal-user.master')

@section('right-sidebar')
    <!-- sidebar is not available -->
@endsection

@section('title','Career Recommendation')

@section('body')

    <main class="col col-xl-9 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
        <main class="bg-white rounded-xl shadow-sm p-6 mb-8">

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-6 text-white">
                    <h1 class="text-4xl font-bold mb-2">Personalized Career Growth Recommendations</h1>
                    <p class="text-xl opacity-80">Based on your profile, activities, and interests</p>
                </div>
                <div class="p-6">
                    @if($recommendations->isEmpty())
                        <div class="bg-gray-50 rounded-xl p-6">
                            <p class="text-xl text-gray-700 mb-4">No recommendations available at this time. To get personalized suggestions:</p>
                            <ul class="list-disc ml-6 space-y-2 text-gray-600">
                                <li>Complete your profile with skills and experience</li>
                                <li>Update your job preferences</li>
                                <li>Engage with community content</li>
                                <li>Participate in research projects</li>
                            </ul>
                        </div>
                    @else
                        <!-- Job Recommendations Section -->
                        <section class="mb-12">
                            <h2 class="text-3xl font-bold mb-6 text-gray-800 flex items-center">
                                <i class="fas fa-briefcase mr-3 text-blue-600"></i>Recommended Jobs
                            </h2>
                            <div class="grid gap-6 md:grid-cols-2">
                                @foreach($recommendations->where('recommendation_type', 1) as $job)
                                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition p-6">
                                        <div class="flex justify-between items-start mb-4">
                                            <div>
                                                <h3 class="text-2xl font-semibold text-gray-800">{{ $job->title }}</h3>
                                                <h4 class="text-lg text-blue-600">{{ $job->subtitle }}</h4>
                                            </div>
                                            <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">
                                            Match: {{ number_format($job->score, 0) }}%
                                        </span>
                                        </div>
                                        <p class="text-gray-600 mb-4">{!! Str::limit($job->description, 200) !!}</p>
                                        <div class="flex flex-wrap gap-4 text-sm text-gray-600">
                                        <span class="flex items-center">
                                            <i class="fas fa-map-marker-alt mr-2 text-red-500"></i>{{ $job->extra_field1 }}
                                        </span>
                                            <span class="flex items-center">
                                            <i class="fas fa-money-bill-wave mr-2 text-green-500"></i>{{ $job->extra_field2 }}
                                        </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>

                        <!-- Resource Spaces Section -->
                        <section class="mb-12">
                            <h2 class="text-3xl font-bold mb-6 text-gray-800 flex items-center">
                                <i class="fas fa-users mr-3 text-purple-600"></i>Recommended Resource Spaces
                            </h2>
                            <div class="grid gap-6 md:grid-cols-2">
                                @foreach($recommendations->where('recommendation_type', 3) as $space)
                                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition p-6">
                                        <div class="flex justify-between items-start mb-4">
                                            <div>
                                                <h3 class="text-2xl font-semibold text-gray-800">{{ $space->title }}</h3>
                                                <h4 class="text-lg text-purple-600">Created by: {{ $space->subtitle }}</h4>
                                            </div>
                                            <span class="bg-purple-100 text-purple-800 text-sm font-medium px-3 py-1 rounded-full">
                                            Match: {{ number_format($space->score, 0) }}%
                                        </span>
                                        </div>
                                        <p class="text-gray-600 mb-4">{{ Str::limit($space->description, 200) }}</p>
                                        <div class="mt-2 text-sm text-gray-500 flex items-center">
                                            <i class="fas fa-user-circle mr-2 text-purple-500"></i>
                                            Based on your activities:
                                            <span class="font-medium text-purple-700 ml-1">
                                            Education, Skills, Work Experience, etc.
                                        </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>

                        <!-- Activity Prompt -->
                        <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl p-6 mt-12">
                            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Want More Personalized Recommendations?</h3>
                            <p class="text-lg text-gray-700 mb-4">Improve your recommendations by taking these actions:</p>
                            <ul class="grid gap-3 md:grid-cols-2">
                                <li class="flex items-center text-gray-600">
                                    <i class="fas fa-check-circle mr-2 text-green-500"></i>
                                    Update your skills and experience
                                </li>
                                <li class="flex items-center text-gray-600">
                                    <i class="fas fa-comments mr-2 text-blue-500"></i>
                                    Engage with content related to your interests
                                </li>
                                <li class="flex items-center text-gray-600">
                                    <i class="fas fa-users mr-2 text-purple-500"></i>
                                    Participate in discussions and research projects
                                </li>
                                <li class="flex items-center text-gray-600">
                                    <i class="fas fa-cog mr-2 text-gray-500"></i>
                                    Complete your job preferences
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </main>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
@endsection
