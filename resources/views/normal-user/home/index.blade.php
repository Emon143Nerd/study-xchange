@extends('normal-user.master')

@section('right-sidebar')
    <!-- sidebar is not available -->
@endsection

@section('title','Feed')

@section('body')

    <!-- Main Content -->
    <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
        <div class="main-content">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
            <style>
                @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

                body {
                    font-family: 'Poppins', sans-serif;
                    background-color: #ffffff;
                    color: #333;
                    margin: 0;
                    padding: 20px;
                }

                .slider-container {
                    width: 100%;
                    overflow-x: auto;
                    padding: 20px 0;
                }

                .slider-wrapper {
                    display: flex;
                    gap: 20px;
                    padding-bottom: 20px;
                    scroll-snap-type: x mandatory;
                }

                .slider-item {
                    flex: 0 0 auto;
                    width: 280px;
                    scroll-snap-align: start;
                    background: #f8f9fa;
                    border-radius: 12px;
                    padding: 20px;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                    transition: transform 0.3s ease, box-shadow 0.3s ease;
                }

                .slider-item:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
                }

                .stat-number {
                    font-size: 2.5rem;
                    font-weight: 700;
                    color: #4F46E5;
                    margin-bottom: 10px;
                }

                .feature-icon {
                    font-size: 2rem;
                    color: #4F46E5;
                    margin-bottom: 15px;
                }

                h3 {
                    font-size: 1.2rem;
                    margin-bottom: 10px;
                    color: #333;
                }

                p {
                    font-size: 0.9rem;
                    color: #666;
                }

                .slider-container::-webkit-scrollbar {
                    height: 8px;
                }

                .slider-container::-webkit-scrollbar-thumb {
                    background-color: #4F46E5;
                    border-radius: 4px;
                }

                .slider-container::-webkit-scrollbar-track {
                    background-color: #f1f1f1;
                }

                .scroll-indicator {
                    text-align: center;
                    margin-top: 10px;
                    color: #666;
                    font-size: 0.9rem;
                }

                @media (max-width: 768px) {
                    .slider-item {
                        width: 220px;
                    }
                }
            </style>

            <div class="slider-container">
                <div class="slider-wrapper">

                    <!-- Features -->
                    <div class="slider-item">
                        <i class="fas fa-question-circle feature-icon"></i>
                        <h3>Ask Questions</h3>
                        <p>Get answers from experts and peers in your field</p>
                    </div>
                    <div class="slider-item">
                        <i class="fas fa-users feature-icon"></i>
                        <h3>Resource Spaces</h3>
                        <p>Join collaborative learning communities</p>
                    </div>
                    <div class="slider-item">
                        <i class="fas fa-briefcase feature-icon"></i>
                        <h3>Job Portal</h3>
                        <p>Find internships and job opportunities</p>
                    </div>
                    <div class="slider-item">
                        <i class="fas fa-graduation-cap feature-icon"></i>
                        <h3>Admissions</h3>
                        <p>Track and apply for university admissions</p>
                    </div>
                    <!-- Stats -->
                    <div class="stat-box">
                        <i class="fas fa-users stat-icon"></i>
                        <div class="stat-number">{{ $userCount }}</div>
                        <div class="stat-label" style="color: black; font-size: 14px;">Active Students</div>
                    </div>

                    <div class="stat-box">
                        <i class="fas fa-question-circle stat-icon"></i>
                        <div class="stat-number">{{ $questionCount }}</div>
                        <div class="stat-label" style="color: black; font-size: 14px;">Questions Answered</div>
                    </div>

                    <div class="stat-box">
                        <i class="fas fa-book-open stat-icon"></i>
                        <div class="stat-number">{{ $resourceSpaceCount }}</div>
                        <div class="stat-label" style="color: black; font-size: 14px;">Resource Spaces</div>
                    </div>

                    <div class="stat-box">
                        <i class="fas fa-briefcase stat-icon"></i>
                        <div class="stat-number">{{ $jobCircularCount }}</div>
                        <div class="stat-label" style="color: black; font-size: 14px;">Job Opportunities</div>
                    </div><style>
                        .stats-container {
                            display: flex;
                            flex-wrap: wrap;
                            justify-content: center;
                            gap: 20px;
                            padding: 20px;
                            background-color: #f8f9fa;
                        }

                        .stat-box {
                            flex: 1;
                            min-width: 200px;
                            padding: 20px;
                            text-align: center;
                            background: white;
                            border-radius: 10px;
                            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                            transition: all 0.3s ease;
                        }

                        .stat-box:hover {
                            transform: translateY(-5px);
                            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
                        }

                        .stat-icon {
                            font-size: 2.5em;
                            color: #4361ee;
                            margin-bottom: 15px;
                        }

                        .stat-number {
                            font-size: 1.8em;
                            font-weight: bold;
                            color: #2b2d42;
                            margin: 10px 0;
                        }

                        .stat-label {
                            color: black;
                            font-size: 1.1em;
                        }
                    </style>


                </div>
            </div>


            <script>
                const slider = document.querySelector('.slider-container');
                let isDown = false;
                let startX;
                let scrollLeft;

                slider.addEventListener('mousedown', (e) => {
                    isDown = true;
                    slider.classList.add('active');
                    startX = e.pageX - slider.offsetLeft;
                    scrollLeft = slider.scrollLeft;
                });

                slider.addEventListener('mouseleave', () => {
                    isDown = false;
                    slider.classList.remove('active');
                });

                slider.addEventListener('mouseup', () => {
                    isDown = false;
                    slider.classList.remove('active');
                });

                slider.addEventListener('mousemove', (e) => {
                    if (!isDown) return;
                    e.preventDefault();
                    const x = e.pageX - slider.offsetLeft;
                    const walk = (x - startX) * 2;
                    slider.scrollLeft = scrollLeft - walk;
                });
            </script>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-feed" role="tabpanel" aria-labelledby="pills-feed-tab">
                    <!-- Post Tab -->

                    <!-- Follow People -->
                    <div>
                        <!-- Slider Accounts -->

                        <!-- Feeds -->
                        <div class="pt-4 feeds">
                            <!-- Feed Item -->
                            <style>
                                /* Question Item Styles */
                                .question-item {
                                    background: #fff;
                                    border-radius: 8px;
                                    padding: 20px;
                                    margin-bottom: 20px;
                                    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
                                }

                                .dis-flex {
                                    display: flex;
                                }

                                .question-avatar {
                                    width: 48px;
                                    height: 48px;
                                    border-radius: 50%;
                                    object-fit: cover;
                                }

                                .question-title {
                                    color: #2d3748;
                                    font-weight: 600;
                                    font-size: 1.1rem;
                                    text-decoration: none;
                                    margin-bottom: 4px;
                                }

                                .question-meta {
                                    color: #718096;
                                    font-size: 0.875rem;
                                }

                                .question-body {
                                    color: #4a5568;
                                    margin: 12px 0;
                                    line-height: 1.6;
                                }

                                .question-stats {
                                    display: flex;
                                    align-items: center;
                                    gap: 16px;
                                    margin-top: 12px;
                                }

                                .stat-item {
                                    display: flex;
                                    align-items: center;
                                    gap: 4px;
                                }

                                .stat-item i {
                                    font-size: 1.2rem;
                                }

                                /* Resource Space Styles */
                                .group-item {
                                    transition: transform 0.2s;
                                }

                                .group-item:hover {
                                    transform: translateY(-2px);
                                }

                                .group-img {
                                    width: 60px;
                                    height: 60px;
                                    object-fit: cover;
                                }

                                /* Card hover effect */
                                .card:hover {
                                    transform: scale(1.02);
                                    transition: transform 0.2s;
                                }

                                .text-black {
                                    color: black;
                                }

                                /* Admission Circular Styles */
                                .admission-card {
                                    background: #fff;
                                    border-radius: 12px;
                                    transition: all 0.3s ease;
                                    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
                                    margin-bottom: 20px;
                                }

                                .admission-card:hover {
                                    transform: translateY(-2px);
                                    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                                }

                                .admission-card .content-wrapper {
                                    display: flex;
                                    align-items: flex-start;
                                    justify-content: space-between;
                                    padding: 20px;
                                }

                                .admission-card .text-content {
                                    flex: 1;
                                    padding-right: 20px;
                                }

                                .admission-card .image-content {
                                    flex-shrink: 0;
                                }

                                .admission-card .university-name {
                                    color: #6c757d;
                                    font-size: 0.9rem;
                                    margin-bottom: 8px;
                                }

                                .admission-card .title {
                                    font-size: 1.1rem;
                                    font-weight: 600;
                                    color: #2d3748;
                                    margin-bottom: 10px;
                                }

                                .admission-card .description {
                                    color: #4a5568;
                                    margin-bottom: 15px;
                                }

                                .admission-card .meta-content {
                                    display: flex;
                                    justify-content: space-between;
                                    align-items: center;
                                }

                                .admission-card .date {
                                    color: #3490dc;
                                    font-weight: 500;
                                }
                            </style>

                            @foreach($shuffledItems as $item)
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            @switch($item->type)
                                                @case('admission')
                                                    <div class="admission-card">
                                                        <div class="content-wrapper">
                                                            <div class="text-content">
                                                                <div class="university-name">
                                                                    {{ $item->university_name }}
                                                                </div>
                                                                <h3 class="title">{{ $item->title }}</h3>
                                                                <div class="description">
                                                                    {!! \Illuminate\Support\Str::limit(ucfirst(strtolower($item->description)), 200, '...') !!}
                                                                </div>
                                                                <div class="meta-content">
                                                                    <div class="date">
                                                                        {{ \Carbon\Carbon::parse($item->start_date)->format('d F Y') }}
                                                                    </div>
                                                                    <form action="{{ route('university.compare.add') }}" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="university_id" value="{{ $item->university_id }}">
                                                                        <input type="hidden" name="admission_circular_id" value="{{ $item->id }}">
                                                                        <button type="submit" class="btn btn-outline-primary btn-sm">Add to Compare</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <div class="image-content">
                                                                <img src="{{ asset($item->image) }}" width="80" height="80" class="img-fluid rounded-4" alt="university-img">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @break

                                                @case('job')
                                                    <div class="job-card mb-4">
                                                        <a href="{{ route('normal-user.job.detail', $item->id) }}" class="text-decoration-none text-black">
                                                            <div class="card border-0 shadow-lg" style="border-radius: 16px;">
                                                                <div class="row g-0">
                                                                    <div class="col-md-4">
                                                                        <img src="{{ asset($item->image) }}" alt="Blog Thumbnail" class="img-fluid rounded-start" style="height: 100%; object-fit: cover;">
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <div class="card-body">
                                                                            <h5 class="fw-bold mb-2 text-dark">{{ $item->title }}</h5>
                                                                            <p class="text-muted small mb-3">{{ $item->company->name }}, {{ $item->created_at->diffForHumans() }}</p>
                                                                            <p class="text-truncate mb-3 text-black" style="max-height: 60px; overflow: hidden;">{!! \Illuminate\Support\Str::limit($item->description, 180, '...') !!}</p>
                                                                            <div class="d-flex justify-content-between align-items-center text-dark">
                                                                                <div class="text-muted small">
                                                                                    <i class="bi bi-eye me-1"></i><strong>{{ $item->hit_count }}</strong> Views
                                                                                </div>
                                                                                <span class="btn btn-primary btn-sm">Read More</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    @break

                                                @case('question')
                                                    <div class="question-item bg-white shadow-sm">
                                                        <div class="d-flex align-items-center gap-3 mb-3">
                                                            @if($item->user->image)
                                                                <!-- Display user image -->
                                                                <img src="{{ asset($item->user->image) }}" class="img-fluid rounded-circle border border-primary" alt="profile-img" style="width: 35px; height: 35px; object-fit: cover;">
                                                            @else
                                                                <!-- Fallback to initials with a customizable background color -->
                                                                <div class="rounded-circle border border-primary d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; background-color: #f0f0f0; color: #007bff; font-size: 15px; font-weight: bold;">
                                                                    {{ strtoupper(substr($item->user->image, 0, 2)) }}
                                                                </div>
                                                            @endif                                                            <div>
                                                                <a href="{{ route('normal-user.question.detail', ['id' => $item->id]) }}" class="question-title d-block mb-1">{{ $item->title }}</a>
                                                                <p class="question-meta mb-0">{{ $item->created_at->diffForHumans() }}</p>
                                                            </div>
                                                        </div>
                                                        <a href="{{ route('normal-user.question.detail', ['id' => $item->id]) }}" class="question-link text-decoration-none">
                                                            <p class="question-body">{!! \Illuminate\Support\Str::limit($item->description, 180, $end='...') !!}</p>
                                                        </a>
                                                        <div class="question-stats">
                                                            <div class="stat-item">
                                                                <i class='bx bx-upvote'></i>
                                                                <span>{{ $item->upvotes()->count() }} Votes</span>
                                                            </div>
                                                            <div class="stat-item">
                                                                <i class='bx bx-comment'></i>
                                                                <span class="text-green-600">{{ $item->questionComments()->count() }} Comments</span>
                                                            </div>
                                                            <div class="stat-item">
                                                                <i class='bx bx-show'></i>
                                                                <span>{{ $item->hit_count }} Views</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @break

                                                @case('resource_space')
                                                    <div class="group-item bg-white p-3 rounded-4 mb-3 shadow-sm">
                                                        <div class="d-flex align-items-center">
                                                            <img src="{{ asset($item->image) }}" class="group-img rounded-circle me-3" alt="group-icon">
                                                            <div class="flex-grow-1">
                                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                                    <a href="{{ route('normal-user.resource-space.detail', $item->id) }}" class="text-decoration-none">
                                                                        <h6 class="fw-bold mb-0 text-body">{{ $item->name }}</h6>
                                                                    </a>
                                                                </div>
                                                                <a href="{{ route('normal-user.resource-space.detail', $item->id) }}" class="text-decoration-none">
                                                                    <p class="text-muted small mb-2">
                                                                        {{ $item->description ?? 'No description available for this group.' }}
                                                                    </p>
                                                                </a>
                                                                <div class="d-flex align-items-center">
                                                                    <p class="text-muted small mb-0 me-3">
                                                                        <span class="material-icons md-18 me-1">post_add</span>
                                                                        <strong>{{ $item->postCount }}</strong> Posts
                                                                    </p>
                                                                    <p class="text-muted small mb-0">
                                                                        <span class="material-icons md-18 me-1">groups</span>
                                                                        <strong>{{ $item->memberCount }}</strong> Members
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @break
                                            @endswitch
                                        </div>
                                    </div>
                                </div>
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
                </div>

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




                    <style>
                        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

                        :root {
                            --primary-color: #4A90E2;
                            --secondary-color: #34495E;
                            --accent-color: #E74C3C;
                            --text-color: #2C3E50;
                            --bg-color: #F8FAFC;
                            --card-bg: #FFFFFF;
                        }

                        * {
                            margin: 0;
                            padding: 0;
                            box-sizing: border-box;
                        }

                        body {
                            font-family: 'Inter', sans-serif;
                            background-color: var(--bg-color);
                            color: var(--text-color);
                            line-height: 1.6;
                        }

                        .scrollable-container {
                            width: 330px;
                            height: 90vh;
                            overflow-y: auto;
                            padding: 10px;
                            background: var(--bg-color);
                            border-radius: 20px;
                            box-shadow: 0 0 20px rgba(0,0,0,0.1);
                        }

                        .profile-card {
                            background: var(--card-bg);
                            border-radius: 20px;
                            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
                            overflow: hidden;
                            transition: transform 0.3s ease;
                        }

                        .profile-card:hover {
                            transform: translateY(-5px);
                        }

                        .profile-header {
                            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
                            padding: 1.5rem;
                            text-align: center;
                            position: relative;
                        }

                        .profile-avatar {
                            width: 100px;
                            height: 100px;
                            border-radius: 50%;
                            border: 4px solid var(--card-bg);
                            margin-bottom: 0.8rem;
                            transition: transform 0.3s ease;
                        }

                        .profile-avatar:hover {
                            transform: scale(1.05);
                        }

                        .profile-name {
                            color: white;
                            font-size: 1.3rem;
                            font-weight: 600;
                            margin-bottom: 0.4rem;
                        }

                        .profile-tagline {
                            color: rgba(255,255,255,0.8);
                            font-size: 0.8rem;
                        }

                        .profile-stats {
                            display: flex;
                            justify-content: space-around;
                            padding: 0.8rem;
                            background: rgba(255,255,255,0.1);
                            backdrop-filter: blur(10px);
                            margin-top: 0.8rem;
                        }

                        .stat {
                            text-align: center;
                        }

                        .stat-value {
                            color: white;
                            font-size: 1rem;
                            font-weight: 600;
                        }

                        .stat-label {
                            color: rgba(255,255,255,0.8);
                            font-size: 0.7rem;
                        }

                        .profile-body {
                            padding: 1.5rem;
                        }

                        .profile-section {
                            margin-bottom: 1.2rem;
                        }

                        .section-title {
                            font-size: 0.9rem;
                            font-weight: 600;
                            color: var(--secondary-color);
                            margin-bottom: 0.4rem;
                            display: flex;
                            align-items: center;
                        }

                        .section-title i {
                            margin-right: 0.4rem;
                            color: var(--primary-color);
                        }

                        .skill-tags {
                            display: flex;
                            flex-wrap: wrap;
                            gap: 0.4rem;
                        }

                        .skill-tag {
                            background: var(--primary-color);
                            color: white;
                            padding: 0.2rem 0.6rem;
                            border-radius: 20px;
                            font-size: 0.7rem;
                            transition: transform 0.2s ease;
                        }

                        .skill-tag:hover {
                            transform: scale(1.05);
                        }

                        .achievement-list {
                            list-style-type: none;
                        }

                        .achievement-item {
                            display: flex;
                            align-items: center;
                            margin-bottom: 0.4rem;
                            font-size: 0.8rem;
                        }

                        .achievement-icon {
                            color: var(--accent-color);
                            margin-right: 0.4rem;
                        }

                        .profile-footer {
                            background: var(--bg-color);
                            padding: 0.8rem 1.5rem;
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                        }

                        .connect-btn {
                            background: var(--primary-color);
                            color: white;
                            border: none;
                            padding: 0.4rem 0.8rem;
                            border-radius: 20px;
                            cursor: pointer;
                            transition: background 0.3s ease;
                            font-size: 0.8rem;
                        }

                        .connect-btn:hover {
                            background: var(--secondary-color);
                        }

                        .social-links a {
                            color: var(--secondary-color);
                            margin-left: 0.8rem;
                            transition: color 0.3s ease;
                            font-size: 0.9rem;
                        }

                        .social-links a:hover {
                            color: var(--primary-color);
                        }

                        @keyframes pulse {
                            0% { transform: scale(1); }
                            50% { transform: scale(1.05); }
                            100% { transform: scale(1); }
                        }

                        .pulse {
                            animation: pulse 2s infinite;
                        }
                    </style>

                <div class="scrollable-container">
                    <div class="profile-card">
                        <div class="profile-header">
{{--                            <img src="{{ $user->image ? asset($user->image) : 'https://i.pravatar.cc/301' }}" alt="{{ $user->name }}" class="profile-avatar">--}}
                            @if($user->image)
                                <!-- Display user image -->
                                <img src="{{ asset($user->image) }}" class="profile-avatar img-fluid rounded-circle border border-primary" alt="{{ $user->name }}" style="width: 65px; height: 65px; object-fit: cover;">
                            @else
                                <!-- Fallback to initials with a customizable background color -->
                                <div class="rounded-circle border border-primary d-flex align-items-center justify-content-center" style="width: 65px; height: 65px; background-color: #f0f0f0; color: #007bff; font-size: 15px; font-weight: bold;">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                            @endif

                            <h2 class="profile-name">{{ $user->name }}</h2>
                            <p class="profile-tagline">{{ $user->email ?? 'No email available' }}</p>
                            <div class="profile-stats">
                                <div class="stat">
                                    <div class="stat-label">Date of Birth</div>
                                    <div class="stat-value">{{ $user->date_of_birth ? \Carbon\Carbon::parse($user->date_of_birth)->format('d M, Y') : 'N/A' }}</div>

                                </div>
                                <div class="stat">
                                    <div class="stat-label">Location</div>
                                    <div class="stat-value">{{ $user->location ?? 'Location not set' }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-body">
                            <div class="profile-section">
                                <h3 class="section-title"><i class="fas fa-graduation-cap"></i>Education</h3>
                                @forelse ($educations as $education)
                                    <p>{{ $education->degree }} in {{ $education->field_of_study }}, {{ $education->institution }} ({{ $education->start_date }} - {{ $education->end_date ?? 'Present' }})</p>
                                @empty
                                    <p>No education details available</p>
                                @endforelse
                            </div>
                            <div class="profile-section">
                                <h3 class="section-title"><i class="fas fa-code"></i>Skills</h3>
                                <div class="skill-tags">
                                    @forelse ($skills as $skill)
                                        <span class="skill-tag">{{ $skill->skill_name }}</span>
                                    @empty
                                        <span>No skills added</span>
                                    @endforelse
                                </div>
                            </div>
                        </div>
{{--                        <div class="profile-footer">--}}
{{--                            <button class="connect-btn pulse">Connect</button>--}}
{{--                            <div class="social-links">--}}
{{--                                @if ($user->github)--}}
{{--                                    <a href="{{ $user->github }}" title="GitHub"><i class="fab fa-github"></i></a>--}}
{{--                                @endif--}}
{{--                                @if ($user->linkedin)--}}
{{--                                    <a href="{{ $user->linkedin }}" title="LinkedIn"><i class="fab fa-linkedin"></i></a>--}}
{{--                                @endif--}}
{{--                                @if ($user->twitter)--}}
{{--                                    <a href="{{ $user->twitter }}" title="Twitter"><i class="fab fa-twitter"></i></a>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>

                </div>
                </div>
            </div>
    </aside>

@endsection
