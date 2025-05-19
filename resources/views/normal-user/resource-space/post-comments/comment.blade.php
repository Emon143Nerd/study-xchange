{{--<div class="comment mb-3">--}}
{{--    <div class="d-flex align-items-start">--}}
{{--        <img src="{{ $comment->user->profile_picture ?? 'https://via.placeholder.com/40' }}"--}}
{{--             alt="User Avatar"--}}
{{--             class="rounded-circle me-2"--}}
{{--             style="width: 40px; height: 40px;">--}}
{{--        <div class="comment-content w-100">--}}
{{--            <strong>{{ $comment->user->name }}</strong>--}}
{{--            <p class="mb-1 text-break">{{ $comment->comment }}</p>--}}
{{--            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>--}}

{{--            <!-- Delete Button (only visible to the comment owner) -->--}}
{{--            @if(auth()->id() == $comment->user_id)--}}
{{--                <form action="{{ route('normal-user.resource-space-post.comment.delete', ['id' => $comment->id]) }}" method="POST" class="mt-2">--}}
{{--                    @csrf--}}
{{--                    @method('DELETE')--}}
{{--                    <button type="submit" class="btn btn-link btn-sm text-danger delete-btn">Delete</button>--}}
{{--                </form>--}}
{{--            @endif--}}

{{--            <!-- Reply Button -->--}}
{{--            <button class="btn btn-link btn-sm text-decoration-none mt-1 reply-btn" data-bs-toggle="collapse" data-bs-target="#replyForm{{ $comment->id }}">Reply</button>--}}

{{--            <!-- Reply Form -->--}}
{{--            <div id="replyForm{{ $comment->id }}" class="collapse mt-2">--}}
{{--                <form action="{{ route('normal-user.resource-space-post.comment', ['post' => $post->id]) }}" method="POST" class="w-100">--}}
{{--                    @csrf--}}
{{--                    <textarea class="form-control form-control-sm" name="comment" rows="2" placeholder="Write your reply..." required></textarea>--}}
{{--                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">--}}
{{--                    <div class="d-flex justify-content-end mt-1">--}}
{{--                        <button type="submit" class="btn btn-secondary btn-sm">Reply</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}

{{--            <!-- Nested Replies -->--}}
{{--            @if ($comment->replies->count() > 0)--}}
{{--                <div class="nested-reply">--}}
{{--                    @foreach ($comment->replies as $reply)--}}
{{--                        @include('normal-user.resource-space.post-comments.comment', ['comment' => $reply])--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}



{{--<style>--}}
{{--    /* General Comment Styling */--}}
{{--    .comment {--}}
{{--        background-color: #f9f9f9;--}}
{{--        border: 1px solid #ddd;--}}
{{--        border-radius: 10px;--}}
{{--        padding: 15px;--}}
{{--        margin-bottom: 10px;--}}
{{--        word-wrap: break-word; /* Prevent long words from overflowing */--}}
{{--    }--}}

{{--    /* User Avatar */--}}
{{--    .comment img {--}}
{{--        width: 40px;--}}
{{--        height: 40px;--}}
{{--        border-radius: 50%;--}}
{{--    }--}}

{{--    /* Content Styling */--}}
{{--    .comment-content {--}}
{{--        overflow-wrap: break-word; /* Ensure long text breaks to new lines */--}}
{{--    }--}}

{{--    /* Reply Button */--}}
{{--    .reply-btn {--}}
{{--        font-size: 0.9rem;--}}
{{--        color: #007bff;--}}
{{--        border: none;--}}
{{--        background: none;--}}
{{--    }--}}

{{--    .reply-btn:hover {--}}
{{--        text-decoration: underline;--}}
{{--    }--}}

{{--    /* Styling for Nested Replies */--}}
{{--    .nested-reply {--}}
{{--        margin-left: 20px;--}}
{{--        border-left: 2px solid #ddd; /* Add a visual indentation indicator */--}}
{{--        padding-left: 10px;--}}
{{--        max-width: 100%; /* Prevent overflow */--}}
{{--    }--}}

{{--    /* Limit deep nesting indentation */--}}
{{--    .nested-reply .nested-reply {--}}
{{--        margin-left: 15px;--}}
{{--    }--}}

{{--    /* Make nested replies horizontally scrollable for extreme cases */--}}
{{--    .nested-reply {--}}
{{--        overflow-x: auto;--}}
{{--        white-space: normal;--}}
{{--    }--}}

{{--    /* Responsive Design */--}}
{{--    @media (max-width: 768px) {--}}
{{--        .comment img {--}}
{{--            width: 35px;--}}
{{--            height: 35px;--}}
{{--        }--}}

{{--        .nested-reply {--}}
{{--            margin-left: 10px;--}}
{{--            padding-left: 8px;--}}
{{--        }--}}
{{--    }--}}

{{--    /* Handle extreme nesting gracefully by capping margins */--}}
{{--    .nested-reply:nth-child(10) {--}}
{{--        margin-left: 5px;--}}
{{--    }--}}

{{--    .delete-btn{--}}
{{--        text-decoration: none;--}}
{{--    }--}}
{{--</style>--}}
