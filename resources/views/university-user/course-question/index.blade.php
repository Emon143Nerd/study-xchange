@extends('university-user.master')

@section('title','Course Question List')

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
                            <i class="fa-solid fa-file-lines me-1"></i>Course Question List
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
                                        <th>Course Title</th>
                                        <th>Question Type</th>
                                        <th>Difficulty Level</th>
                                        <th>Question</th>
                                        <th>Duration</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($courseQuestions as $courseQuestion)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{ $courseQuestion->Course->title }}</td>
                                            <td>{{$courseQuestion->question_type}}</td>
                                            <td>{{$courseQuestion->difficulty_level}}</td>
                                            <td>{!! \Illuminate\Support\Str::limit(ucfirst(strtolower($courseQuestion->question)), 20, '...') !!}</td>
                                            <td>{{$courseQuestion->duration}}</td>
                                            <td>{{$courseQuestion->status}}</td>
                                            <td class="text-nowrap">
                                                <a href="{{route('university-user.course-question.edit', ['id'=>$courseQuestion->id])}}"
                                                   class="btn btn-warning btn-sm content-icon">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <a href="{{route('university-user.course-question.delete', ['id'=>$courseQuestion->id])}}"
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




