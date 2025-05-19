@extends('university-user.master')

@section('title','Edit Subject Category')

@section('body')


    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Edit Subject Category</li>
                </ol>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <p class="alert-success">{{session('message')}}</p>
                    <div class="row">

                        <form action="{{ route('university-user.subject-category.update', ['slug' =>$subjectCategory->slug]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-xl-8">
                                <div class="card h-auto">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <input type="hidden" name="university_id" value="{{ auth()->user()->university->id }}"> <!-- Automatically assign the university ID -->
                                            <label class="form-label">Name</label>
                                            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name',$subjectCategory->name) }}">
                                            @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" id="ckeditor">{{ old('description',$subjectCategory->description) }}</textarea>
                                            @error('description')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label w-100">Status</label>
                                            <select class="form-control solid default-select" name="status">
                                                <option disabled selected>Select Status</option>
                                                <option value="1" {{ old('status',$subjectCategory->status) == '1' ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ old('status',$subjectCategory->status) == '0' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            @error('status')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="cm-content-body publish-content form excerpt">
                                            <div class="card-body">
                                                <div class="avatar-upload d-flex align-items-center">
                                                    <div class="position-relative">
                                                        <div class="avatar-preview">
                                                            <div id="imagePreview" style="background-image: url('{{ $subjectCategory->image ? asset($subjectCategory->image) : 'https://mophy.dexignzone.com/xhtml/page-error-404.html' }}');"></div>
                                                        </div>
                                                        <div class="change-btn d-flex align-items-center flex-wrap">
                                                            <input type='file' name="image" class="form-control d-none" id="imageUpload" accept=".png, .jpg, .jpeg">
                                                            <label for="imageUpload" class="btn btn-primary light btn-sm ms-0">Select Image</label>
                                                            @error('image')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary btn-sm me-2" type="submit" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                Create Category
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
