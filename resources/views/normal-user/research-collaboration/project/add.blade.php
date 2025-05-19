@extends('normal-user.master')
@extends('normal-user.message')

@section('tb-site-sidebar')
    <!-- sidebar is not available -->
@endsection

@section('title','Add Project')

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
                        <form action="{{ route('normal-user.research-project.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                            <div class="row">
                                <input type="hidden" name="created_by" value="{{ auth()->id() }}">
                                <div class="col-md-6 col-sm-12 mb-24">
                                    <div class="form-group"> <label class="form-label">Project Title</label>
                                        <input class="form-control" name="title" placeholder="Project Title">
                                        @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 mb-24">
                                    <div class="form-group"> <label class="form-label">Department</label>
                                        <input class="form-control" name="department" placeholder="Department">
                                        @error('department')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 mb-24">
                                    <div class="form-group"> <label class="form-label">Project Objective</label>
                                        <input class="form-control" name="objective" placeholder="Project Objective">
                                        @error('objective')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 mb-24">
                                    <label class="form-label">From:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"> <i class='bx bx-calendar'></i> </div>
                                        </div>
                                        <input id="datepicker" class="form-control fc-datepicker" name="timeline_from" placeholder="DD-MM-YYYY" type="text">
                                        @error('timeline_from')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 mb-24">
                                    <label class="form-label">To:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"> <i class='bx bx-calendar'></i> </div>
                                        </div>
                                        <input id="datepicker" class="form-control fc-datepicker" name="timeline_to" placeholder="DD-MM-YYYY" type="text">
                                        @error('timeline_to')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 mb-24">
                                        <div class="form-group">
                                            <label class="form-label">Team Members</label>
                                            <div id="team-members-container">
                                                <!-- Loop through existing team members -->
                                                @foreach($researchProject->teamMembers as $teamMember)
                                                    <div class="input-group mb-3">
                                                        <input type="email" name="research_team_members[]" class="form-control"
                                                               value="{{ $teamMember->email }}"
                                                               placeholder="Enter Team Member's Email"
                                                               oninvalid="this.setCustomValidity('Please enter a valid email address')"
                                                               oninput="this.setCustomValidity('')" required>
                                                        <button type="button" class="btn btn-danger ms-2" onclick="removeTeamMember(this)">Remove</button>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <!-- Button to add a new team member -->
                                            <button type="button" class="btn btn-success mt-3" onclick="addTeamMember()">Add Another Team Member</button>

                                            <!-- Error for team members -->
                                            @error('research_team_members')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                            <!-- Error for individual team member emails -->
                                            @error('research_team_members.*')
                                            <br><span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            <div class="form-group mb-24"> <label class="form-label">Description:</label>
                                <textarea class="form-control" name="description" cols="30" rows="10"></textarea>
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
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="custom-controls-stacked d-lg-flex align-items-center">
                                        <label class="form-label mt-1 fs-18 font-w500 color-primary">Work Status :</label>
                                        <label class="custom-control custom-radio success me-4">
                                            <input type="radio" class="custom-control-input" name="status" value="1" {{ old('status', 1) == 1 ? 'checked' : '' }}>
                                            <span class="custom-control-label">Pending</span>
                                        </label>
                                        <label class="custom-control custom-radio success me-4">
                                            <input type="radio" class="custom-control-input" name="status" value="2" {{ old('status') == 2 ? 'checked' : '' }}>
                                            <span class="custom-control-label">On Progress</span>
                                        </label>
                                        <label class="custom-control custom-radio success me-4">
                                            <input type="radio" class="custom-control-input" name="status" value="3" {{ old('status') == 3 ? 'checked' : '' }}>
                                            <span class="custom-control-label">Completed</span>
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>
                            <div class="gr-btn mt-15">
                                <button type="submit" class="btn btn-primary btn-lg fs-16">SUBMIT</button>
                                <button type="reset" class="btn btn-danger btn-lg mr-15 fs-16">CLOSE</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>




        </div>
    </div>
    <!-- END MAIN CONTENT -->

    <!-- JavaScript for Adding and Removing Team Members -->
    <script>
        function addTeamMember() {
            const container = document.getElementById('team-members-container');
            const newMember = document.createElement('div');
            newMember.className = 'input-group mb-3';
            newMember.innerHTML = `
            <input type="email" name="research_team_members[]" class="form-control" placeholder="Enter Team Member's Email"
                   oninvalid="this.setCustomValidity('Please enter a valid email address')"
                   oninput="this.setCustomValidity('')" required>
            <button type="button" class="btn btn-danger ms-2" onclick="removeTeamMember(this)">Remove</button>
        `;
            container.appendChild(newMember);
        }

        function removeTeamMember(button) {
            const container = document.getElementById('team-members-container');
            if (container.childElementCount > 1) {
                button.parentElement.remove();
            } else {
                alert("At least one team member is required.");
            }
        }
    </script>

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
