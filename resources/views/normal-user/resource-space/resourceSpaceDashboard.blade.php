@extends('normal-user.master')

@section('right-sidebar')
    <!-- sidebar is not available -->
@endsection

@section('title','Resource Space Dashboard')

@section('body')
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Main Content -->
    <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
        <div class="d-flex align-items-center mb-3">
            <a href="{{route('normal-user.resource-space.detail',$resourceSpace->id)}}" class="material-icons text-dark text-decoration-none m-none me-3">arrow_back</a>
            <p class="ms-2 mb-0 fw-bold text-body fs-6">Explore</p>
        </div>
        <div class="container mx-auto px-6 py-8">
            <!-- Dashboard Header -->
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Resource Space Engagement Dashboard</h1>
                <form action="{{ route('normal-user.resource-space.delete', $resourceSpace->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this resource space?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Resource Space</button>
                </form>
            </div>

            <!-- Dashboard Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-8">
                <!-- Post Count Card -->
                <div class="box-width bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transform transition-all duration-300">
                    <div class="flex items-center space-x-4">
                        <div class="bg-blue-500 text-white p-3 rounded-full">
                            <i class="fas fa-file-alt text-2xl"></i> <!-- Post Icon -->
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-700">Total Posts</h2>
                            <p class="text-4xl font-bold text-blue-600" id="post_count">{{ $postCount }}</p>
                        </div>
                    </div>
                </div>

                <!-- Member Count Card -->
                <div class="box-width bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transform transition-all duration-300">
                    <div class="flex items-center space-x-4">
                        <div class="bg-green-500 text-white p-3 rounded-full">
                            <i class="fas fa-users text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-700">Total Members</h2>
                            <p class="text-4xl font-bold text-green-600" id="member_count">{{ $memberCount }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Upvotes Card -->
                <div class="box-width bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transform transition-all duration-300">
                    <div class="flex items-center space-x-4">
                        <div class="bg-green-600 text-white p-3 rounded-full">
                            <i class="fas fa-thumbs-up text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-700">Total Upvotes</h2>
                            <p class="text-4xl font-bold text-green-500" id="total_upvotes">{{ $totalUpvotes }}</p>
                        </div>
                    </div>
                    <!-- Progress Bar -->
                    @if($totalUpvotes)
                    <div class="mt-4">
                        <div class="bg-green-100 h-2 rounded-full">
                            <div class="bg-green-500 h-2 rounded-full" style="width: {{ ($totalUpvotes / $totalEngagement) * 100 }}%"></div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Total Downvotes Card -->
                <div class="box-width bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transform transition-all duration-300">
                    <div class="flex items-center space-x-4">
                        <div class="bg-red-500 text-white p-3 rounded-full">
                            <i class="fas fa-thumbs-down text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-700">Total Downvotes</h2>
                            <p class="text-4xl font-bold text-red-500" id="total_downvotes">{{ $totalDownvotes }}</p>
                        </div>
                    </div>
                    <!-- Progress Bar -->
                    @if($totalDownvotes)
                    <div class="mt-4">
                        <div class="bg-red-100 h-2 rounded-full">
                            <div class="bg-red-500 h-2 rounded-full" style="width: {{ ($totalDownvotes / $totalEngagement) * 100 }}%"></div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Total Comments Card -->
                <div class="box-width bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transform transition-all duration-300">
                    <div class="flex items-center space-x-4">
                        <div class="bg-indigo-500 text-white p-3 rounded-full">
                            <i class="fas fa-comment-dots text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-700">Total Comments</h2>
                            <p class="text-4xl font-bold text-indigo-600" id="total_comments">{{ $totalComments }}</p>
                        </div>
                    </div>
                    <!-- Progress Bar -->
                    @if($totalComments)
                    <div class="mt-4">
                        <div class="bg-indigo-100 h-2 rounded-full">
                            <div class="bg-indigo-500 h-2 rounded-full" style="width: {{ ($totalComments / $totalEngagement) * 100 }}%"></div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Total Engagement Card -->
                <div class="box-width bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transform transition-all duration-300">
                    <div class="flex items-center space-x-4">
                        <div class="bg-yellow-500 text-white p-3 rounded-full">
                            <i class="fas fa-chart-line text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-700">Total Engagement</h2>
                            <p class="text-4xl font-bold text-yellow-500" id="total_engagement">{{ $totalEngagement }}</p>
                        </div>
                    </div>
                    <!-- Progress Bar -->
                    @if($totalEngagement)
                    <div class="mt-4">
                        <div class="bg-yellow-100 h-2 rounded-full">
                            <div class="bg-yellow-500 h-2 rounded-full" style="width: {{ ($totalEngagement / $totalEngagement) * 100 }}%"></div>
                        </div>
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </main>

    <style>
        .box-width{
            width: 270px;
        }
    </style>



    <aside class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-6 col-12">
        <div class="fix-right-sidebar">
            <div class="side-trend lg-none">

                <h4 class="text-2xl font-bold text-gray-800 flex items-center mb-2">
                    <span class="material-icons text-blue-500 mr-2">list_alt</span>
                    All Posts
                </h4>
                @if($posts->isNotEmpty())
                    <!-- Single Post Card -->

                    @foreach($posts as $post)
                        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
                            <div class="card-body">
                                <!-- Post Header -->
                                <div class="d-flex align-items-center mb-3">
                                    @if($post->user->image)
                                        <!-- Display user image -->
                                        <img src="{{asset($post->user->image)}}" alt="User Image" class="rounded-circle me-3 shadow-sm" style="width: 50px; height: 50px;">
                                    @else
                                        <!-- Fallback to initials with a customizable background color -->
                                        <div class="rounded-circle border border-primary d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; background-color: #f0f0f0; color: #007bff; font-size: 15px; font-weight: bold;">
                                            {{ strtoupper(substr($post->user->image, 0, 2)) }}
                                        </div>
                                    @endif
                                    <div class="ml-2">
                                        <h6 class="fw-bold mb-0">{{ $post->user->name }}</h6>
                                        <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                                    </div>

                                        <!-- Post Status Edit (Visible only for the post owner) -->
                                        @if(Auth::check() && Auth::user()->id == $post->resourceSpace->user_id)
                                            <div class="d-flex align-items-center">
                                                <!-- Status Edit Trigger -->
                                                <div class="dropdown">
                                                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle"
                                                            type="button"
                                                            id="postStatusDropdown{{ $post->id }}"
                                                            data-bs-toggle="dropdown"
                                                            aria-expanded="false" style="margin-left: 88px;">
                                                        {{ ucfirst($post->status) }}
                                                    </button>
                                                    <form class="dropdown-menu p-3 dropdown-menu-end"
                                                          style="min-width: 250px;"
                                                          aria-labelledby="postStatusDropdown{{ $post->id }}"
                                                          action="{{ route('normal-user.resource-space-post.update', $post->id) }}"
                                                          method="POST">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="mb-3">
                                                            <label for="status{{ $post->id }}" class="form-label">Pin Your Post</label>
                                                            <select id="status{{ $post->id }}"
                                                                    name="status"
                                                                    class="form-select @error('status') is-invalid @enderror"
                                                                    required>
                                                                <option value="1" {{ old('status', $post->status) == '1' ? 'selected' : '' }}>Pin</option>
                                                                <option value="0" {{ old('status', $post->status) == '0' ? 'selected' : '' }}>Unpin</option>
                                                            </select>
                                                            @error('status')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>

                                                        <input type="hidden" name="resource_space_id" value="{{ $post->resourceSpace->id }}">
                                                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                                                        <div class="mb-3">
                                                            <label for="title" class="form-label">Title</label>
                                                            <input type="text" id="title" name="title" class="form-control" placeholder="Enter Title" value="{{ old('title', $post->title) }}" readonly>
                                                            @error('title')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="description" class="form-label">Description</label>
                                                            <textarea id="description" name="description" class="form-control" rows="4" placeholder="Enter Description" readonly>{{ old('description', $post->description) }}</textarea>
                                                            @error('description')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="image" class="form-label">Image (Optional)</label>
                                                            <input type="file" id="image" name="image" class="form-control" accept="image/*" disabled>
                                                            @error('image')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="d-grid">
                                                            <button type="submit" class="btn btn-primary">Update Status</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        @endif
                                </div>

                                <!-- Post Image -->
                                @if($post->image)
                                    <div class="mb-3">
                                        <img src="{{ asset($post->image) }}" alt="Post Image" class="img-fluid" style="border-radius: 10px;">
                                    </div>
                                @endif

                                <!-- Post Content -->
                                {!! \Illuminate\Support\Str::limit($post->description, 100, $end='...') !!}

                                <!-- Post Actions -->
                                <div class="d-flex justify-content-between align-items-center mt-4">

                                    <div>
                                        <!-- Displaying the number of upvotes and downvotes -->
                                        <div>
                                            <form action="{{ route('normal-user.resource-space-post.upvote', $post->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-light btn-sm text-success me-2">
                                                    <i class="bi bi-hand-thumbs-up-fill"></i> Upvote
                                                </button>
                                            </form>
                                            <span class="vote-count">{{ $post->upvotes }}</span>

                                            <form action="{{ route('normal-user.resource-space-post.downvote', $post->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-light btn-sm text-danger">
                                                    <i class="bi bi-hand-thumbs-down-fill"></i> Downvote
                                                </button>
                                            </form>
                                            <span class="vote-count">{{ $post->downvotes }}</span>
                                        </div>

                                        <!-- Optionally add some custom CSS for spacing -->
                                        <style>
                                            .vote-count {
                                                margin-left: 5px;
                                                font-weight: bold;
                                                font-size: 1.2em;
                                            }
                                        </style>

                                    </div>

                                </div>
                            </div>

                        </div>
                    @endforeach

                @else
                    <p class="text-sm text-gray-500 mt-1">There are no posts available at the moment. Please check back later.</p>
                @endif

            </div>
        </div>
    </aside>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        .fix-right-sidebar {
            max-height: 620px;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #dce2e8 #f0f0f0;
        }

    </style>

    <!-- Optional: Add some custom CSS to improve the look -->
    <style>
        /* Ensure dropdown form looks clean and interactive */
        .dropdown-menu.show {
            display: block;
            opacity: 1;
            visibility: visible;
        }
        .dropdown-menu form {
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border: 1px solid #e0e0e0;
        }
    </style>
@endsection
