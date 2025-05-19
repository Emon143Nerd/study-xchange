@extends('normal-user.master')

@section('right-sidebar')
    <!-- sidebar is not available -->
@endsection

@section('title','Resource Space List')

@section('body')

    <!-- Main Content -->
    <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
        <div class="d-flex align-items-center mb-3">
            <a href="{{route('normal-user.resource-space.index')}}" class="material-icons text-dark text-decoration-none m-none me-3">arrow_back</a>
            <p class="ms-2 mb-0 fw-bold text-body fs-6">Explore</p>
        </div>
        <!-- Headline -->
        <h5 class="fw-bold mb-4 text-start mt-3">Answer the Questions to Join the Resource Group</h5>
        <!-- Question Form -->
        <div class="card shadow-sm border-0 p-4">


            <form action="{{ route('normal-user.resource-space.saveRequest', ['id' => $resourceSpace->id]) }}" method="POST">
                @csrf
                @foreach ($questions as $index => $question)
                    <div class="mb-3">
                        <label>{{ $index + 1 }}. {{ $question->question }}</label>
                        <input type="text" name="answers[{{ $question->id }}]" class="form-control" required>
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>



        </div>
    </main>

    <!-- Main Content -->

@endsection
