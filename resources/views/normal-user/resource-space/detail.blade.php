@extends('normal-user.master')
@extends('normal-user.message')

@section('right-sidebar')
    <!-- sidebar is not available -->
@endsection

@section('title','Resource Space Detail')

@section('body')


    <!-- Main Content -->
    <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
        <div class="d-flex align-items-center mb-3">
            <a href="{{route('normal-user.resource-space.index')}}" class="material-icons text-dark text-decoration-none m-none me-3">arrow_back</a>
            <p class="ms-2 mb-0 fw-bold text-body fs-6">Explore</p>
        </div>
        <!-- Group Header -->
        <div class="card border-0 shadow-lg mb-4" style="border-radius: 12px; overflow: hidden;">
            <div class="position-relative">
                <!-- Cover Image -->
                <!-- Group Image -->
                <div class="position-absolute top-100 start-50 translate-middle" style="width: 100px; height: 100px; margin-top: 70px;">
                    <img src="{{asset($resourceSpace->image)}}" alt="Group Image" class="rounded-circle border border-light shadow-sm" style="width: 100px; height: 100px;">
                </div>
            </div>
            <div class="card-body text-center mt-5" style="height: 265px; padding-top: 100px;">
                <!-- Group Name and Description -->
                <h4 class="fw-bold mb-1">{{$resourceSpace->name}}</h4>
                <p class="text-muted small">{{$resourceSpace->description}}</p>
                <!-- Group Stats -->
                <div class="d-flex justify-content-center gap-3 mt-3">
                    <p class="text-muted small mb-0"><strong>{{ $resourceSpace->resourceSpaceUsers->count() }}</strong> Members</p>
                    <p class="text-muted small mb-0"><strong>{{ $postCount }}</strong> Posts</p>
                </div>
                <!-- Join Button -->
                @if($resourceSpace->user_id !== auth()->id())
                    @if(!$isMember)
                        <form action="{{ route('normal-user.resource-space.toggleMembership', $resourceSpace->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm mt-3">Join Resource Space</button>
                        </form>
                    @else
                        <form action="{{ route('normal-user.resource-space.toggleMembership', $resourceSpace->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm mt-3">Leave Resource Space</button>
                        </form>
                    @endif
                @else
                        <a href="{{route('normal-user.resource-space-post.dashboard', $resourceSpace->id)}}" type="submit" class="btn btn-success btn-sm mt-3">Resource Space Dashboard</a>

                @endif


            </div>
        </div>

        <!-- Group Posts Section -->
        <section class="mb-4">
            <!-- Header Section -->
            <!-- Group Posts Header -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold"></h5>
                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">Create New</button>
            </div>

            <!-- Modal for selecting Post or Blog -->
            <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-4 shadow-lg">
                        <div class="modal-header border-0">
                            <h5 class="modal-title text-center" id="createModalLabel">Create New</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <p class="lead mb-4">Select an option to proceed:</p>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-outline-primary btn-lg px-5 py-3 mx-3 mb-3 rounded-pill shadow-sm" id="createPostBtn">
                                    <i class="bi bi-file-earmark-post me-2"></i> Create Post
                                </button>
                                <button class="btn btn-outline-dark btn-lg px-5 py-3 mx-3 mb-3 rounded-pill shadow-sm" id="createBlogBtn">
                                    <i class="bi bi-journal-text me-2"></i> Create Blog
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Create Post Form Modal -->
            <div class="modal fade" id="createPostModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-3 shadow-lg">
                        <div class="modal-header border-0">
                            <h5 class="modal-title" id="createPostModalLabel">Create Post</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('normal-user.resource-space-post.store') }}" enctype="multipart/form-data">
                                @csrf <!-- Laravel CSRF protection -->
                                <input type="hidden" name="resource_space_id" value="{{ $resourceSpace->id }}"> <!-- Set the resource space ID -->
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}"> <!-- Set the authenticated user ID -->

                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" id="title" name="title" class="form-control" placeholder="Enter Title" value="{{ old('title') }}" required>
                                    @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea id="description" name="description" class="form-control" rows="4" placeholder="Enter Description" required>{{ old('description') }}</textarea>
                                    @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Image (Optional)</label>
                                    <input type="file" id="image" name="image" class="form-control" accept="image/*">
                                    @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success px-4 py-2">Create Post</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Create Blog Form Modal -->
            <div class="modal fade" id="createBlogModal" tabindex="-1" aria-labelledby="createBlogModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-3 shadow-lg">
                        <div class="modal-header border-0">
                            <h5 class="modal-title" id="createBlogModalLabel">Create Blog</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('normal-user.resource-space-blog.store') }}" enctype="multipart/form-data">
                                @csrf <!-- Laravel CSRF protection -->
                                <input type="hidden" name="resource_space_id" value="{{ $resourceSpace->id }}"> <!-- Set the resource space ID -->
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}"> <!-- Set the authenticated user ID -->

                                <div class="mb-3">
                                    <input type="text" class="form-control" name="title" placeholder="Enter Title" value="{{ old('title') }}" required>
                                    @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea id="summernote" name="description" required>{{ old('description') }}</textarea>
                                    @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-outline-dark px-4 py-2">Create Blog</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add these in your <head> section or before </body> -->
            <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#summernote').summernote({
                        placeholder: 'Write your blog content here...',
                        height: 300,
                        toolbar: [
                            ['style', ['style']],
                            ['font', ['bold', 'underline', 'italic', 'clear']],
                            ['fontsize', ['fontsize']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['table', ['table']],
                            ['insert', ['link']],
                            ['view', ['fullscreen', 'codeview']]
                        ],
                        styleTags: [
                            'p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'
                        ],
                        fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '24', '36'],
                        callbacks: {
                            onImageUpload: function(files) {
                                // Disable direct image uploads for security
                                alert('Please use image URLs or upload images separately');
                            }
                        }
                    });
                });
            </script>

            <!-- Quill.js Text Editor Script -->
            <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
            <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

            <script>

                // Modal Button Actions
                document.getElementById('createPostBtn').addEventListener('click', function() {
                    $('#createModal').modal('hide');
                    $('#createPostModal').modal('show');
                });

                document.getElementById('createBlogBtn').addEventListener('click', function() {
                    $('#createModal').modal('hide');
                    $('#createBlogModal').modal('show');
                });

                // Reset modals to fix blocking issue
                const modals = document.querySelectorAll('.modal');
                modals.forEach((modal) => {
                    modal.addEventListener('hidden.bs.modal', function () {
                        document.body.style.overflow = ''; // Reset body overflow
                        document.querySelectorAll('.modal-backdrop').forEach(function(backdrop) {
                            backdrop.remove(); // Remove backdrop manually
                        });
                    });
                });
            </script>

