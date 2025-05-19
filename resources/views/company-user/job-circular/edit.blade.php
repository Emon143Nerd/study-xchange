@extends('company-user.master')

@section('title','Edit Job Circular')

@section('body')


    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Edit Job Circular</li>
                </ol>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="media-body">
                        <p class="mb-0">{{session('message')}}</p>
                    </div>
                    <div class="row">
                        <form action="{{ route('company-user.job-circular.update', $jobCircular->id) }}" id="details-form" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') <!-- Use PUT method for updates -->
                            <div class="col-xl-8">
                                <div class="card h-auto">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label">Company Name</label>
                                            <select class="form-control default-select h-auto wide" name="company_id">
                                                <option value="" disabled>Select Company Name</option>
                                                @foreach($companies as $company)
                                                    <option value="{{ $company->id }}"
                                                        {{ (old('company_id', $jobCircular->company_id) == $company->id) ? 'selected' : '' }}>
                                                        {{ $company->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('company_id')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="title" class="form-control" placeholder="Title"
                                                   value="{{ old('title', $jobCircular->title) }}">
                                            @error('title')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Location</label>
                                            <input type="text" name="location" class="form-control" placeholder="Location"
                                                   value="{{ old('location', $jobCircular->location) }}">
                                            @error('location')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" id="ckeditor">{{ old('description', $jobCircular->description) }}</textarea>
                                            @error('description')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Responsibilities -->
                                        <label for="responsibilities">Responsibilities:</label>
                                        <div id="editor-container">{!! old('responsibilities', $jobCircular->responsibilities) !!}</div>
                                        <input type="hidden" name="responsibilities" value="{{ old('responsibilities', $jobCircular->responsibilities) }}" id="responsibilities">
                                        <div id="responsibilities-error" class="error-message">Responsibilities field is required.</div>
                                        @error('responsibilities')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                        <!-- Requirements -->
                                        <label for="requirements">Requirements:</label>
                                        <div id="requirements-editor-container">{!! old('requirement', $jobCircular->requirement) !!}</div>
                                        <input type="hidden" name="requirement" value="{{ old('requirement', $jobCircular->requirement) }}" id="requirements">
                                        <div id="requirements-error" class="error-message">Requirements field is required.</div>
                                        @error('requirement')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror


                                        <div class="mb-3">
                                            <label class="form-label w-100">Job Type</label>
                                            <select class="form-control solid default-select" name="type">
                                                <option disabled>Select Industry</option>
                                                <option value="Full Time" {{ old('type', $jobCircular->type) == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                                                <option value="Part Time" {{ old('type', $jobCircular->type) == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                                                <option value="Remote" {{ old('type', $jobCircular->type) == 'Remote' ? 'selected' : '' }}>Remote</option>
                                                <option value="Internship" {{ old('type', $jobCircular->type) == 'Internship' ? 'selected' : '' }}>Internship</option>
                                            </select>
                                            @error('type')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Salary Range</label>
                                            <input type="text" name="salary_range" class="form-control" placeholder="Salary Range"
                                                   value="{{ old('salary_range', $jobCircular->salary_range) }}">
                                            @error('salary_range')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="mb-3">
                                            <label for="datePicker" class="form-label">Select Date</label>
                                            <input
                                                type="date"
                                                id="datePicker"
                                                name="application_deadline"
                                                value="{{ old('application_deadline', $jobCircular->application_deadline) }}"
                                                class="form-control"
                                            >
                                        </div>


                                        <div class="mb-3">
                                            <label class="form-label w-100">Status</label>
                                            <select class="form-control solid default-select" name="status">
                                                <option disabled>Select Status</option>
                                                <option value="1" {{ old('status', $jobCircular->status) == '1' ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ old('status', $jobCircular->status) == '0' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            @error('status')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="cm-content-body publish-content form excerpt">
                                            <label for="formFileLg" class="form-label">Image</label>
                                            <div class="card-body">
                                                <div class="avatar-upload d-flex align-items-center">
                                                    <div class="position-relative">
                                                        <div class="avatar-preview">
                                                            <div id="imagePreview"
                                                                 style="background-image: url({{ $jobCircular->image ? asset($jobCircular->image) : 'https://via.placeholder.com/150' }});">
                                                            </div>
                                                        </div>
                                                        <div class="change-btn d-flex align-items-center flex-wrap">
                                                            <input type='file' name="image" class="form-control d-none" id="imageUpload" accept=".png, .jpg, .jpeg">
                                                            <label for="imageUpload" class="btn btn-primary light btn-sm ms-0">Change Image</label>
                                                            @error('image')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <button class="btn btn-primary btn-sm me-2" type="submit">
                                                Update Circular
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->
    <!-- Include Quill library -->
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script>
        // Initialize Quill editors
        const responsibilitiesEditor = new Quill('#editor-container', {
            theme: 'snow',
            placeholder: 'Write your responsibilities here...',
            modules: {
                toolbar: [
                    [{ header: [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ list: 'ordered' }, { list: 'bullet' }],
                    ['link', 'image']
                ]
            }
        });

        const requirementsEditor = new Quill('#requirements-editor-container', {
            theme: 'snow',
            placeholder: 'Write your requirements here...',
            modules: {
                toolbar: [
                    [{ header: [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ list: 'ordered' }, { list: 'bullet' }],
                    ['link', 'image']
                ]
            }
        });

        // Validate and handle form submission
        const form = document.querySelector('#details-form');
        form.onsubmit = function (event) {
            let isValid = true;

            // Get content from editors
            const responsibilitiesContent = responsibilitiesEditor.root.innerHTML.trim();
            const requirementsContent = requirementsEditor.root.innerHTML.trim();

            // Check if content is empty (including cases with only <p><br></p>)
            if (responsibilitiesContent === '' || responsibilitiesContent === '<p><br></p>') {
                document.querySelector('#responsibilities-error').style.display = 'block';
                isValid = false;
            } else {
                document.querySelector('#responsibilities-error').style.display = 'none';
                document.querySelector('#responsibilities').value = responsibilitiesContent;
            }

            if (requirementsContent === '' || requirementsContent === '<p><br></p>') {
                document.querySelector('#requirements-error').style.display = 'block';
                isValid = false;
            } else {
                document.querySelector('#requirements-error').style.display = 'none';
                document.querySelector('#requirements').value = requirementsContent;
            }

            // Prevent form submission if validation fails
            if (!isValid) {
                event.preventDefault();
            }
        };
    </script>
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <style>
        #editor-container, #requirements-editor-container {
            height: 200px;
        }
        .error-message {
            color: red;
            font-size: 14px;
            display: none;
        }
    </style>

@endsection
