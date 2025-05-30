@extends('company-user.master')

@section('title','Job Application Detail')

@section('body')

//
    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Job Application Detail</li>
                </ol>
            </div>
            <!-- Row -->
            <div class="container mt-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Applicant Details</h3>
                    </div>
                    <div class="card-body">
                        <!-- Basic Information -->
                        <h4>Basic Information</h4>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Name:</strong> {{ $jobApplication->name }}
                            </div>
                            <div class="col-md-4">
                                <strong>Email:</strong> {{ $jobApplication->email }}
                            </div>
                            <div class="col-md-4">
                                <strong>Phone:</strong> {{ $jobApplication->phone }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Gender:</strong> {{ $jobApplication->gender == 1 ? 'Male' : 'Female' }}
                            </div>
                            <div class="col-md-4">
                                <strong>Date of Birth:</strong> {{ $jobApplication->date_of_birth ?? 'N/A' }}
                            </div>
                            <div class="col-md-4">
                                <strong>Location:</strong> {{ $jobApplication->location ?? 'N/A' }}
                            </div>
                        </div>
                        <div class="mb-4">
                            <strong>Resume:</strong>
                            @if($jobApplication->resume)
                                <img src="{{ asset($jobApplication->resume) }}" alt="">
{{--                                <a href="{{ asset($jobApplication->resume) }}" target="_blank">Download Resume</a>--}}
                            @else
                                Not Provided
                            @endif
                        </div>
                        <div class="mb-4">
                            <strong>Profile Image:</strong>
                            @if($jobApplication->image)
                                <img src="{{ asset($jobApplication->image) }}" alt="Profile Image" width="150" class="img-thumbnail">
                            @else
                                Not Provided
                            @endif
                        </div>

{{--                        <h4>Education</h4>--}}
{{--                        @if(is_array($education) && count($education))--}}
{{--                            <table class="table table-bordered mb-4">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th>Institution</th>--}}
{{--                                    <th>Degree</th>--}}
{{--                                    <th>Field of Study</th>--}}
{{--                                    <th>Start Date</th>--}}
{{--                                    <th>End Date</th>--}}
{{--                                    <th>Grade</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                @foreach($education as $edu)--}}
{{--                                    <tr>--}}
{{--                                        <td>{{ $edu['institution_name'] ?? 'N/A' }}</td>--}}
{{--                                        <td>{{ $edu['degree'] ?? 'N/A' }}</td>--}}
{{--                                        <td>{{ $edu['field_of_study'] ?? 'N/A' }}</td>--}}
{{--                                        <td>{{ $edu['start_date'] ?? 'N/A' }}</td>--}}
{{--                                        <td>{{ $edu['end_date'] ?? 'N/A' }}</td>--}}
{{--                                        <td>{{ $edu['grade'] ?? 'N/A' }}</td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        @else--}}
{{--                            <p>No education records provided.</p>--}}
{{--                        @endif--}}



{{--                        <!-- Skills -->--}}
{{--                        <h4>Skills</h4>--}}
{{--                        @if(is_array($skills) && count($skills) > 0)  <!-- Check if it's an array and has elements -->--}}
{{--                        <ul>--}}
{{--                            @foreach($skills as $skill)--}}
{{--                                @if(is_array($skill))  <!-- Ensure $skill is an array -->--}}
{{--                                <li>{{ $skill['skill_name'] }} ({{ $skill['proficiency_level'] == 1 ? 'Beginner' : ($skill['proficiency_level'] == 2 ? 'Intermediate' : 'Advanced') }})</li>--}}
{{--                                @else--}}
{{--                                    <p>Invalid skill data.</p>  <!-- Display a fallback message for invalid data -->--}}
{{--                                @endif--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                        @else--}}
{{--                            <p>No skills provided.</p>--}}
{{--                        @endif--}}




{{--                        <!-- Work Experience -->--}}
{{--                        <h4>Work Experience</h4>--}}
{{--                        @if(is_array($workExperience) && count($workExperience) > 0)--}}
{{--                            <table class="table table-bordered mb-4">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th>Company</th>--}}
{{--                                    <th>Job Title</th>--}}
{{--                                    <th>Start Date</th>--}}
{{--                                    <th>End Date</th>--}}
{{--                                    <th>Description</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                @foreach($workExperience as $experience)--}}
{{--                                    @if(is_array($experience))  <!-- Check if $experience is an array -->--}}
{{--                                    <tr>--}}
{{--                                        <td>{{ $experience['company_name'] }}</td>--}}
{{--                                        <td>{{ $experience['job_title'] }}</td>--}}
{{--                                        <td>{{ $experience['start_date'] }}</td>--}}
{{--                                        <td>{{ $experience['end_date'] }}</td>--}}
{{--                                        <td>{{ $experience['description'] }}</td>--}}
{{--                                    </tr>--}}
{{--                                    @else--}}
{{--                                        <p>Invalid experience data.</p>--}}
{{--                                    @endif--}}
{{--                                @endforeach--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        @else--}}
{{--                            <p>No work experience provided.</p>--}}
{{--                        @endif--}}



{{--                        <!-- Certifications -->--}}
{{--                        <h4>Certifications</h4>--}}
{{--                        @if($jobApplication->certifications && count($jobApplication->certifications))--}}
{{--                            <ul>--}}
{{--                                @foreach($jobApplication->certifications as $cert)--}}
{{--                                    <li>{{ $cert['certification_name'] }} from {{ $cert['issuing_organization'] }} ({{ $cert['issue_date'] }} - {{ $cert['expiration_date'] ?? 'No Expiry' }})</li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        @else--}}
{{--                            <p>No certifications provided.</p>--}}
{{--                        @endif--}}

{{--                        <!-- Job Preferences -->--}}
{{--                        <h4>Job Preferences</h4>--}}
{{--                        @if($jobApplication->job_preference && is_array($jobApplication->job_preference))--}}
{{--                            <ul>--}}
{{--                                <li><strong>Preferred Location:</strong> {{ $jobApplication->job_preference['preferred_location'] ?? 'Not specified' }}</li>--}}
{{--                                <li><strong>Preferred Industry:</strong> {{ $jobApplication->job_preference['preferred_industry'] ?? 'Not specified' }}</li>--}}
{{--                                <li><strong>Preferred Job Type:</strong>--}}
{{--                                    @if(isset($jobApplication->job_preference['preferred_job_type']))--}}
{{--                                        {{ $jobApplication->job_preference['preferred_job_type'] == 1 ? 'Full-time' : ($jobApplication->job_preference['preferred_job_type'] == 2 ? 'Part-time' : ($jobApplication->job_preference['preferred_job_type'] == 3 ? 'Remote' : 'Internship')) }}--}}
{{--                                    @else--}}
{{--                                        Not specified--}}
{{--                                    @endif--}}
{{--                                </li>--}}
{{--                                <li><strong>Salary Expectation:</strong> ${{ number_format($jobApplication->job_preference['salary_expectation'] ?? 0) }}</li>--}}
{{--                            </ul>--}}
{{--                        @else--}}
{{--                            <p>No job preferences provided.</p>--}}
{{--                        @endif--}}


                        <!-- Education -->
                        <h4>Education</h4>
                        @php
                            // Get the education data from the related user model
                            $educationData = $jobApplication->user->education ?? [];
                        @endphp

                        @if($educationData->isNotEmpty())
                            <table class="table table-bordered mb-4">
                                <thead>
                                <tr>
                                    <th>Institution</th>
                                    <th>Degree</th>
                                    <th>Field of Study</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Grade</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($educationData as $edu)
                                    <tr>
                                        <td>{{ $edu->institution_name ?? 'N/A' }}</td>
                                        <td>{{ $edu->degree ?? 'N/A' }}</td>
                                        <td>{{ $edu->field_of_study ?? 'N/A' }}</td>
                                        <td>{{ $edu->start_date ?? 'N/A' }}</td>
                                        <td>{{ $edu->end_date ?? 'N/A' }}</td>
                                        <td>{{ $edu->grade ?? 'N/A' }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No education records provided.</p>
                        @endif


                        <!-- Skills -->
                        <!-- Skills -->
                        <h4>Skills</h4>
                        @php
                            $skillsData = $skills ?? (optional($jobApplication->user)->skills ?? []);
                        @endphp
                        @if(!empty($skillsData))
                            <ul>
                                @foreach($skillsData as $skill)
                                    <li>
                                        @php
                                            // Handle different data types
                                            if (is_string($skill)) {
                                                // Try to parse if it's a JSON string
                                                $skillParsed = json_decode($skill, true);
                                                $skillName = $skillParsed['skill_name'] ?? $skill;
                                                $proficiencyLevel = $skillParsed['proficiency_level'] ?? 1;
                                            } elseif (is_array($skill)) {
                                                $skillName = $skill['skill_name'] ?? 'N/A';
                                                $proficiencyLevel = $skill['proficiency_level'] ?? 1;
                                            } elseif (is_object($skill)) {
                                                $skillName = $skill->skill_name ?? 'N/A';
                                                $proficiencyLevel = $skill->proficiency_level ?? 1;
                                            } else {
                                                $skillName = 'N/A';
                                                $proficiencyLevel = 1;
                                            }

                                            // Convert proficiency level to readable text
                                            $proficiencyText = match($proficiencyLevel) {
                                                1 => 'Beginner',
                                                2 => 'Intermediate',
                                                3 => 'Advanced',
                                                default => 'Unknown'
                                            };
                                        @endphp

                                        {{ $skillName }} ({{ $proficiencyText }})
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No skills provided.</p>
                        @endif




                        <!-- Work Experience -->
                        <!-- Work Experience -->
                        <h4>Work Experience</h4>
                        @php
                            $workExperienceData = $workExperience ?? (optional($jobApplication->user)->workExperiences ?? []);
                        @endphp
                        @if(!empty($workExperienceData))
                            <table class="table table-bordered mb-4">
                                <thead>
                                <tr>
                                    <th>Company</th>
                                    <th>Job Title</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Description</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($workExperienceData as $experience)
                                    @php
                                        // Handle different data types
                                        if (is_string($experience)) {
                                            // Try to parse if it's a JSON string
                                            $expParsed = json_decode($experience, true);
                                            $companyName = $expParsed['company_name'] ?? 'N/A';
                                            $jobTitle = $expParsed['job_title'] ?? 'N/A';
                                            $startDate = $expParsed['start_date'] ?? 'N/A';
                                            $endDate = $expParsed['end_date'] ?? 'N/A';
                                            $description = $expParsed['description'] ?? '';
                                        } elseif (is_array($experience)) {
                                            $companyName = $experience['company_name'] ?? 'N/A';
                                            $jobTitle = $experience['job_title'] ?? 'N/A';
                                            $startDate = $experience['start_date'] ?? 'N/A';
                                            $endDate = $experience['end_date'] ?? 'N/A';
                                            $description = $experience['description'] ?? '';
                                        } elseif (is_object($experience)) {
                                            $companyName = $experience->company_name ?? 'N/A';
                                            $jobTitle = $experience->job_title ?? 'N/A';
                                            $startDate = $experience->start_date ?? 'N/A';
                                            $endDate = $experience->end_date ?? 'N/A';
                                            $description = $experience->description ?? '';
                                        } else {
                                            $companyName = 'N/A';
                                            $jobTitle = 'N/A';
                                            $startDate = 'N/A';
                                            $endDate = 'N/A';
                                            $description = '';
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{ $companyName }}</td>
                                        <td>{{ $jobTitle }}</td>
                                        <td>{{ $startDate }}</td>
                                        <td>{{ $endDate }}</td>
                                        <td>{{ $description }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No work experience provided.</p>
                        @endif

                        <!-- Certifications -->
                        <!-- Certifications -->
{{--                        <h4>Certifications</h4>--}}
{{--                        @php--}}
{{--                            $certificationsData = $certifications ?? (optional($jobApplication->user)->certifications ?? []);--}}
{{--                        @endphp--}}
{{--                        @if(!empty($certificationsData))--}}
{{--                            <ul>--}}
{{--                                @foreach($certificationsData as $cert)--}}
{{--                                    @php--}}
{{--                                        // Comprehensive type handling--}}
{{--                                        if (is_string($cert)) {--}}
{{--                                            // If it's a JSON string, try to decode--}}
{{--                                            $certData = json_decode($cert, true);--}}
{{--                                            if (json_last_error() !== JSON_ERROR_NONE) {--}}
{{--                                                // If JSON decoding fails, treat the string as the certification name--}}
{{--                                                $certData = ['certification_name' => $cert];--}}
{{--                                            }--}}
{{--                                        } elseif (is_array($cert)) {--}}
{{--                                            $certData = $cert;--}}
{{--                                        } elseif (is_object($cert)) {--}}
{{--                                            $certData = (array) $cert;--}}
{{--                                        } else {--}}
{{--                                            $certData = [];--}}
{{--                                        }--}}

{{--                                        // Extract certification details with fallbacks--}}
{{--                                        $certName = $certData['certification_name'] ?? 'N/A';--}}
{{--                                        $issuingOrg = $certData['issuing_organization'] ?? 'N/A';--}}
{{--                                        $issueDate = $certData['issue_date'] ?? 'N/A';--}}
{{--                                        $expirationDate = $certData['expiration_date'] ?? 'No Expiry';--}}
{{--                                        $imageUrl = $cert->image ? asset('storage/'.$cert->image) : null;  // Assuming the image is stored in storage--}}

{{--                                    @endphp--}}

{{--                                    <li>--}}
{{--                                        {{ $certName }}--}}
{{--                                        @if($issuingOrg !== 'N/A')--}}
{{--                                            from {{ $issuingOrg }}--}}
{{--                                        @endif--}}
{{--                                        ({{ $issueDate }} - {{ $expirationDate }})--}}
{{--                                    </li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        @else--}}
{{--                            <p>No certifications provided.</p>--}}
{{--                        @endif--}}


                        <h4>Certifications</h4>
                        @php
                            $certifications = $jobApplication->user->certifications ?? [];
                        @endphp

                        @if($certifications->isNotEmpty())
                            <ul>
                                @foreach($certifications as $cert)
                                    <li>
                                        <strong>{{ $cert->certification_name }}</strong>
                                        from {{ $cert->issuing_organization }}
                                        ({{ $cert->issue_date }} - {{ $cert->expiration_date ?? 'No Expiry' }})
                                        @if($cert->image)
                                            <br>
                                            <img src="{{ asset($cert->image) }}" alt="Certification Image" style="max-width: 100px; height: auto;">
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No certifications provided.</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->

@endsection
