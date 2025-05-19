@extends('university-user.master')

@section('title','Students Quiz Responses')

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
                            <i class="fa-solid fa-file-lines me-1"></i>Students Quiz Responses
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
                                <div class="table-responsive w-100">
                                    @if($quizResponses->isEmpty())
                                        <p>No quiz responses found for this university.</p>
                                    @else
                                        <table id="example3" class="display min-w850 w-100">
                                            <thead>
                                            <tr>
                                                <th>Serial</th>
                                                <th>User</th>
                                                <th>Skill Name</th>
                                                <th>Score</th>
                                                <th>Accuracy</th>
                                                <th>Type</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($quizResponses as $index => $response)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $response->user_name }}</td>
                                                    <td>{{ $response->skill_name }}</td>
                                                    <td>{{ $response->score }}</td>
                                                    <td>{{ $response->accuracy }}%</td>
                                                    <td>{{ $response->type }}</td>
                                                    <td>
                                                        <a href="{{ route('university-user.quiz.response.edit', ['assessmentResultId' => $response->assessment_result_id]) }}"
                                                           class="btn btn-warning btn-sm content-icon">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @endif


                                </div>

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




