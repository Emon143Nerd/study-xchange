@extends('normal-user.master')

@section('right-sidebar')
    <!-- sidebar is not available -->
@endsection

@section('title','Job Circular Detail')

@section('body')


    <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
        <div class="main-content">
            <div class="d-flex align-items-center mb-4">
                <a href="{{route('normal-user.job.index')}}" class="material-icons text-dark text-decoration-none m-none me-3">arrow_back</a>
                <p class="ms-2 mb-0 fw-bold text-body fs-6">Back To List</p>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <!-- Feeds -->
            <div class="feeds">
                <!-- Feed Item -->
                <div class="container mt-5">
                    <!-- Hero Section -->
                    <div class="card shadow-lg rounded-4">
                        <div class="card-body p-5">
                            <div class="d-flex align-items-center">
                                <!-- Company Logo -->
                                <img src="{{ asset($jobCircular->company->logo) }}"
                                     alt="Company Logo"
                                     class="rounded-circle shadow-sm"
                                     style="width: 80px; height: 80px; object-fit: cover;">

                                <div class="ms-4">
                                    <!-- Job Title and Company Info -->
                                    <h2 class="fw-bold mb-1">{{ $jobCircular->title }}</h2>
                                    <p class="text-muted mb-2">
                                        <i class="bi bi-building me-1"></i>{{ $jobCircular->company->name }}
                                        <span class="mx-2">•</span>
                                        <i class="bi bi-geo-alt-fill me-1"></i>{{ $jobCircular->location }}
                                    </p>
                                    <span class="badge bg-primary rounded-pill px-3 py-1">{{ $jobCircular->type }}</span>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-end mt-4">
{{--                                <button class="btn btn-outline-primary me-2">--}}
{{--                                    <i class="bi bi-bookmark me-1"></i> Save Job--}}
{{--                                </button>--}}
{{--                                <button class="btn btn-primary">--}}
{{--                                    <i class="bi bi-send-fill me-1"></i> Apply Now--}}
{{--                                </button>--}}
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#jobModal">
                                    Apply Now
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Job Details Section -->
                    <div class="card mt-4 shadow-sm rounded-4">
                        <div class="card-body p-5">
                            <!-- Job Description -->
                            <h4 class="fw-bold mb-4 text-primary">Job Description</h4>
                            <p class="text-muted fs-5">{!! $jobCircular->description !!}</p>


                            <!-- Key Responsibilities -->
                            <h5 class="fw-bold mt-5 text-primary">Key Responsibilities</h5>
                            <ul class="list-unstyled mt-3">
                                <p class="text-muted fs-5">{!! $jobCircular->responsibilities !!}</p>

                            </ul>

                            <!-- Requirements -->
                            <h5 class="fw-bold mt-5 text-primary">Requirements</h5>
                            <ul class="list-unstyled mt-3">
                                <p class="text-muted fs-5">{!! $jobCircular->requirement !!}</p>

                            </ul>
                        </div>
                    </div>

                    <!-- About Company Section -->
                    <div class="card shadow-sm rounded-4 p-4 mb-5 mt-4">
                        <div class="row g-4">
                            <!-- Company Logo -->
                            <div class="col-md-4 text-center">
                                <img src="{{ asset($jobCircular->company->image) }}"
                                     alt="{{ $jobCircular->company->name }}"
                                     class="img-fluid rounded-3 shadow-sm"
                                     style="max-height: 200px; object-fit: cover;">
                            </div>

                            <!-- Company Details -->
                            <div class="col-md-8">
                                <h4 class="fw-bold mb-3 text-primary">About the Company</h4>

                                <!-- Company Name -->
                                <p class="text-dark fs-4 mb-2">
                                    <strong>Company Name:</strong>
                                    {{ $jobCircular->company->name }}
                                </p>

                                <!-- Industry -->
                                <p class="text-muted fs-5 mb-2">
                                    <strong>Industry:</strong>
                                    {{ $jobCircular->company->industry }}
                                </p>

                                <!-- About -->
                                <p class="text-muted fs-5 mb-2">
                                    <strong>About:</strong>
                                    {!! $jobCircular->company->about ?? 'Description not available.' !!}
                                </p>

                                <!-- Location -->
                                <p class="text-muted fs-5 mb-2">
                                    <strong>Location:</strong>
                                    {{ $jobCircular->company->location ?? 'Location not specified.' }}
                                </p>

                            </div>
                        </div>
                    </div>



                    <!-- Sidebar Section -->

                </div>


                <!-- Job Circular Detail End -->



                <!-- Admission Form Modal -->
                <div class="modal fade" id="jobModal" tabindex="-1" aria-labelledby="jobModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="jobModalLabel">Job Application</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>


                            <!-- Job Application -->

                            <div class="modal-body">
                                <form action="{{ route('normal-user.application.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <!-- Job Circular Information -->

                                    <input type="hidden" class="form-control" id="jobCircularId" name="job_circular_id" value="{{ old('job_circular_id', $jobCircular->id ?? '') }}" required>
                                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ old('user_id', auth()->user()->id ?? '') }}" required>


                                    <!-- Personal Information Section -->
                                    <h6 class="text-primary mt-4">Personal Information</h6>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" value="{{ old('name', auth()->user()->name ?? '') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" value="{{ old('phone', auth()->user()->phone ?? '') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email', auth()->user()->email ?? '') }}" required>
                                    </div>


                                    <!-- Education Section -->
                                    <h6 class="text-primary mt-4">Education Information from your Profile</h6>
                                    @foreach($userEducations as $education)
                                        <input type="hidden" name="education[]" value="{{ old('education[]', json_encode($education)) }}">
                                    @endforeach

                                    <!-- Skills Section -->
                                    <h6 class="text-primary mt-4">Skills Information from your Profile</h6>
                                    @foreach($userSkills as $skill)
                                        <input type="hidden" name="skill[]" value="{{ old('skill[]', json_encode($skill)) }}">
                                    @endforeach

                                    <!-- Work Experience Section -->
                                    <h6 class="text-primary mt-4">Work Experience from your Profile</h6>
                                    @foreach($userWorkExperiences as $workExperience)
                                        <input type="hidden" name="work_experience[]" value="{{ old('work_experience[]', json_encode($workExperience)) }}">
                                    @endforeach

                                    <!-- Certifications Section -->
                                    <h6 class="text-primary mt-4">Certifications from your Profile</h6>
                                    @foreach($userCertifications as $certification)
                                        <input type="hidden" name="certifications[]" value="{{ old('certifications[]', json_encode($certification)) }}">
                                    @endforeach

                                    <!-- Job Preferences Section -->
                                    <h6 class="text-primary mt-4">Job Preferences from your Profile</h6>
                                    @foreach($userJobPreferences as $jobPreference)
                                        <input type="hidden" name="job_preference[]" value="{{ old('job_preference[]', json_encode($jobPreference)) }}">
                                    @endforeach


                                    <!-- Resume Upload -->
                                    <h6 class="text-primary mt-4">Resume</h6>
                                    <div class="mb-3">
                                        <label for="resume" class="form-label">Upload Resume</label>
                                        <input type="file" class="form-control" id="resume" name="resume" required>
                                    </div>

                                    <!-- Image Upload -->
                                    <h6 class="text-primary mt-4">Upload Image</h6>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Upload Image</label>
                                        <input type="file" class="form-control" id="image" name="image" required>
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary w-100">Submit Application</button>
                                </form>
                            </div>


                            <!-- Job Application -->




                        </div>
                    </div>
                </div>



            </div>
        </div>
    </main>


    <!-- Sidebar -->
    <aside class="col col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12 order-xl-3 order-lg-3 mt-5">
        <div class="fix-sidebar">
            <div class="side-trend">
                <!-- Salary & Additional Details -->
                <div class="card shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">Salary & Benefits</h5>
                        <p class="mb-2"><i class="bi bi-currency-dollar me-2"></i><strong>{{ $jobCircular->salary_range }}</strong></p>
                        <p><i class="bi bi-clock me-2"></i>Application Deadline:
                            <strong class="text-danger">{{ \Carbon\Carbon::parse($jobCircular->application_deadline)->format('d F, Y') }}</strong>
                        </p>
                    </div>
                </div>

                <!-- Analytics -->
                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-body py-3">
                        <div class="row g-0">
                            <div class="col-6 border-end">
                                <div class="text-center p-2">
                                    <p class="text-muted small text-uppercase mb-1">Views</p>
                                    <span class="fs-5 fw-semibold">{{ $jobCircular->hit_count }}</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center p-2">
                                    <p class="text-muted small text-uppercase mb-1">Applications</p>
                                    <span class="fs-5 fw-semibold">{{ $applicationCount }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Similar Jobs -->
                <div class="card shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">Other Jobs</h5>
                        @foreach ($otherJobCirculars as $otherJob)
                            <!-- Job Card -->
                            <a href="{{ route('normal-user.job.detail', $otherJob->id) }}" class="text-decoration-none">
                                <div class="card mb-3" style="border: 1px solid #ddd; border-radius: 8px;"> <!-- Added border and rounded corners -->
                                    <img src="{{ asset($otherJob->image) }}" class="card-img-top" alt="{{ $otherJob->title }}" style="height: 100px; object-fit: cover;">
                                    <div class="card-body">
                                        <h6 class="card-title">{{ $otherJob->title }}</h6>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>




            </div>
        </div>
    </aside>


    <style>
        .card {
            border: none;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .text-muted {
            color: #6c757d !important;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .badge {
            font-size: 14px;
            padding: 8px 12px;
        }

    </style>

@endsection
