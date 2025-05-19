@extends('normal-user.master')
@extends('normal-user.message')

@section('right-sidebar')
    <!-- sidebar is not available -->
@endsection

@section('title','Question List')

@section('body')


    <!-- Main Content -->
    <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
        <!-- timeline -->
        <div class="timeline-container lg:flex 2xl:gap-16 gap-12 mx-auto" id="js-oversized">

            <!-- Main Content Section -->
            <div class="timeline-main w-2/3">

                <div class="timeline-header flex justify-between items-center mb-6">
                    <h2 class="timeline-title">Top Questions</h2>
{{--                    <div class="flex justify-start">--}}
{{--                        <button class="timeline-btn" type="button" data-bs-toggle="modal" data-bs-target="#askQuestionModal">--}}
{{--                            Ask Your Question--}}
{{--                        </button>--}}
{{--                    </div>--}}
                    <div class="flex justify-start">
                        <button class="ask-question-btn" type="button" data-bs-toggle="modal" data-bs-target="#askQuestionModal" style="margin-left: 450px;">
                            Ask Your Question
                        </button>
                    </div>
                    <style>
                        .ask-question-btn {
                            background: #2463EB; /* Gradient colors */
                            color: white;
                            font-weight: bold;
                            padding: 10px 20px;
                            font-size: 16px;
                            border: none;
                            border-radius: 8px;
                            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
                            cursor: pointer;
                            transition: all 0.3s ease;
                        }

                        .ask-question-btn:hover {
                            background: #093ba4; /* Reverse gradient on hover */
                            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15); /* Slightly larger shadow */
                            transform: scale(1.05); /* Slight zoom effect */
                        }

                        .ask-question-btn:active {
                            transform: scale(0.98); /* Button press effect */
                            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                        }

                    </style>
                </div>

                <!-- Ask Your Question Modal -->
                <div class="modal fade" id="askQuestionModal" tabindex="-1" aria-labelledby="askQuestionModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="askQuestionModalLabel">Ask Your Question</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                @if(Auth::check())
                                <form id="questionForm" action="{{route('normal-user.question.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <!-- Title Input -->
                                    <div class="mb-3">
                                        <label for="questionTitle" class="form-label">Title</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="questionTitle" name="title" placeholder="Enter your question title" required>
                                        @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Description Input -->
                                    <div class="mb-3">
                                        <label for="questionDescription" class="form-label">Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="questionDescription" name="description" rows="4" placeholder="Provide details about your question" required></textarea>
                                        @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Tags Input -->
                                    <div class="mb-3">
                                        <label for="tags" class="form-label">Tags</label>
                                        <div id="tags-container" class="tags-container">
                                            <input type="text" id="tag-input" placeholder="Enter tags and press Enter" class="form-control">
                                        </div>
                                        <input type="hidden" name="tags" id="hidden-tags-input">
                                        @error('tags')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Image Upload -->
                                    <div class="mb-3">
                                        <label for="questionImage" class="form-label">Upload Image (Optional)</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="questionImage" name="image">
                                        @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary w-100">Submit Question</button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>





                <nav class="filter-navigation">
                    <ul class="filter-list">
                        <li class="filter-item">
                            <a href="{{ route('normal-user.question.filter', ['type' => 'trending']) }}"
                               class="filter-link {{ request('type') === 'trending' ? 'active' : '' }}">
                                Trending
                            </a>
                        </li>
                        <li class="filter-item">
                            <a href="{{ route('normal-user.question.filter', ['type' => 'monthly']) }}"
                               class="filter-link {{ request('type') === 'monthly' ? 'active' : '' }}">
                                Monthly
                            </a>
                        </li>
{{--                        <li class="filter-item">--}}
{{--                            <a href="{{ route('normal-user.question.filter', ['type' => 'my_interests']) }}"--}}
{{--                               class="filter-link {{ request('type') === 'my_interests' ? 'active' : '' }}">--}}
{{--                                My Interests--}}
{{--                            </a>--}}
{{--                        </li>--}}
                    </ul>
                </nav>
                <style>
                    .filter-navigation {
                        background-color: #ffffff;
                        border-radius: 12px;
                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                        padding: 8px;
                        margin: 20px 0;
                        width: 400px;
                    }

                    .filter-list {
                        list-style-type: none;
                        padding: 0;
                        margin: 0;
                        display: flex;
                        justify-content: center;
                        gap: 8px;
                    }

                    .filter-item {
                        flex: 1;
                        max-width: 150px;
                    }

                    .filter-link {
                        display: block;
                        text-align: center;
                        padding: 12px 20px;
                        text-decoration: none;
                        color: #4a5568;
                        font-weight: 500;
                        font-size: 14px;
                        border-radius: 8px;
                        transition: all 0.3s ease;
                        background-color: #f7fafc;
                        border: 2px solid transparent;
                    }

                    .filter-link:hover {
                        background-color: #edf2f7;
                        color: #2d3748;
                    }

                    .filter-link.active {
                        background-color: #ffffff;
                        color: #ffffff;
                        border-color: #2463EB;
                    }

                    @media (max-width: 640px) {
                        .filter-list {
                            flex-direction: column;
                            align-items: stretch;
                        }

                        .filter-item {
                            max-width: none;
                        }
                    }
                </style>


                <!-- Question Feed -->
                <div class="timeline-feed mt-6 space-y-4">
                    @foreach($questions as $question)
                        <div class="question-item">
                        <div class="flex dis-flex items-center gap-4">
                            @if($question->user->image)
                                <!-- Display user image -->
                                <img src="{{ asset($question->user->image) }}" class="img-fluid rounded-circle border border-primary" alt="profile-img" style="width: 35px; height: 35px; object-fit: cover;">
                            @else
                                <!-- Fallback to initials with a customizable background color -->
                                <div class="rounded-circle border border-primary d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; background-color: #f0f0f0; color: #007bff; font-size: 15px; font-weight: bold;">
                                    {{ strtoupper(substr($question->user->image, 0, 2)) }}
                                </div>
                            @endif                            <div class="flex flex-col items-start">
                                <a href="{{ route('normal-user.question.detail', ['id' => $question->id]) }}" class="question-title">{{ $question->title }}</a>
                                <p class="question-meta">{{ $question->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                            <a href="{{ route('normal-user.question.detail', ['id' => $question->id]) }}" class="question-link">
                            <p class="question-body">{!! \Illuminate\Support\Str::limit($question->description, 180, $end='...') !!}</p>
                            </a>
                            <div class="question-stats flex items-center gap-6">
                                <!-- Displaying Vote count -->
                                <span class="stat-item votes"><i class='bx bx-upvote'></i>{{ $question->upvotes()->count() }} Votes</span>
                                <!-- Displaying Comment count -->
                                <span class="stat-item comments text-sm text-green-600 font-semibold px-4 py-2 rounded-lg bg-gray-100 hover:bg-green-100"><i class='bx bx-comment'></i>{{ $question->questionComments()->count() }} Comments</span>
                                <!-- Displaying Hit count as Views -->
                                <span class="stat-item views text-sm text-gray-600 font-semibold px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200"><i class='bx bx-show'></i>{{ $question->hit_count }} Views</span>
                            </div>

                        </div>
                    @endforeach
                </div>


            </div>
        </div>

        <!-- Scoped CSS -->


        <!-- timeline -->



        <div class="text-center mt-4">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mb-0 mt-2">Loading</p>
        </div>
    </main>
    <!-- Main Content -->

    <aside class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-6 col-12">
        <div class="fix-sidebar">
            <div class="side-trend lg-none">
                <!-- Search Tab -->
                <div class="sticky-sidebar2 mb-3">

                    <div class="input-group mb-4 shadow-sm rounded-4 overflow-hidden py-2 bg-white">
                        <span class="input-group-text material-icons border-0 bg-white text-primary">search</span>
                        <form action="{{ route('normal-user.question.search') }}" method="GET" class="w-full">
                            <input type="text" name="query" class="form-control border-0 fw-light ps-1 w-full py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Search Questions" value="{{ request('query') }}">
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </aside>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tagInput = document.getElementById('tag-input');
            const tagsContainer = document.getElementById('tags-container');
            const hiddenTagsInput = document.getElementById('hidden-tags-input');
            let tags = [];

            tagInput.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' && tagInput.value.trim() !== '') {
                    e.preventDefault();
                    addTag(tagInput.value.trim());
                    tagInput.value = '';
                }
            });

            function addTag(tag) {
                if (!tags.includes(tag)) {
                    tags.push(tag);
                    renderTags();
                    updateHiddenInput();
                }
            }

            function renderTags() {
                tagsContainer.innerHTML = '';
                tags.forEach(tag => {
                    const tagElement = document.createElement('span');
                    tagElement.classList.add('tag');
                    tagElement.textContent = tag;

                    const closeElement = document.createElement('span');
                    closeElement.classList.add('tag-close');
                    closeElement.textContent = '×';
                    closeElement.addEventListener('click', () => removeTag(tag));

                    tagElement.appendChild(closeElement);
                    tagsContainer.appendChild(tagElement);
                });

                tagsContainer.appendChild(tagInput); // Re-append the input element
            }

            function removeTag(tag) {
                tags = tags.filter(t => t !== tag);
                renderTags();
                updateHiddenInput();
            }

            function updateHiddenInput() {
                hiddenTagsInput.value = tags.join(',');
            }
        });
    </script>
    <style>
        .tags-container {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            border: 1px solid #ced4da;
            padding: 10px;
            border-radius: 8px;
            background-color: #fff;
        }

        #tag-input {
            border: none;
            outline: none;
            flex-grow: 1;
            padding: 5px;
        }

        .tag {
            display: inline-flex;
            align-items: center;
            background-color: #e3f2fd;
            padding: 5px 10px;
            border-radius: 16px;
            font-size: 14px;
            color: #0d6efd;
            font-weight: 500;
        }

        .tag-close {
            margin-left: 8px;
            cursor: pointer;
            font-weight: bold;
            color: #d32f2f;
        }
    </style>
    <style>
        /* Active Filter Button */
        .active-filter {
            background-color: #1d4ed8; /* Blue */
            color: #ffffff; /* White font for active */
            font-weight: bold;
            border: 1px solid #1d4ed8;
            transition: all 0.3s ease;
        }

        /* Inactive Filter Button */
        .inactive-filter {
            background-color: #f3f4f6; /* Light Gray */
            color: #1f2937; /* Dark Gray font for inactive */
            border: 1px solid #d1d5db; /* Border Gray */
            transition: all 0.3s ease;
        }

        .inactive-filter:hover {
            background-color: #e5e7eb; /* Slightly darker gray */
            color: #111827; /* Darker gray on hover */
        }

        /* Add spacing between filter buttons */
        .filter-buttons a {
            margin-right: 0.5rem; /* Add space between components */
        }

        /* Remove extra margin for the last button */
        .filter-buttons a:last-child {
            margin-right: 0;
        }
    </style>

    <style>
        .question-link {
            text-decoration: none;
        }

        /* Ensure the filter section aligns correctly */
        .timeline-filters {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }



        /* Styling for filter buttons */
        .filter-link {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            color: #1f2937;
            font-weight: 500;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .filter-link.active {
            color: #2463eb;
            font-weight: 600;
        }
    </style>

    <style>
        .dis-flex{
            display: flex;
        }
        .question-title{
            text-decoration: none; /* Remove underline */
        }

        /* Custom Container */
        .timeline-container {
            max-width: 1065px;
        }

        /* Header */
        .timeline-header .timeline-title {
            font-size: 1.875rem;
            font-weight: 600;
            color: #1f2937;
        }


        /* Filter Buttons */
        .timeline-filters .filter-buttons {
            background-color: #f3f4f6;
            padding: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .timeline-filters .filter-link {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            color: #1f2937;
            font-weight: 500;
            transition: background 0.3s;
        }

        .timeline-filters .filter-link:hover {
            background-color: #2463eb;
            color: white;
        }

        /* Question Feed */
        .question-item{
            margin-top: 20px;
        }
        .timeline-feed .question-item {
            background-color: white;
            border-radius: 1rem;
            padding: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .timeline-feed .question-avatar {
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
        }

        .timeline-feed .question-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1f2937;
        }

        .timeline-feed .question-meta,
        .timeline-feed .question-body,
        .timeline-feed .question-stats span {
            color: #4b5563;
            font-size: 0.875rem;
        }
    </style>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

@endsection
