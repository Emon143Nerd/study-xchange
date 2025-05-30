<div class="comment-item mb-3" data-comment-id="{{ $comment->id }}">
    <div class="comment-card">
        <div class="d-flex align-items-start gap-3">
            <div class="avatar-container">
                <img src="{{ asset($comment->user->image) }}"
                     alt="{{ $comment->user->name }}"
                     class="user-avatar comment-avatar">
            </div>

            <div class="comment-content flex-grow-1">
                <div class="comment-header mb-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="user-info">
                            <strong class="username text-dark">{{ $comment->user->name }}</strong>
                            <small class="timestamp text-muted ms-2">
                                <i class="bi bi-clock me-1"></i>{{ $comment->created_at->diffForHumans() }}
                            </small>
                        </div>

                        <!-- Delete Button (only visible to the comment owner) -->
                        @if(auth()->id() == $comment->user_id)
                            <div class="comment-actions">
                                <form action="{{ route('normal-user.resource-space-post.comment.delete', ['id' => $comment->id]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link btn-sm text-danger p-0 delete-btn" title="Delete comment">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="comment-text mb-3">
                    <p class="mb-0 text-break lh-base">{{ $comment->comment }}</p>
                </div>

                <div class="comment-footer">
                    <!-- Only show reply button if comment has no replies yet -->
                    @if($comment->replies->count() == 0)
                        <button class="btn btn-link btn-sm text-primary p-0 reply-btn"
                                data-bs-toggle="collapse"
                                data-bs-target="#replyForm{{ $comment->id }}"
                                title="Reply to comment">
                            <i class="bi bi-reply me-1"></i>Reply
                        </button>
                    @else
                        <span class="text-muted small">
                            <i class="bi bi-reply me-1"></i>Already replied
                        </span>
                    @endif
                </div>

                <!-- Reply Form (only show if no replies exist) -->
                @if($comment->replies->count() == 0)
                    <div id="replyForm{{ $comment->id }}" class="collapse mt-3">
                        <div class="reply-form-container">
                            <div class="d-flex align-items-start gap-2">
                                <img src="{{ asset(auth()->user()->image) }}"
                                     alt="Your Avatar"
                                     class="reply-avatar">
                                <form action="{{ route('normal-user.resource-space-post.comment', ['post' => $post->id]) }}" method="POST" class="flex-grow-1">
                                    @csrf
                                    <div class="form-group mb-2">
                                        <textarea class="form-control form-control-sm border-0 shadow-sm"
                                                  name="comment"
                                                  rows="2"
                                                  placeholder="Write your reply..."
                                                  required
                                                  style="resize: none; background-color: #f8f9fa;"></textarea>
                                    </div>
                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill" data-bs-toggle="collapse" data-bs-target="#replyForm{{ $comment->id }}">
                                            Cancel
                                        </button>
                                        <button type="submit" class="btn btn-sm btn-primary rounded-pill">
                                            <i class="bi bi-send me-1"></i>Reply
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Single Reply (only one will be shown) -->
                @if ($comment->replies->count() > 0)
                    <div class="nested-replies mt-3">
                        @php
                            $reply = $comment->replies->first(); // Get only the first reply
                        @endphp
                        <div class="comment-item mb-3" data-comment-id="{{ $reply->id }}">
                            <div class="comment-card reply-card">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="avatar-container">
                                        <img src="{{ asset($reply->user->image) }}"
                                             alt="{{ $reply->user->name }}"
                                             class="user-avatar reply-avatar">
                                    </div>

                                    <div class="comment-content flex-grow-1">
                                        <div class="comment-header mb-2">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="user-info">
                                                    <strong class="username text-dark">{{ $reply->user->name }}</strong>
                                                    <small class="timestamp text-muted ms-2">
                                                        <i class="bi bi-clock me-1"></i>{{ $reply->created_at->diffForHumans() }}
                                                    </small>
                                                </div>

                                                <!-- Delete Button (only visible to the reply owner) -->
                                                @if(auth()->id() == $reply->user_id)
                                                    <div class="comment-actions">
                                                        <form action="{{ route('normal-user.resource-space-post.comment.delete', ['id' => $reply->id]) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-link btn-sm text-danger p-0 delete-btn" title="Delete reply">
                                                                <i class="bi bi-trash3"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="comment-text mb-2">
                                            <p class="mb-0 text-break lh-base">{{ $reply->comment }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    /* Modern Comment System Styling */
    .comment-item {
        position: relative;
    }

    .comment-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        border: 1px solid #e9ecef;
        transition: all 0.2s ease;
        position: relative;
    }

    .comment-card:hover {
        border-color: #dee2e6;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    /* Reply Card Styling */
    .reply-card {
        background: #f8f9fa;
        border: 1px solid #e3e6ea;
        padding: 15px;
        border-radius: 10px;
    }

    .reply-card:hover {
        background: #f1f3f4;
        border-color: #d6d9dc;
    }

    /* Avatar Styling */
    .avatar-container {
        position: relative;
    }

    .user-avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .comment-avatar {
        width: 40px;
        height: 40px;
    }

    .reply-avatar {
        width: 32px;
        height: 32px;
        border: 2px solid #fff;
    }

    /* User Info */
    .username {
        font-size: 0.95rem;
        font-weight: 600;
        color: #2c3e50;
    }

    .timestamp {
        font-size: 0.8rem;
        color: #6c757d;
    }

    /* Comment Content */
    .comment-text {
        font-size: 0.95rem;
        line-height: 1.6;
        color: #495057;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    /* Action Buttons */
    .reply-btn {
        font-size: 0.85rem;
        font-weight: 500;
        text-decoration: none !important;
        color: #007bff;
        transition: color 0.2s ease;
    }

    .reply-btn:hover {
        color: #0056b3;
    }

    .delete-btn {
        font-size: 0.9rem;
        text-decoration: none !important;
        color: #dc3545;
        transition: all 0.2s ease;
        opacity: 0.7;
    }

    .delete-btn:hover {
        opacity: 1;
        color: #c82333;
    }

    /* Reply Form */
    .reply-form-container {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 15px;
        border: 1px solid #e9ecef;
    }

    /* Nested Replies */
    .nested-replies {
        position: relative;
        margin-left: 25px;
        padding-left: 20px;
    }

    .nested-replies::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(to bottom, #007bff, #e9ecef);
        border-radius: 1px;
    }

    /* New Comment Section */
    .new-comment-section .card {
        border-radius: 15px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }

    /* Modal Enhancements */
    .modal-content {
        border-radius: 15px;
        overflow: hidden;
    }

    .modal-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }

    .modal-body {
        background-color: #fdfdfd;
        max-height: 70vh;
        overflow-y: auto;
    }

    /* Comments Container */
    .comments-container {
        max-height: 500px;
        overflow-y: auto;
        padding-right: 5px;
    }

    .comments-container::-webkit-scrollbar {
        width: 6px;
    }

    .comments-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    .comments-container::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 3px;
    }

    .comments-container::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }

    /* Form Controls */
    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.15);
    }

    /* Button Enhancements */
    .btn-primary {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        border: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,123,255,0.3);
    }

    .btn-outline-primary {
        border-width: 2px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-outline-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,123,255,0.2);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .comment-card {
            padding: 15px;
            border-radius: 10px;
        }

        .reply-card {
            padding: 12px;
        }

        .user-avatar {
            width: 35px;
            height: 35px;
        }

        .comment-avatar {
            width: 32px;
            height: 32px;
        }

        .reply-avatar {
            width: 28px;
            height: 28px;
        }

        .nested-replies {
            margin-left: 15px;
            padding-left: 15px;
        }

        .username {
            font-size: 0.9rem;
        }

        .comment-text {
            font-size: 0.9rem;
        }

        .modal-body {
            padding: 1rem;
        }
    }

    @media (max-width: 576px) {
        .comment-card {
            padding: 12px;
        }

        .reply-card {
            padding: 10px;
        }

        .nested-replies {
            margin-left: 10px;
            padding-left: 10px;
        }

        .modal-dialog {
            margin: 0.5rem;
        }
    }

    /* Animation for new comments */
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .comment-item {
        animation: slideIn 0.3s ease-out;
    }

    /* Loading states */
    .btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    /* Focus states for accessibility */
    .btn:focus,
    .form-control:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(0,123,255,0.25);
    }

    /* Empty state */
    .comments-container:empty::after {
        content: "No comments yet. Be the first to share your thoughts!";
        display: block;
        text-align: center;
        color: #6c757d;
        font-style: italic;
        padding: 40px 20px;
        background: #f8f9fa;
        border-radius: 10px;
        border: 2px dashed #dee2e6;
    }
</style>
