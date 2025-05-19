@extends('normal-user.master')

@section('right-sidebar')
    <!-- sidebar is not available -->
@endsection

@section('title','Resource Space Question Creation')

@section('body')


    <!-- Main Content -->
    <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
        <div class="container mt-4">
            <!-- Header Section -->
            <div class="mb-4 text-center">
                <h2 class="fw-bold">Create Joining Questions</h2>
                <p class="text-muted">Add up to 7 questions for users to join this resource space. The first question is mandatory.</p>
            </div>

            <!-- Question Form -->
            <form action="{{ route('normal-user.resource-space.saveQuestions', $resourceSpace->id) }}" method="POST" class="shadow p-4 rounded-4 bg-white">
                @csrf
                <div id="questions-container">
                    @for ($i = 1; $i <= 7; $i++)
                        <div class="mb-3 question-item">
                            <label for="question-{{ $i }}" class="form-label">Question {{ $i }}</label>
                            <input type="text" name="questions[]" id="question-{{ $i }}"
                                   class="form-control @if ($i === 1) border-primary @else border-secondary @endif"
                                   placeholder="Enter question {{ $i }}"
                                {{ $i === 1 ? 'required' : '' }}>
                        </div>
                    @endfor
                </div>
                <small class="text-muted">You can leave non-mandatory questions blank if not needed.</small>

                <!-- Submit Button -->
                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-primary px-5">Save Questions</button>
                </div>
            </form>
        </div>
    </main>


@endsection
