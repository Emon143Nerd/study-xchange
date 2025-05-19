@extends('university-user.master')

@section('title','Edit Admission Circular')

@section('body')


    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Edit Admission Circular</li>
                </ol>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <p class="alert-success">{{session('message')}}</p>
                    <div class="row">

                        <form action="{{ route('university-user.admission-circular.update',['slug'=>$admissionCircular->slug]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-xl-8">
                                <div class="card h-auto">
                                    <div class="card-body">

                                        <!-- University Selection -->
                                        <div class="mb-3">
                                            <label class="form-label">University Name</label>
                                            <select class="form-control default-select h-auto wide" name="university_id" required>
                                                <option value="" disabled>Select University</option>
                                                @foreach($universities as $university)
                                                    <option value="{{ $university->id }}" {{ old('university_id', $admissionCircular->university_id) == $university->id ? 'selected' : '' }}>
                                                        {{ $university->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('university_id')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Subject Category Selection -->
                                        <div class="mb-3">
                                            <label class="form-label">Subject Category</label>
                                            <select class="form-control default-select h-auto wide" name="subject_category_id" required>
                                                <option value="" disabled>Select Subject Category</option>
                                                @foreach($subjectCategories as $subjectCategory)
                                                    <option value="{{ $subjectCategory->id }}" {{ old('subject_category_id', $admissionCircular->subject_category_id) == $subjectCategory->id ? 'selected' : '' }}>
                                                        {{ $subjectCategory->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('subject_category_id')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Circular Title -->
                                        <div class="mb-3">
                                            <label class="form-label">Circular Title</label>
                                            <input type="text" name="title" class="form-control" placeholder="Circular Title" value="{{ old('title', $admissionCircular->title) }}" required>
                                            @error('title')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Description -->
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" id="ckeditor" class="form-control" rows="4" required>{{ old('description', $admissionCircular->description) }}</textarea>
                                            @error('description')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Total Fees -->
                                        <div class="mb-3">
                                            <label class="form-label">Total Fees</label>
                                            <input type="text" name="total_fees" class="form-control" placeholder="Total Fees" value="{{ old('total_fees', $admissionCircular->total_fees) }}" required>
                                            @error('total_fees')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Minimum GPA Requirement -->
                                        <div class="mb-3">
                                            <label class="form-label">Minimum GPA Requirement</label>
                                            <input type="text" name="min_gpa_req" class="form-control" placeholder="Minimum GPA Requirement" value="{{ old('min_gpa_req', $admissionCircular->min_gpa_req) }}" required>
                                            @error('min_gpa_req')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Start and End Dates -->
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Start Date</label>
                                                <input name="start_date" type="text" class="datepicker-default form-control" placeholder="Start Date"
                                                       value="{{ old('start_date', \Carbon\Carbon::parse($admissionCircular->start_date)->format('d-m-Y')) }}" required>
                                                @error('start_date')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">End Date</label>
                                                <input name="end_date" type="text" class="datepicker-default form-control" placeholder="End Date"
                                                       value="{{ old('end_date', \Carbon\Carbon::parse($admissionCircular->end_date)->format('d-m-Y')) }}" required>
                                                @error('end_date')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Status -->
                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <select class="form-control solid default-select" name="status" required>
                                                <option disabled>Select Status</option>
                                                <option value="1" {{ old('status', $admissionCircular->status) == '1' ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ old('status', $admissionCircular->status) == '0' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            @error('status')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Image Upload -->
                                        <div class="mb-3">
                                            <label class="form-label">Image</label>
                                            <input type="file" name="image" class="form-control" accept=".png, .jpg, .jpeg">
                                            @if($admissionCircular->image)
                                                <img src="{{ asset($admissionCircular->image) }}" alt="Circular Image" class="mt-2" width="100">
                                            @endif
                                            @error('image')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Attachment Upload -->
                                        <div class="mb-3">
                                            <label class="form-label">Attachment</label>
                                            <input class="form-control" name="attachment" type="file" accept=".pdf, .doc, .docx">
                                            @if($admissionCircular->attachment)
                                                @if(in_array(pathinfo($admissionCircular->attachment, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                                    <img src="{{ asset($admissionCircular->attachment) }}" width="100" alt="">
                                                @else
                                                    <iframe src="{{ asset($admissionCircular->attachment) }}" style="width:100%; height:200px;" frameborder="0"></iframe>
                                                @endif
                                            @endif
                                            @error('attachment')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="mb-3">
                                            <button class="btn btn-primary" type="submit">Update Circular</button>
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

@endsection