{{--            <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">--}}
{{--            <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>--}}


            <!-- Bootstrap JS (for modal and other features) -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>




<!-- Show All posts and blogs -->


{{--            @if($sortedItems->isNotEmpty())--}}
{{--                @foreach($sortedItems as $item)--}}
{{--                    @if($item['type'] === 'post')--}}
{{--                        <!-- Post Card -->--}}
{{--                        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">--}}
{{--                            <div class="card-body">--}}
{{--                                <!-- Post Header -->--}}
{{--                                <div class="d-flex align-items-center mb-3">--}}
{{--                                    @if($item['data']->user->image)--}}
{{--                                        <img src="{{asset($item['data']->user->image)}}" alt="User Image" class="rounded-circle me-3 shadow-sm" style="width: 50px; height: 50px;">--}}
{{--                                    @else--}}
{{--                                        <div class="rounded-circle border border-primary d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; background-color: #f0f0f0; color: #007bff; font-size: 15px; font-weight: bold;">--}}
{{--                                            {{ strtoupper(substr($item['data']->user->name, 0, 2)) }}--}}
{{--                                        </div>--}}
{{--                                    @endif--}}
{{--                                    <div class="ml-2">--}}
{{--                                        <h6 class="fw-bold mb-0">{{ $item['data']->user->name }}</h6>--}}
{{--                                        <small class="text-muted">{{ $item['data']->created_at->diffForHumans() }}</small>--}}
{{--                                    </div>--}}

{{--                                    <!-- Post Edit/Delete Dropdown -->--}}
{{--                                    @if(Auth::check() && Auth::user()->id == $item['data']->user_id)--}}
{{--                                        <div class="dropdown ms-auto">--}}
{{--                                            <a href="#" class="text-muted text-decoration-none material-icons md-20 rounded-circle bg-light p-1"--}}
{{--                                               id="dropdownMenuPost{{ $item['data']->id }}" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                                                more_vert--}}
{{--                                            </a>--}}
{{--                                            <ul class="dropdown-menu fs-13 dropdown-menu-end" aria-labelledby="dropdownMenuPost{{ $item['data']->id }}">--}}
{{--                                                <li><a class="dropdown-item text-muted" href="#editPost{{ $item['data']->id }}" data-bs-toggle="collapse">--}}
{{--                                                        <span class="material-icons md-13 me-1">edit</span> Edit Post</a></li>--}}
{{--                                                <li>--}}
{{--                                                    <form action="{{route('normal-user.resource-space-post.delete',$item['data']->id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">--}}
{{--                                                        @csrf--}}
{{--                                                        @method('DELETE')--}}
{{--                                                        <button type="submit" class="dropdown-item text-muted">--}}
{{--                                                            <span class="material-icons md-13 me-1">delete</span> Delete Post--}}
{{--                                                        </button>--}}
{{--                                                    </form>--}}
{{--                                                </li>--}}
{{--                                            </ul>--}}
{{--                                        </div>--}}

{{--                                        <!-- Edit Form -->--}}
{{--                                        <div id="editPost{{ $item['data']->id }}" class="collapse mt-3">--}}
{{--                                            <form method="POST" action="{{ route('normal-user.resource-space-post.update', $item['data']->id) }}" enctype="multipart/form-data">--}}
{{--                                                @csrf--}}
{{--                                                @method('PUT')--}}
{{--                                                <input type="hidden" name="resource_space_id" value="{{ $resourceSpace->id }}">--}}
{{--                                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">--}}

{{--                                                <div class="mb-3">--}}
{{--                                                    <label for="title" class="form-label">Title</label>--}}
{{--                                                    <input type="text" id="title" name="title" class="form-control" placeholder="Enter Title" value="{{ old('title', $item['data']->title) }}" required>--}}
{{--                                                    @error('title')--}}
{{--                                                    <small class="text-danger">{{ $message }}</small>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}

{{--                                                <div class="mb-3">--}}
{{--                                                    <label for="description" class="form-label">Description</label>--}}
{{--                                                    <textarea id="description" name="description" class="form-control" rows="4" placeholder="Enter Description" required>{{ old('description', $item['data']->description) }}</textarea>--}}
{{--                                                    @error('description')--}}
{{--                                                    <small class="text-danger">{{ $message }}</small>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}

{{--                                                <div class="mb-3">--}}
{{--                                                    <label for="image" class="form-label">Image (Optional)</label>--}}
{{--                                                    <input type="file" id="image" name="image" class="form-control" accept="image/*">--}}
{{--                                                    @error('image')--}}
{{--                                                    <small class="text-danger">{{ $message }}</small>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}

{{--                                                <div class="d-flex justify-content-end">--}}
{{--                                                    <button type="submit" class="btn btn-success px-4 py-2">Update Post</button>--}}
{{--                                                </div>--}}
{{--                                            </form>--}}
{{--                                        </div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}

{{--                                <h6 class="text-gray-800 text-lg font-semibold mb-3">{{ $item['data']->title }}</h6>--}}

{{--                                <!-- Post Image -->--}}
{{--                                @if($item['data']->image)--}}
{{--                                    <div class="mb-3">--}}
{{--                                        <img src="{{ asset($item['data']->image) }}" alt="Post Image" class="img-fluid" style="border-radius: 10px;">--}}
{{--                                    </div>--}}
{{--                                @endif--}}

{{--                                <!-- Post Content -->--}}
{{--                                <p>{!! $item['data']->description !!}</p>--}}

{{--                                <!-- Post Actions -->--}}
{{--                                <div class="d-flex justify-content-between align-items-center mt-4">--}}
{{--                                    <div>--}}
{{--                                        <form action="{{ route('normal-user.resource-space-post.upvote', $item['data']->id) }}" method="POST" style="display:inline;">--}}
{{--                                            @csrf--}}
{{--                                            <button type="submit" class="btn btn-light btn-sm text-success me-2">--}}
{{--                                                <i class="bi bi-hand-thumbs-up-fill"></i> Upvote--}}
{{--                                            </button>--}}
{{--                                        </form>--}}
{{--                                        <span class="vote-count">{{ $item['data']->upvotes }}</span>--}}

{{--                                        <form action="{{ route('normal-user.resource-space-post.downvote', $item['data']->id) }}" method="POST" style="display:inline;">--}}
{{--                                            @csrf--}}
{{--                                            <button type="submit" class="btn btn-light btn-sm text-danger">--}}
{{--                                                <i class="bi bi-hand-thumbs-down-fill"></i> Downvote--}}
{{--                                            </button>--}}
{{--                                        </form>--}}
{{--                                        <span class="vote-count">{{ $item['data']->downvotes }}</span>--}}
{{--                                    </div>--}}

{{--                                    <div>--}}
{{--                                        <button class="btn btn-light btn-sm text-primary me-2" data-bs-toggle="modal" data-bs-target="#commentModal{{ $item['data']->id }}">--}}
{{--                                            <i class="bi bi-chat-dots-fill"></i> Comments--}}
{{--                                        </button>--}}
{{--                                        <button class="btn btn-light btn-sm text-primary">--}}
{{--                                            <i class="bi bi-share-fill"></i> Share--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <!-- Comments Modal -->--}}
{{--                            <div class="modal fade" id="commentModal{{ $item['data']->id }}" tabindex="-1" aria-labelledby="commentModalLabel{{ $item['data']->id }}" aria-hidden="true">--}}
{{--                                <div class="modal-dialog modal-lg">--}}
{{--                                    <div class="modal-content">--}}
{{--                                        <div class="modal-header">--}}
{{--                                            <h5 class="modal-title" id="commentModalLabel{{ $item['data']->id }}">Post Comments</h5>--}}
{{--                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                                        </div>--}}

{{--                                        <div class="modal-body">--}}
{{--                                            <!-- Add New Comment -->--}}
{{--                                            <div class="mb-4">--}}
{{--                                                <div class="d-flex align-items-start">--}}
{{--                                                    <img src="{{ auth()->user()->profile_picture ?? 'https://via.placeholder.com/50' }}"--}}
{{--                                                         alt="User Avatar"--}}
{{--                                                         class="rounded-circle me-2"--}}
{{--                                                         style="width: 50px; height: 50px;">--}}
{{--                                                    <form action="{{ route('normal-user.resource-space-post.comment', ['post' => $item['data']->id]) }}" method="POST" class="w-100">--}}
{{--                                                        @csrf--}}
{{--                                                        <textarea class="form-control" name="comment" rows="2" placeholder="Write your comment..." required></textarea>--}}
{{--                                                        <div class="d-flex justify-content-end mt-2">--}}
{{--                                                            <button type="submit" class="btn btn-primary btn-sm">Post Comment</button>--}}
{{--                                                        </div>--}}
{{--                                                    </form>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                            <hr>--}}

{{--                                            <!-- Comments Section -->--}}
{{--                                            <div class="comment-section">--}}
{{--                                                @foreach ($item['data']->comments as $comment)--}}
{{--                                                    @include('normal-user.resource-space.post-comments.comment', ['comment' => $comment])--}}
{{--                                                @endforeach--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @else--}}
{{--                        <!-- Blog Card -->--}}
{{--                        <div class="card border-0 shadow-lg mb-4" style="border-radius: 16px;">--}}
{{--                            <div class="row g-0">--}}
{{--                                @if($item['data']->image)--}}
{{--                                    <div class="col-md-4">--}}
{{--                                        <img src="{{asset($item['data']->image)}}" alt="Blog Thumbnail" class="img-fluid rounded-start" style="height: 100%; object-fit: cover;">--}}
{{--                                    </div>--}}
{{--                                @endif--}}
{{--                                <div class="col-md-{{ $item['data']->image ? '8' : '12' }}">--}}
{{--                                    <div class="card-body">--}}
{{--                                        <h5 class="fw-bold mb-2">{{$item['data']->title}}</h5>--}}
{{--                                        <p class="text-muted small mb-3">{{ $item['data']->created_at->diffForHumans() }}</p>--}}
{{--                                        <p class="text-truncate mb-3" style="max-height: 60px; overflow: hidden;">--}}
{{--                                            {!! \Illuminate\Support\Str::limit($item['data']->description, 30) !!}--}}
{{--                                        </p>--}}
{{--                                        <div class="d-flex justify-content-between align-items-center">--}}
{{--                                            <div class="text-muted small">--}}
{{--                                                <i class="bi bi-eye me-1"></i><strong>{{$item['data']->hit_count}}</strong> Views--}}
{{--                                            </div>--}}
{{--                                            <a href="{{route('normal-user.resource-space-blog.detail',['id'=>$item['data']->id])}}" class="btn btn-primary btn-sm">Read More</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
{{--            @else--}}
{{--                <div class="alert alert-info">No posts or blogs found.</div>--}}
{{--                @endif--}}

{{--                <style>--}}
{{--                    .vote-count {--}}
{{--                        margin-left: 5px;--}}
{{--                        font-weight: bold;--}}
{{--                        font-size: 1.2em;--}}
{{--                    }--}}
{{--                </style>--}}

{{--                <script>--}}
{{--                    function toggleComments() {--}}
{{--                        const commentsSection = document.getElementById('comments-section');--}}
{{--                        commentsSection.style.display = commentsSection.style.display === 'none' ? 'block' : 'none';--}}
{{--                    }--}}
{{--                </script>--}}














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

                                <!-- Post Edit/Delete Dropdown (Visible only for the post owner) -->
                                @if(Auth::check() && Auth::user()->id == $post->user_id)
                                    <div class="dropdown ms-auto">
                                        <a href="#" class="text-muted text-decoration-none material-icons md-20 rounded-circle bg-light p-1"
                                           id="dropdownMenuPost{{ $post->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                            more_vert
                                        </a>
                                        <ul class="dropdown-menu fs-13 dropdown-menu-end" aria-labelledby="dropdownMenuPost{{ $post->id }}">
                                            <!-- Edit Post -->
                                            <li><a class="dropdown-item text-muted" href="#editPost{{ $post->id }}" data-bs-toggle="collapse">
                                                    <span class="material-icons md-13 me-1">edit</span> Edit Post</a></li>
                                            <!-- Delete Post -->
                                            <li>
                                                <form action="{{route('normal-user.resource-space-post.delete',$post->id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-muted">
                                                        <span class="material-icons md-13 me-1">delete</span> Delete Post
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- Edit Form (Visible when 'Edit' is clicked) -->
                                    <div id="editPost{{ $post->id }}" class="collapse mt-3">
                                        <form method="POST" action="{{ route('normal-user.resource-space-post.update', $post->id) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <input type="hidden" name="resource_space_id" value="{{ $resourceSpace->id }}">
                                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                                            <div class="mb-3">
                                                <label for="title" class="form-label">Title</label>
                                                <input type="text" id="title" name="title" class="form-control" placeholder="Enter Title" value="{{ old('title', $post->title) }}" required>
                                                @error('title')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea id="description" name="description" class="form-control" rows="4" placeholder="Enter Description" required>{{ old('description', $post->description) }}</textarea>
                                                @error('description')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="image" class="form-label">Image (Optional)</label>
                                                <input type="file" id="image" name="image" class="form-control" accept="image/*">
                                                @error('image')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-success px-4 py-2">Update Post</button>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            </div>

                            <h6 class="text-gray-800 text-lg font-semibold mb-3">{{ $post->title }}</h6>

                            <!-- Post Image -->
                            @if($post->image)
                                <div class="mb-3">
                                    <img src="{{ asset($post->image) }}" alt="Post Image" class="img-fluid" style="border-radius: 10px;">
                                </div>
                            @endif

                            <!-- Post Content -->
                            <p>{!! $post->description !!}</p>

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


                                <div>
                                    <button class="btn btn-light btn-sm text-primary me-2" data-bs-toggle="modal" data-bs-target="#commentModal"><i class="bi bi-chat-dots-fill"></i> Comments</button>
{{--                                    <button class="btn btn-outline-primary btn-sm d-flex align-items-center gap-2 comment-trigger-btn" data-bs-toggle="modal" data-bs-target="#commentModal">--}}
{{--                                        <i class="bi bi-chat-dots-fill"></i>--}}
{{--                                        <span>Comments</span>--}}
{{--                                    </button>--}}
{{--                                    <button class="btn btn-light btn-sm text-primary"><i class="bi bi-share-fill"></i> Share</button>--}}
                                </div>
                            </div>
                        </div>

                        <!-- Modal to post comments -->
                        <div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content border-0 shadow-lg">
                                    <!-- Modal Header -->
                                    <div class="modal-header bg-light border-0 pb-3">
                                        <h5 class="modal-title fw-bold text-dark" id="commentModalLabel">
                                            <i class="bi bi-chat-dots me-2 text-primary"></i>Comments
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <!-- Modal Body -->
                                    <div class="modal-body px-4 py-3">
                                        <!-- Add New Comment -->
                                        <div class="new-comment-section mb-4">
                                            <div class="card border-0 bg-light">
                                                <div class="card-body p-3">
                                                    <div class="d-flex align-items-start gap-3">
                                                        <div class="avatar-container">
                                                            <img src="{{ asset(auth()->user()->image) }}"
                                                                 alt="User Avatar"
                                                                 class="user-avatar">
                                                        </div>
                                                        <form action="{{ route('normal-user.resource-space-post.comment', ['post' => $post->id]) }}" method="POST" class="flex-grow-1">
                                                            @csrf
                                                            <div class="form-group mb-3">
                                        <textarea class="form-control border-0 shadow-sm"
                                                  name="comment"
                                                  rows="3"
                                                  placeholder="Share your thoughts..."
                                                  required
                                                  style="resize: none; background-color: white;"></textarea>
                                                            </div>
                                                            <div class="d-flex justify-content-end">
                                                                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">
                                                                    <i class="bi bi-send me-1"></i>Post Comment
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Comments Section -->
                                        <div class="comments-container">
                                            <div class="comments-header mb-3">
                                                <h6 class="text-muted mb-0">
                                                    <i class="bi bi-chat-square-text me-2"></i>Discussion
                                                </h6>
                                            </div>

                                            <div class="comment-section">
                                                @foreach ($comments as $comment)
                                                    @include('normal-user.resource-space.post-comments.comment', ['comment' => $comment])
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach

            @endif

        </section>

        <script>
            function toggleComments() {
                const commentsSection = document.getElementById('comments-section');
                commentsSection.style.display = commentsSection.style.display === 'none' ? 'block' : 'none';
            }
        </script>
        <!-- Icon -->
        <!-- Bootstrap JS and Popper.js -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


        <!-- Group Blogs Section -->
        <section class="mb-4">

            <!-- Single Blog -->
            @if($blogs->isNotEmpty())
                @foreach($blogs as $blog)
                    <div class="card border-0 shadow-lg mb-4" style="border-radius: 16px;">
                        <div class="row g-0">
                            <!-- Blog Thumbnail -->
                            @if($blog->image)
                            <div class="col-md-4">
                                <img src="{{asset($blog->image)}}" alt="Blog Thumbnail" class="img-fluid rounded-start" style="height: 100%; object-fit: cover;">
                            </div>
                            @endif
                            <!-- Blog Content -->
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="fw-bold mb-2">{{$blog->title}}</h5>
                                    <p class="text-muted small mb-3">{{ $blog->created_at->diffForHumans() }}</p>
                                    <p class="text-truncate mb-3" style="max-height: 60px; overflow: hidden;">{!! \Illuminate\Support\Str::limit($blog->description,30) !!}</p>
                                    <!-- Blog Meta -->
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="text-muted small">
                                            <i class="bi bi-eye me-1"></i><strong>{{$blog->hit_count}}</strong> Views
                                        </div>
                                        <a href="{{route('normal-user.resource-space-blog.detail',['id'=>$blog->id])}}" class="btn btn-primary btn-sm">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            <!-- Add more blogs as needed -->
        </section>

    </main>
    <!-- Main Content -->



    <aside class="side-bar col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-6 col-12">
        <div class="fix-right-sidebar">
            <div class="scrollable-content">
                <div class="side-trend lg-none">

                <!-- Button to Trigger Modal -->
                    @if($resourceSpace->type == 2)
                        @if($resourceSpace->user_id == auth()->id())
                            @if($resourceSpace->questions->isEmpty())
                                <!-- Show Create Joining Questions Button if no questions are created -->
                                <a href="{{ route('normal-user.resource-space.storeResourceQuestion', $resourceSpace->id) }}" class="btn btn-primary w-100 mb-3">
                                    Create Joining Questions
                                </a>
                            @else
                                <!-- Show Edit Joining Questions Button if questions are already created -->
                                <a href="{{ route('normal-user.resource-space.editResourceQuestion', $resourceSpace->id) }}" class="btn btn-primary w-100 mb-3">
                                    Edit Joining Questions
                                </a>
                            @endif
                        @endif
                    @endif



                <div class="space-y-8">
                    <!-- Resource Space Stats -->
                    <div class="bg-gradient-to-br from-blue-50 to-white shadow-lg rounded-xl p-6">
                        <h5 class="text-xl font-bold text-blue-700 mb-6 flex items-center">
                            <span class="material-icons text-blue-500 mr-2 text-2xl">insights</span>
                            Resource Space Stats
                        </h5>
                        <ul class="space-y-4">
                            <li class="flex items-center">
                                <span class="material-icons text-green-500 text-2xl mr-3">groups</span>
                                <span class="text-gray-700 font-medium">Total Members:</span>
                                <strong class="ml-auto text-gray-900">{{ $resourceSpace->resourceSpaceUsers->count() }}</strong>
                            </li>
                            <li class="flex items-center">
                                <span class="material-icons text-blue-500 text-2xl mr-3">article</span>
                                <span class="text-gray-700 font-medium">Total Posts:</span>
                                <strong class="ml-auto text-gray-900">{{ $postCount }}</strong>
                            </li>
                            <li class="flex items-center">
                                <span class="material-icons text-yellow-500 text-2xl mr-3">visibility</span>
                                <span class="text-gray-700 font-medium">Total Engagement:</span>
                                <strong class="ml-auto text-gray-900">{{$totalEngagement}}</strong>
                            </li>
                        </ul>
                    </div>

                    <!-- Featured Post -->
                    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-6 text-white">
                            <h5 class="text-lg font-bold flex items-center">
                                <span class="material-icons mr-2 text-2xl">push_pin</span>
                                Pinned Post
                            </h5>
                        </div>

                        @php $displayed = false; @endphp

                        @foreach($posts as $post)
                            @if($post->status == 1 && !$displayed)
                                <div class="p-6">
                                    <!-- Post Image -->
                                    @if($post->image)
                                        <div class="mb-3">
                                            <img src="{{ asset($post->image) }}" alt="Post Image" class="img-fluid" style="border-radius: 10px;">
                                        </div>
                                    @endif
                                    <h6 class="text-gray-800 text-lg font-semibold mb-3">{{ $post->title }}</h6>
                                    <p class="text-gray-600 mb-4">
                                        {{ $post->description }}
{{--                                        {{ \Illuminate\Support\Str::limit($post->description, 100) }}--}}
                                    </p>
                                </div>
                                @php $displayed = true; @endphp
                            @endif
                        @endforeach

                    </div>


                </div>





            </div>
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



    /*  right sidebar design */
        .card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .card h5 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }
        .card h5 span {
            margin-right: 0.5rem;
        }
        .card ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .card ul li {
            margin-bottom: 0.5rem;
            color: #6b7280;
            display: flex;
            align-items: center;
        }
        .card ul li span {
            margin-right: 0.5rem;
        }
        .card a {
            color: #ffffff;
            font-weight: 600;
            text-decoration: none;
        }

    </style>
    <style>
        .fix-right-sidebar {
            max-height: 660px;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #e7eef5 #f0f0f0;
            border-radius: 10px;
        }

        .side-bar{
            position: fixed;
            top: 10px;
            right: 10px;
            width: 300px;
            max-height: 660px;
            overflow: hidden;
            border-radius: 10px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">



@endsection
