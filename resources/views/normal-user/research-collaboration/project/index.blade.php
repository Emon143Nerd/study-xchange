@extends('normal-user.master')
@extends('normal-user.message')

@section('tb-site-sidebar')
    <!-- sidebar is not available -->
@endsection

@section('title','Research Collaboration')

@section('body')


    <!-- Research Collaboration Project -->
    <link rel="shortcut icon" href="{{asset('/')}}normal-user-assets/research-project-assets/images/favicon.png" type="image/png">
    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="{{asset('/')}}normal-user-assets/research-project-assets/fonts.gstatic.com/index.html">
    <link href="{{asset('/')}}normal-user-assets/research-project-assets/fonts.googleapis.com/css2c4ad.css?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <!-- BOXICONS -->
    <link href='{{asset('/')}}normal-user-assets/research-project-assets/unpkg.com/boxicons%402.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{asset('/')}}normal-user-assets/research-project-assets/css/icons.min.css">

    <!-- Plugin -->

    <link rel="stylesheet" href="{{asset('/')}}normal-user-assets/research-project-assets/libs/pg-calendar-master/pignose.calendar.css">
    <!-- APP CSS -->
    <link rel="stylesheet" href="{{asset('/')}}normal-user-assets/research-project-assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('/')}}normal-user-assets/research-project-assets/css/grid.css">
    <link rel="stylesheet" href="{{asset('/')}}normal-user-assets/research-project-assets/css/style.css">
    <link rel="stylesheet" href="{{asset('/')}}normal-user-assets/research-project-assets/css/responsive.css">
    <!-- Research Collaboration Project -->

    <style>
        .main-content.project {
            position: relative; /* Ensure it respects layout flow */
            width: 100%; /* Full width or adjust as needed */
            max-width: none; /* Remove any width limitations */
            margin: 0; /* Reset default margins */
            padding: 0; /* Adjust padding as needed */
            left: 0; /* Align it to the left edge */
        }

        .main-content.project .row {
            width: 100%;
            margin: 0;
        }

        .sticky-component {
            position: sticky;
            top: 20px; /* Adjust based on desired offset from the top */
            z-index: 1000; /* Ensure it remains on top of overlapping elements */
        }

        .scrollable-container {
            max-height: 500px; /* Set the height you want for the scrollable area */
            overflow-y: auto; /* Enable vertical scrolling */
            padding: 15px; /* Optional padding for better aesthetics */
            border: 1px solid #ccc; /* Optional border for visual clarity */
            background-color: #f9f9f9; /* Optional background color */
            border-radius: 10px; /* Optional rounded corners */
        }


    </style>







    <!-- MAIN CONTENT -->
{{--    <div class="style-2 main">--}}
{{--        <!-- Left Component -->--}}
{{--        <div class="style-2 main-content project " >--}}

