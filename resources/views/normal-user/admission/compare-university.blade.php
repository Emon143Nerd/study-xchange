@extends('normal-user.master')

@section('right-sidebar')
    <!-- sidebar is not available -->
@endsection

@section('title','Compare University')

@section('body')

    <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
        <div class="main-content">
            <div class="d-flex align-items-center mb-3">
                <a href="{{route('normal-user.admission.index')}}" class="material-icons text-dark text-decoration-none m-none me-3">arrow_back</a>
                <p class="ms-2 mb-0 fw-bold text-body fs-6">Back</p>
            </div>
            <div class="bg-white rounded-4 overflow-hidden shadow-sm mb-4 mb-lg-0 p-4" style="width: 1000px;">
                <!-- Heading -->
                <h3 class="mb-4 text-primary fw-bold" style="font-size: 1.75rem;">Compare Universities</h3>

                <!-- Compare Universities -->
                @if(session('compare_universities') && count(session('compare_universities')) > 0)
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        @foreach(session('compare_universities') as $university)
                            <div class="col">
                                <div class="card shadow-lg border-0 h-100">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary fw-bold" style="font-size: 1.25rem;">{{ $university['name'] }}</h5>
                                        <p><strong>Title:</strong> {{ $university['circular_title'] ?? 'N/A' }}</p>
                                        <p><strong>Rank:</strong> {{ $university['rank'] ?? 'N/A' }}</p>
                                        <p><strong>Tuition Fees:</strong> ${{ $university['circular_total_fees'] ?? 'N/A' }}</p>
                                        <p><strong>Minimum CGPA Required:</strong> ${{ number_format($university['min_gpa_required'], 2) ?? 'N/A' }}</p>
                                        <p><strong>Campus Facilities:</strong> {{ $university['campus_facilities'] ?? 'Not Available' }}</p>
                                        <p><strong>Scholarships:</strong> {{ $university['scholarships'] ?? 'Not Available' }}</p>
                                        <p><strong>Placement Records:</strong> {{ $university['placement_records'] ?? 'Not Available' }}</p>
                                        <p><strong>Residence Facilities:</strong> {{ $university['residence_facilities'] ?? 'Not Available' }}</p>
                                        <p><strong>Food Facilities:</strong> {{ $university['food_facilities'] ?? 'Not Available' }}</p>
                                        <p><strong>Average Living Cost:</strong> ${{ $university['avg_living_cost'] ?? 'N/A' }}</p>

                                        <!-- Remove from Compare Button -->
                                        <form action="{{ route('university.compare.remove') }}" method="POST" class="mt-3">
                                            @csrf
{{--                                            <input type="hidden" name="university_id" value="{{ $university['id'] }}">--}}
                                            <input type="hidden" name="admission_circular_id" value="{{ $university['admission_circular_id'] }}">
                                            <button type="submit" class="btn btn-danger w-100">Remove from Compare</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted text-center">No universities added to the comparison list yet.</p>
                @endif
            </div>

            <style>
                .card {
                    border-radius: 8px;
                    transition: transform 0.3s ease, box-shadow 0.3s ease;
                }

                .card:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                }

                .card-body {
                    padding: 1.5rem;
                }

                .card-title {
                    font-size: 1.25rem;
                }

                .btn {
                    font-weight: 600;
                    transition: background-color 0.3s ease;
                }

                .btn-danger:hover {
                    background-color: #d9534f;
                }
            </style>

        </div>
    </main>

    <style>
        .card {
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

    </style>
@endsection
