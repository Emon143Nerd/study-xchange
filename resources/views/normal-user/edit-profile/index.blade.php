@extends('normal-user.master')
@extends('normal-user.message')


@section('right-sidebar')
    <!-- sidebar is not available -->
@endsection

@section('title','Edit Profile')

@section('body')

    <main class="col col-xl-8 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
        <div class="main-content">
            <div class="mb-5">
                <header class="profile d-flex align-items-center">
                    <img alt="#" src="{{asset($user->image)}}" style="width: 70px; height: 70px" class="rounded-circle me-3">
                    <div>
                        <span class="text-muted text_short">WELCOME 👋</span>
                        <h4 class="mb-0 text-dark"><span class="fw-bold">{{$user->name}}</span></h4>
                    </div>
{{--                    <div class="fix-sidebar">--}}
{{--                        <div class="side-trend lg-none">--}}
{{--                            <div class="sticky-sidebar2 mb-3" style="margin-top: 25px; margin-left: 370px;">--}}

{{--                                <a href="{{ route('normal-user.edit-profile.activity', ['id' => session('user_id')]) }}" class="btn btn-primary d-flex align-items-center">--}}
{{--                                    <span class="btn-icon material-icons">visibility</span>--}}
{{--                                    <span class="btn-text">View User Activity</span>--}}
{{--                                </a>--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </header>
            </div>
            <!-- Feeds -->
            <div class="feeds">
                <!-- Feed Item -->
                <div class="bg-white p-4 feed-item rounded-4 shadow-sm mb-3 faq-page">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="lead fw-bold text-body mb-0">Edit Profile</h5>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-12">

                            <form action="{{route('normal-user.edit-profile.update', ['id' => session('user_id')])}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-floating mb-3 d-flex align-items-end">
                                    <input type="text" class="form-control rounded-5" id="floatingssName" name="name" value="{{$user->name}}" placeholder="first">
                                    <label for="floatingssName">NAME</label>
                                </div>
                                <div class="form-floating mb-3 d-flex align-items-end">
                                    <input type="text" class="form-control rounded-5" id="floatingssName" name="email" value="{{$user->email}}" placeholder="first">
                                    <label for="floatingssName">Email</label>
                                </div>
                                <div class="form-floating mb-3 d-flex align-items-center">
                                    <input type="date" class="form-control rounded-5" id="floatingBirth" name="date_of_birth" value="{{ $user->date_of_birth }}" placeholder="DATE OF BIRTH">
                                    <label for="floatingBirth">DATE OF BIRTH</label>
                                </div>

                                <div class="form-floating mb-3 d-flex align-items-center">
                                    <input type="text" class="form-control rounded-5" id="floatingBirth" name="location" value="{{$user->location}}" placeholder="DATE OF BIRTH">
                                    <label for="floatingBirth">Location</label>
                                </div>
{{--                                <div class="form-floating mb-3 d-flex align-items-center">--}}
{{--                                    <input type="password" name="password" class="form-control rounded-5" id="floatingPassd" placeholder="*******">--}}
{{--                                    <label for="floatingPassd">PASSWORD</label>--}}
{{--                                </div>--}}
                                <label class="mb-2 text-muted small">GENDER</label>
                                <div class="d-flex align-items-center mb-3 px-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" value="1" id="male"
                                            {{ $user->gender == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="male">
                                            Male
                                        </label>
                                    </div>
                                    <div class="form-check mx-3">
                                        <input class="form-check-input" type="radio" name="gender" value="2" id="female"
                                            {{ $user->gender == '2' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="female">
                                            Female
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" value="3" id="not"
                                            {{ $user->gender == '3' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="not">
                                            Prefer not to say
                                        </label>
                                    </div>
                                </div>
                                <!-- Image Upload Field -->
                                <div class="mb-3">
                                    <label for="profileImage" class="form-label">Profile Picture</label>
                                    <input type="file" class="form-control" id="profileImage" name="image" accept="image/*">
                                    @if($user->image)
                                        <div class="mt-2">
                                            <img src="{{ asset($user->image) }}" alt="Current Profile Image" class="img-thumbnail" style="width: 150px; height: auto;">
                                        </div>
                                    @endif
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary rounded-5 w-100 text-decoration-none py-3 fw-bold text-uppercase m-0">SAVE</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>



                <!-- Education -->
                <div class="bg-white p-4 feed-item rounded-4 shadow-sm mb-3 faq-page">

                    <div class="container py-4">
                        <h5 class="lead fw-bold text-body mb-3">Education</h5>



                        <form action="{{ route('normal-user.education.store') }}" method="POST">
                            @csrf

                            <!-- Dynamic Education Fields -->
                            <div id="education-container">
                                @foreach ($userEducations as $index => $education)
                                    <div class="education-item border rounded p-3 mb-3">
                                        <input type="hidden" name="education[{{ $index }}][user_id]" value="{{ auth()->id() }}">
                                        <input type="hidden" name="education[{{ $index }}][id]" value="{{ $education->id }}">

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="education[{{ $index }}][institution_name]" placeholder="Institution Name" value="{{ $education->institution_name }}" required>
                                            <label>Institution Name</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="education[{{ $index }}][degree]" placeholder="Degree" value="{{ $education->degree }}" required>
                                            <label>Degree</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="education[{{ $index }}][field_of_study]" placeholder="Field of Study" value="{{ $education->field_of_study }}" required>
                                            <label>Field of Study</label>
                                        </div>

                                        <div class="row g-3 mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input type="date" class="form-control" name="education[{{ $index }}][start_date]" placeholder="Start Date" value="{{ $education->start_date }}" required>
                                                    <label>Start Date</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input type="date" class="form-control" name="education[{{ $index }}][end_date]" placeholder="End Date" value="{{ $education->end_date }}" required>
                                                    <label>End Date</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="number" step="0.01" class="form-control" name="education[{{ $index }}][grade]" placeholder="Grade" value="{{ $education->grade }}" required>
                                            <label>Grade</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" name="education[{{ $index }}][description]" placeholder="Description" style="height: 100px;" required>{{ $education->description }}</textarea>
                                            <label>Description</label>
                                        </div>

                                        <button type="button" class="btn btn-danger remove-education-item" data-index="{{ $index }}">Remove</button>
                                        <input type="hidden" name="education[{{ $index }}][delete]" value="0" class="delete-flag">

                                    </div>
                                @endforeach
                            </div>

                            <!-- Add More Button -->
                            <div class="d-flex justify-content-end mb-3">
                                <button type="button" id="add-education" class="btn btn-primary">Add Education</button>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Save Education</button>
                            </div>
                        </form>
                    </div>


                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            let educationIndex = {{ count($userEducations) }}; // Ensure new index starts correctly
                            const educationContainer = document.getElementById('education-container');
                            const addEducationButton = document.getElementById('add-education');

                            // Function to add a new education component
                            const addEducationComponent = () => {
                                const newEducationItem = document.createElement('div');
                                newEducationItem.classList.add('education-item', 'border', 'rounded', 'p-3', 'mb-3');
                                newEducationItem.innerHTML = `
            <input type="hidden" name="education[${educationIndex}][user_id]" value="{{ auth()->id() }}">
            <input type="hidden" name="education[${educationIndex}][delete]" value="0" class="delete-flag">

            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="education[${educationIndex}][institution_name]" placeholder="Institution Name" required>
                <label>Institution Name</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="education[${educationIndex}][degree]" placeholder="Degree" required>
                <label>Degree</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="education[${educationIndex}][field_of_study]" placeholder="Field of Study" required>
                <label>Field of Study</label>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="date" class="form-control" name="education[${educationIndex}][start_date]" placeholder="Start Date" required>
                        <label>Start Date</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="date" class="form-control" name="education[${educationIndex}][end_date]" placeholder="End Date" required>
                        <label>End Date</label>
                    </div>
                </div>
            </div>

            <div class="form-floating mb-3">
                <input type="number" step="0.01" class="form-control" name="education[${educationIndex}][grade]" placeholder="Grade" required>
                <label>Grade</label>
            </div>

            <div class="form-floating mb-3">
                <textarea class="form-control" name="education[${educationIndex}][description]" placeholder="Description" style="height: 100px;" required></textarea>
                <label>Description</label>
            </div>

            <button type="button" class="btn btn-danger remove-education-item" data-index="${educationIndex}">Remove</button>
        `;
                                educationContainer.appendChild(newEducationItem);
                                educationIndex++;
                            };

                            // Ensure only one event listener is attached
                            if (!addEducationButton.dataset.listenerAdded) {
                                addEducationButton.dataset.listenerAdded = 'true';

                                // Add education component on button click
                                addEducationButton.addEventListener('click', addEducationComponent);
                            }

                            // Remove education component
                            educationContainer.addEventListener('click', (e) => {
                                if (e.target.classList.contains('remove-education-item')) {
                                    const educationItem = e.target.closest('.education-item');
                                    const deleteFlag = educationItem.querySelector('.delete-flag');
                                    if (deleteFlag) {
                                        deleteFlag.value = '1'; // Mark for deletion
                                    }
                                    educationItem.style.display = 'none'; // Hide the item visually
                                }
                            });
                        });

                    </script>



                </div>



                <!-- Skills -->
                <div class="bg-white p-4 feed-item rounded-4 shadow-sm mb-3 faq-page">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="lead fw-bold text-body mb-0">Skills</h5>
                    </div>



                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <form action="{{ route('normal-user.skill.store') }}" method="POST" id="skills-form">
                                @csrf

                                <div id="skills-container">
                                    @foreach ($userSkills as $index => $skill)
                                        <!-- Dynamic Skill Item Template -->
                                        <div class="skill-item border p-3 mb-3 rounded" data-index="{{ $index }}">

                                            <input type="hidden" name="skill[{{ $index }}][user_id]" value="{{ auth()->id() }}">
                                            <input type="hidden" name="skill[{{ $index }}][id]" value="{{ $skill->id }}">

                                            <div class="row mb-2">
                                                <!-- Skill Name -->
                                                <div class="col-md-8">
                                                    <label for="skill_name_{{ $index }}" class="form-label">Skill Name</label>
                                                    <input type="text" class="form-control" id="skill_name_{{ $index }}" name="skill[{{ $index }}][skill_name]" value="{{ $skill->skill_name }}" placeholder="Enter Skill Name" required>
                                                </div>

                                                <!-- Proficiency Level -->
                                                <div class="col-md-4">
                                                    <label for="proficiency_level_{{ $index }}" class="form-label">Proficiency Level</label>
                                                    <select class="form-select" id="proficiency_level_{{ $index }}" name="skill[{{ $index }}][proficiency_level]" required>
                                                        <option value="1" {{ $skill->proficiency_level == 1 ? 'selected' : '' }}>Beginner</option>
                                                        <option value="2" {{ $skill->proficiency_level == 2 ? 'selected' : '' }}>Intermediate</option>
                                                        <option value="3" {{ $skill->proficiency_level == 3 ? 'selected' : '' }}>Advanced</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Remove Button -->
                                            <button type="button" class="btn btn-danger remove-skill-item" data-index="{{ $index }}">Remove</button>
                                            <input type="hidden" name="skill[{{ $index }}][delete]" value="0" class="delete-flag">
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Add Button -->
                                <div class="d-flex justify-content-end mb-3">
                                    <button type="button" id="add-skill" class="btn btn-primary">Add Skill</button>
                                </div>
                                <!-- Submit Button -->
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success">Save Skills</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            let skillIndex = {{ count($userSkills) }}; // Ensure new index starts correctly
                            const skillsContainer = document.getElementById('skills-container');
                            const addSkillButton = document.getElementById('add-skill');

                            // Function to add a new skill component
                            const addSkillComponent = () => {
                                const newSkillItem = document.createElement('div');
                                newSkillItem.classList.add('skill-item', 'border', 'rounded', 'p-3', 'mb-3');
                                newSkillItem.innerHTML = `
    <input type="hidden" name="skill[${skillIndex}][user_id]" value="{{ auth()->id() }}">
    <input type="hidden" name="skill[${skillIndex}][delete]" value="0" class="delete-flag">

    <div class="row mb-2">
        <div class="col-md-8">
            <label for="skill_name_${skillIndex}" class="form-label">Skill Name</label>
            <input type="text" class="form-control" id="skill_name_${skillIndex}" name="skill[${skillIndex}][skill_name]" placeholder="Enter Skill Name" required>
        </div>

        <div class="col-md-4">
            <label for="proficiency_level_${skillIndex}" class="form-label">Proficiency Level</label>
            <select class="form-select" id="proficiency_level_${skillIndex}" name="skill[${skillIndex}][proficiency_level]" required>
                <option value="1">Beginner</option>
                <option value="2">Intermediate</option>
                <option value="3">Advanced</option>
            </select>
        </div>
    </div>

    <button type="button" class="btn btn-danger remove-skill-item" data-index="${skillIndex}">Remove</button>
`;


                                skillsContainer.appendChild(newSkillItem);
                                skillIndex++; // Increment index for next skill item
                            };

                            // Add event listener for adding new skill item
                            if (!addSkillButton.dataset.listenerAdded) {
                                addSkillButton.dataset.listenerAdded = 'true';

                                // Add skill component on button click
                                addSkillButton.addEventListener('click', addSkillComponent);
                            }

                            // Remove skill component
                            skillsContainer.addEventListener('click', (e) => {
                                if (e.target.classList.contains('remove-skill-item')) {
                                    const skillItem = e.target.closest('.skill-item');
                                    const deleteFlag = skillItem.querySelector('.delete-flag');
                                    if (deleteFlag) {
                                        deleteFlag.value = '1'; // Mark for deletion
                                    }
                                    skillItem.style.display = 'none'; // Hide the item visually
                                }
                            });
                        });
                    </script>

                </div>




                <!-- Work Experience -->
                <div class="bg-white p-4 feed-item rounded-4 shadow-sm mb-3 faq-page">

                    <div class="container mt-4">
                        <h5 class="lead fw-bold text-body mb-3">Work Experience</h5>

                        <form action="{{ route('normal-user.workExperience.store') }}" method="POST" id="work-experience-form">
                            @csrf

                            <div id="work-experience-container">
                                @foreach ($workExperiences as $index => $experience)
                                    <!-- Dynamic Work Experience Item Template -->
                                    <div class="work-experience-item mb-4 border p-3 rounded" data-index="{{ $index }}">

                                        <input type="hidden" name="work_experience[{{ $index }}][user_id]" value="{{ auth()->id() }}">
                                        <input type="hidden" name="work_experience[{{ $index }}][id]" value="{{ $experience->id }}">

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="company_name_{{ $index }}" name="work_experience[{{ $index }}][company_name]" value="{{ $experience->company_name }}" placeholder="Company Name" required>
                                            <label for="company_name_{{ $index }}">Company Name</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="job_title_{{ $index }}" name="work_experience[{{ $index }}][job_title]" value="{{ $experience->job_title }}" placeholder="Job Title" required>
                                            <label for="job_title_{{ $index }}">Job Title</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="start_date_{{ $index }}" name="work_experience[{{ $index }}][start_date]" value="{{ $experience->start_date }}" placeholder="Start Date" required>
                                            <label for="start_date_{{ $index }}">Start Date</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="end_date_{{ $index }}" name="work_experience[{{ $index }}][end_date]" value="{{ $experience->end_date }}" placeholder="End Date" required>
                                            <label for="end_date_{{ $index }}">End Date</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" id="description_{{ $index }}" name="work_experience[{{ $index }}][description]" placeholder="Description" style="height: 100px;" required>{{ $experience->description }}</textarea>
                                            <label for="description_{{ $index }}">Description</label>
                                        </div>

                                        <!-- Remove Button -->
                                        <button type="button" class="btn btn-danger remove-work-experience" data-index="{{ $index }}">Remove</button>
                                        <input type="hidden" name="work_experience[{{ $index }}][delete]" value="0" class="delete-flag">
                                    </div>
                                @endforeach
                            </div>

                            <!-- Add Button -->
                            <div class="d-flex justify-content-end mb-3">
                                <button type="button" id="add-work-experience" class="btn btn-primary">Add Work Experience</button>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Save Work Experience</button>
                            </div>
                        </form>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            let experienceIndex = {{ count($workExperiences) }}; // Ensure new index starts correctly
                            const workExperienceContainer = document.getElementById('work-experience-container');
                            const addExperienceButton = document.getElementById('add-work-experience');

                            // Function to add a new work experience component
                            const addExperienceComponent = () => {
                                const newWorkExperience = document.createElement('div');
                                newWorkExperience.classList.add('work-experience-item', 'mb-4', 'border', 'p-3', 'rounded');
                                newWorkExperience.innerHTML = `
                <input type="hidden" name="work_experience[${experienceIndex}][user_id]" value="{{ auth()->id() }}">
                <input type="hidden" name="work_experience[${experienceIndex}][delete]" value="0" class="delete-flag">

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="company_name_${experienceIndex}" name="work_experience[${experienceIndex}][company_name]" placeholder="Company Name" required>
                    <label for="company_name_${experienceIndex}">Company Name</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="job_title_${experienceIndex}" name="work_experience[${experienceIndex}][job_title]" placeholder="Job Title" required>
                    <label for="job_title_${experienceIndex}">Job Title</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="start_date_${experienceIndex}" name="work_experience[${experienceIndex}][start_date]" placeholder="Start Date" required>
                    <label for="start_date_${experienceIndex}">Start Date</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="end_date_${experienceIndex}" name="work_experience[${experienceIndex}][end_date]" placeholder="End Date" required>
                    <label for="end_date_${experienceIndex}">End Date</label>
                </div>

                <div class="form-floating mb-3">
                    <textarea class="form-control" id="description_${experienceIndex}" name="work_experience[${experienceIndex}][description]" placeholder="Description" style="height: 100px;" required></textarea>
                    <label for="description_${experienceIndex}">Description</label>
                </div>

                <button type="button" class="btn btn-danger remove-work-experience" data-index="${experienceIndex}">Remove</button>
            `;

                                workExperienceContainer.appendChild(newWorkExperience);
                                experienceIndex++; // Increment index for next work experience item
                            };

                            // Add event listener for adding new work experience item
                            if (!addExperienceButton.dataset.listenerAdded) {
                                addExperienceButton.dataset.listenerAdded = 'true';

                                // Add work experience component on button click
                                addExperienceButton.addEventListener('click', addExperienceComponent);
                            }

                            // Remove work experience component
                            workExperienceContainer.addEventListener('click', (e) => {
                                if (e.target.classList.contains('remove-work-experience')) {
                                    const experienceItem = e.target.closest('.work-experience-item');
                                    const deleteFlag = experienceItem.querySelector('.delete-flag');
                                    if (deleteFlag) {
                                        deleteFlag.value = '1'; // Mark for deletion
                                    }
                                    experienceItem.style.display = 'none'; // Hide the item visually
                                }
                            });
                        });
                    </script>
                </div>










                <!-- Certifications -->

                <div class="bg-white p-4 feed-item rounded-4 shadow-sm mb-3 faq-page">
                    <div class="container mt-4">
                        <h5 class="lead fw-bold text-body mb-3">Certification</h5>
                        <form action="{{ route('normal-user.certification.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div id="certifications-container">
                                <!-- Existing certifications -->
                                @foreach ($user->certifications as $index => $certification)
                                    <div class="certificate-item mb-3 border rounded p-3 shadow-sm">
                                        <input type="hidden" name="certificates[{{ $index }}][id]" value="{{ $certification->id }}">
                                        <input type="hidden" name="certificates[{{ $index }}][user_id]" value="{{ auth()->id() }}">

                                        <div class="mb-3">
                                            <label for="certification_name" class="form-label">Certification Name</label>
                                            <input type="text" name="certificates[{{ $index }}][certification_name]"
                                                   class="form-control"
                                                   value="{{ $certification->certification_name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="issuing_organization" class="form-label">Issuing Organization</label>
                                            <input type="text" name="certificates[{{ $index }}][issuing_organization]"
                                                   class="form-control"
                                                   value="{{ $certification->issuing_organization }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="issue_date" class="form-label">Issue Date</label>
                                            <input type="date" name="certificates[{{ $index }}][issue_date]"
                                                   class="form-control"
                                                   value="{{ $certification->issue_date }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="expiration_date" class="form-label">Expiration Date </label>
                                            <input type="date" name="certificates[{{ $index }}][expiration_date]"
                                                   class="form-control"
                                                   value="{{ $certification->expiration_date }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="certificate_image" class="form-label">Certificate Image </label>
                                            <input type="file" name="certificates[{{ $index }}][certificate_image]"
                                                   class="form-control" required>
                                            @if($certification->image)
                                                <div class="mb-2">
                                                    <img src="{{ Storage::url($certification->image) }}"
                                                         alt="Certification Image"
                                                         class="img-thumbnail"
                                                         style="max-width: 200px; max-height: 200px; object-fit: cover;">
                                                </div>
                                            @endif
                                        </div>
                                        <button type="button" class="btn btn-danger remove-certificate">Remove</button>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Add Button -->
                            <div class="d-flex justify-content-end mb-3">
                                <button type="button" id="add-certificate" class="btn btn-primary">Add New Certification</button>
                            </div>
                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Save Certifications</button>
                            </div>
                        </form>

                    </div>
                </div>

                <script>
                    document.getElementById('add-certificate').addEventListener('click', function () {
                        const container = document.getElementById('certifications-container');
                        const index = container.children.length;

                        const newCertificateHTML = `
            <div class="certificate-item mb-3 border rounded p-3 shadow-sm">
                <div class="mb-3">
                    <label for="certification_name" class="form-label">Certification Name</label>
                    <input type="text" name="certificates[${index}][certification_name]"
                           class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="issuing_organization" class="form-label">Issuing Organization</label>
                    <input type="text" name="certificates[${index}][issuing_organization]"
                           class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="issue_date" class="form-label">Issue Date</label>
                    <input type="date" name="certificates[${index}][issue_date]"
                           class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="expiration_date" class="form-label">Expiration Date (optional)</label>
                    <input type="date" name="certificates[${index}][expiration_date]"
                           class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="certificate_image" class="form-label">Certificate Image (optional)</label>
                    <input type="file" name="certificates[${index}][certificate_image]"
       class="form-control" required>
            <label for="certificate_image" class="form-label">Certificate Image (optional)</label>


                </div>
                <button type="button" class="btn btn-danger remove-certificate">Remove</button>
            </div>
        `;
                        container.insertAdjacentHTML('beforeend', newCertificateHTML);
                    });

                    document.getElementById('certifications-container').addEventListener('click', function (event) {
                        if (event.target.classList.contains('remove-certificate')) {
                            const certificateItem = event.target.closest('.certificate-item');

                            // Find the hidden ID field to identify this certification
                            const hiddenIdField = certificateItem.querySelector('input[name$="[id]"]');
                            if (hiddenIdField) {
                                // Add a hidden delete input field
                                const deleteInput = document.createElement('input');
                                deleteInput.type = 'hidden';
                                deleteInput.name = `certificates[${hiddenIdField.value}][delete]`;
                                deleteInput.value = 1;
                                certificateItem.appendChild(deleteInput);
                            }

                            // Optionally hide the item visually
                            certificateItem.style.display = 'none';
                        }
                    });


                    // Function to handle image preview
                    function handleImagePreview(event) {
                        const input = event.target;
                        const previewContainer = input.nextElementSibling;

                        // Clear previous preview
                        previewContainer.innerHTML = '';

                        // Check if a file is selected
                        if (input.files && input.files[0]) {
                            const reader = new FileReader();

                            reader.onload = function(e) {
                                const img = document.createElement('img');
                                img.src = e.target.result;
                                img.classList.add('img-thumbnail');
                                img.style.maxWidth = '200px';
                                img.style.maxHeight = '200px';
                                img.style.objectFit = 'cover';
                                img.alt = 'Certificate Preview';

                                previewContainer.appendChild(img);
                            }

                            reader.readAsDataURL(input.files[0]);
                        }
                    }

                    // Add event listener to existing image inputs
                    document.getElementById('certifications-container').addEventListener('change', function(event) {
                        if (event.target.classList.contains('certificate-image-input')) {
                            handleImagePreview(event);
                        }
                    });

                </script>





                <!-- Job Preferences -->
                <div class="bg-white p-4 feed-item rounded-4 shadow-sm mb-3 faq-page">
                    <div class="container py-4">
                        <h5 class="lead fw-bold text-body mb-3">Job Preferences</h5>

                        <form action="{{ route('normal-user.jobPreference.store') }}" method="POST" id="job-preferences-form">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                            <div id="job-preferences-container">
                                @if($userJobPreferences && $userJobPreferences->isNotEmpty())
                                    @foreach($userJobPreferences as $index => $preference)
                                        <div class="job-preference-item border p-4 rounded mb-4" data-index="{{ $index }}">

                                            <!-- Hidden Inputs for User ID and Preference ID -->
                                            <input type="hidden" name="preferences[{{ $index }}][user_id]" value="{{ auth()->id() }}">
                                            <input type="hidden" name="preferences[{{ $index }}][id]" value="{{ $preference->id }}">
                                            <input type="hidden" name="preferences[{{ $index }}][delete]" value="0" class="delete-flag">

                                            <div class="mb-3">
                                                <label for="preferred_location_{{ $index }}" class="form-label">Preferred Location</label>
                                                <input type="text" name="preferences[{{ $index }}][preferred_location]" class="form-control" placeholder="Enter preferred location" value="{{ $preference->preferred_location }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="preferred_industry_{{ $index }}" class="form-label">Preferred Industry</label>
                                                <input type="text" name="preferences[{{ $index }}][preferred_industry]" class="form-control" placeholder="Enter preferred industry" value="{{ $preference->preferred_industry }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="preferred_job_type_{{ $index }}" class="form-label">Preferred Job Type</label>
                                                <select name="preferences[{{ $index }}][preferred_job_type]" class="form-select" required>
                                                    <option value="Full Time" {{ $preference->preferred_job_type == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                                                    <option value="Part Time" {{ $preference->preferred_job_type == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                                                    <option value="Remote" {{ $preference->preferred_job_type == 'Remote' ? 'selected' : '' }}>Remote</option>
                                                    <option value="Internship" {{ $preference->preferred_job_type == 'Internship' ? 'selected' : '' }}>Internship</option>
                                                </select>
                                            </div>


                                            <div class="mb-3">
                                                <label for="salary_expectation_{{ $index }}" class="form-label">Salary Expectation</label>
                                                <input type="number" name="preferences[{{ $index }}][salary_expectation]" class="form-control" placeholder="Enter salary expectation" value="{{ $preference->salary_expectation }}" required>
                                            </div>

                                            <button type="button" class="btn btn-danger remove-preference" data-index="{{ $index }}">Remove</button>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <!-- Add Button -->
                            <div class="d-flex justify-content-end mb-3">
                                <button type="button" id="add-preference" class="btn btn-primary">Add Preference</button>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Save Preferences</button>
                            </div>
                        </form>

                        <script>
                            document.addEventListener('DOMContentLoaded', function () {

                                let preferenceIndex = {{ count($userJobPreferences) }}; // Ensure new index starts correctly
                                const preferenceContainer = document.getElementById('job-preferences-container');
                                const addPreferenceButton = document.getElementById('add-preference');

                                // Function to add a new work experience component
                                const addPreferenceComponent = () => {
                                    const newPreference = document.createElement('div');
                                    newPreference.classList.add('job-preference-item', 'mb-4', 'border', 'p-3', 'rounded');
                                    newPreference.innerHTML = `


                <input type="hidden" name="preferences[${preferenceIndex}][user_id]" value="{{ auth()->id() }}">
                <input type="hidden" name="preferences[${preferenceIndex}][delete]" value="0" class="delete-flag">

                <div class="mb-3">
                    <label for="preferred_location_${preferenceIndex}" class="form-label">Preferred Location</label>
                    <input type="text" name="preferences[${preferenceIndex}][preferred_location]" class="form-control" placeholder="Enter preferred location" required>
                </div>

                <div class="mb-3">
                    <label for="preferred_industry_${preferenceIndex}" class="form-label">Preferred Industry</label>
                    <input type="text" name="preferences[${preferenceIndex}][preferred_industry]" class="form-control" placeholder="Enter preferred industry" required>
                </div>

                <div class="mb-3">
                    <label for="preferred_job_type_${preferenceIndex}" class="form-label">Preferred Job Type</label>
                    <select name="preferences[${preferenceIndex}][preferred_job_type]" class="form-select" required>
    <option value="Full Time">Full Time</option>
    <option value="Part Time">Part Time</option>
    <option value="Remote">Remote</option>
    <option value="Internship">Internship</option>
</select>
                </div>

                <div class="mb-3">
                    <label for="salary_expectation_${preferenceIndex}" class="form-label">Salary Expectation</label>
                    <input type="number" name="preferences[${preferenceIndex}][salary_expectation]" class="form-control" placeholder="Enter salary expectation" required>
                </div>

                <button type="button" class="btn btn-danger remove-preference" data-index="${preferenceIndex}">Remove</button>
            `;


                                    preferenceContainer.appendChild(newPreference);
                                    preferenceIndex++; // Increment index for next work experience item
                                };

                                // Add event listener for adding new work experience item
                                if (!addPreferenceButton.dataset.listenerAdded) {
                                    addPreferenceButton.dataset.listenerAdded = 'true';

                                    // Add work experience component on button click
                                    addPreferenceButton.addEventListener('click', addPreferenceComponent);
                                }

                                // Remove work experience component
                                preferenceContainer.addEventListener('click', (e) => {
                                    if (e.target.classList.contains('remove-preference')) {
                                        const preferenceItem = e.target.closest('.job-preference-item');
                                        const deleteFlag = preferenceItem.querySelector('.delete-flag');
                                        if (deleteFlag) {
                                            deleteFlag.value = '1'; // Mark for deletion
                                        }
                                        preferenceItem.style.display = 'none'; // Hide the item visually
                                    }
                                });
                            });
                        </script>
                    </div>
                </div>




{{--                <div class="bg-white p-4 feed-item rounded-4 shadow-sm faq-page mb-3">--}}
{{--                    <div class="mb-3">--}}
{{--                        <h5 class="lead fw-bold text-body mb-0">Confirm your password--}}
{{--                        </h5>--}}
{{--                        <p class="mb-0">Please enter your password in order to get this.--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                    <div class="row justify-content-center">--}}
{{--                        <div class="col-lg-12">--}}
{{--                            <form action="https://askbootstrap.com/preview/vogel-v-12/profile.html">--}}
{{--                                <div class="form-floating mb-3 d-flex align-items-center">--}}
{{--                                    <input type="password" class="form-control rounded-5" id="floatingPass" placeholder="password" value="12345678">--}}
{{--                                    <label for="floatingPass">PASSWORD</label>--}}
{{--                                </div>--}}
{{--                                <div class="d-grid">--}}
{{--                                    <button class="btn btn-primary w-100 text-decoration-none rounded-5 py-3 fw-bold text-uppercase m-0">Confirm</button>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

            </div>
        </div>
    </main>

{{--    <aside class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-6 col-12">--}}
{{--        <div class="fix-sidebar">--}}
{{--            <div class="side-trend lg-none">--}}
{{--                <div class="sticky-sidebar2 mb-3" style="margin-top: 25px;">--}}
{{--                    <button class="view-activity-btn">--}}
{{--                        <span class="btn-icon material-icons">visibility</span>--}}
{{--                        <span class="btn-text"><a href="{{route('normal-user.edit-profile.activity', ['id' => session('user_id')])}}" style="color: white; text-decoration: none">View User Activity</a></span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </aside>--}}
    <style>
        .sticky-sidebar2 {
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .view-activity-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 12px 20px;
            background-color: #2463eb;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 500;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(52, 152, 219, 0.3);
        }

        .view-activity-btn:hover {
            background-color: #0e4bd0;
            box-shadow: 0 4px 6px rgba(41, 128, 185, 0.4);
            transform: translateY(-2px);
        }

        .view-activity-btn:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px rgba(41, 128, 185, 0.4);
        }

        .btn-icon {
            margin-right: 10px;
            font-size: 20px;
        }

        .btn-text {
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .sticky-sidebar2 {
                padding: 15px;
            }

            .view-activity-btn {
                padding: 10px 15px;
                font-size: 14px;
            }

            .btn-icon {
                font-size: 18px;
            }
        }
    </style>
@endsection
