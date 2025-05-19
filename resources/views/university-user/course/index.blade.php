@extends('university-user.master')

@section('title','University Course List')

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
                            <i class="fa-solid fa-file-lines me-1"></i>University Course List
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
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($courses->isEmpty())
                                        <p>No courses found.</p>
                                    @else
                                        @foreach($courses as $course)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$course->title}}</td>
                                                <td>{!! \Illuminate\Support\Str::limit(ucfirst(strtolower($course->description)), 15, '...') !!}</td>
                                                <td>{{$course->status}}</td>
                                                <td class="text-nowrap">
                                                    <a href="{{route('university-user.course.edit', ['id'=>$course->id])}}" class="btn btn-warning btn-sm content-icon">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    <a href="{{route('university-user.course.delete', ['id'=>$course->id])}}" class="btn btn-danger btn-sm content-icon">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

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




