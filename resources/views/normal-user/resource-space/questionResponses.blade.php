@extends('normal-user.master')

@section('right-sidebar')
    <!-- sidebar is not available -->
@endsection

@section('title','Resource Space Question Responses')

@section('body')

    <!-- Main Content -->
    <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
        <div class="d-flex align-items-center mb-3">
            <a href="{{route('normal-user.resource-space.index')}}" class="material-icons text-dark text-decoration-none m-none me-3">arrow_back</a>
            <p class="ms-2 mb-0 fw-bold text-body fs-6">Explore</p>
        </div>
        <!-- Headline -->
        <h5 class="fw-bold mb-4 text-start mt-3">Resource Space Question Responses</h5>
        <!-- Question Response -->

        <div class="card shadow-sm border-0 p-4">
            @if($userResponses->count() > 0)
                @foreach($userResponses as $userResponse)
                    <div class="mb-5">
                        <h5 class="fw-bold mb-3">{{ $userResponse['user']->name }}'s Responses</h5>
                        <div class="ps-3">
                            @foreach($userResponse['answers'] as $index => $answer)
                                <div class="mb-4">
                                    <h6 class="fw-bold">{{ $index + 1 }}. {{ $answer['question'] }}</h6>
                                    <div class="list-group">
                                        <div class="list-group-item">
                                            {{ $answer['answer'] }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <hr class="my-4">
                    </div>
                @endforeach
            @else
                <div class="alert alert-info">No responses found for this resource space.</div>
            @endif
        </div>

    </main>

    <!-- Main Content -->

@endsection
