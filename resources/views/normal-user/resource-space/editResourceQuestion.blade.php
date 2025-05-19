@extends('normal-user.master')

@section('right-sidebar')
    <!-- sidebar is not available -->
@endsection

@section('title','Edit Resource Space Question')

@section('body')


    <!-- Main Content -->
    <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
        <div class="container mt-4">
            <!-- Header Section -->
            <div class="mb-4 text-center">
                <h2 class="fw-bold">Edit Joining Questions</h2>
                <p class="text-muted">Add up to 7 questions for users to join this resource space. The first question is mandatory.</p>
            </div>

            <!-- Question Form -->
            <form action="{{ route('normal-user.resource-space.updateQuestions', $resourceSpace->id) }}" method="POST" class="shadow p-4 rounded-4 bg-white">
                @csrf
                <div id="questions-container">
                    <!-- Loop through the existing questions -->
                    @foreach($resourceSpace->questions as $key => $question)
                        <div class="mb-3 question-item">
                            <label for="question-{{ $key + 1 }}" class="form-label">Question {{ $key + 1 }}</label>
                            <input type="text" name="questions[]" id="question-{{ $key + 1 }}"
                                   class="form-control @if ($key === 0) border-primary @else border-secondary @endif"
                                   placeholder="Enter question {{ $key + 1 }}"
                                   value="{{ old('questions.' . $key, $question->question) }}"
                                {{ $key === 0 ? 'required' : '' }}>
                        </div>
                    @endforeach

                    <!-- Add empty fields for up to 7 questions if fewer than 7 questions exist -->
                    @for ($i = $resourceSpace->questions->count(); $i < 7; $i++)
                        <div class="mb-3 question-item">
                            <label for="question-{{ $i + 1 }}" class="form-label">Question {{ $i + 1 }}</label>
                            <input type="text" name="questions[]" id="question-{{ $i + 1 }}"
                                   class="form-control @if ($i === 0) border-primary @else border-secondary @endif"
                                   placeholder="Enter question {{ $i + 1 }}">
                        </div>
                    @endfor
                </div>
                <small class="text-muted">You can leave non-mandatory questions blank if not needed.</small>

                <!-- Submit Button -->
                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-primary px-5">Update Questions</button>
                </div>
            </form>

        </div>
    </main>


@endsection
