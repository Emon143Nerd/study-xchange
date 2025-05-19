@extends('normal-user.master')
@extends('normal-user.message')

@section('tb-site-sidebar')
    <!-- sidebar is not available -->
@endsection

@section('title','Task Detail')

@section('body')

    <!-- Research Collaboration Create Project -->
    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="{{asset('/')}}normal-user-assets/research-project-assets/fonts.gstatic.com/index.html">
    <link href="{{asset('/')}}normal-user-assets/research-project-assets/fonts.googleapis.com/css2c4ad.css?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <!-- BOXICONS -->
    <link href='{{asset('/')}}normal-user-assets/research-project-assets/unpkg.com/boxicons%402.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{asset('/')}}normal-user-assets/research-project-assets/css/icons.min.css">

    <!-- APP CSS -->
    <link rel="stylesheet" href="{{asset('/')}}normal-user-assets/research-project-assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('/')}}normal-user-assets/research-project-assets/css/grid.css">
    <link rel="stylesheet" href="{{asset('/')}}normal-user-assets/research-project-assets/css/style.css">
    <link rel="stylesheet" href="{{asset('/')}}normal-user-assets/research-project-assets/css/responsive.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Research Collaboration Create Project -->


    <style>
        .main-content.project {
            position: relative; /* Ensure it respects layout flow */
            width: 100%; /* Full width or adjust as needed */
            max-width: none; /* Remove any width limitations */
            margin: 0; /* Reset default margins */
            padding: 0; /* Adjust padding as needed */
            left: 0; /* Align it to the left edge */
        }
    </style>

    <div class="main">

        <div class="main-content project">
            <div class="container my-5">
                <div class="card border-0 shadow-lg rounded-4">
                    <!-- Header Section -->
                    <div class="card-header bg-gradient-primary text-black rounded-top">
                        <h3 class="mb-0">{{ $task->title }}</h3>
                    </div>

                    <div class="card-body p-5">
                        <!-- Task Details Grid -->
                        <div class="row mb-4 gx-5 gy-3">
                            <!-- Due Date -->
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <i class="bx bx-calendar fs-24 text-primary me-3"></i>
                                    <div>
                                        <h6 class="text-secondary fw-bold mb-1">Due Date</h6>
                                        <p class="fs-18">{{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Task Status -->
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <i class="bx bx-flag-checkered fs-24 text-primary me-3"></i>
                                    <div>
                                        <h6 class="text-secondary fw-bold mb-1">Status</h6>
                                        <p class="fs-18">
                                            @if($task->status == 1)
                                                <span class="badge bg-danger">Pending</span>
                                            @elseif($task->status == 2)
                                                <span class="badge bg-yellow text-dark">On Progress</span>
                                            @elseif($task->status == 3)
                                                <span class="badge bg-success">Completed</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Team Member Section -->
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="d-flex align-items-start">
                                    <i class="bx bx-user-circle fs-24 text-primary me-3"></i>
                                    <div>
                                        <h6 class="text-secondary fw-bold mb-1">Assigned Team Member</h6>
                                        <p class="fs-18">{{ $task->teamMember->user->name ?? 'Unassigned' }}</p>
                                        <small class="text-muted">{{ $task->teamMember->user->email ?? '' }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Task Description -->
                        <div class="mb-4">
                            <div class="d-flex align-items-start">
                                <i class="bx bx-align-left fs-24 text-primary me-3"></i>
                                <div>
                                    <h6 class="text-secondary fw-bold mb-1">Description</h6>
                                    <p class="fs-18">{{ $task->description }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Attachment Section -->
                        @if($task->attachment)
                            <div class="mb-4">
                                <div class="d-flex align-items-start">
                                    <i class="bx bx-paperclip fs-24 text-primary me-3"></i>
                                    <div>
                                        <h6 class="text-secondary fw-bold mb-1">Attachment</h6>
                                        <a href="{{ asset($task->attachment) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                            <i class="bx bx-download me-2"></i> Download Attachment
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Footer Section -->
                    <div class="card-footer bg-light py-3 d-flex justify-content-between align-items-center">
                        <button type="button" onclick="goBack()" href="{{ route('normal-user.research-project.detail', ['id'=>$task->id]) }}" class="btn btn-outline-secondary">
                            <i class="bx bx-arrow-back me-2"></i> Back to Project
                        </button>

                        <a href="{{ route('normal-user.research-task.edit',['id'=>$task->id]) }}" class="btn btn-outline-primary">
                            <i class="bx bx-edit-alt me-2"></i> Edit Task
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Research Collaboration Create Project -->
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/jquery/jquery.min.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/jquery/jquery-ui.min.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/moment/min/moment.min.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/peity/jquery.peity.min.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/chart.js/Chart.bundle.min.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/owl.carousel/owl.carousel.min.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/js/countto.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/simplebar/simplebar.min.js"></script>


    <!-- APP JS -->
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/js/main.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/js/shortcode.js"></script>

    <!-- Include Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        // Initialize Flatpickr
        document.addEventListener("DOMContentLoaded", function() {
            flatpickr("#datepicker", {
                dateFormat: "d-m-Y", // Date format as "DD-MM-YYYY"
            });
        });
    </script>
    <!-- Research Collaboration Create Project -->



@endsection
