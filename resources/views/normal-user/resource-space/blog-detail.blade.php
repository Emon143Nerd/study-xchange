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
        <div class="container my-5">
            <div class="card border-0 shadow-lg">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h1 class="fw-bold">{{ $blog->title }}</h1>
                            <p class="text-muted">{{ $blog->created_at->format('F d, Y') }}</p>
                        </div>

{{--                        @if(auth()->id() == $blog->user_id)--}}
{{--                            <form action="{{ route('normal-user.resource-space-blog.delete', $blog->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog?');">--}}
{{--                                @csrf--}}
{{--                                @method('DELETE')--}}
{{--                                <button type="submit" class="btn btn-danger">--}}
{{--                                    <i class="fas fa-trash"></i> Delete Blog--}}
{{--                                </button>--}}
{{--                            </form>--}}
{{--                        @endif--}}

                        <!-- Post Edit/Delete Dropdown (Visible only for the post owner) -->
                        @if(Auth::check() && Auth::user()->id == $blog->user_id)
                            <div class="dropdown ms-auto">
                                <a href="#" class="text-muted text-decoration-none material-icons md-20 rounded-circle bg-light p-1"
                                   id="dropdownMenuPost{{ $blog->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                    more_vert
                                </a>
                                <ul class="dropdown-menu fs-13 dropdown-menu-end" aria-labelledby="dropdownMenuPost{{ $blog->id }}">
                                    <!-- Edit Post -->
{{--                                    <li><a class="dropdown-item text-muted" href="#editPost{{ $blog->id }}" data-bs-toggle="collapse">--}}
{{--                                            <span class="material-icons md-13 me-1">edit</span> Edit Blog</a>--}}
{{--                                    </li>--}}
                                    <!-- Delete Post -->
                                    <li>
                                        <form action="{{route('normal-user.resource-space-blog.delete',$blog->id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-muted">
                                                <span class="material-icons md-13 me-1">delete</span> Delete Blog
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>

                    @if($blog->image)
                        <div class="mb-4">
                            <img src="{{ asset($blog->image) }}" alt="Blog Image" class="img-fluid rounded">
                        </div>
                    @endif

                    <div>{!! $blog->description !!}</div>
                </div>
            </div>
        </div>

    </main>

@endsection