{{--            <div class="row">--}}
{{--                <div class="col-9 col-xl-7 col-md-8 col-sm-12">--}}
{{--                    <div class="box card-box">--}}
{{--                        <!-- Total Projects -->--}}
{{--                        <div class="icon-box bg-color-6 d-block">--}}
{{--                            <div class="content text-center color-6">--}}
{{--                                <h5 class="title-box fs-17 font-w500">Total Project</h5>--}}
{{--                                <div class="themesflat-counter fs-18 font-wb">--}}
{{--                                    <span class="number">{{ $totalProjects }} +</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <!-- Pending Projects -->--}}
{{--                        <div class="icon-box bg-color-7 d-block">--}}
{{--                            <div class="content text-center color-7">--}}
{{--                                <h5 class="title-box fs-17 font-w500">Pending Project</h5>--}}
{{--                                <div class="themesflat-counter fs-18 font-wb">--}}
{{--                                    <span class="number">{{ $pendingProjects }} +</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <!-- Ongoing Projects -->--}}
{{--                        <div class="icon-box bg-color-8 d-block">--}}
{{--                            <div class="content text-center color-8">--}}
{{--                                <h5 class="title-box fs-17 font-w500">On Going Project</h5>--}}
{{--                                <div class="themesflat-counter fs-18 font-wb">--}}
{{--                                    <span class="number">{{ $ongoingProjects }} +</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <!-- Completed Projects -->--}}
{{--                        <div class="icon-box bg-color-9 d-block">--}}
{{--                            <div class="content text-center color-9">--}}
{{--                                <h5 class="title-box fs-17 font-w500">Complete Project</h5>--}}
{{--                                <div class="themesflat-counter fs-18 font-wb">--}}
{{--                                    <span class="number">{{ $completedProjects }} +</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="row">--}}
{{--                <!-- Left Component: Recent Project Update -->--}}
{{--                <div class="col-lg-7 col-md-8">--}}
{{--                    <div class="box-header pt-0 pl-0 ms-0 mb-4 mt-4 border-bottom-0 responsive-header">--}}
{{--                        <h4 class="box-title fs-22">Recent Project Update</h4>--}}
{{--                        <div class="card-options">--}}
{{--                            <div class="btn-list d-flex">--}}
{{--                                <a href="{{route('normal-user.research-project.create')}}" class="btn text-primary border-primary d-flex align-items-center mr-5">--}}
{{--                                    <i class='bx bx-plus-circle mr-5'></i>Add Project--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}



{{--                    <div class="scrollable-container">--}}
{{--                        <div class="row">--}}
{{--                            <!-- First Project Card -->--}}
{{--                            @foreach($researchProjects as $researchProject)--}}
{{--                            <div class="col-xl-6 col-md-6 col-sm-12">--}}
{{--                                <div class="box left-dot">--}}
{{--                                    <div class="box-body">--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-12 mb-10">--}}
{{--                                                <div class="mt-0 text-start">--}}
{{--                                                    <a href="{{route('normal-user.research-project.detail',['id'=>$researchProject->id])}}" class="box-title mb-0 mt-1 mb-3 font-w600 fs-18">{{$researchProject->title}}</a>--}}
{{--                                                    <p class="fs-14 font-w500 text-muted mb-6">{{$researchProject->department}}</p>--}}
{{--                                                    <span class="fs-13 mt-2 text-muted">{{ \Illuminate\Support\Str::limit($researchProject->objective, 25) }}</span>--}}
{{--                                                </div>--}}
{{--                                                <img src="{{asset('/')}}normal-user-assets/research-project-assets/images/icon/experience.png" alt="img" class="img-box">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="box-footer">--}}
{{--                                        <div class="d-flex align-items-center">--}}
{{--                                            <div class="d-flex mb-3 mb-md-0">--}}
{{--                                                <div class="mr-10">--}}
{{--                                                    <div class="chart-circle chart-circle-xs" data-value="0.75" data-thickness="3" data-color="#3C21F7">--}}
{{--                                                        <canvas width="40" height="40"></canvas>--}}
{{--                                                        <div class="chart-circle-value">75%</div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <ul class="user-list mb-0">--}}
{{--                                                    <li><img src="{{asset('/')}}normal-user-assets/research-project-assets/images/avatar/user-1.png" alt="user"></li>--}}
{{--                                                    <li><img src="{{asset('/')}}normal-user-assets/research-project-assets/images/avatar/user-2.png" alt="user"></li>--}}
{{--                                                    <li><img src="{{asset('/')}}normal-user-assets/research-project-assets/images/avatar/user-3.png" alt="user"></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}

{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            @endforeach--}}
{{--                            <!-- Repeat other project cards here -->--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}



{{--        </div>--}}
{{--    </div>--}}
    <!-- END MAIN CONTENT -->
    <div class="container-fluid">
        <div class="row">
            <!-- Statistics Section -->
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- Total Projects -->
                            <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
                                <div class="bg-color-6 p-3 text-center rounded">
                                    <h5 class="fs-17 font-weight-500 text-black">Total Project</h5>
                                    <div class="fs-18 font-weight-bold text-black">
                                        <span class="number">{{ $totalProjects }} +</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Pending Projects -->
                            <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
                                <div class="bg-color-7 p-3 text-center rounded">
                                    <h5 class="fs-17 font-weight-500 text-black">Pending Project</h5>
                                    <div class="fs-18 font-weight-bold text-black">
                                        <span class="number">{{ $pendingProjects }} +</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Ongoing Projects -->
                            <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
                                <div class="bg-color-8 p-3 text-center rounded">
                                    <h5 class="fs-17 font-weight-500 text-black">On Going Project</h5>
                                    <div class="fs-18 font-weight-bold text-black">
                                        <span class="number">{{ $ongoingProjects }} +</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Completed Projects -->
                            <div class="col-md-3 col-sm-6">
                                <div class="bg-color-9 p-3 text-center rounded">
                                    <h5 class="fs-17 font-weight-500 text-black">Complete Project</h5>
                                    <div class="fs-18 font-weight-bold text-black">
                                        <span class="number">{{ $completedProjects }} +</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Project Updates Section -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title fs-22">Recent Project Update</h4>
                        <a href="{{route('normal-user.research-project.create')}}" class="btn btn-primary">
                            <i class='bx bx-plus-circle mr-2'></i>Add Project
                        </a>
                    </div>
                    <div class="card-body">
{{--                        <div class="row">--}}
{{--                            @foreach($researchProjects as $researchProject)--}}
{{--                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4">--}}
{{--                                    <div class="card h-100">--}}
{{--                                        <div class="card-body">--}}
{{--                                            <h5 class="card-title mb-2">--}}
{{--                                                <a href="{{route('normal-user.research-project.detail',['id'=>$researchProject->id])}}" class="text-dark font-weight-bold">{{$researchProject->title}}</a>--}}
{{--                                            </h5>--}}
{{--                                            <p class="card-text text-muted mb-2">{{$researchProject->department}}</p>--}}
{{--                                            <p class="card-text">{{ \Illuminate\Support\Str::limit($researchProject->objective, 100) }}</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
                        <div class="row">
                            @foreach($researchProjects as $researchProject)
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card h-100 shadow-sm border-0">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title mb-3">
                                                <a href="{{route('normal-user.research-project.detail',['id'=>$researchProject->id])}}" class="text-dark text-decoration-none stretched-link">
                                                    {{$researchProject->title}}
                                                </a>
                                            </h5>
                                            <h6 class="card-subtitle mb-3 text-muted">
                                                <i class="fas fa-university me-2"></i>{{$researchProject->department}}
                                            </h6>
                                            <p class="card-text flex-grow-1">{{ \Illuminate\Support\Str::limit($researchProject->objective, 100) }}</p>
                                            <div class="d-flex justify-content-between align-items-center mt-3">
                                                <p class="fs-18 font-w400">
                                                    @if ($researchProject->status == 1)
                                                        <span class="badge bg-warning">Pending</span>
                                                    @elseif ($researchProject->status == 2)
                                                        <span class="badge bg-info">On Progress</span>
                                                    @elseif ($researchProject->status == 3)
                                                        <span class="badge bg-success">Completed</span>
                                                    @else
                                                        <span class="badge bg-secondary">Unknown</span>
                                                    @endif
                                                </p>
                                                <small class="text-muted">
                                                    <i class="far fa-calendar-alt me-1"></i>
                                                    {{$researchProject->created_at->format('M d, Y')}}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
{{--                        <div class="row mt-4">--}}
{{--                            <div class="col-12 text-center">--}}
{{--                                <a href="{{route('normal-user.research-project.index')}}" class="btn btn-outline-primary">View All Projects</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Research Collaboration Project -->
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/jquery/jquery.min.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/jquery/jquery-ui.min.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/moment/min/moment.min.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/peity/jquery.peity.min.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/chart.js/Chart.bundle.min.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/owl.carousel/owl.carousel.min.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/js/countto.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/circle-progress/circle-progress.min.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/pg-calendar-master/pignose.calendar.full.min.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/apexcharts/apexcharts.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/simplebar/simplebar.min.js"></script>

    <!-- APP JS -->
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/js/pages/chart-circle.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/js/main.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/js/pages/project.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/js/shortcode.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/js/script.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/js/pages/dashboard.js"></script>
    <!-- Research Collaboration Project -->



@endsection
