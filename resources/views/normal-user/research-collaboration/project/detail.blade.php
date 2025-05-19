@extends('normal-user.master')
@extends('normal-user.message')

@section('tb-site-sidebar')
    <!-- sidebar is not available -->
@endsection

@section('title','Project Detail')

@section('body')


    <!-- Research Collaboration Project Detail-->
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
    <!-- Research Collaboration Project Detail-->

    <!-- Research Collaboration Project Detail Calendar-->
    <style>
        /* Custom CSS for FullCalendar */
        #calendar {
            height: 400px;
            max-height: 400px;
        }
        .fc-daygrid-day-number {
            color: #000;
        }
        .fc-daygrid-day.fc-day-today {
            background-color: #e0f7fa !important;
        }
        .fc-toolbar-title {
            color: #000 !important;
        }
    </style>
    <!-- Research Collaboration Project Detail Calendar-->


    <!-- Research Collaboration Task Table-->
    <link rel="stylesheet" href="{{asset('/')}}normal-user-assets/research-project-assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="{{asset('/')}}normal-user-assets/research-project-assets/libs/date-picker/datepicker.css">
    <link rel="stylesheet" href="{{asset('/')}}normal-user-assets/research-project-assets/libs/datatable/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="{{asset('/')}}normal-user-assets/research-project-assets/libs/rating/css/rating-themes.css">
    <!-- Research Collaboration Task Table-->


    <!-- Research Collaboration Calendar-->
    <style>
        .main-content.project {
            position: relative; /* Ensure it respects layout flow */
            width: 100%; /* Full width or adjust as needed */
            max-width: none; /* Remove any width limitations */
            margin: 0; /* Reset default margins */
            padding: 0; /* Adjust padding as needed */
            left: 0; /* Align it to the left edge */
        }

        .container {
            display: flex; /* Use flexbox to align the divs side by side */
            width: 100%; /* Full width container */
            gap: 10px; /* Optional: Add some spacing between the divs */
        }

        .left-div {
            width: 65%; /* Set 65% width for the left div */
            background-color: #f2f2f2; /* Optional: Add a background color */
            padding: 20px; /* Optional: Add padding for better spacing */
            /*box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); !* Optional: Add shadow for styling *!*/
            border-radius: 8px; /* Optional: Round the corners */
        }

        .right-div {
            width: 45%; /* Set 35% width for the right div */
            background-color: #e0e0e0; /* Optional: Add a background color */
            padding: 20px; /* Optional: Add padding for better spacing */
            /*box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); !* Optional: Add shadow for styling *!*/
            border-radius: 8px; /* Optional: Round the corners */
        }


        .sticky-component {
            position: sticky;
            top: 20px; /* Adjust based on desired offset from the top */
            z-index: 1000; /* Ensure it remains on top of overlapping elements */
        }


    </style>

    <!-- FullCalendar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />

    <style>
        .input-container {
            display: flex;
            flex-direction: column;
            width: 200px;
            margin: 20px;
            margin-left: -1px;
        }
        .input-container label {
            margin-bottom: 8px;
            font-weight: bold;
        }
        .input-container input {
            padding: 8px;
            font-size: 16px;
        }
        .ui-datepicker {
            background: #fff; /* Background color */
            border: 1px solid #ddd; /* Border color */
            padding: 10px;
            border-radius: 8px;
        }
        .ui-datepicker .ui-datepicker-header {
            background: #007bff; /* Header background color */
            color: #fff; /* Header text color */
        }
        .ui-datepicker .ui-datepicker-title {
            font-weight: bold;
        }
        .ui-datepicker .ui-state-default {
            background: #f8f9fa;
            border: 1px solid #ddd;
            color: #333;
        }
        .ui-datepicker .ui-state-hover {
            background: #007bff;
            color: #fff;
        }
    </style>
    <style>
        /* Ensure the color of month and year are visible */
        .flatpickr-months .flatpickr-month .flatpickr-month-prev,
        .flatpickr-months .flatpickr-month .flatpickr-month-next {
            color: #000 !important; /* Change the color of the prev/next buttons */
        }

        .flatpickr-months .flatpickr-month .flatpickr-months .flatpickr-month-name {
            color: #007bff !important; /* Change the color of the month name */
        }

        .flatpickr-months .flatpickr-month .flatpickr-year {
            color: #28a745 !important; /* Change the color of the year name */
        }

        .flatpickr-calendar .flatpickr-months .flatpickr-month .flatpickr-prev-month,
        .flatpickr-calendar .flatpickr-months .flatpickr-month .flatpickr-next-month {
            color: #007bff !important; /* Ensure month navigation arrows are visible */
        }

        .flatpickr-calendar .flatpickr-months .flatpickr-month .flatpickr-prev-year,
        .flatpickr-calendar .flatpickr-months .flatpickr-month .flatpickr-next-year {
            color: #007bff !important; /* Ensure year navigation arrows are visible */
        }

        /* Change the background color of the calendar */
        .flatpickr-calendar {
            background-color: #007bff !important; /* Change this to your desired color */
        }

        .flatpickr-months, .flatpickr-days {
            background-color: #007bff !important; /* Ensure consistency in background color */
        }
    </style>

    <!-- google font -->
    <link href="../../fonts.googleapis.com/css2307e.css?family=Inter:wght@200;300;400;500;600;700;800&amp;display=swap" rel="stylesheet">
    <!-- Research Collaboration Calendar-->


    <!-- MAIN CONTENT -->
    <div class="main">

        <div class="main-content project">




            <div class="container">
                <div class="left-div">
                    <!-- Left div content goes here -->
                    <div class="row">
                        <div class="col-12">
                            <div class="box project">
                                <div class="box-header">
                                    <h4 class="box-title">{{$researchProject->title}}</h4>
                                    <div class="box-right d-flex">
                                        @if (auth()->id() == $researchProject->created_by)
                                        <div class="dropdown ml-14">
                                            <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class='bx bx-dots-vertical-rounded fs-22'></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="{{route('normal-user.research-project.edit',['id'=>$researchProject->id])}}">
                                                    <i class="bx bx-edit me-2"></i>Edit
                                                </a>
                                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this project?')) { document.getElementById('delete-project-form').submit(); }">
                                                    <i class="bx bx-trash"></i> Delete
                                                </a>
                                                <!-- Hidden Form for Deletion -->
                                                <form id="delete-project-form" action="{{ route('normal-user.research-project.delete', $researchProject->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </div>
                                        @endif


                                    </div>
                                </div>
                                <div class="divider"></div>
                                <div class="box-body d-flex justify-content-between pb-0">
                                    <div class="team-name">
                                        <a href="#" class="team">
                                            <div class="icon"><i class="fas fa-tags"></i></div>
                                            <h5>{{$researchProject->objective}}</h5>
                                        </a>
                                    </div>
                                </div>
                                <div class="divider"></div>
                                <div class="box-body content">
                                    <div class="card border-0 shadow-sm p-4 rounded">
                                        <h3 class="text-primary font-w600 mb-4">{{ $researchProject->title }}</h3>
                                        <hr>

                                        <!-- Project Details Grid -->
                                        <div class="row gx-5 gy-4">
                                            <!-- Department -->
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-start">
                                                    <i class="bx bx-buildings fs-24 text-primary me-3"></i>
                                                    <div>
                                                        <h6 class="text-secondary mb-1">Department</h6>
                                                        <p class="fs-18 font-w400">{{ $researchProject->department }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Created By -->
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-start">
                                                    <i class="bx bx-user fs-24 text-primary me-3"></i>
                                                    <div>
                                                        <h6 class="text-secondary mb-1">Created By</h6>
                                                        <p class="fs-18 font-w400">{{ $researchProject->creator->name }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Objective -->
                                            <div class="col-md-12">
                                                <div class="d-flex align-items-start">
                                                    <i class="bx bx-bulb fs-24 text-primary me-3"></i>
                                                    <div>
                                                        <h6 class="text-secondary mb-1">Objective</h6>
                                                        <p class="fs-18 font-w400">{{ $researchProject->objective }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Timeline -->
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-start">
                                                    <i class="bx bx-calendar fs-24 text-primary me-3"></i>
                                                    <div>
                                                        <h6 class="text-secondary mb-1">Timeline From</h6>
                                                        <p class="fs-18 font-w400">{{ \Carbon\Carbon::parse($researchProject->timeline_from)->format('d M Y') }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="d-flex align-items-start">
                                                    <i class="bx bx-calendar fs-24 text-primary me-3"></i>
                                                    <div>
                                                        <h6 class="text-secondary mb-1">Timeline To</h6>
                                                        <p class="fs-18 font-w400">{{ \Carbon\Carbon::parse($researchProject->timeline_to)->format('d M Y') }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Description -->
                                            <div class="col-md-12">
                                                <div class="d-flex align-items-start">
                                                    <i class="bx bx-align-left fs-24 text-primary me-3"></i>
                                                    <div>
                                                        <h6 class="text-secondary mb-1">Description</h6>
                                                        <p class="fs-18 font-w400">{{ $researchProject->description }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="d-flex align-items-start">
                                                    <i class="bx bx-flag fs-24 text-primary me-3"></i>
                                                    <div>
                                                        <h6 class="text-secondary mb-1">Work Status</h6>
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
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                        <!-- Team Members Section -->
                                        @foreach($teamMembers as $teamMember)
                                            @if($teamMember->status != 3) <!-- Exclude team members with status 3 -->
                                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="mb-1">{{ $teamMember->name }}</h6>
                                                    <small class="text-muted">{{ $teamMember->email }}</small>
                                                </div>
                                                <div>
                                                    <!-- Conditionally show icons based on status -->
                                                    @if($teamMember->status == 1)
                                                        <i class="bx bx-time text-warning fs-24" title="Pending"></i>
                                                    @elseif($teamMember->status == 2)
                                                        <i class="bx bx-user-check text-success fs-24" title="Accepted"></i>
                                                    @endif
                                                </div>
                                            </div>
                                            @endif
                                        @endforeach

                                        <!-- Attachments Section -->
                                        @if($researchProject->attachment)
                                            <div class="mt-4 pt-3 border-top">
                                                <h6 class="text-secondary mb-3">Attachments</h6>
                                                <a href="{{ asset($researchProject->attachment) }}" target="_blank" class="btn btn-outline-primary">
                                                    <i class="bx bx-link-external me-2"></i>View Attachment
                                                </a>
                                            </div>
                                        @endif

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="right-div">
                    <!-- Right div content goes here -->
                    <div class="w-full lg:w-1/2 flex-1">
                        <div class="lg:space-y-4 lg:pb-8 max-lg:grid sm:grid-cols-2 max-lg:gap-6">
                            <!-- Small Calendar -->
{{--                            <div class="bg-white rounded-xl shadow-sm md:p-2 p-1 space-y-2 text-sm font-medium border1 w-full">--}}
{{--                                <div id="calendar" class="max-w-xs mx-auto"></div>--}}
{{--                            </div>--}}
                            <!-- Small Calendar -->
                            <div class="calendar-container">
                                <div id="calendar"></div>
                            </div>
                        </div>

                        <!-- Meeting Component -->

                        @if (auth()->id() == $researchProject->created_by)
                            <!-- Create Meeting Request Component -->
{{--                            <div id="create-meeting" class="bg-white rounded-xl shadow-sm p-4 mt-4 space-y-4">--}}
{{--                                <h2 class="text-lg font-bold text-gray-700">Create Meeting Request</h2>--}}
{{--                                <form action="{{ route('normal-user.research-project-meeting.create', $researchProject->id) }}" method="POST" id="meeting-form">--}}
{{--                                    @csrf--}}

{{--                                    <!-- Meeting Title -->--}}
{{--                                    <div class="mb-4">--}}
{{--                                        <label for="meeting-title" class="block text-sm font-medium text-gray-600">Meeting Title</label>--}}
{{--                                        <input type="text" id="meeting-title" name="title" class="form-input w-full mt-1 border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Enter meeting title" required>--}}
{{--                                    </div>--}}

{{--                                    <!-- Proposed Times -->--}}
{{--                                    <div class="mb-4">--}}
{{--                                        <label class="block text-sm font-medium text-gray-600">Proposed Times</label>--}}
{{--                                        <div class="space-y-2 mt-2">--}}
{{--                                            <input type="datetime-local" name="time1" class="form-input w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required>--}}
{{--                                            <input type="datetime-local" name="time2" class="form-input w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required>--}}
{{--                                            <input type="datetime-local" name="time3" class="form-input w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <!-- Meeting Link -->--}}
{{--                                    <div class="mb-4">--}}
{{--                                        <label for="meeting-link" class="block text-sm font-medium text-gray-600">Meeting Link (Optional)</label>--}}
{{--                                        <input type="text" id="meeting-link" name="meeting_link" class="form-input w-full mt-1 border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Enter Zoom/Meet link (Optional)">--}}
{{--                                    </div>--}}

{{--                                    <!-- Hidden Fields -->--}}
{{--                                    <input type="hidden" name="research_project_id" value="{{ $researchProject->id }}">--}}
{{--                                    <input type="hidden" name="created_by" value="{{ auth()->id() }}">--}}

{{--                                    <!-- Submit Button -->--}}
{{--                                    <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 transition">Create Meeting Request</button>--}}
{{--                                </form>--}}

{{--                            </div>--}}

                            <div id="create-meeting" class="bg-white rounded-xl shadow-sm p-4 mt-4 space-y-4">
                                <h2 class="text-lg font-bold text-gray-700">Create Meeting Request</h2>

                                @if ($errors->any())
                                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if(session('error'))
                                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                @if(session('message'))
                                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                                        {{ session('message') }}
                                    </div>
                                @endif

                                <form action="{{ route('normal-user.research-project-meeting.create', $researchProject->id) }}"
                                      method="POST"
                                      id="meeting-form"
                                      class="space-y-4">
                                    @csrf

                                    <!-- Meeting Title -->
                                    <div>
                                        <label for="meeting-title" class="block text-sm font-medium text-gray-600">Meeting Title</label>
                                        <input type="text"
                                               id="meeting-title"
                                               name="title"
                                               value="{{ old('title') }}"
                                               class="form-input w-full mt-1 border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror"
                                               placeholder="Enter meeting title"
                                               required>
                                        @error('title')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Proposed Times -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600">Proposed Times</label>
                                        <div class="space-y-2 mt-2">
                                            <input type="datetime-local"
                                                   name="time1"
                                                   value="{{ old('time1') }}"
                                                   class="form-input w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('time1') border-red-500 @enderror"
                                                   required>
                                            @error('time1')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror

                                            <input type="datetime-local"
                                                   name="time2"
                                                   value="{{ old('time2') }}"
                                                   class="form-input w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('time2') border-red-500 @enderror"
                                                   required>
                                            @error('time2')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror

                                            <input type="datetime-local"
                                                   name="time3"
                                                   value="{{ old('time3') }}"
                                                   class="form-input w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('time3') border-red-500 @enderror"
                                                   required>
                                            @error('time3')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Meeting Link -->
                                    <div>
                                        <label for="meeting-link" class="block text-sm font-medium text-gray-600">Meeting Link (Optional)</label>
                                        <input type="url"
                                               id="meeting-link"
                                               name="meeting_link"
                                               value="{{ old('meeting_link') }}"
                                               class="form-input w-full mt-1 border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('meeting_link') border-red-500 @enderror"
                                               placeholder="Enter Zoom/Meet link (Optional)">
                                        @error('meeting_link')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 transition">
                                        Create Meeting Request
                                    </button>
                                </form>
                            </div>
                            <!-- Create Meeting Request Component End -->
                            <style>
                                /* General Styling for the Create Meeting Request Component */
                                #create-meeting {
                                    background-color: #f9f9f9;
                                    border: 1px solid #e5e5e5;
                                    border-radius: 12px;
                                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                                    padding: 20px;
                                    margin-top: 20px;
                                    max-width: 100%;
                                }

                                /* Heading Styling */
                                #create-meeting h2 {
                                    font-size: 1.5rem;
                                    color: #333;
                                    font-weight: 600;
                                    margin-bottom: 15px;
                                    border-bottom: 2px solid #e5e5e5;
                                    padding-bottom: 10px;
                                }

                                /* Form Styling */
                                #create-meeting form {
                                    display: flex;
                                    flex-direction: column;
                                    gap: 15px;
                                }

                                /* Labels */
                                #create-meeting label {
                                    font-size: 0.875rem;
                                    color: #555;
                                    font-weight: 500;
                                }

                                /* Inputs */
                                #create-meeting .form-input {
                                    width: 100%;
                                    padding: 10px;
                                    font-size: 0.9rem;
                                    color: #333;
                                    border: 1px solid #d1d5db;
                                    border-radius: 8px;
                                    background-color: #fff;
                                    transition: border-color 0.3s, box-shadow 0.3s;
                                }

                                #create-meeting .form-input:focus {
                                    border-color: #2563eb;
                                    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
                                    outline: none;
                                }

                                /* Submit Button */
                                #create-meeting button[type="submit"] {
                                    font-size: 1rem;
                                    font-weight: 600;
                                    background-color: #2563eb;
                                    color: #fff;
                                    padding: 10px 15px;
                                    border: none;
                                    border-radius: 8px;
                                    cursor: pointer;
                                    transition: background-color 0.3s, transform 0.2s;
                                }

                                #create-meeting button[type="submit"]:hover {
                                    background-color: #1e3a8a;
                                    transform: translateY(-2px);
                                }

                                /* Responsive Design */
                                @media (max-width: 768px) {
                                    #create-meeting {
                                        padding: 15px;
                                    }

                                    #create-meeting h2 {
                                        font-size: 1.25rem;
                                    }
                                }

                            </style>
                        @endif

                        @if(isset($meeting) && $meeting)
                            <!-- Upcoming Meeting Section -->
                            <!-- Show the meeting selection form only if the user hasn't already responded -->
                            @if(!$hasResponded)
                                <div class="meeting-container">
                                    <div class="meeting-card">
                                        <h2>Upcoming Meeting</h2>
                                        <h3>{{ $meeting->title }}</h3>
                                        <p class="instructions">Please select your preferred meeting time:</p>

                                        <!-- Meeting Selection Form -->
                                        <form id="meeting-form" action="{{ route('normal-user.research-project-meeting.respondToMeeting', $meeting->id) }}" method="POST">
                                            @csrf
                                            <div class="meeting-times">
                                                @foreach (['time1', 'time2', 'time3'] as $time)
                                                    <label class="meeting-time">
                                                        <input type="radio" name="selected_time" value="{{ $time }}" required
                                                               @if (isset($selectedTime) && $selectedTime == $time) checked @endif>
                                                        <div class="time-content">
                                                            <div class="radio-circle"></div>
                                                            <div class="time-details">
                                                                <div class="date-group">
                                                                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                                                    </svg>
                                                                    <span>{{ \Carbon\Carbon::parse($meeting->$time)->format('M d, Y') }}</span>
                                                                </div>
                                                                <div class="time-group">
                                                                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                                        <circle cx="12" cy="12" r="10"></circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                    <span>{{ \Carbon\Carbon::parse($meeting->$time)->format('h:i A') }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </label>
                                                @endforeach
                                            </div>

                                            <!-- Confirm Button -->
                                            <button type="submit" class="confirm-button">Confirm Selection</button>
                                        </form>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const form = document.getElementById('meeting-form');

                                        form.addEventListener('submit', function(e) {
                                            e.preventDefault();
                                            const selectedTime = document.querySelector('input[name="selected_time"]:checked');

                                            if (selectedTime) {
                                                // You should let the form be submitted normally.
                                                form.submit(); // Submit the form after checking the time.
                                            } else {
                                                alert('Please select a meeting time.');
                                            }
                                        });
                                    });
                                </script>

                            @else

                                @if(!$meeting->final_time)
                                <div class="meeting-container">
                                    <div class="meeting-card">
                                        <h2>Upcoming Meeting</h2>
                                        <h3>{{ $meeting->title }}</h3>
                                        <p class="instructions">You have already confirmed your meeting time.</p>
                                        <p><strong>Selected Time:</strong> {{ $selectedTime }}</p> <!-- Display formatted time here -->
                                    </div>
                                </div>
                                @endif


                                <!-- Upcoming Meeting Component End -->
                            @endif
                            <style>
                                .meeting-container {
                                    max-width: 600px;
                                    margin: 2rem auto;
                                    padding: 0 1rem;
                                }

                                .meeting-card {
                                    background-color: white;
                                    border-radius: 12px;
                                    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                                    border: 1px solid #e5e7eb;
                                    padding: 1.5rem;
                                }

                                h2 {
                                    font-size: 1.5rem;
                                    font-weight: 600;
                                    color: #1f2937;
                                    margin: 0 0 0.5rem 0;
                                }

                                h3 {
                                    font-size: 1.125rem;
                                    font-weight: 500;
                                    color: #4b5563;
                                    margin: 0 0 1.5rem 0;
                                }

                                .instructions {
                                    color: #6b7280;
                                    margin-bottom: 1.5rem;
                                }

                                .meeting-times {
                                    display: flex;
                                    flex-direction: column;
                                    gap: 0.75rem;
                                    margin-bottom: 1.5rem;
                                }

                                .meeting-time {
                                    display: block;
                                    cursor: pointer;
                                }

                                .meeting-time input[type="radio"] {
                                    display: none;
                                }

                                .time-content {
                                    display: flex;
                                    align-items: center;
                                    padding: 1rem;
                                    border: 2px solid #e5e7eb;
                                    border-radius: 8px;
                                    transition: all 0.2s ease;
                                }

                                .meeting-time:hover .time-content {
                                    border-color: #93c5fd;
                                    background-color: #f8fafc;
                                }

                                .radio-circle {
                                    width: 1.25rem;
                                    height: 1.25rem;
                                    border: 2px solid #d1d5db;
                                    border-radius: 50%;
                                    margin-right: 1rem;
                                    position: relative;
                                    transition: all 0.2s ease;
                                }

                                .meeting-time input[type="radio"]:checked + .time-content {
                                    border-color: #3b82f6;
                                    background-color: #eff6ff;
                                }

                                .meeting-time input[type="radio"]:checked + .time-content .radio-circle {
                                    border-color: #3b82f6;
                                    background-color: #3b82f6;
                                }

                                .meeting-time input[type="radio"]:checked + .time-content .radio-circle::after {
                                    content: '';
                                    position: absolute;
                                    width: 0.5rem;
                                    height: 0.5rem;
                                    background-color: white;
                                    border-radius: 50%;
                                    top: 50%;
                                    left: 50%;
                                    transform: translate(-50%, -50%);
                                }

                                .time-details {
                                    display: flex;
                                    gap: 2rem;
                                    align-items: center;
                                }

                                .date-group, .time-group {
                                    display: flex;
                                    align-items: center;
                                    gap: 0.5rem;
                                }

                                .icon {
                                    width: 1.25rem;
                                    height: 1.25rem;
                                    color: #6b7280;
                                }

                                .confirm-button {
                                    width: 100%;
                                    padding: 0.75rem 1rem;
                                    background-color: #3b82f6;
                                    color: white;
                                    border: none;
                                    border-radius: 8px;
                                    font-size: 1rem;
                                    font-weight: 500;
                                    cursor: pointer;
                                    transition: background-color 0.2s ease;
                                }

                                .confirm-button:hover {
                                    background-color: #2563eb;
                                }

                                .confirm-button:focus {
                                    outline: none;
                                    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5);
                                }
                            </style>


                            <!-- Final Meeting -->

                            <div class="meeting-card mt-5">
                                @if(isset($meeting))
                                    @if($meeting->final_time)
                                        <div class="final-meeting-details p-4 bg-white rounded-lg shadow">
                                            <h5 class="text-xl font-bold text-gray-800 mb-4">Finalized Meeting Details</h5>
                                            <div class="space-y-3">
                                                <div class="flex items-start">
                                                    <div class="flex-shrink-0">
                                                        <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                    </div>
                                                    <div class="ml-3">
                                                        <p class="text-sm font-medium text-gray-900">Title</p>
                                                        <p class="text-sm text-gray-500">{{ $meeting->title }}</p>
                                                    </div>
                                                </div>

                                                @if($meeting->meeting_link)
                                                    <div class="flex items-start">
                                                        <div class="flex-shrink-0">
                                                            <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                                            </svg>
                                                        </div>
                                                        <div class="ml-3">
                                                            <p class="text-sm font-medium text-gray-900">Meeting Link</p>
                                                            <a href="{{ $meeting->meeting_link }}" target="_blank" class="text-sm text-blue-600 hover:text-blue-800">Join Meeting</a>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="flex items-start">
                                                    <div class="flex-shrink-0">
                                                        <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                    </div>
                                                    <div class="ml-3">
                                                        <p class="text-sm font-medium text-gray-900">Final Time</p>
                                                        <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($meeting->final_time)->format('F j, Y, g:i A') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="pending-meeting-details p-4 bg-white rounded-lg shadow">
                                            <h5 class="text-xl font-bold text-gray-800 mb-4">Proposed Meeting Times</h5>

                                            <div class="space-y-4">
                                                @foreach(['time1', 'time2', 'time3'] as $time)
                                                    <div class="flex items-start">
                                                        <div class="flex-shrink-0">
                                                            <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                            </svg>
                                                        </div>
                                                        <div class="ml-3">
                                                            <p class="text-sm text-gray-900">{{ ucfirst($time) }}: {{ \Carbon\Carbon::parse($meeting->$time)->format('F j, Y, g:i A') }}</p>
                                                            <p class="text-xs text-gray-500">Votes: {{ $responseCounts[$time] ?? 0 }}</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            @if(!$allMembersResponded)
                                                <div class="mt-4 p-3 bg-yellow-50 rounded-md">
                                                    <p class="text-sm text-yellow-700">
                                                        Waiting for all team members to respond. The meeting time will be finalized automatically once everyone has submitted their preference.
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                            </div>
                        @endif
                        <style>
                            /* Meeting Card Container */
                            .meeting-card {
                                max-width: 800px;
                                margin: 20px auto;
                                font-family: system-ui, -apple-system, sans-serif;
                            }

                            /* Final Meeting Details Section */
                            .final-meeting-details {
                                background-color: white;
                                border-radius: 0.75rem;
                                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.06);
                                padding: 1.5rem;
                                border: 1px solid #e5e7eb;
                            }

                            .final-meeting-details h5 {
                                color: #1f2937;
                                font-size: 1.25rem;
                                font-weight: 600;
                                margin-bottom: 1.5rem;
                                padding-bottom: 0.75rem;
                                border-bottom: 1px solid #e5e7eb;
                            }

                            /* Flex Container for Meeting Details */
                            .flex.items-start {
                                display: flex;
                                align-items: flex-start;
                                margin-bottom: 1rem;
                            }

                            .flex-shrink-0 {
                                flex-shrink: 0;
                            }

                            /* Icon Styles */
                            .h-5.w-5 {
                                height: 1.25rem;
                                width: 1.25rem;
                                color: #6b7280;
                            }

                            /* Text Container */
                            .ml-3 {
                                margin-left: 0.75rem;
                            }

                            /* Text Styles */
                            .text-sm {
                                font-size: 0.875rem;
                                line-height: 1.25rem;
                            }

                            .font-medium {
                                font-weight: 500;
                            }

                            .text-gray-900 {
                                color: #111827;
                            }

                            .text-gray-500 {
                                color: #6b7280;
                            }

                            /* Meeting Link Styles */
                            .text-blue-600 {
                                color: #2563eb;
                                text-decoration: none;
                                transition: color 0.2s;
                            }

                            .text-blue-600:hover {
                                color: #1d4ed8;
                                text-decoration: underline;
                            }

                            /* Pending Meeting Details Section */
                            .pending-meeting-details {
                                background-color: white;
                                border-radius: 0.75rem;
                                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                                padding: 1.5rem;
                                border: 1px solid #e5e7eb;
                            }

                            .pending-meeting-details h5 {
                                color: #1f2937;
                                font-size: 1.25rem;
                                font-weight: 600;
                                margin-bottom: 1.5rem;
                                padding-bottom: 0.75rem;
                                border-bottom: 1px solid #e5e7eb;
                            }

                            /* Time Slots Container */
                            .space-y-4 > * + * {
                                margin-top: 1rem;
                            }

                            /* Individual Time Slot */
                            .space-y-4 .flex {
                                padding: 0.75rem;
                                border-radius: 0.5rem;
                                background-color: #f9fafb;
                                transition: background-color 0.2s;
                            }

                            .space-y-4 .flex:hover {
                                background-color: #f3f4f6;
                            }

                            /* Vote Count */
                            .text-xs {
                                font-size: 0.75rem;
                                line-height: 1rem;
                            }

                            /* Waiting Message Container */
                            .bg-yellow-50 {
                                background-color: #fffbeb;
                                border-radius: 0.375rem;
                                padding: 1rem;
                                margin-top: 1rem;
                            }

                            .text-yellow-700 {
                                color: #b45309;
                            }

                            /* Responsive Design */
                            @media (max-width: 640px) {
                                .meeting-card {
                                    margin: 1rem;
                                }

                                .final-meeting-details,
                                .pending-meeting-details {
                                    padding: 1rem;
                                }

                                .space-y-4 .flex {
                                    flex-direction: column;
                                }

                                .space-y-4 .flex .ml-3 {
                                    margin-left: 0;
                                    margin-top: 0.5rem;
                                }
                            }

                            /* Loading State */
                            .loading-indicator {
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                padding: 2rem;
                                color: #6b7280;
                            }

                            /* Success States */
                            .success-badge {
                                display: inline-flex;
                                align-items: center;
                                padding: 0.25rem 0.75rem;
                                background-color: #059669;
                                color: white;
                                border-radius: 9999px;
                                font-size: 0.875rem;
                                font-weight: 500;
                            }

                            /* Meeting Time Slots Hover Effects */
                            .time-slot {
                                transition: transform 0.2s, box-shadow 0.2s;
                            }

                            .time-slot:hover {
                                transform: translateY(-2px);
                                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                            }

                            /* Vote Count Badge */
                            .vote-count {
                                display: inline-flex;
                                align-items: center;
                                padding: 0.125rem 0.5rem;
                                background-color: #e5e7eb;
                                border-radius: 9999px;
                                font-size: 0.75rem;
                                font-weight: 500;
                                color: #4b5563;
                            }

                            /* Meeting Link Button */
                            .meeting-link-button {
                                display: inline-flex;
                                align-items: center;
                                gap: 0.5rem;
                                padding: 0.5rem 1rem;
                                background-color: #2563eb;
                                color: white;
                                border-radius: 0.375rem;
                                font-size: 0.875rem;
                                font-weight: 500;
                                transition: background-color 0.2s;
                            }

                            .meeting-link-button:hover {
                                background-color: #1d4ed8;
                            }

                            .meeting-link-button svg {
                                height: 1rem;
                                width: 1rem;
                            }

                            /* Divider */
                            .divider {
                                height: 1px;
                                background-color: #e5e7eb;
                                margin: 1rem 0;
                            }

                            /* Status Indicators */
                            .status-indicator {
                                display: inline-flex;
                                align-items: center;
                                gap: 0.375rem;
                                font-size: 0.875rem;
                                color: #6b7280;
                            }

                            .status-indicator::before {
                                content: '';
                                display: block;
                                width: 0.5rem;
                                height: 0.5rem;
                                border-radius: 9999px;
                                background-color: currentColor;
                            }

                            .status-indicator.pending {
                                color: #eab308;
                            }

                            .status-indicator.finalized {
                                color: #059669;
                            }
                        </style>
                            <!-- Final Meeting -->

{{--                        @if ($meeting && !$meeting->isExpired() && auth()->id() === $meeting->created_by)--}}
                        @if ($meeting &&  auth()->id() === $meeting->created_by)
                            <form action="{{ route('normal-user.meeting.delete', $meeting->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete Meeting</button>
                            </form>
                        @endif


                        @endif



                    </div>
                </div>

            </div>


            <div id="add_project" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Create Project</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Project Name</label>
                                            <input class="form-control" value="" type="text">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Client</label>
                                            <select class="select">
                                                <option>Client 1</option>
                                                <option>Client 2</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <div class="cal-icon">
                                                <input class="form-control " type="date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <div class="cal-icon">
                                                <input class="form-control " type="date">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Rate</label>
                                            <input placeholder="$50" class="form-control" value="" type="text">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <select class="select">
                                                <option>Hourly</option>
                                                <option selected>Fixed</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Priority</label>
                                            <select class="select">
                                                <option selected>High</option>
                                                <option>Medium</option>
                                                <option>Low</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea rows="4" class="form-control" placeholder="Enter your message here"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Upload Files</label>
                                    <input class="form-control" type="file">
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->



    <!-- Task Table -->

    <div class="main">
        <div class="main-content client project">
            <div class="row">
                <div class="col-8 col-xl-12">
                    <div class="box pd-0">
                        <div class="tab-menu-heading hremp-tabs p-0">
                            <div class="tabs-menu1">
                                <!-- Tabs -->
                                <ul class="nav panel-tabs w-100 d-flex justify-content-between">
                                    <li><a href="#tab5" class="active" data-bs-toggle="tab">Tasks</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="d-flex justify-content-between align-items-center px-3 py-2">
                            <h5 class="m-0">Task List</h5>
                            @if (auth()->id() == $researchProject->created_by)
                            <a href="{{route('normal-user.research-task.create', ['researchProjectId' => $researchProject->id])}}" class="btn btn-success" type="button">
                                <i class="bx bx-plus me-2"></i>Add Task
                            </a>
                            @endif
                        </div>

                        <div class="panel-body tabs-menu-body hremp-tabs1 p-0">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab5">
                                    <div class="box-body">
                                        <table class="table table-vcenter text-nowrap table-bordered dataTable no-footer" id="task-profile-1" role="grid">

                                            <thead>
                                            <tr class="top">
                                                <th class="border-bottom-0 text-center sorting fs-14 font-w500" tabindex="0" aria-controls="task-profile-1" rowspan="1" colspan="1" style="width: 26.6562px;">No</th>
                                                <th class="border-bottom-0 sorting fs-14 font-w500" tabindex="0" aria-controls="task-profile-1" rowspan="1" colspan="1" style="width: 222.312px;">Task</th>
                                                <th class="border-bottom-0 sorting fs-14 font-w500" tabindex="0" aria-controls="task-profile-1" rowspan="1" colspan="1" style="width: 84.8281px;">Assigned To</th>
                                                <th class="border-bottom-0 sorting fs-14 font-w500" tabindex="0" aria-controls="task-profile-1" rowspan="1" colspan="1" style="width: 87.9844px;">Deadline</th>
                                                <th class="border-bottom-0 sorting fs-14 font-w500" tabindex="0" aria-controls="task-profile-1" rowspan="1" colspan="1" style="width: 110.719px;">Work Status</th>
                                                <th class="border-bottom-0 sorting_disabled fs-14 font-w500" rowspan="1" colspan="1" style="width: 145.391px;">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if($researchProject->tasks->isEmpty())
                                                <p class="no-tasks-message">No tasks available for this project.</p>
                                                <style>
                                                    .no-tasks-message {
                                                        margin-left: 33px;  /* Apply left margin */
                                                        font-size: 16px;    /* Adjust font size for better readability */
                                                        font-weight: 500;   /* Slightly bold text */
                                                        color: #333;        /* Dark text color for good contrast */
                                                        background-color: #f9f9f9; /* Light background to make it stand out */
                                                        padding: 10px 20px; /* Add padding to make it look more polished */
                                                        border-left: 4px solid #007bff; /* Add a blue left border for emphasis */
                                                        border-radius: 8px; /* Slightly rounded corners */
                                                        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Add a soft shadow for depth */
                                                        max-width: 500px; /* Limit the width to avoid it stretching too much */
                                                        margin-top: 20px; /* Add space above the message */
                                                    }
                                                </style>
                                            @else
                                                @foreach($researchProject->tasks as $task)
                                                    <tr class="odd">
                                                        <td class="text-center">Task {{$loop->iteration}}</td>
                                                        <td>
                                                            <a href="#" class="d-flex "> <span>{{ $task->title }}</span> </a>
                                                        </td>
                                                        <td><span class="badge badge-danger-light">{{ $task->teamMember->user->name ?? 'Unassigned' }}</span></td>
                                                        <td>{{ \Carbon\Carbon::parse($task->due_date)->format('d-m-Y') }}</td>
                                                        <td>
    <span class="badge
        @switch($task->status)
            @case(1)
                badge-danger  {{-- Red background for Not Started --}}
                @break
            @case(2)
                badge-warning {{-- Yellow background for In Progress --}}
                @break
            @case(3)
                badge-success {{-- Green background for Completed --}}
                @break
            @default
                badge-secondary {{-- Default background for Unknown --}}
        @endswitch">
        @switch($task->status)
            @case(1)
                Not Started
                @break
            @case(2)
                In Progress
                @break
            @case(3)
                Completed
                @break
            @default
                Unknown
        @endswitch
    </span>
                                                        </td>

                                                        <td>
                                                            <div class="dropdown ml-14">
                                                                <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class='bx bx-dots-vertical-rounded fs-22'></i>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    @if (auth()->id() == $researchProject->created_by)

                                                                    <!-- Edit Option -->
                                                                    <a class="dropdown-item" href="{{ route('normal-user.research-task.edit',['id'=>$task->id]) }}">
                                                                        <i class="bx bx-edit me-2"></i> Edit
                                                                    </a>
                                                                    @endif
                                                                    <!-- Detail Option -->
                                                                    <a class="dropdown-item" href="{{ route('normal-user.research-task.detail', ['id'=>$task->id]) }}">
                                                                        <i class="bx bx-detail me-2"></i> Detail
                                                                    </a>

                                                                        <!-- Delete Option -->
                                                                        <a class="dropdown-item" href="{{ route('normal-user.research-task.delete',['id'=>$task->id]) }}">
                                                                            <i class="bx bx-trash"></i> Delete
                                                                        </a>
                                                                </div>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- End Task Table -->



    <!-- Research Collaboration Project Detail-->
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/jquery/jquery.min.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/jquery/jquery-ui.min.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/moment/min/moment.min.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/apexcharts/apexcharts.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/peity/jquery.peity.min.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/chart.js/Chart.bundle.min.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/owl.carousel/owl.carousel.min.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/simplebar/simplebar.min.js"></script>

    <!-- APP JS -->
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/js/main.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/js/shortcode.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/js/script.js"></script>
    <!-- Research Collaboration Project Detail-->

    <!-- Research Collaboration Task Table-->
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/bootstrap-datepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/js/countto.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/date-picker/datepicker.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/rating/js/custom-ratings.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/rating/js/jquery.barrating.js"></script>
    <script src="{{asset('/')}}normal-user-assets/research-project-assets/libs/circle-progress/circle-progress.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Research Collaboration Calendar-->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: '500px',  // Set a specific height here
                contentHeight: '500px',  // Ensure content height matches the specified height
                aspectRatio: 1.5,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek,dayGridDay'
                },
                events: {!! json_encode($events) !!}
            });
            calendar.render();
        });

    </script>
    <!-- FullCalendar JavaScript -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>


    <script>
        $(function() {
            $("#due_date").datepicker({
                dateFormat: 'dd-mm-yy', // Format: DD-MM-YYYY
                showButtonPanel: true,
                changeMonth: true,
                changeYear: true
            });
        });
    </script>

    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
    <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
    <style>
        /* Custom styling for the calendar container */
        .calendar-container {
            background-color: #ffffff;
            border: 1px solid #e5e7eb; /* Light border for modern appearance */
            border-radius: 0.75rem; /* Rounded corners */
            padding: 1rem; /* Uniform padding */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }
        #calendar {
            max-width: 700px;
            margin: 0 auto;
        }
    </style>

    <!-- Research Collaboration Calendar-->

    <!-- Research Collaboration Task Table-->
    <!-- Research Collaboration Meeting-->


@endsection
