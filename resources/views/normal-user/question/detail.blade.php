@extends('normal-user.master')
@extends('normal-user.message')

@section('right-sidebar')
    <!-- sidebar is not available -->
@endsection

@section('title','Edit Profile')

@section('body')

    <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
        <div class="main-content">
            <div class="d-flex align-items-center mb-3">
                <a href="{{route('normal-user.question.index')}}" class="material-icons text-dark text-decoration-none m-none me-3">arrow_back</a>
                <p class="ms-2 mb-0 fw-bold text-body fs-6">Explore</p>
            </div>

            <!-- Trending Item -->
            <!-- Feed Item -->
            <div class="bg-white p-3 feed-item rounded-4 mb-3 shadow-sm">
                <div class="d-flex">
{{--                    <img src="" class="img-fluid rounded-circle user-img" alt="profile-logo">--}}
                    @if($question->user->image)
                        <!-- Display user image -->
                        <img src="{{ asset($question->user->image) }}" class="img-fluid rounded-circle border border-primary" alt="profile-img" style="width: 35px; height: 35px; object-fit: cover;">
                    @else
                        <!-- Fallback to initials with a customizable background color -->
                        <div class="rounded-circle border border-primary d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; background-color: #f0f0f0; color: #007bff; font-size: 15px; font-weight: bold;">
                            {{ strtoupper(substr($question->user->image, 0, 2)) }}
                        </div>
                    @endif
                    <div class="d-flex ms-3 align-items-start w-100">
                        <div class="w-100">
                            <div class="d-flex align-items-center justify-content-between">
                                <a href="#" class="text-decoration-none d-flex align-items-center">
                                    <h6 class="fw-bold mb-0 text-body">{{ $question->user->name }}</h6>
                                    <span class="ms-2 material-icons bg-primary p-0 md-16 fw-bold text-white rounded-circle ov-icon">done</span>
                                </a>
                                <div class="d-flex align-items-center small">
                                    <p class="text-muted mb-0">{{ $question->created_at->diffForHumans() }}</p>
                                    <div class="dropdown">
                                        @if (auth()->id() == $question->user_id)
                                            <a href="#" class="text-muted text-decoration-none material-icons ms-2 md-20 rounded-circle bg-light p-1" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">more_vert</a>
                                            <ul class="dropdown-menu fs-13 dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                                <li>
                                                    <a class="dropdown-item text-muted" href="#" data-bs-toggle="modal" data-bs-target="#editQuestionModal{{ $question->id }}">
                                                        <span class="material-icons md-13 me-1">edit</span>Edit
                                                    </a>
                                                </li>

                                                <li><a class="dropdown-item text-muted" href="{{ route('normal-user.question.delete', $question->id) }}"><span class="material-icons md-13 me-1">delete</span>Delete</a></li>
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="my-2">
                                <p class="mb-3 text-primary">{{ $question->title }}</p>
                                <!-- Display question image -->
                                @if($question->image)
                                    <div class="mt-3">
                                        <img src="{{ asset($question->image) }}" alt="Question Image" class="img-fluid rounded-3 shadow-sm" style="max-height: 250px; object-fit: cover;">
                                    </div>
                                @endif
                                <ul class="list-unstyled mb-3 mt-3">
                                    <p>{{ $question->description }}</p>
                                </ul>

                                <p class="mb-2">
                                    @foreach($question->tags as $tag)
                                        <a href="#" class="text-decoration-none">#{{ $tag->tags }}</a>
                                    @endforeach
                                </p>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <div class="d-flex gap-3">
                                        <!-- Upvote Button -->
                                        <form action="{{ route('question.vote', $question->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="vote" value="1">
                                            <button type="submit" class="text-decoration-none d-flex align-items-start fw-light border-0 bg-transparent p-0">
            <span
                class="material-icons md-20 me-2 {{ auth()->check() && $question->votes->where('user_id', auth()->id())->where('vote', 1)->count() ? 'text-primary' : 'text-muted' }}">
                thumb_up_off_alt
            </span>
{{--                upvote option                                --}}
                                                <span>{{ number_format($question->upvotes()->count()) }}</span>
                                            </button>
                                        </form>

                                        <!-- Downvote Button -->
                                        <form action="{{ route('question.vote', $question->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="vote" value="0">
                                            <button type="submit" class="text-decoration-none d-flex align-items-start fw-light border-0 bg-transparent p-0">
            <span
                class="material-icons md-20 me-2 {{ auth()->check() && $question->votes->where('user_id', auth()->id())->where('vote', 0)->count() ? 'text-primary' : 'text-muted' }}">
                thumb_down_off_alt
            </span>
                                                <span>{{ number_format($question->downvotes()->count()) }}</span>
                                            </button>
                                        </form>
                                    </div>



                                    <div class="d-flex align-items-center mb-3" data-bs-toggle="modal" data-bs-target="#commentModal">
                                        <a href="#" class="text-muted text-decoration-none d-flex align-items-start fw-light">
                                            <span class="material-icons md-20 me-2">chat_bubble_outline</span>
                                            <span>{{$question->questionComments->count()}}</span>
                                        </a>
                                    </div>
                                    <div>
{{--                                        <a href="#" class="text-muted text-decoration-none d-flex align-items-start fw-light">--}}
{{--                                            <span class="material-icons md-18 me-2">share</span>--}}
{{--                                            <span>Share</span>--}}
{{--                                        </a>--}}
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-3" data-bs-toggle="modal" data-bs-target="#commentModal">
                                    <span class="material-icons bg-white border-0 text-primary pe-2 md-36">account_circle</span>
                                    <input type="text" class="form-control form-control-sm rounded-3 fw-light" placeholder="Write Your comment">
                                </div>
                                <div class="comments">
                                    @if($question->questionComments && $question->questionComments->count() > 0)
                                        @foreach($question->questionComments as $comment)
                                            <div class="comment">
                                                @if ($comment->status == 1)
                                            <div class="d-flex mb-2">
                                                <a href="#" class="text-dark text-decoration-none">
                                                    @if($comment->user->image)
                                                        <!-- Display user image -->
                                                        <img src="{{ asset($comment->user->image) }}" class="img-fluid rounded-circle border border-primary" alt="profile-img" style="width: 56px; height: 56px; object-fit: cover;">
                                                    @else
                                                        <!-- Fallback to initials with a customizable background color -->
                                                        <div class="rounded-circle border border-primary d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; background-color: #f0f0f0; color: #007bff; font-size: 15px; font-weight: bold;">
                                                            {{ strtoupper(substr($comment->user->name, 0, 2)) }}
                                                        </div>
                                                    @endif
                                                </a>

