@extends('normal-user.master')

@section('right-sidebar')
    <!-- sidebar is not available -->
@endsection

@section('title','Job Circular List')

@section('body')

    <!-- Main Content -->
    <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
        <!-- timeline -->
        <div class="timeline-container lg:flex 2xl:gap-16 gap-12 mx-auto" id="js-oversized">

            <!-- Main Content Section -->
            <div class="timeline-main w-2/3">

                <div class="timeline-header flex justify-between items-center mb-6">
                    <h5 class="text-lg md:text-xl font-semibold text-black text-center py-2 mt-4" style="margin-left: -70px;">
                        {{ Auth::user()->name }}, ready to explore exciting new job opportunities?
                    </h5>
                    <p style="margin-bottom: 30px;">
                        Based on your profile and search history
                    </p>

                </div>


                <!-- Job Feed -->

                @foreach($jobs as $job)
                    <a href="{{ route('normal-user.job.detail', $job->id) }}" class="text-decoration-none text-black">
                        <div class="card border-0 shadow-lg mb-4" style="border-radius: 16px;">
                            <div class="row g-0">
                                <!-- Blog Thumbnail -->
                                <div class="col-md-4">
                                    <img src="{{ asset($job->image) }}" alt="Blog Thumbnail" class="img-fluid rounded-start" style="height: 100%; object-fit: cover;">
                                </div>
                                <!-- Blog Content -->
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="fw-bold mb-2 text-dark">{{ $job->title }}</h5>
                                        <p class="text-muted small mb-3">{{ $job->company->name }}, {{ $job->created_at->diffForHumans() }}</p>
                                        <p class="text-truncate mb-3 text-black" style="max-height: 60px; overflow: hidden;">{!! \Illuminate\Support\Str::limit($job->description, 180, '...') !!}</p>

                                        <!-- Blog Meta -->
                                        <div class="d-flex justify-content-between align-items-center text-dark">
                                            <div class="text-muted small">
                                                <i class="bi bi-eye me-1"></i><strong>{{ $job->hit_count }}</strong> Views
                                            </div>
                                            <span class="btn btn-primary btn-sm">Read More</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
                <style>
                    .card:hover {
                        transform: scale(1.02);
                        transition: transform 0.2s;
                    }
                    .text-black {
                        color: black;
                    }

                </style>




            </div>
        </div>




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
                        <form action="{{ route('normal-user.job.search') }}" method="GET" class="w-full d-flex align-items-center">
                            <span class="input-group-text material-icons border-0 bg-white text-primary">search</span>
                            <input type="text" name="query" class="form-control border-0 fw-light ps-1 w-full py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Search Job Circulars" value="{{ request('query') }}">
                        </form>
                    </div>



                </div>
            </div>
        </div>
    </aside>


    <style>
        /* Styling for the image (making it rectangular with rounded corners) */
        .question-avatar {
            width: 120px; /* Fixed width for the rectangle */
            height: 80px; /* Fixed height for the rectangle */
            border-radius: 10px; /* Rounded corners for the rectangle */
            object-fit: cover; /* Ensures the image doesn't stretch and maintains aspect ratio */
        }

        /* Adjusting the layout: image to the right side and text to the left */
        .question-item {
            background-color: white;
            border-radius: 1rem;
            padding: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between; /* Positions the content (text and image) */
            align-items: center; /* Vertically aligns content */
        }

        /* Adjust the text styling */
        .question-item .question-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1f2937;
        }

        .question-item .question-meta,
        .question-item .question-body,
        .question-item .question-stats span {
            color: #4b5563;
            font-size: 0.875rem;
        }

        .question-item .question-body {
            margin-top: 0.5rem;
        }

    </style>

@endsection
