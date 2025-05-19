@extends('university-user.master')

@section('title','Course Quiz Question List')

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
                                        <th>Duration</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($quizzes as $quiz)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{ $quiz->Course->title }}</td>
                                            <td>{{$quiz->question_type}}</td>
                                            <td>{{$quiz->difficulty_level}}</td>
                                            <td>{{$quiz->duration}}</td>
                                            <td>{{$quiz->status}}</td>
                                            <td class="text-nowrap">
                                                @if($quiz->id)
                                                    <a href="{{route('university-user.course-quiz-question.edit', ['id'=>$quiz->id])}}"
                                                       class="btn btn-warning btn-sm content-icon">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                @else
                                                    <p>No ID available</p>
                                                @endif
                                                <a href="{{route('university-user.course-quiz-question.delete', ['id'=>$quiz->id])}}"
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




