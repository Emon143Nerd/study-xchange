@extends('university-user.master')

@section('title','Add Course')

@section('body')


    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Add University Courses</li>
                </ol>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="media-body">
                        <p class="mb-0">{{session('message')}}</p>
                    </div>
                    <div class="row">

                        <form action="{{ route('university-user.course.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-xl-8">
                                <div class="card h-auto">
                                    <div class="card-body">
                                        <input type="hidden" name="university_id" value="{{ $universityId }}">
                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="title" class="form-control" placeholder="Question" value="{{ old('title') }}">
                                            @error('title')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" id="ckeditor">{{ old('description') }}</textarea>
                                            @error('description')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label w-100">Status</label>
                                            <select class="form-control solid default-select" name="status">
                                                <option disabled selected>Select Status</option>
                                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            @error('status')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary btn-sm me-2" type="submit" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                Create Courses
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

@endsection