{{--                                                <div class="comment">--}}
{{--                                                    @if ($comment->status == 1)--}}
                                                <div class="ms-2 small">
                                                    <a href="#" class="text-dark text-decoration-none">
                                                        <div class="bg-light px-3 py-2 rounded-4 mb-1 chat-text">
                                                            <p class="fw-500 mb-0">{{ $comment->user->name }}</p>
                                                            <span class="text-muted">{!! $comment->answer !!}</span>

                                                        </div>
                                                    </a>
                                                    <!-- Edit and Delete options only for the comment's author -->
                                                    @if(auth()->id() == $comment->user_id)
                                                        <div class="d-flex align-items-center ms-2">
                                                            <a href="#" class="small text-muted text-decoration-none" data-bs-toggle="modal" data-bs-target="#editCommentModal{{ $comment->id }}">Edit</a>
                                                            <span class="fs-3 text-muted material-icons mx-1">circle</span>
                                                            <a href="{{route('normal-user.question.comment.delete', $comment->id)}}" class="small text-muted text-decoration-none">Delete</a>
                                                        </div>
                                                    @endif




                                                    <div class="d-flex align-items-center ms-2">
                                                        <span class="fs-3 text-muted material-icons mx-1">circle</span>
                                                        <span class="small text-muted">{{ $comment->created_at->diffForHumans() }}</span>
                                                    </div>
                                                </div>



                                            </div>
                                                    <a href="{{ route('normal-user.question.comment.reportSpam', $comment->id) }}"
                                                       class="text-red-500 text-sm">Report Spam</a>
                                                @else
                                                    <p class="text-gray-500 italic">This comment has been hidden due to multiple reports.</p>
                                                @endif
                                            </div>
                                        @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Trending Item -->

            <!-- Edit Comment Modal -->
            <div class="modal fade" id="editCommentModal{{ $comment->id }}" tabindex="-1" aria-labelledby="editCommentModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editCommentModalLabel">Edit Comment</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Form to edit the comment -->
                            <form action="{{ route('normal-user.question.comment.update', $comment->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <input type="hidden" name="question_id" value="{{ $question->id }}">
                                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                    <textarea name="answer" id="ckeditor{{ $comment->id }}" class="form-control" rows="4">{!! $comment->answer !!}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            @else
                <p class="text-muted">No comments available.</p>
            @endif

            <!-- Include CKEditor JS -->
            <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
            <script>
                // Initialize CKEditor for each modal
                @foreach($question->questionComments as $comment)
                CKEDITOR.replace('ckeditor{{ $comment->id }}', {
                    height: 200, // Set the height of the editor
                    removePlugins: 'resize,elementspath', // Remove unnecessary plugins
                    toolbar: [
                        { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
                        { name: 'paragraph', items: ['BulletedList', 'NumberedList'] },
                        { name: 'links', items: ['Link', 'Unlink'] }
                    ],
                    on: {
                        instanceReady: function () {
                            // Disable notification display by overriding the default showNotification method
                            this.showNotification = function () {}; // This will prevent notifications from being shown
                        }
                    }
                });
                @endforeach
            </script>


            <!-- question edit -->
            <!-- Edit Question Modal -->
            <div class="modal fade" id="editQuestionModal{{ $question->id }}" tabindex="-1" aria-labelledby="editQuestionModalLabel{{ $question->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editQuestionModalLabel{{ $question->id }}">Edit Question</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('normal-user.question.update', $question->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                <!-- Title Input -->
                                <div class="mb-3">
                                    <label for="editQuestionTitle{{ $question->id }}" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="editQuestionTitle{{ $question->id }}" name="title" value="{{ $question->title }}" required>
                                </div>

                                <!-- Description Input -->
                                <div class="mb-3">
                                    <label for="editQuestionDescription{{ $question->id }}" class="form-label">Description</label>
                                    <textarea class="form-control" id="editQuestionDescription{{ $question->id }}" name="description" rows="4" required>{{ $question->description }}</textarea>
                                </div>

                                <!-- Tags Input -->
                                <div class="mb-3">
                                    <label for="tags" class="form-label">Tags</label>
                                    <div id="tags-container-{{ $question->id }}" class="tags-container">
                                        <input type="text" id="tag-input-{{ $question->id }}" class="form-control" placeholder="Enter tags and press Enter">
                                    </div>
                                    <input type="hidden" name="tags" id="hidden-tags-input-{{ $question->id }}" value="{{ $question->tags->pluck('tags')->implode(',') }}">
                                </div>

                                <!-- Image Upload -->
                                <div class="mb-3">
                                    <label for="editQuestionImage{{ $question->id }}" class="form-label">Upload Image (Optional)</label>
                                    <input type="file" class="form-control" id="editQuestionImage{{ $question->id }}" name="image">
                                    <p class="text-muted mt-1">Current Image: <a href="{{ asset($question->image) }}" target="_blank">{{ $question->image }}</a></p>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary w-100">Update Question</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>





            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const tagInput = document.getElementById('tag-input-{{ $question->id }}');
                    const tagsContainer = document.getElementById('tags-container-{{ $question->id }}');
                    const hiddenTagsInput = document.getElementById('hidden-tags-input-{{ $question->id }}');
                    let tags = hiddenTagsInput.value ? hiddenTagsInput.value.split(',').filter(tag => tag.trim() !== '') : [];

                    renderTags();

                    tagInput.addEventListener('keydown', function (e) {
                        if (e.key === 'Enter' && tagInput.value.trim() !== '') {
                            e.preventDefault();
                            addTag(tagInput.value.trim());
                            tagInput.value = '';
                        }
                    });

                    function addTag(tag) {
                        tag = tag.trim();
                        if (tag !== '' && !tags.includes(tag)) {
                            tags.push(tag);
                            renderTags();
                            updateHiddenInput();
                        }
                    }

                    function renderTags() {
                        tagsContainer.innerHTML = '';
                        tags.forEach(tag => {
                            const tagElement = document.createElement('span');
                            tagElement.classList.add('tag');
                            tagElement.textContent = tag;

                            const closeElement = document.createElement('span');
                            closeElement.classList.add('tag-close');
                            closeElement.textContent = '×';
                            closeElement.addEventListener('click', () => removeTag(tag));

                            tagElement.appendChild(closeElement);
                            tagsContainer.appendChild(tagElement);
                        });

                        tagsContainer.appendChild(tagInput);
                    }

                    function removeTag(tag) {
                        tags = tags.filter(t => t !== tag);
                        renderTags();
                        updateHiddenInput();
                    }

                    function updateHiddenInput() {
                        tags = tags.filter(tag => tag.trim() !== ''); // Ensure no blank tags
                        hiddenTagsInput.value = tags.join(',');
                    }
                });
            </script>

            <!-- question edit -->



            <!-- Comment Modal -->
            <div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-4 overflow-hidden border-0">
                        <div class="modal-header d-none">
                            <h5 class="modal-title" id="exampleModalLabel2">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <div class="row m-0">
                                <div class="col-sm-7 px-0 m-sm-none">
                                    <!-- Image Slider (if you have one) -->
                                    <div class="image-slider">
                                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-indicators">
                                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                            </div>
                                            <div class="carousel-inner" style="height: 300px; overflow: hidden;">
                                                <div class="carousel-item active">
                                                    <img src="{{ asset('/') }}normal-user-assets/assets/img/login.jpeg" class="d-block w-100 h-100 object-cover" alt="...">
                                                </div>
                                            </div>

                                            <!-- Add the following CSS -->
                                            <style>
                                                .object-cover {
                                                    object-fit: cover;
                                                    height: 100%;
                                                    width: 100%;
                                                }
                                            </style>

                                        </div>
                                    </div>

                                    <!-- Comment Section with CKEditor -->
                                    <div class="mt-3">
                                        <form action="{{ route('normal-user.question.comment.store') }}" method="POST">
                                            @csrf
                                            <div class="form-group" style="width: 460px; margin-left: 8px;">
                                                <label for="comment" class="form-label fw-bold">Write a Comment</label>
                                                <input type="hidden" name="question_id" value="{{ $question->id }}"> <!-- Pass the question ID -->
                                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                                <textarea name="answer" id="ckeditorDirect" class="form-control" rows="6" placeholder="Write your comment..."></textarea>
                                            </div>
                                            <button type="submit" style="margin-left: 10px;" class="btn btn-primary mt-3">Post Comment</button>
                                        </form>
                                    </div>

                                    <!-- Include CKEditor JS -->
                                    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
                                    <script>
                                        // Initialize CKEditor directly below the carousel
                                        CKEDITOR.replace('ckeditorDirect', {
                                            height: 150, // Adjust height as needed
                                            removePlugins: 'resize,elementspath', // Remove unnecessary plugins
                                            toolbar: [
                                                { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
                                                { name: 'paragraph', items: ['BulletedList', 'NumberedList'] },
                                                { name: 'links', items: ['Link', 'Unlink'] }
                                            ],
                                            on: {
                                                instanceReady: function () {
                                                    this.showNotification = function () {}; // Disable notifications
                                                }
                                            }
                                        });
                                    </script>

                                </div>
                                <div class="col-sm-5 content-body px-web-0">
                                    <div class="d-flex flex-column h-100">
                                        <div class="d-flex p-3 border-bottom">
                                            <!-- User image and name section -->
                                            @if($question->user->image)
                                                <img src="{{ asset($question->user->image) }}" class="img-fluid rounded-circle border border-primary" alt="profile-img" style="width: 35px; height: 35px; object-fit: cover;">
                                            @else
                                                <div class="rounded-circle border border-primary d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; background-color: #f0f0f0; color: #007bff; font-size: 15px; font-weight: bold;">
                                                    {{ strtoupper(substr($question->user->name, 0, 2)) }}
                                                </div>
                                            @endif
                                            <div class="d-flex align-items-center justify-content-between w-100">
                                                <a href="profile.html" class="text-decoration-none ms-3">
                                                    <div class="d-flex align-items-center">
                                                        <h6 class="fw-bold text-body mb-0">{{$question->user->name}}</h6>
                                                        <p class="ms-2 material-icons bg-primary p-0 md-16 fw-bold text-white rounded-circle ov-icon mb-0">done</p>
                                                    </div>
                                                </a>
                                                <div class="small dropdown">
                                                    <a href="#" class="text-muted text-decoration-none material-icons ms-2 md-" data-bs-dismiss="modal">close</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="comments p-3" style="overflow-y: auto; max-height: 470px;">
                                            <!-- Comments Section -->
                                            @foreach($question->questionComments as $comment)
                                                <div class="d-flex mb-2">
                                                    <a href="#" class="text-dark text-decoration-none">
                                                        @if($comment->user->image)
                                                            <img src="{{ asset($comment->user->image) }}" class="img-fluid rounded-circle border border-primary" alt="profile-img" style="width: 56px; height: 56px; object-fit: cover;">
                                                        @else
                                                            <div class="rounded-circle border border-primary d-flex align-items-center justify-content-center" style="width: 33px; height: 33px; background-color: #f0f0f0; color: #007bff; font-size: 12px; font-weight: bold;">
                                                                {{ strtoupper(substr($comment->user->name, 0, 2)) }}
                                                            </div>
                                                        @endif
                                                    </a>
                                                    <div class="ms-2 small">
                                                        <div class="bg-light px-3 py-2 rounded-4 mb-1 chat-text" style="width: 275px;">
                                                            <p class="fw-500 mb-0">{{$comment->user->name}}</p>
                                                            <span class="text-muted">{!! $comment->answer !!}</span>
                                                        </div>
                                                        <div class="d-flex align-items-center ms-2">
                                                            <span class="fs-3 text-muted material-icons mx-1">circle</span>
                                                            <span class="small text-muted">{{ $comment->created_at->diffForHumans() }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="border-top p-3 mt-auto">
                                            <!-- Comment Box -->
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <div class="d-flex gap-3">
                                                    <!-- Upvote Button -->
                                                    <form action="{{ route('question.vote', $question->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <input type="hidden" name="vote" value="1">
                                                        <button type="submit" class="text-decoration-none d-flex align-items-start fw-light border-0 bg-transparent p-0">
            <span
                class="material-icons md-20 me-2 {{ auth()->check() && $question->votes->where('user_id', auth()->id())->where('vote', 1)->count() ? 'text-primary' : 'text-muted' }}">
                thumb_up_off_alt
            </span>
                                                            <span>{{ number_format($question->upvotes()->count()) }}</span>
                                                        </button>
                                                    </form>

                                                    <!-- Downvote Button -->
                                                    <form action="{{ route('question.vote', $question->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <input type="hidden" name="vote" value="0">
                                                        <button type="submit" class="text-decoration-none d-flex align-items-start fw-light border-0 bg-transparent p-0">
            <span
                class="material-icons md-20 me-2 {{ auth()->check() && $question->votes->where('user_id', auth()->id())->where('vote', 0)->count() ? 'text-primary' : 'text-muted' }}">
                thumb_down_off_alt
            </span>
                                                            <span>{{ number_format($question->downvotes()->count()) }}</span>
                                                        </button>
                                                    </form>
                                                </div>

                                                <div>
{{--                                                    <a href="#" class="text-muted text-decoration-none d-flex align-items-start fw-light"><span class="material-icons md-18 me-2">share</span><span>Share</span></a>--}}
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>








        </div>
    </main>



    <style>
        /* For comment section to prevent overflow */
        .comments {
            max-width: 100%;
            overflow-wrap: break-word;
        }

        .comments .chat-text {
            word-wrap: break-word;
            white-space: normal;
        }

        /* For CKEditor to prevent hidden text and allow vertical scroll */
        .cke_editable {
            height: auto !important;
            max-height: 150px !important;
            overflow-y: auto !important;
            padding: 10px !important;
        }

        /* Ensure the comment input form does not overlap */
        .comment-input-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .comment-input-container .form-control {
            min-height: 120px;
        }

        /* Fix modal and content overflow */
        .modal-body {
            overflow: hidden;
        }

        .modal-dialog {
            max-width: 900px;
        }

        /* Adjust for image container if needed */
        .cke_inner {
            border-radius: 0.375rem !important;
            border: 1px solid #ced4da !important;
        }

    </style>


    <aside class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-6 col-12" style="margin-top: 50px;">
        <div class="fix-sidebar">
            <div class="side-trend lg-none">
                <!-- Search Tab -->
                <div class="sticky-sidebar2 mb-3">

                    <div class="bg-white rounded-4 overflow-hidden shadow-sm account-follow mb-4">
                        <h6 class="fw-bold text-body p-3 mb-0 border-bottom">Related Questions</h6>

                        @foreach($relatedQuestions as $relatedQuestion)
                            <div class="p-3 border-bottom d-flex text-dark text-decoration-none account-item">
                                <!-- Profile Image Placeholder, can be replaced with actual image if necessary -->
                                <a href="{{ route('normal-user.question.detail', $relatedQuestion->id) }}">
{{--                                    <img src="{{asset($relatedQuestion->image)}}" style="width: 90px; height: auto;" class="img-fluid rounded-circle me-3" alt="profile-img">--}}
                                    @if($relatedQuestion->image)
                                        <!-- Display user image -->
                                        <img src="{{ asset($relatedQuestion->image) }}" class="img-fluid rounded-circle border border-primary" alt="profile-img" style="width: 90px; height: auto; object-fit: cover;">
                                    @else
                                        <!-- Fallback to initials with a customizable background color -->
                                        <div class="rounded-circle border border-primary d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; background-color: #f0f0f0; color: #007bff; font-size: 15px; font-weight: bold;">
                                            {{ strtoupper(substr($relatedQuestion->title, 0, 2)) }}
                                        </div>
                                    @endif
                                </a>

                                <div style="margin-left: 10px;">
                                    <p class="fw-bold mb-0 pe-3 d-flex align-items-center">
                                        <a class="text-decoration-none text-dark" href="{{ route('normal-user.question.detail', $relatedQuestion->id) }}">
                                            {{ Str::limit($relatedQuestion->title, 50) }} <!-- Limiting title length -->
                                        </a>
                                    </p>
                                    <div class="text-muted fw-light">
                                        <p class="mb-1 small">{{ Str::limit($relatedQuestion->description, 100) }}</p> <!-- Limiting description length -->
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </aside>


@endsection
