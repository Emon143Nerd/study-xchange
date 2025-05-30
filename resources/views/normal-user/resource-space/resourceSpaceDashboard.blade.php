@extends('normal-user.master')

@section('right-sidebar')
    <!-- sidebar is not available -->
@endsection

@section('title','Resource Space Dashboard')

@section('body')
{{--    <script src="https://cdn.tailwindcss.com"></script>--}}

{{--    <!-- Main Content -->--}}
{{--    <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">--}}
{{--        <div class="d-flex align-items-center mb-3">--}}
{{--            <a href="{{route('normal-user.resource-space.detail',$resourceSpace->id)}}" class="material-icons text-dark text-decoration-none m-none me-3">arrow_back</a>--}}
{{--            <p class="ms-2 mb-0 fw-bold text-body fs-6">Explore</p>--}}
{{--        </div>--}}
{{--        <div class="container mx-auto px-6 py-8">--}}
{{--            <!-- Dashboard Header -->--}}
{{--            <div class="flex items-center justify-between mb-8">--}}
{{--                <h1 class="text-3xl font-bold text-gray-800">Resource Space Engagement Dashboard</h1>--}}
{{--                <form action="{{ route('normal-user.resource-space.delete', $resourceSpace->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this resource space?');">--}}
{{--                    @csrf--}}
{{--                    @method('DELETE')--}}
{{--                    <button type="submit" class="btn btn-danger">Delete Resource Space</button>--}}
{{--                </form>--}}
{{--            </div>--}}

{{--            <!-- Dashboard Cards -->--}}
{{--            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-8">--}}
{{--                <!-- Post Count Card -->--}}
{{--                <div class="box-width bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transform transition-all duration-300">--}}
{{--                    <div class="flex items-center space-x-4">--}}
{{--                        <div class="bg-blue-500 text-white p-3 rounded-full">--}}
{{--                            <i class="fas fa-file-alt text-2xl"></i> <!-- Post Icon -->--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                            <h2 class="text-xl font-semibold text-gray-700">Total Posts</h2>--}}
{{--                            <p class="text-4xl font-bold text-blue-600" id="post_count">{{ $postCount }}</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <!-- Member Count Card -->--}}
{{--                <div class="box-width bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transform transition-all duration-300">--}}
{{--                    <div class="flex items-center space-x-4">--}}
{{--                        <div class="bg-green-500 text-white p-3 rounded-full">--}}
{{--                            <i class="fas fa-users text-2xl"></i>--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                            <h2 class="text-xl font-semibold text-gray-700">Total Members</h2>--}}
{{--                            <p class="text-4xl font-bold text-green-600" id="member_count">{{ $memberCount }}</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <!-- Total Upvotes Card -->--}}
{{--                <div class="box-width bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transform transition-all duration-300">--}}
{{--                    <div class="flex items-center space-x-4">--}}
{{--                        <div class="bg-green-600 text-white p-3 rounded-full">--}}
{{--                            <i class="fas fa-thumbs-up text-2xl"></i>--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                            <h2 class="text-xl font-semibold text-gray-700">Total Upvotes</h2>--}}
{{--                            <p class="text-4xl font-bold text-green-500" id="total_upvotes">{{ $totalUpvotes }}</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- Progress Bar -->--}}
{{--                    @if($totalUpvotes)--}}
{{--                    <div class="mt-4">--}}
{{--                        <div class="bg-green-100 h-2 rounded-full">--}}
{{--                            <div class="bg-green-500 h-2 rounded-full" style="width: {{ ($totalUpvotes / $totalEngagement) * 100 }}%"></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @endif--}}
{{--                </div>--}}

{{--                <!-- Total Downvotes Card -->--}}
{{--                <div class="box-width bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transform transition-all duration-300">--}}
{{--                    <div class="flex items-center space-x-4">--}}
{{--                        <div class="bg-red-500 text-white p-3 rounded-full">--}}
{{--                            <i class="fas fa-thumbs-down text-2xl"></i>--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                            <h2 class="text-xl font-semibold text-gray-700">Total Downvotes</h2>--}}
{{--                            <p class="text-4xl font-bold text-red-500" id="total_downvotes">{{ $totalDownvotes }}</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- Progress Bar -->--}}
{{--                    @if($totalDownvotes)--}}
{{--                    <div class="mt-4">--}}
{{--                        <div class="bg-red-100 h-2 rounded-full">--}}
{{--                            <div class="bg-red-500 h-2 rounded-full" style="width: {{ ($totalDownvotes / $totalEngagement) * 100 }}%"></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @endif--}}
{{--                </div>--}}

{{--                <!-- Total Comments Card -->--}}
{{--                <div class="box-width bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transform transition-all duration-300">--}}
{{--                    <div class="flex items-center space-x-4">--}}
{{--                        <div class="bg-indigo-500 text-white p-3 rounded-full">--}}
{{--                            <i class="fas fa-comment-dots text-2xl"></i>--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                            <h2 class="text-xl font-semibold text-gray-700">Total Comments</h2>--}}
{{--                            <p class="text-4xl font-bold text-indigo-600" id="total_comments">{{ $totalComments }}</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- Progress Bar -->--}}
{{--                    @if($totalComments)--}}
{{--                    <div class="mt-4">--}}
{{--                        <div class="bg-indigo-100 h-2 rounded-full">--}}
{{--                            <div class="bg-indigo-500 h-2 rounded-full" style="width: {{ ($totalComments / $totalEngagement) * 100 }}%"></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @endif--}}
{{--                </div>--}}

{{--                <!-- Total Engagement Card -->--}}
{{--                <div class="box-width bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transform transition-all duration-300">--}}
{{--                    <div class="flex items-center space-x-4">--}}
{{--                        <div class="bg-yellow-500 text-white p-3 rounded-full">--}}
{{--                            <i class="fas fa-chart-line text-2xl"></i>--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                            <h2 class="text-xl font-semibold text-gray-700">Total Engagement</h2>--}}
{{--                            <p class="text-4xl font-bold text-yellow-500" id="total_engagement">{{ $totalEngagement }}</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- Progress Bar -->--}}
{{--                    @if($totalEngagement)--}}
{{--                    <div class="mt-4">--}}
{{--                        <div class="bg-yellow-100 h-2 rounded-full">--}}
{{--                            <div class="bg-yellow-500 h-2 rounded-full" style="width: {{ ($totalEngagement / $totalEngagement) * 100 }}%"></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @endif--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </main>--}}

{{--    <style>--}}
{{--        .box-width{--}}
{{--            width: 270px;--}}
{{--        }--}}
{{--    </style>--}}


<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Main Content -->
<main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
    <div class="d-flex align-items-center mb-3">
        <a href="{{route('normal-user.resource-space.detail',$resourceSpace->id)}}" class="material-icons text-dark text-decoration-none m-none me-3">arrow_back</a>
        <p class="ms-2 mb-0 fw-bold text-body fs-6">Explore</p>
    </div>

    <div class="container mx-auto px-2 sm:px-4 lg:px-6 py-4 lg:py-8">
        <!-- Dashboard Header -->
        <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between mb-4 lg:mb-8 gap-4">
            <div class="w-full lg:w-auto">
                <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-800 break-words">Advanced Engagement Dashboard</h1>
                <p class="text-sm sm:text-base text-gray-600 mt-1 lg:mt-2 break-words">Comprehensive analytics for {{ $resourceSpace->name }}</p>
            </div>
            <div class="w-full lg:w-auto">
                <form action="{{ route('normal-user.resource-space.delete', $resourceSpace->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this resource space? This action cannot be undone.');" class="w-full lg:w-auto">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-full lg:w-auto text-sm">
                        <i class="fas fa-trash-alt me-2"></i>Delete Resource Space
                    </button>
                </form>
            </div>
        </div>

        <!-- Weighted Engagement Score Card -->
        <div class="mb-4 lg:mb-8">
            <div class="bg-gradient-to-r from-purple-600 to-blue-600 text-white shadow-xl rounded-lg p-3 sm:p-6 lg:p-8">
                <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">
                    <div class="w-full lg:w-auto">
                        <h2 class="text-lg sm:text-xl lg:text-2xl font-bold mb-1 lg:mb-2 break-words">Weighted Engagement Score</h2>
                        <p class="text-purple-100 text-sm sm:text-base break-words">Comprehensive engagement quality metric</p>
                    </div>
                    <div class="text-left lg:text-right w-full lg:w-auto">
                        <p class="text-2xl sm:text-3xl lg:text-5xl font-bold">{{ $weighted_engagement_score }}</p>
                        <p class="text-purple-200 text-sm sm:text-base">Quality Score</p>
                    </div>
                </div>
                <div class="mt-4 lg:mt-6">
                    <div class="bg-white bg-opacity-20 h-2 lg:h-3 rounded-full">
                        <div class="bg-white h-2 lg:h-3 rounded-full transition-all duration-1000" style="width: {{ min(100, ($weighted_engagement_score / 100) * 100) }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Primary Metrics Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 sm:gap-4 lg:gap-6 mb-4 lg:mb-8">
            <!-- Total Posts Card -->
            <div class="bg-white shadow-lg rounded-lg p-3 sm:p-4 lg:p-6 hover:shadow-xl transform transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center space-x-3 lg:space-x-4">
                    <div class="bg-blue-500 text-white p-2 lg:p-3 rounded-full flex-shrink-0">
                        <i class="fas fa-file-alt text-base lg:text-2xl"></i>
                    </div>
                    <div class="min-w-0 flex-1">
                        <h3 class="text-sm sm:text-base lg:text-lg font-semibold text-gray-700 break-words">Total Posts</h3>
                        <p class="text-xl sm:text-2xl lg:text-3xl font-bold text-blue-600 break-all">{{ $post_count }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Members Card -->
            <div class="bg-white shadow-lg rounded-lg p-3 sm:p-4 lg:p-6 hover:shadow-xl transform transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center space-x-3 lg:space-x-4">
                    <div class="bg-green-500 text-white p-2 lg:p-3 rounded-full flex-shrink-0">
                        <i class="fas fa-users text-base lg:text-2xl"></i>
                    </div>
                    <div class="min-w-0 flex-1">
                        <h3 class="text-sm sm:text-base lg:text-lg font-semibold text-gray-700 break-words">Total Members</h3>
                        <p class="text-xl sm:text-2xl lg:text-3xl font-bold text-green-600 break-all">{{ $member_count }}</p>
                        <p class="text-xs sm:text-sm text-gray-500 break-words">{{ $verified_members }} verified</p>
                    </div>
                </div>
            </div>

            <!-- Net Votes Card -->
            <div class="bg-white shadow-lg rounded-lg p-3 sm:p-4 lg:p-6 hover:shadow-xl transform transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center space-x-3 lg:space-x-4">
                    <div class="bg-{{ $net_votes >= 0 ? 'green' : 'red' }}-500 text-white p-2 lg:p-3 rounded-full flex-shrink-0">
                        <i class="fas fa-thumbs-{{ $net_votes >= 0 ? 'up' : 'down' }} text-base lg:text-2xl"></i>
                    </div>
                    <div class="min-w-0 flex-1">
                        <h3 class="text-sm sm:text-base lg:text-lg font-semibold text-gray-700 break-words">Net Votes</h3>
                        <p class="text-xl sm:text-2xl lg:text-3xl font-bold text-{{ $net_votes >= 0 ? 'green' : 'red' }}-600 break-all">{{ $net_votes }}</p>
                        <p class="text-xs sm:text-sm text-gray-500 break-words">Ratio: {{ $vote_ratio }}:1</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Advanced Metrics Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-3 sm:gap-4 lg:gap-6 mb-4 lg:mb-8">
            <!-- Average Post Quality -->
            <div class="bg-white shadow-lg rounded-lg p-3 sm:p-4 lg:p-6 hover:shadow-xl transform transition-all duration-300">
                <div class="flex flex-col items-center text-center space-y-2 lg:space-y-3">
                    <div class="bg-purple-500 text-white p-2 lg:p-3 rounded-full">
                        <i class="fas fa-star text-base lg:text-xl"></i>
                    </div>
                    <div class="w-full">
                        <h3 class="text-xs sm:text-sm lg:text-base font-semibold text-gray-700 break-words leading-tight">Avg Quality</h3>
                        <p class="text-lg sm:text-xl lg:text-2xl font-bold text-purple-600 break-all">{{ $avg_post_quality_score }}</p>
                    </div>
                </div>
            </div>

            <!-- Thread Depth -->
            <div class="bg-white shadow-lg rounded-lg p-3 sm:p-4 lg:p-6 hover:shadow-xl transform transition-all duration-300">
                <div class="flex flex-col items-center text-center space-y-2 lg:space-y-3">
                    <div class="bg-indigo-500 text-white p-2 lg:p-3 rounded-full">
                        <i class="fas fa-comments text-base lg:text-xl"></i>
                    </div>
                    <div class="w-full">
                        <h3 class="text-xs sm:text-sm lg:text-base font-semibold text-gray-700 break-words leading-tight">Thread Depth</h3>
                        <p class="text-lg sm:text-xl lg:text-2xl font-bold text-indigo-600 break-all">{{ $avg_thread_depth }}</p>
                    </div>
                </div>
            </div>

            <!-- Stickiness Ratio -->
            <div class="bg-white shadow-lg rounded-lg p-3 sm:p-4 lg:p-6 hover:shadow-xl transform transition-all duration-300">
                <div class="flex flex-col items-center text-center space-y-2 lg:space-y-3">
                    <div class="bg-yellow-500 text-white p-2 lg:p-3 rounded-full">
                        <i class="fas fa-chart-line text-base lg:text-xl"></i>
                    </div>
                    <div class="w-full">
                        <h3 class="text-xs sm:text-sm lg:text-base font-semibold text-gray-700 break-words leading-tight">Stickiness</h3>
                        <p class="text-lg sm:text-xl lg:text-2xl font-bold text-yellow-600 break-all">{{ $stickiness_ratio }}%</p>
                    </div>
                </div>
            </div>

            <!-- Company Posts -->
            <div class="bg-white shadow-lg rounded-lg p-3 sm:p-4 lg:p-6 hover:shadow-xl transform transition-all duration-300">
                <div class="flex flex-col items-center text-center space-y-2 lg:space-y-3">
                    <div class="bg-orange-500 text-white p-2 lg:p-3 rounded-full">
                        <i class="fas fa-building text-base lg:text-xl"></i>
                    </div>
                    <div class="w-full">
                        <h3 class="text-xs sm:text-sm lg:text-base font-semibold text-gray-700 break-words leading-tight">Expert Posts</h3>
                        <p class="text-lg sm:text-xl lg:text-2xl font-bold text-orange-600 break-all">{{ $company_user_posts }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detailed Analytics Section -->
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-4 lg:gap-8 mb-4 lg:mb-8">
            <!-- Vote Breakdown -->
            <div class="bg-white shadow-lg rounded-lg p-3 sm:p-4 lg:p-6">
                <h3 class="text-base sm:text-lg lg:text-xl font-bold text-gray-800 mb-3 lg:mb-4 break-words">Vote Analysis</h3>
                <div class="space-y-3 lg:space-y-4">
                    <div class="flex justify-between items-center gap-2">
                        <span class="text-gray-600 text-sm sm:text-base break-words flex-1">Total Upvotes</span>
                        <span class="font-bold text-green-600 text-sm sm:text-base break-all flex-shrink-0">{{ $total_upvotes }}</span>
                    </div>
                    <div class="bg-green-100 h-2 rounded-full">
                        <div class="bg-green-500 h-2 rounded-full transition-all duration-1000"
                             style="width: {{ ($total_upvotes + $total_downvotes) > 0 ? ($total_upvotes / ($total_upvotes + $total_downvotes)) * 100 : 0 }}%"></div>
                    </div>

                    <div class="flex justify-between items-center gap-2">
                        <span class="text-gray-600 text-sm sm:text-base break-words flex-1">Total Downvotes</span>
                        <span class="font-bold text-red-600 text-sm sm:text-base break-all flex-shrink-0">{{ $total_downvotes }}</span>
                    </div>
                    <div class="bg-red-100 h-2 rounded-full">
                        <div class="bg-red-500 h-2 rounded-full transition-all duration-1000"
                             style="width: {{ ($total_upvotes + $total_downvotes) > 0 ? ($total_downvotes / ($total_upvotes + $total_downvotes)) * 100 : 0 }}%"></div>
                    </div>
                </div>
            </div>

            <!-- Activity Overview -->
            <div class="bg-white shadow-lg rounded-lg p-3 sm:p-4 lg:p-6">
                <h3 class="text-base sm:text-lg lg:text-xl font-bold text-gray-800 mb-3 lg:mb-4 break-words">User Activity</h3>
                <div class="space-y-3 lg:space-y-4">
                    <div class="flex justify-between items-center gap-2">
                        <span class="text-gray-600 text-sm sm:text-base break-words flex-1">Monthly Active Users</span>
                        <span class="font-bold text-blue-600 text-sm sm:text-base break-all flex-shrink-0">{{ $monthly_active_users }}</span>
                    </div>
                    <div class="flex justify-between items-center gap-2">
                        <span class="text-gray-600 text-sm sm:text-base break-words flex-1">Weekly Active Users</span>
                        <span class="font-bold text-green-600 text-sm sm:text-base break-all flex-shrink-0">{{ $weekly_active_users }}</span>
                    </div>
                    <div class="flex justify-between items-center gap-2">
                        <span class="text-gray-600 text-sm sm:text-base break-words flex-1">New Member Activation</span>
                        <span class="font-bold text-purple-600 text-sm sm:text-base break-all flex-shrink-0">{{ $new_member_activation_rate }}%</span>
                    </div>
                    <div class="flex justify-between items-center gap-2">
                        <span class="text-gray-600 text-sm sm:text-base break-words flex-1">Verified Comments</span>
                        <span class="font-bold text-indigo-600 text-sm sm:text-base break-all flex-shrink-0">{{ $verified_user_comments }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Blog Analytics -->
        @if($total_blogs > 0)
            <div class="bg-white shadow-lg rounded-lg p-3 sm:p-4 lg:p-6 mb-4 lg:mb-8">
                <h3 class="text-base sm:text-lg lg:text-xl font-bold text-gray-800 mb-3 lg:mb-4 break-words">Blog Performance</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 sm:gap-4 lg:gap-6">
                    <div class="text-center p-3 rounded-lg bg-gray-50">
                        <p class="text-xl sm:text-2xl lg:text-3xl font-bold text-blue-600 break-all">{{ $total_blogs }}</p>
                        <p class="text-gray-600 text-sm sm:text-base break-words">Total Blogs</p>
                    </div>
                    <div class="text-center p-3 rounded-lg bg-gray-50">
                        <p class="text-xl sm:text-2xl lg:text-3xl font-bold text-green-600 break-all">{{ $total_blog_hits }}</p>
                        <p class="text-gray-600 text-sm sm:text-base break-words">Total Views</p>
                    </div>
                    <div class="text-center p-3 rounded-lg bg-gray-50">
                        <p class="text-xl sm:text-2xl lg:text-3xl font-bold text-purple-600 break-all">{{ $avg_blog_hits }}</p>
                        <p class="text-gray-600 text-sm sm:text-base break-words">Avg Views/Blog</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Engagement Breakdown Chart -->
        <div class="bg-white shadow-lg rounded-lg p-3 sm:p-4 lg:p-6 mb-4 lg:mb-6">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-3 lg:mb-4 gap-3">
                <h3 class="text-base sm:text-lg lg:text-xl font-bold text-gray-800 break-words">Engagement Breakdown</h3>
                <div class="flex flex-wrap gap-2 w-full lg:w-auto">
                    <button onclick="changeChartType('doughnut')" class="chart-type-btn active px-2 sm:px-3 py-1 text-xs sm:text-sm bg-blue-500 text-white rounded flex-1 sm:flex-none">Doughnut</button>
                    <button onclick="changeChartType('bar')" class="chart-type-btn px-2 sm:px-3 py-1 text-xs sm:text-sm bg-gray-300 text-gray-700 rounded flex-1 sm:flex-none">Bar</button>
                    <button onclick="changeChartType('line')" class="chart-type-btn px-2 sm:px-3 py-1 text-xs sm:text-sm bg-gray-300 text-gray-700 rounded flex-1 sm:flex-none">Line</button>
                </div>
            </div>

            <!-- Chart Container -->
            <div class="relative">
                <div class="h-48 sm:h-64 lg:h-80">
                    <canvas id="engagementChart"></canvas>
                </div>

                <!-- Chart Legend for Mobile -->
                <div class="mt-3 lg:hidden">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs sm:text-sm">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-green-500 rounded flex-shrink-0"></div>
                            <span class="break-words">Upvotes ({{ $total_upvotes }})</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-indigo-500 rounded flex-shrink-0"></div>
                            <span class="break-words">Comments ({{ $total_comments }})</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-yellow-500 rounded flex-shrink-0"></div>
                            <span class="break-words">Blog Views ({{ $total_blog_hits }})</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-blue-500 rounded flex-shrink-0"></div>
                            <span class="break-words">Posts ({{ $post_count }})</span>
                        </div>
                        <div class="flex items-center gap-2 sm:col-span-2 sm:justify-center">
                            <div class="w-3 h-3 bg-purple-500 rounded flex-shrink-0"></div>
                            <span class="break-words">Members ({{ $member_count }})</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Engagement Summary -->
            <div class="mt-4 lg:mt-6 p-3 sm:p-4 bg-gray-50 rounded-lg">
                <h4 class="font-semibold text-gray-800 mb-2 lg:mb-3 text-sm sm:text-base break-words">Engagement Summary</h4>
                <div class="grid grid-cols-2 lg:grid-cols-5 gap-2 sm:gap-4 text-center">
                    <div class="p-2 bg-white rounded">
                        <p class="text-sm sm:text-lg font-bold text-green-600 break-all">{{ $total_upvotes }}</p>
                        <p class="text-xs text-gray-600 break-words leading-tight">Total Upvotes</p>
                    </div>
                    <div class="p-2 bg-white rounded">
                        <p class="text-sm sm:text-lg font-bold text-indigo-600 break-all">{{ $total_comments }}</p>
                        <p class="text-xs text-gray-600 break-words leading-tight">Total Comments</p>
                    </div>
                    <div class="p-2 bg-white rounded">
                        <p class="text-sm sm:text-lg font-bold text-yellow-600 break-all">{{ $total_blog_hits }}</p>
                        <p class="text-xs text-gray-600 break-words leading-tight">Blog Views</p>
                    </div>
                    <div class="p-2 bg-white rounded">
                        <p class="text-sm sm:text-lg font-bold text-blue-600 break-all">{{ $post_count }}</p>
                        <p class="text-xs text-gray-600 break-words leading-tight">Total Posts</p>
                    </div>
                    <div class="p-2 bg-white rounded col-span-2 lg:col-span-1">
                        <p class="text-sm sm:text-lg font-bold text-purple-600 break-all">{{ $member_count }}</p>
                        <p class="text-xs text-gray-600 break-words leading-tight">Total Members</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Insights -->
        <div class="bg-white shadow-lg rounded-lg p-3 sm:p-4 lg:p-6">
            <h3 class="text-base sm:text-lg lg:text-xl font-bold text-gray-800 mb-3 lg:mb-4 break-words">Key Insights</h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 sm:gap-4">
                <div class="p-3 sm:p-4 bg-blue-50 rounded-lg">
                    <h4 class="font-semibold text-blue-800 mb-1 lg:mb-2 text-sm sm:text-base break-words">Engagement Rate</h4>
                    <p class="text-xl sm:text-2xl font-bold text-blue-600 break-all">
                        {{ $member_count > 0 ? round((($total_upvotes + $total_comments + $post_count) / $member_count) * 100, 1) : 0 }}%
                    </p>
                    <p class="text-xs sm:text-sm text-blue-600 break-words">Actions per member</p>
                </div>
                <div class="p-3 sm:p-4 bg-green-50 rounded-lg">
                    <h4 class="font-semibold text-green-800 mb-1 lg:mb-2 text-sm sm:text-base break-words">Community Health</h4>
                    <p class="text-xl sm:text-2xl font-bold text-green-600 break-words">
                        @if($weighted_engagement_score >= 80)
                            Excellent
                        @elseif($weighted_engagement_score >= 60)
                            Good
                        @elseif($weighted_engagement_score >= 40)
                            Fair
                        @else
                            Needs Improvement
                        @endif
                    </p>
                    <p class="text-xs sm:text-sm text-green-600 break-words">Based on weighted score</p>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    let engagementChart;

    // Chart data
    const chartData = {
        labels: ['Upvotes', 'Comments', 'Blog Views', 'Posts', 'Members'],
        datasets: [{
            data: [{{ $total_upvotes }}, {{ $total_comments }}, {{ $total_blog_hits }}, {{ $post_count }}, {{ $member_count }}],
            backgroundColor: [
                '#10B981', // Green
                '#6366F1', // Indigo
                '#F59E0B', // Yellow
                '#3B82F6', // Blue
                '#8B5CF6'  // Purple
            ],
            borderWidth: 2,
            borderColor: '#fff'
        }]
    };

    // Initialize chart when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('engagementChart').getContext('2d');

        engagementChart = new Chart(ctx, {
            type: 'doughnut',
            data: chartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        display: window.innerWidth > 1024, // Hide legend on mobile and tablet
                        labels: {
                            padding: 15,
                            font: {
                                size: window.innerWidth > 768 ? 12 : 10
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = total > 0 ? Math.round((value / total) * 100) : 0;
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                },
                cutout: '60%',
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        });

        // Add smooth animations to cards on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.shadow-lg').forEach(card => {
            observer.observe(card);
        });
    });

    // Function to change chart type
    function changeChartType(type) {
        // Update button states
        document.querySelectorAll('.chart-type-btn').forEach(btn => {
            btn.classList.remove('active', 'bg-blue-500', 'text-white');
            btn.classList.add('bg-gray-300', 'text-gray-700');
        });

        event.target.classList.remove('bg-gray-300', 'text-gray-700');
        event.target.classList.add('active', 'bg-blue-500', 'text-white');

        // Destroy existing chart
        if (engagementChart) {
            engagementChart.destroy();
        }

        // Create new chart with different type
        const ctx = document.getElementById('engagementChart').getContext('2d');

        let chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    display: window.innerWidth > 1024,
                    labels: {
                        padding: 15,
                        font: {
                            size: window.innerWidth > 768 ? 12 : 10
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.raw || 0;
                            if (type === 'doughnut') {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = total > 0 ? Math.round((value / total) * 100) : 0;
                                return `${label}: ${value} (${percentage}%)`;
                            }
                            return `${label}: ${value}`;
                        }
                    }
                }
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        };

        // Add specific options for doughnut chart
        if (type === 'doughnut') {
            chartOptions.cutout = '60%';
        }

        // Add specific options for bar and line charts
        if (type === 'bar' || type === 'line') {
            chartOptions.scales = {
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: {
                            size: window.innerWidth > 768 ? 12 : 10
                        }
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: window.innerWidth > 768 ? 12 : 10
                        }
                    }
                }
            };
        }

        engagementChart = new Chart(ctx, {
            type: type,
            data: chartData,
            options: chartOptions
        });
    }

    // Handle window resize for responsive legend and font sizes
    window.addEventListener('resize', function() {
        if (engagementChart) {
            engagementChart.options.plugins.legend.display = window.innerWidth > 1024;
            engagementChart.options.plugins.legend.labels.font.size = window.innerWidth > 768 ? 12 : 10;

            if (engagementChart.options.scales) {
                engagementChart.options.scales.y.ticks.font.size = window.innerWidth > 768 ? 12 : 10;
                engagementChart.options.scales.x.ticks.font.size = window.innerWidth > 768 ? 12 : 10;
            }

            engagementChart.update();
        }
    });
