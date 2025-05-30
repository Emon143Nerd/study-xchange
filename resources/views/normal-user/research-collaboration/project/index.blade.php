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
