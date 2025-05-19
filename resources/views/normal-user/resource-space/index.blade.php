@extends('normal-user.master')
@extends('normal-user.message')


@section('right-sidebar')
    <!-- sidebar is not available -->
@endsection

@section('title','Resource Space List')

@section('body')


    <!-- Main Content -->
    <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
        <!-- Headline -->
        <h5 class="fw-bold mb-4 text-start mt-3">Explore Engaging Communities: Where Shared Interests and Teamwork Thrive</h5>



        <!-- Button to Trigger Modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createGroupModal">
            Create Resource Space
        </button>

        <!-- Create Group Modal -->
        <div class="modal fade" id="createGroupModal" tabindex="-1" aria-labelledby="createGroupModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createGroupModalLabel">Create a New Resource Space</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{route('normal-user.resource-space.store')}}" enctype="multipart/form-data">
                            @csrf
                            <!-- Group Name -->
                            <div class="mb-3">
                                <label for="groupName" class="form-label text-muted">Resource Space Name</label>
                                <input type="text" id="groupName" name="name" value="{{ old('name') }}" class="form-control border-2 rounded-3 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Enter resource space name" required>
                                @error('name')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Group Type -->
                            <div class="mb-3">
                                <label for="groupType" class="form-label text-muted">Resource Space Type</label>
                                <select id="groupType" name="type" class="form-select border-2 rounded-3 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                                    <option value="">Select Resource Space Type</option>
                                    <option value="1" {{ old('type') == '1' ? 'selected' : '' }}>Public</option>
                                    <option value="2" {{ old('type') == '2' ? 'selected' : '' }}>Private</option>
{{--                                    <option value="3" {{ old('type') == '3' ? 'selected' : '' }}>Premium</option>--}}
                                </select>
                            </div>

                            <!-- Group Description -->
                            <div class="mb-3">
                                <label for="groupDescription" class="form-label text-muted">Resource Space Description</label>
                                <textarea id="groupDescription" name="description" class="form-control border-2 rounded-3 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-400" rows="3" placeholder="Describe your resource space in a few words" required>{{ old('description') }}</textarea>
                                @error('description')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Group Image -->
                            <div class="mb-3">
                                <label for="groupImage" class="form-label text-muted">Resource Space Image</label>
                                <input type="file" id="groupImage" name="image" class="form-control border-2 rounded-3 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-400" accept="image/*" required>
                                @error('image')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Hidden User ID -->
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Create Resource Space</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Create Group Modal -->





        <!-- timeline -->
        <div class="timeline-container lg:flex 2xl:gap-16 gap-12 mx-auto" id="js-oversized">

            <!-- Main Content Section -->
            <div class="tab-pane fade show active" id="pills-groups" role="tabpanel" aria-labelledby="pills-groups-tab">
                <!-- Group List -->
                <div class="pt-4 groups">

                    <!-- Group Item -->
                    <div class="d-flex mb-3">
                        <a href="{{ route('normal-user.resource-space.index', ['type' => 1]) }}"
                           class="btn btn-sm {{ $filterType == 1 ? 'btn-primary' : 'btn-outline-primary' }} me-2">Public</a>
                        <a href="{{ route('normal-user.resource-space.index', ['type' => 2]) }}"
                           class="btn btn-sm {{ $filterType == 2 ? 'btn-primary' : 'btn-outline-primary' }} me-2">Private</a>
{{--                        <a href="{{ route('normal-user.resource-space.index', ['type' => 3]) }}"--}}
{{--                           class="btn btn-sm {{ $filterType == 3 ? 'btn-primary' : 'btn-outline-primary' }}">Premium</a>--}}
                    </div>

                    <!-- Existing code for displaying resource spaces -->
                    @foreach($resourceSpaces as $resourceSpace)
                        <div class="bg-white p-3 group-item rounded-4 mb-3 shadow-sm">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset($resourceSpace->image) }}" class="img-fluid rounded-circle group-img me-3" alt="group-icon">
                                <div class="w-100">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ route('normal-user.resource-space.detail', $resourceSpace->id) }}" class="text-decoration-none">
                                            <h6 class="fw-bold mb-0 text-body">{{ $resourceSpace->name }}</h6>
                                        </a>
                                    </div>
                                    <a href="{{ route('normal-user.resource-space.detail', $resourceSpace->id) }}" class="text-decoration-none">
                                        <p class="text-muted small mt-2">
                                            {{ $resourceSpace->description ?? 'No description available for this group.' }}
                                        </p>
                                    </a>
                                    <div class="d-flex mt-2">
                                        <p class="text-muted small mb-0 me-3">
                                            <span class="material-icons md-18 me-1">post_add</span>
                                            <strong>{{ $resourceSpace->postCount }}</strong> Posts
                                        </p>
                                        <p class="text-muted small mb-0">
                                            <span class="material-icons md-18 me-1">groups</span>
                                            <strong>{{ $resourceSpace->memberCount }}</strong> Members
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Add More Group Items Below -->
                </div>
            </div>

            <!-- Main Content Section -->

        </div>



        <!-- timeline -->

        <div class="text-center mt-4">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mb-0 mt-2">Loading</p>
        </div>
    </main>
    <!-- Main Content -->

    <aside class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-6 col-12">
        <div class="fix-sidebar">
            <div class="side-trend lg-none">

                <!-- Search Tab -->
                <div class="sticky-sidebar2 mb-3">
                    <form action="{{ route('normal-user.resource-space.index') }}" method="GET" class="input-group mb-4 shadow-sm rounded-4 overflow-hidden py-2 bg-white">
                        <span class="input-group-text material-icons border-0 bg-white text-primary">search</span>
                        <input type="text" name="query"
                               class="form-control border-0 fw-light ps-1 w-full py-2 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                               placeholder="Search Resource Spaces"
                               value="{{ $searchQuery ?? '' }}">
                        <input type="hidden" name="type" value="{{ $resourceSpaces }}">
                    </form>
                </div>
                <!-- Search Tab -->

                <!-- Button to Trigger Modal -->





            </div>
        </div>
    </aside>
    <!-- Main Content -->

    <style>
        .group-item {
            transition: box-shadow 0.2s ease;
        }

        .group-item:hover {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .group-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }

        .material-icons {
            font-size: 20px;
            vertical-align: middle;
        }

        .groups .dropdown-menu {
            min-width: 200px;
        }


        /* Create Group */
        .form-control, .form-select {
            border-color: #ced4da;
            border-width: 2px;
        }

        .form-control:focus, .form-select:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        /* File input styling */
        input[type="file"] {
            border-color: #ced4da;
            border-width: 2px;
            padding: 8px;
        }

    </style>



@endsection
