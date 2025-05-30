@extends('normal-user.master')
@extends('normal-user.message')

@section('tb-site-sidebar')
    <!-- sidebar is not available -->
@endsection

@section('title','Add Task')

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

    <!-- MAIN CONTENT -->
    <div class="main">

        <div class="main-content project">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-body">
                            <form action="{{ route('normal-user.research-task.store', ['researchProjectId' => $researchProject->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="research_project_id" value="{{ $researchProject->id }}">

                                <div class="row">
                                <div class="col-md-6 col-sm-12 mb-24">
                                    <div class="form-group">
                                        <label class="form-label">Task Title</label>
                                        <input class="form-control @error('title') border-danger @enderror" name="title" placeholder="Task Title" value="{{ old('title') }}">
                                        @error('title')
                                        <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                    <div class="col-md-6 col-sm-12 mb-24 form-group position-relative">
                                        <label class="form-label">Deadline:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"> <i class='bx bx-calendar'></i> </div>
                                            </div>
                                            <input id="datepicker" class="form-control fc-datepicker {{ $errors->has('due_date') ? 'border-danger' : '' }}" name="due_date" placeholder="DD-MM-YYYY" type="text" value="{{ old('due_date') }}">
                                            @error('due_date')
                                            <span class="position-absolute text-danger" style="top: 50%; right: 10px; transform: translateY(-50%); font-size: 14px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>



                                    <!-- Hidden fields to pass project timeline to JavaScript -->
                                    <input type="hidden" id="timeline_from" value="{{ \Carbon\Carbon::parse($researchProject->timeline_from)->format('d-m-Y') }}">
                                    <input type="hidden" id="timeline_to" value="{{ \Carbon\Carbon::parse($researchProject->timeline_to)->format('d-m-Y') }}">

                                </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-12 mb-24">
                                    <div class="form-group">
                                        <label class="form-label">Team Members</label>
                                        <div id="team-members-container">
                                            <!-- Initial Input Field -->
                                            <div class="input-group mb-3">
                                                <select name="research_team_member_id" class="form-control custom-select select2 select2-hidden-accessible" data-placeholder="Select Client" tabindex="-1" aria-hidden="true" data-select2-id="select2-data-38-9jkg">
                                                    <option label="Select Member" data-select2-id="select2-data-40-q3xu"></option>
                                                    @foreach($teamMembers as $teamMember)
                                                        <option value="{{ $teamMember->id }}" {{ old('research_team_member_id') == $teamMember->id ? 'selected' : '' }}>{{ $teamMember->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('research_team_member_id')
                                                <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-24"> <label class="form-label">Description:</label>
                                <textarea class="form-control @error('description') border-danger @enderror" name="description" cols="30" rows="10">{{ old('description') }}</textarea>
                                @error('description')
                                <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group"> <label class="form-label">Attachment:</label>
                                        <div class="input-group file-browser">
                                            <label class="input-group-append mb-0"> <span class="btn ripple btn-light"> Browse
                                                    <input type="file" name="attachment" class="file-browserinput" style="display: none;">
                                                </span>
                                            </label>
                                        </div>
                                        @error('attachment')
                                        <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="custom-controls-stacked d-lg-flex align-items-center">
                                        <label class="form-label mt-1 fs-18 font-w500 color-primary">Work Status :</label>
                                        <label class="custom-control custom-radio success me-4">
                                            <input type="radio" class="custom-control-input @error('status') border-danger @enderror" name="status" value="1" {{ old('status') == 1 ? 'checked' : '' }}>
                                            <span class="custom-control-label">Pending</span>
                                        </label>
                                        <label class="custom-control custom-radio success me-4">
                                            <input type="radio" class="custom-control-input @error('status') border-danger @enderror" name="status" value="2" {{ old('status') == 2 ? 'checked' : '' }}>
                                            <span class="custom-control-label">On Progress</span>
                                        </label>
                                        <label class="custom-control custom-radio success me-4">
                                            <input type="radio" class="custom-control-input @error('status') border-danger @enderror" name="status" value="3" {{ old('status') == 3 ? 'checked' : '' }}>
                                            <span class="custom-control-label">Completed</span>
                                        </label>
                                        @error('status')
                                        <span class="text-danger" style="font-size: 14px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="gr-btn mt-15">
                                    <button type="submit" class="btn btn-primary btn-lg fs-16">SUBMIT</button>
                                    <button type="reset" class="btn btn-danger btn-lg mr-15 fs-16">CLOSE</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
    <!-- END MAIN CONTENT -->



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
