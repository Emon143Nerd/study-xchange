@extends('company-user.master')

@section('title','Job Circular List')

@section('body')

    <!--**********************************
            Content body start
        ***********************************-->

    <div class="content-body default-height">
        <div class="container-fluid">
            <!-- Row -->
            <div class="row">
                <div class="filter cm-content-box box-primary">
                    <div class="content-title SlideToolHeader">
                        <div class="cpa">
                            <i class="fa-solid fa-file-lines me-1"></i>Company List
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
                                        <th>Title</th>
                                        <th>Company</th>
                                        <th>Type</th>
                                        <th>Application Deadline</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($jobCirculars as $jobCircular)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{ $jobCircular->title }}</td>
                                            <td>{{ $jobCircular->company->name }}</td>
                                            <td>{{ $jobCircular->type }}</td>
                                            <td>{{ $jobCircular->application_deadline }}</td>
                                            <td>{{ $jobCircular->status }}</td>
                                            <td><img src="{{asset($jobCircular->image)}}" width="100" height="auto" alt=""></td>
                                            <td class="text-nowrap">
                                                <a href="{{route('company-user.job-circular.edit', ['id'=>$jobCircular->id])}}"
                                                   class="btn btn-warning btn-sm content-icon">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <a href="{{route('company-user.job-circular.delete', ['id'=>$jobCircular->id])}}"
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




