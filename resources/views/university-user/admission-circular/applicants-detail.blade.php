@extends('university-user.master')

@section('title','Applicants Detail')

@section('body')


    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Applicants Detail</li>
                </ol>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="media-body">
                        <p class="mb-0">{{session('message')}}</p>
                    </div>
                    <div class="row">

                        <div class="container">
                            <div class="card">
                                <div class="card-header">Edit Applicant Details</div>
                                <div class="card-body">
                                    <form action="{{ route('university-user.applicants.update', $applicant->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="full_name" class="form-label">Full Name</label>
                                            <input type="text" class="form-control" name="full_name" id="full_name" value="{{ old('full_name', $applicant->full_name) }}" readonly>
                                            @error('full_name')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $applicant->email) }}" readonly>
                                            @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="dob" class="form-label">Date of Birth</label>
                                            <input type="date" class="form-control" name="dob" id="dob" value="{{ old('dob', $applicant->dob) }}" readonly>
                                            @error('dob')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="nationality" class="form-label">Nationality</label>
                                            <input type="text" class="form-control" name="nationality" id="nationality" value="{{ old('nationality', $applicant->nationality) }}" readonly>
                                            @error('nationality')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="prev_education" class="form-label">Previous Education</label>
                                            <input type="text" class="form-control" name="prev_education" id="prev_education" value="{{ old('prev_education', $applicant->prev_education) }}" readonly>
                                            @error('prev_education')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="gpa" class="form-label">GPA</label>
                                            <input type="number" step="0.01" class="form-control" name="gpa" id="gpa" value="{{ old('gpa', $applicant->gpa) }}" readonly>
                                            @error('gpa')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="subject_category_id" class="form-label">Subject Category</label>
                                            <select class="form-control" name="subject_category_id" id="subject_category_id" disabled>
                                                @foreach($subjectCategories as $category)
                                                    <option value="{{ $category->id }}" {{ old('subject_category_id', $applicant->subject_category_id) == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('subject_category_id')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="transcript" class="form-label">Transcript</label>
                                            <div class="border p-2 rounded bg-light">
                                                @if($applicant->transcript)
                                                    <a href="{{ asset($applicant->transcript) }}" target="_blank" class="btn btn-link">View Transcript</a>
                                                @else
                                                    <p class="text-muted">No Transcript Uploaded</p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="resume" class="form-label">Resume (optional)</label>
                                            <div class="border p-2 rounded bg-light">
                                                @if($applicant->resume)
                                                    <a href="{{ asset($applicant->resume) }}" target="_blank" class="btn btn-link">View Resume</a>
                                                @else
                                                    <p class="text-muted">No Resume Uploaded</p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="recommendation_letter" class="form-label">Recommendation Letter (optional)</label>
                                            <div class="border p-2 rounded bg-light">
                                                @if($applicant->recommendation_letter)
                                                    <a href="{{ asset($applicant->recommendation_letter) }}" target="_blank" class="btn btn-link">View Recommendation Letter</a>
                                                @else
                                                    <p class="text-muted">No Recommendation Letter Uploaded</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="acceptance" class="form-label">Acceptance Status</label>
                                            <select class="form-control" name="acceptance" id="acceptance" required>
                                                <option value="1" {{ old('acceptance', $applicant->acceptance) == 1 ? 'selected' : '' }}>Accepted</option>
                                                <option value="0" {{ old('acceptance', $applicant->acceptance) == 0 ? 'selected' : '' }}>Pending</option>
                                            </select>
                                            @error('acceptance')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update Applicant</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->

@endsection
