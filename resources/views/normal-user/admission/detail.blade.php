@extends('normal-user.master')
@extends('normal-user.message')

@section('right-sidebar')
    <!-- sidebar is not available -->
@endsection

@section('title','Admission Circular Detail')

@section('body')

    <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
        <div class="main-content">
            <div class="d-flex align-items-center mb-4">
                <a href="{{route('normal-user.admission.index')}}" class="material-icons text-dark text-decoration-none m-none me-3">arrow_back</a>
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
                <div class="bg-white p-4 feed-item rounded-4 mb-4 shadow-sm">
                    <div class="d-flex">
                        @if($admissionCircular->image)
                        <img src="{{ asset($admissionCircular->image) }}" class="img-fluid rounded-circle user-img" alt="profile-logo">
                        @endif
                            <div class="d-flex ms-3 align-items-start w-100">
                            <div class="w-100">
                                <div class="d-flex align-items-center justify-content-between">
                                    <a href="profile.html" class="text-decoration-none d-flex align-items-center">
                                        <h6 class="fw-bold mb-0 text-body">{{ $admissionCircular->university_name }}</h6>
                                        <span class="ms-2 material-icons bg-primary p-0 md-16 fw-bold text-white rounded-circle ov-icon">done</span>
                                        <small class="text-muted ms-2">@shay-jordon</small>
                                    </a>
                                    <p class="text-muted mb-0">{{ $admissionCircular->created_at->format('d F Y') }}</p>
                                </div>

                                <div class="my-3">
                                    <p class="fw-bold text-primary">{{ $admissionCircular->title }}</p>
                                    <ul class="list-unstyled mb-3">
                                        <li>{!! $admissionCircular->description !!}</li>
                                    </ul>

                                    <!-- New Section for Additional Details -->
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between">
                                            <div class="me-3">
                                                <p><strong>Total Fees:</strong> ${{$admissionCircular->total_fees}}</p>
                                                <p><strong>Minimum GPA Required:</strong> {{$admissionCircular->min_gpa_req}}</p>
                                                <p><strong>Application Start Date:</strong> {{ \Carbon\Carbon::parse($admissionCircular->start_date)->format('d F Y') }}</p>
                                                <p><strong>Application End Date:</strong> {{ \Carbon\Carbon::parse($admissionCircular->end_date)->format('d F Y') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Image and Attachment Section -->
                                    @if($admissionCircular->attachment)
                                        <div class="mb-3">
                                            <a href="{{ asset($admissionCircular->attachment) }}" class="text-decoration-none" download>
                                                <i class="material-icons text-primary me-1">attach_file</i>Download Attachment
                                            </a>
                                        </div>
                                    @endif


                                    <div class="bg-white p-3 feed-item rounded-4 mb-3 shadow-sm">
                                        <div class="d-flex">
                                            <div class="d-flex ms-3 align-items-start w-100">
                                                <div class="w-100">
                                                    <!-- Admission Circular Details -->
                                                    <div class="my-2">
                                                        <!-- Apply for Admission Button -->
                                                        <div class="d-flex align-items-center mb-3 justify-content-center">
                                                            <button class="btn btn-primary fw-bold rounded-4 px-4 py-2" type="button" data-bs-toggle="modal" data-bs-target="#admissionModal">
                                                                Apply for Admission
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Add more comments as needed -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Admission Form Modal -->
                <div class="modal fade" id="admissionModal" tabindex="-1" aria-labelledby="admissionModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="admissionModalLabel">University Admission Application</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>


                            <div class="modal-body">
                                <form action="{{route('normal-user.admission.application.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <!-- Personal Information Section -->
                                    <h6 class="text-primary">University Name</h6>
                                    <div class="mb-3">
                                        <label for="universityName" class="form-label">University Name</label>
                                        <input type="text" class="form-control" id="universityName" value="{{ $admissionCircular->university->name }}" readonly>
                                        <input type="hidden" value="{{ $admissionCircular->university->id }}" class="form-control" name="university_id" required>
                                    </div>
                                    <input type="hidden" value="{{$admissionCircular->id}}" class="form-control" name="admission_circular_id" required>
                                    <h6 class="text-primary">Personal Information</h6>
                                    <div class="mb-3">
                                        <label for="fullName" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="fullName" name="full_name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" name="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="dob" class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" id="dob" name="dob" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nationality" class="form-label">Nationality</label>
                                        <input type="text" class="form-control" id="nationality" name="nationality" required>
                                    </div>

                                    <!-- Academic Information Section -->
                                    <h6 class="text-primary mt-4">Academic Information</h6>
                                    <div class="mb-3">
                                        <label for="prevEducation" class="form-label">Previous Education</label>
                                        <input type="text" class="form-control" id="prevEducation" name="prev_education" placeholder="High School, College, etc." required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="gpa" class="form-label">GPA/Percentage Marks</label>
                                        <input type="text" class="form-control" id="gpa" name="gpa" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="testScores" class="form-label">Standardized Test Scores (if applicable)</label>
                                        <input type="text" class="form-control" id="testScores" name="test_scores" placeholder="SAT, ACT, GRE, GMAT, etc.">
                                    </div>

                                    <!-- Program Information Section -->
                                    <h6 class="text-primary mt-4">Program Information</h6>
                                    <div class="mb-3">
                                        <label for="program" class="form-label">Program of Interest</label>
                                        <input type="text" class="form-control" id="subjectCategoryName" value="{{ $admissionCircular->subjectCategory->name }}" readonly>
                                        <input type="hidden" value="{{ $admissionCircular->subjectCategory->id }}" class="form-control" name="subject_category_id" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="startDate" class="form-label">Intended Start Date</label>
                                        <input type="month" class="form-control" id="startDate" name="start_date" required>
                                    </div>

                                    <!-- Supporting Documents Section -->
                                    <h6 class="text-primary mt-4">Supporting Documents</h6>
                                    <div class="mb-3">
                                        <label for="transcripts" class="form-label">Upload Academic Transcripts</label>
                                        <input type="file" class="form-control" id="transcript" name="transcript" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="resume" class="form-label">Upload Resume/CV (Optional)</label>
                                        <input type="file" class="form-control" id="resume" name="resume">
                                    </div>
                                    <div class="mb-3">
                                        <label for="recommendationLetters" class="form-label">Recommendation Letters (Optional)</label>
                                        <input type="file" class="form-control" id="recommendationLetter" name="recommendation_letter" multiple>
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary w-100">Submit Application</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </main>

    <aside class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-6 col-12" style="margin-top: 50px;">
        <div class="fix-sidebar">
            <div class="side-trend lg-none">
                <!-- Search Tab -->
                <div class="sticky-sidebar2 mb-3">


                    <div class="bg-white rounded-4 overflow-hidden shadow-sm mb-4">
                        <h6 class="fw-bold text-body p-3 mb-0 border-bottom">Frequently Asked Questions (FAQs)</h6>

                        <!-- FAQ  -->
                        <div class="accordion" id="faqAccordion">
                            @if($faqs->isEmpty())
                                <p class="text-muted">No FAQs available for this admission circular.</p>
                            @else
                                @foreach($faqs as $index => $faq)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading{{ $index }}">
                                            <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}"
                                                    type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapse{{ $index }}"
                                                    aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                                    aria-controls="collapse{{ $index }}">
                                                <strong>{{ $faq->question }}</strong>
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $index }}"
                                             class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                             aria-labelledby="heading{{ $index }}"
                                             data-bs-parent="#faqAccordion">
                                            <div class="accordion-body">
                                                {!! $faq->answer !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>



                    </div>



{{--                    <div class="bg-white rounded-4 overflow-hidden shadow-sm account-follow mb-4">--}}
{{--                        <h6 class="fw-bold text-body p-3 mb-0 border-bottom">Connect With Alumni</h6>--}}
{{--                        <!-- Account Item -->--}}
{{--                        <div class="p-3 border-bottom d-flex text-dark text-decoration-none account-item">--}}
{{--                            <a href="profile.html">--}}
{{--                                <img src="{{asset('/')}}normal-user-assets/assets/img/rmate5.jpg" class="img-fluid rounded-circle me-3" alt="profile-img">--}}
{{--                            </a>--}}
{{--                            <div>--}}
{{--                                <p class="fw-bold mb-0 pe-3 d-flex align-items-center"><a class="text-decoration-none text-dark" href="profile.html">Webartinfo</a><span class="ms-2 material-icons bg-primary p-0 md-16 fw-bold text-white rounded-circle ov-icon">done</span></p>--}}
{{--                                <div class="text-muted fw-light">--}}
{{--                                    <p class="mb-1 small">@abcdsec</p>--}}
{{--                                    <span class="text-muted d-flex align-items-center small"><span class="material-icons me-1 small">open_in_new</span>Promoted</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="ms-auto">--}}
{{--                                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">--}}
{{--                                    <input type="checkbox" class="btn-check" id="btncheck7">--}}
{{--                                    <label class="btn btn-outline-primary btn-sm px-3 rounded-pill" for="btncheck7"><span class="follow">+ Follow</span><span class="following d-none">Following</span></label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- Account Item -->--}}
{{--                        <div class="p-3 border-bottom d-flex text-dark text-decoration-none account-item">--}}
{{--                            <a href="profile.html">--}}
{{--                                <img src="{{asset('/')}}normal-user-assets/assets/img/rmate4.jpg" class="img-fluid rounded-circle me-3" alt="profile-img">--}}
{{--                            </a>--}}
{{--                            <div>--}}
{{--                                <p class="fw-bold mb-0 pe-3 d-flex align-items-center"><a class="text-decoration-none text-dark" href="profile.html">John Smith</a><span class="ms-2 material-icons bg-primary p-0 md-16 fw-bold text-white rounded-circle ov-icon">done</span></p>--}}
{{--                                <div class="text-muted fw-light">--}}
{{--                                    <p class="mb-1 small">@johnsmith</p>--}}
{{--                                    <span class="text-muted d-flex align-items-center small">Designer</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="ms-auto">--}}
{{--                                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">--}}
{{--                                    <input type="checkbox" class="btn-check" id="btncheck8">--}}
{{--                                    <label class="btn btn-outline-primary btn-sm px-3 rounded-pill" for="btncheck8"><span class="follow">+ Follow</span><span class="following d-none">Following</span></label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
                </div>
            </div>
        </div>
    </aside>

@endsection