</script>

<style>
    .animate-fade-in {
        animation: fadeInUp 0.6s ease-out forwards;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Custom gradient backgrounds */
    .bg-gradient-to-r {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    /* Hover effects */
    .hover\:shadow-xl:hover {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .hover\:-translate-y-1:hover {
        transform: translateY(-4px);
    }

    /* Progress bar animations */
    .bg-green-500, .bg-red-500, .bg-blue-500, .bg-indigo-500, .bg-purple-500, .bg-yellow-500 {
        transition: width 1.5s ease-in-out;
    }

    /* Card hover glow effect */
    .bg-white:hover {
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    }

    /* Chart container styling */
    #engagementChart {
        max-height: 400px;
    }

    /* Chart type buttons */
    .chart-type-btn {
        transition: all 0.3s ease;
        min-width: 60px;
    }

    .chart-type-btn:hover {
        transform: translateY(-1px);
    }

    /* Text overflow prevention */
    .break-words {
        word-wrap: break-word;
        word-break: break-word;
        hyphens: auto;
    }

    .break-all {
        word-break: break-all;
    }

    .leading-tight {
        line-height: 1.25;
    }

    /* Flex utilities for responsive text */
    .min-w-0 {
        min-width: 0;
    }

    .flex-shrink-0 {
        flex-shrink: 0;
    }

    /* Responsive adjustments */
    @media (max-width: 640px) {
        .container {
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }

        #engagementChart {
            max-height: 200px;
        }

        /* Ensure text doesn't overflow in small cards */
        .grid-cols-1.sm\:grid-cols-2.xl\:grid-cols-4 > div {
            min-height: 120px;
        }

        /* Better spacing for mobile */
        .space-y-2 > * + * {
            margin-top: 0.5rem;
        }
    }

    @media (max-width: 480px) {
        /* Extra small screens */
        .text-xl {
            font-size: 1.125rem;
        }

        .text-2xl {
            font-size: 1.25rem;
        }

        .text-3xl {
            font-size: 1.5rem;
        }

        /* Ensure minimum card height */
        .bg-white.shadow-lg {
            min-height: 100px;
        }

        /* Better button sizing */
        .chart-type-btn {
            min-width: 50px;
            font-size: 0.75rem;
        }
    }

    /* Ensure proper text wrapping in all containers */
    * {
        box-sizing: border-box;
    }

    /* Prevent horizontal scroll */
    .container {
        max-width: 100%;
        overflow-x: hidden;
    }
</style>



    <aside class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-6 col-12">
        <div class="fix-right-sidebar">
            <div class="side-trend lg-none">

                <h4 class="text-2xl font-bold text-gray-800 flex items-center mb-2">
                    <span class="material-icons text-blue-500 mr-2">list_alt</span>
                    All Posts
                </h4>
                @if($posts->isNotEmpty())
                    <!-- Single Post Card -->

                    @foreach($posts as $post)
                        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
                            <div class="card-body">
                                <!-- Post Header -->
                                <div class="d-flex align-items-center mb-3">
                                    @if($post->user->image)
                                        <!-- Display user image -->
                                        <img src="{{asset($post->user->image)}}" alt="User Image" class="rounded-circle me-3 shadow-sm" style="width: 50px; height: 50px;">
                                    @else
                                        <!-- Fallback to initials with a customizable background color -->
                                        <div class="rounded-circle border border-primary d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; background-color: #f0f0f0; color: #007bff; font-size: 15px; font-weight: bold;">
                                            {{ strtoupper(substr($post->user->image, 0, 2)) }}
                                        </div>
                                    @endif
                                    <div class="ml-2">
                                        <h6 class="fw-bold mb-0">{{ $post->user->name }}</h6>
                                        <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                                    </div>

                                        <!-- Post Status Edit (Visible only for the post owner) -->
                                        @if(Auth::check() && Auth::user()->id == $post->resourceSpace->user_id)
                                            <div class="d-flex align-items-center">
                                                <!-- Status Edit Trigger -->
                                                <div class="dropdown">
                                                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle"
                                                            type="button"
                                                            id="postStatusDropdown{{ $post->id }}"
                                                            data-bs-toggle="dropdown"
                                                            aria-expanded="false" style="margin-left: 88px;">
                                                        {{ ucfirst($post->status) }}
                                                    </button>
                                                    <form class="dropdown-menu p-3 dropdown-menu-end"
                                                          style="min-width: 250px;"
                                                          aria-labelledby="postStatusDropdown{{ $post->id }}"
                                                          action="{{ route('normal-user.resource-space-post.update', $post->id) }}"
                                                          method="POST">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="mb-3">
                                                            <label for="status{{ $post->id }}" class="form-label">Pin Your Post</label>
                                                            <select id="status{{ $post->id }}"
                                                                    name="status"
                                                                    class="form-select @error('status') is-invalid @enderror"
                                                                    required>
                                                                <option value="1" {{ old('status', $post->status) == '1' ? 'selected' : '' }}>Pin</option>
                                                                <option value="0" {{ old('status', $post->status) == '0' ? 'selected' : '' }}>Unpin</option>
                                                            </select>
                                                            @error('status')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>

                                                        <input type="hidden" name="resource_space_id" value="{{ $post->resourceSpace->id }}">
                                                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                                                        <div class="mb-3">
                                                            <label for="title" class="form-label">Title</label>
                                                            <input type="text" id="title" name="title" class="form-control" placeholder="Enter Title" value="{{ old('title', $post->title) }}" readonly>
                                                            @error('title')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="description" class="form-label">Description</label>
                                                            <textarea id="description" name="description" class="form-control" rows="4" placeholder="Enter Description" readonly>{{ old('description', $post->description) }}</textarea>
                                                            @error('description')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="image" class="form-label">Image (Optional)</label>
                                                            <input type="file" id="image" name="image" class="form-control" accept="image/*" disabled>
                                                            @error('image')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="d-grid">
                                                            <button type="submit" class="btn btn-primary">Update Status</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        @endif
                                </div>

                                <!-- Post Image -->
                                @if($post->image)
                                    <div class="mb-3">
                                        <img src="{{ asset($post->image) }}" alt="Post Image" class="img-fluid" style="border-radius: 10px;">
                                    </div>
                                @endif

                                <!-- Post Content -->
                                {!! \Illuminate\Support\Str::limit($post->description, 100, $end='...') !!}

                                <!-- Post Actions -->
                                <div class="d-flex justify-content-between align-items-center mt-4">

                                    <div>
                                        <!-- Displaying the number of upvotes and downvotes -->
                                        <div>
                                            <form action="{{ route('normal-user.resource-space-post.upvote', $post->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-light btn-sm text-success me-2">
                                                    <i class="bi bi-hand-thumbs-up-fill"></i> Upvote
                                                </button>
                                            </form>
                                            <span class="vote-count">{{ $post->upvotes }}</span>

                                            <form action="{{ route('normal-user.resource-space-post.downvote', $post->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-light btn-sm text-danger">
                                                    <i class="bi bi-hand-thumbs-down-fill"></i> Downvote
                                                </button>
                                            </form>
                                            <span class="vote-count">{{ $post->downvotes }}</span>
                                        </div>

                                        <!-- Optionally add some custom CSS for spacing -->
                                        <style>
                                            .vote-count {
                                                margin-left: 5px;
                                                font-weight: bold;
                                                font-size: 1.2em;
                                            }
                                        </style>

                                    </div>

                                </div>
                            </div>

                        </div>
                    @endforeach

                @else
                    <p class="text-sm text-gray-500 mt-1">There are no posts available at the moment. Please check back later.</p>
                @endif

            </div>
        </div>
    </aside>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        .fix-right-sidebar {
            max-height: 620px;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #dce2e8 #f0f0f0;
        }

    </style>

    <!-- Optional: Add some custom CSS to improve the look -->
    <style>
        /* Ensure dropdown form looks clean and interactive */
        .dropdown-menu.show {
            display: block;
            opacity: 1;
            visibility: visible;
        }
        .dropdown-menu form {
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border: 1px solid #e0e0e0;
        }
    </style>
@endsection
