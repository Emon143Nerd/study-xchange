@extends('normal-user.master')

@section('right-sidebar')
    <!-- sidebar is not available -->
@endsection

@section('title','Admission List')

@section('body')

    <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
        <div class="main-content">
            <div class="d-flex align-items-center mb-3">
                <a href="{{route('normal-user.dashboard')}}" class="material-icons text-dark text-decoration-none m-none me-3">arrow_back</a>
                <p class="ms-2 mb-0 fw-bold text-body fs-6">Explore</p>
                <!-- Add a new link for the Compare University Page -->
                <a href="{{ route('normal-user.admission.compare-university') }}" class="btn btn-primary ms-auto fw-bold fs-6" style="padding-left: 40px; padding-right: 40px;">View Compare List</a>
            </div>

            <div class="bg-white rounded-4 overflow-hidden shadow-sm mb-4 mb-lg-0">

                <!-- Trending Item -->

                @foreach($admissionCirculars as $admissionCircular)
                    <a href="{{ route('normal-user.admission.detail', ['slug' => $admissionCircular->slug]) }}" class="p-3 border-bottom d-flex align-items-center text-dark text-decoration-none">
                        <div class="d-flex w-100 justify-content-between align-items-center">
                            <div>
                                <div class="text-muted fw-light d-flex align-items-center">
                                    <small>{{ $admissionCircular->university_name }}</small>
                                </div>
                                <p class="fw-bold mb-0 pe-3">{{ $admissionCircular->title }}</p>
                                <small class="text-muted">{!! \Illuminate\Support\Str::limit(ucfirst(strtolower($admissionCircular->description)), 200, '...') !!}</small><br>

                                <!-- Date and Button side by side -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-primary">{{ \Carbon\Carbon::parse($admissionCircular->start_date)->format('d F Y') }}</span>

                                    <!-- Add to Compare Button -->
                                    <form action="{{ route('university.compare.add') }}" method="POST" class="ms-3" style="padding-right: 250px;">
                                        @csrf
                                        <input type="hidden" name="university_id" value="{{ $admissionCircular->university_id }}">
                                        <input type="hidden" name="admission_circular_id" value="{{ $admissionCircular->id }}">
                                        <button type="submit" class="btn btn-outline-primary btn-sm">Add to Compare</button>
                                    </form>

                                </div>
                            </div>
                        </div>

                        <!-- Image -->
                        <img src="{{ asset($admissionCircular->image) }}" width="80" height="auto" class="img-fluid rounded-4 ms-auto" alt="profile-img">
                    </a>
                @endforeach


                <!-- Trending Item -->

            </div>
        </div>
    </main>

    <aside class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-6 col-12">
        <div class="fix-sidebar">
            <div class="side-trend lg-none">
                <!-- Search Tab -->
                <div class="sticky-sidebar2 mb-3">

                    <div class="input-group mb-4 shadow-sm rounded-4 overflow-hidden py-2 bg-white">
                        <span class="input-group-text material-icons border-0 bg-white text-primary">search</span>
                        <form action="{{ route('normal-user.admission.search') }}" method="GET" class="w-full">
                            <input type="text" name="query" class="form-control border-0 fw-light ps-1 w-full py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Search Admission Circulars" value="{{ request('query') }}">
                        </form>
                    </div>




                    <div class="bg-white rounded-4 overflow-hidden shadow-sm account-follow mb-4">
                        <h6 class="fw-bold text-body p-3 mb-0 border-bottom">Popular Universities</h6>
                        <!-- Top 5 Universities by Rank -->
                        <div class="top-universities mt-4">
                            <div class="list-group">
                                @foreach($topUniversities as $university)
                                    <div class="list-group-item">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset($university->image) }}" class="img-fluid rounded-circle me-3" alt="university-img" width="50" height="50">
                                            <div>
                                                <h6 class="fw-bold mb-1">{{ $university->name }}</h6>
                                                <p class="text-muted mb-0">Rank: {{ $university->rank }}</p>
                                            </div>
                                        </div>

                                        <!-- Display the admission circulars for each university -->
                                        <div class="mt-2">
                                            <h6>Admission Circulars:</h6>
                                            <ul>
                                                @foreach($university->admissionCirculars as $circular)
                                                    <li>
                                                        <a href="{{ route('normal-user.admission.detail', ['slug' => $circular->slug]) }}" class="text-dark text-decoration-none">
                                                            {{ $circular->title }} (Start Date: {{ \Carbon\Carbon::parse($circular->start_date)->format('d F Y') }})
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach

                                    @if($topUniversities->isEmpty())
                                        <p>No admission circulars available for this university.</p>
                                    @endif




                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </aside>

@endsection
