@extends('university-user.master')

@section('title','Edit Students Descriptive Responses')

@section('body')

    <!--**********************************
            Content body start
        ***********************************-->

    <div class="content-body default-height">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Edit Students Descriptive Responses</li>
                </ol>
            </div>
            <div class="container my-5">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="card shadow-lg">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0">Update Assessment Response</h4>
                            </div>
                            <div class="card-body">
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                    <form action="{{ route('university-user.descriptive.response.update', $assessmentResult->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <!-- Assessment Details -->
                                        <div class="row g-4 mb-4">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="assessmentTitle" value="{{ $assessmentResult->skill_name }}" readonly>
                                                    <label for="assessmentTitle">Assessment Title</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="completedTime" value="{{ $assessmentResult->completed_time }} minutes" readonly>
                                                    <label for="completedTime">Completed Time</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Questions and Answers -->
                                        <div class="mb-4">
                                            @foreach($responseDetails as $index => $response)
                                                <div class="card mb-4 shadow-sm">
                                                    <div class="card-header bg-light py-3">
                                                        <h5 class="mb-0">Question {{ $index + 1 }}</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <!-- Question Text -->
                                                        <div class="mb-4">
                                                            <label class="form-label fw-bold">Question:</label>
                                                            <div class="p-3 bg-light rounded">
                                                                {!! $response->question_text !!}
                                                            </div>
                                                        </div>

                                                        <!-- Student's Answer -->
                                                        <div class="mb-4">
                                                            <label class="form-label fw-bold">Student's Answer:</label>
                                                            <div class="border rounded p-3" style="background-color: #f8f9fa; min-height: 100px; font-size: 1.1em; line-height: 1.6;">
                                                                {!! nl2br(e($response->user_answer)) !!}
                                                            </div>
                                                        </div>

                                                        <!-- Evaluation -->
                                                        <div class="row align-items-center">
                                                            <div class="col-md-4">
                                                                <label class="form-label fw-bold">Evaluation:</label>
                                                                <select name="is_correct[{{ $response->question_id }}]"
                                                                        class="form-select form-select-lg @if($response->is_correct == 1) border-success @else border-danger @endif">
                                                                    <option value="1" {{ $response->is_correct == 1 ? 'selected' : '' }}>
                                                                        Correct
                                                                    </option>
                                                                    <option value="0" {{ $response->is_correct == 0 ? 'selected' : '' }}>
                                                                        Incorrect
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <!-- Assessment Score and Feedback -->
                                        <div class="card shadow-sm mb-4">
                                            <div class="card-header bg-light py-3">
                                                <h5 class="mb-0">Overall Assessment</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row g-4 mb-4">
                                                    <div class="col-md-3">
                                                        <div class="form-floating">
                                                            <input type="number" name="score" class="form-control" id="totalScore"
                                                                   value="{{ old('score', $assessmentResult->score) }}" required>
                                                            <label for="totalScore">Total Score</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-floating">
                                                            <input type="number" class="form-control" id="correctAnswers"
                                                                   value="{{ $assessmentResult->correct_answers }}" readonly>
                                                            <label for="correctAnswers">Correct Answers</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-floating">
                                                            <input type="number" class="form-control" id="wrongAnswers"
                                                                   value="{{ $assessmentResult->wrong_answers }}" readonly>
                                                            <label for="wrongAnswers">Wrong Answers</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-floating">
                                                            <input type="number" class="form-control" id="accuracy"
                                                                   value="{{ number_format($assessmentResult->accuracy, 2) }}" readonly>
                                                            <label for="accuracy">Accuracy (%)</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-floating">
                <textarea name="feedback" class="form-control" id="feedback"
                          style="height: 120px" required>{{ old('feedback', $assessmentResult->feedback) }}</textarea>
                                                    <label for="feedback">Overall Feedback</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-end mt-4">
                                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                                Update Assessment
                                            </button>
                                        </div>
                                    </form>
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




