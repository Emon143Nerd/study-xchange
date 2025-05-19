@extends('university-user.master')

@section('title','Subject Category List')

@section('body')

    <!--**********************************
            Content body start
        ***********************************-->

    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Subject Category List</a></li>
                </ol>
            </div>
            <!-- Row -->
            <div class="row">

                <div class="filter cm-content-box box-primary">
                    <div class="content-title SlideToolHeader">
                        <div class="cpa">
                            <div class="media-body">
                                <p class="mb-0">{{session('message')}}</p>
                            </div>
                        </div>
                        <div class="tools">
                            <a href="javascript:void(0);" class="expand handle"><i
                                    class="fal fa-angle-down"></i></a>
                        </div>
                    </div>
                    <div class="cm-content-body form excerpt">
                        <div class="card-body pb-4">
                            <div class="table-responsive w-100">
                                <table id="example3" class="display min-w850 w-100">
                                    <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Modified</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($subjectCategories as $subjectCategory)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{ \Illuminate\Support\Str::limit(ucfirst(strtolower($subjectCategory->name)), 15, '...') }}</td>
                                            <td>{!! \Illuminate\Support\Str::limit(ucfirst(strtolower($subjectCategory->description)), 15, '...') !!}</td>
                                            <td>{{$subjectCategory->status}}</td>
                                            <td>{{ $subjectCategory->created_at->format('d F Y') }}</td>
                                            <td><img src="{{asset($subjectCategory->image)}}" width="100" alt=""></td>
                                            <td class="text-nowrap">
                                                <a href="{{route('university-user.subject-category.edit', ['slug'=>$subjectCategory->slug])}}"
                                                   class="btn btn-warning btn-sm content-icon">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <a href="{{route('university-user.subject-category.delete', ['slug'=>$subjectCategory->slug])}}"
                                                   class="btn btn-danger btn-sm content-icon">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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




