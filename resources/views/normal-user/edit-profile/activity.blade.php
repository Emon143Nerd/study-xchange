@extends('normal-user.master')

@section('right-sidebar')
    <!-- sidebar is not available -->
@endsection

@section('title','Edit Profile')

@section('body')

    <main class="col col-xl-9 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
        <div class="d-flex align-items-center mb-3">
            <a href="{{route('normal-user.edit-profile.index', ['id' => auth()->user()->id])}}" class="material-icons text-dark text-decoration-none m-none me-3">arrow_back</a>
            <p class="ms-2 mb-0 fw-bold text-body fs-6">Back</p>
        </div>
        <div class="saved-posts-container">
            <!-- Saved Job Posts -->
            <section class="saved-section job-posts">
                <h2 class="section-title">Saved Job Posts</h2>
                <div class="posts-list">
                    <!-- Sample Job Post 1 -->
                    <div class="post-card job-post">
                        <div class="post-content">
                            <h3 class="post-title">Senior Web Developer</h3>
                            <p class="post-company">TechCorp Inc.</p>
                            <p class="post-location">San Francisco, CA</p>
                            <p class="post-salary">$120,000 - $150,000</p>
                        </div>
                        <button class="view-button">View Details</button>
                    </div>
                    <!-- Sample Job Post 2 -->
                    <div class="post-card job-post">
                        <div class="post-content">
                            <h3 class="post-title">UX Designer</h3>
                            <p class="post-company">DesignHub</p>
                            <p class="post-location">New York, NY</p>
                            <p class="post-salary">$90,000 - $120,000</p>
                        </div>
                        <button class="view-button">View Details</button>
                    </div>
                    <!-- Sample Job Post 2 -->
                    <div class="post-card job-post">
                        <div class="post-content">
                            <h3 class="post-title">UX Designer</h3>
                            <p class="post-company">DesignHub</p>
                            <p class="post-location">New York, NY</p>
                            <p class="post-salary">$90,000 - $120,000</p>
                        </div>
                        <button class="view-button">View Details</button>
                    </div>
                    <!-- Sample Job Post 2 -->
                    <div class="post-card job-post">
                        <div class="post-content">
                            <h3 class="post-title">UX Designer</h3>
                            <p class="post-company">DesignHub</p>
                            <p class="post-location">New York, NY</p>
                            <p class="post-salary">$90,000 - $120,000</p>
                        </div>
                        <button class="view-button">View Details</button>
                    </div>
                    <!-- Sample Job Post 2 -->
                    <div class="post-card job-post">
                        <div class="post-content">
                            <h3 class="post-title">UX Designer</h3>
                            <p class="post-company">DesignHub</p>
                            <p class="post-location">New York, NY</p>
                            <p class="post-salary">$90,000 - $120,000</p>
                        </div>
                        <button class="view-button">View Details</button>
                    </div>
                    <!-- Sample Job Post 2 -->
                    <div class="post-card job-post">
                        <div class="post-content">
                            <h3 class="post-title">UX Designer</h3>
                            <p class="post-company">DesignHub</p>
                            <p class="post-location">New York, NY</p>
                            <p class="post-salary">$90,000 - $120,000</p>
                        </div>
                        <button class="view-button">View Details</button>
                    </div>
                    <!-- Sample Job Post 2 -->
                    <div class="post-card job-post">
                        <div class="post-content">
                            <h3 class="post-title">UX Designer</h3>
                            <p class="post-company">DesignHub</p>
                            <p class="post-location">New York, NY</p>
                            <p class="post-salary">$90,000 - $120,000</p>
                        </div>
                        <button class="view-button">View Details</button>
                    </div>
                    <!-- Sample Job Post 2 -->
                    <div class="post-card job-post">
                        <div class="post-content">
                            <h3 class="post-title">UX Designer</h3>
                            <p class="post-company">DesignHub</p>
                            <p class="post-location">New York, NY</p>
                            <p class="post-salary">$90,000 - $120,000</p>
                        </div>
                        <button class="view-button">View Details</button>
                    </div>
                    <!-- Sample Job Post 2 -->
                    <div class="post-card job-post">
                        <div class="post-content">
                            <h3 class="post-title">UX Designer</h3>
                            <p class="post-company">DesignHub</p>
                            <p class="post-location">New York, NY</p>
                            <p class="post-salary">$90,000 - $120,000</p>
                        </div>
                        <button class="view-button">View Details</button>
                    </div>
                    <!-- Add more job posts here -->
                </div>
            </section>

            <!-- Saved Questions -->
            <section class="saved-section questions">
                <h2 class="section-title">Saved Questions</h2>
                <div class="posts-list">
                    <!-- Sample Question 1 -->
                    <div class="post-card question-post">
                        <div class="post-content">
                            <h3 class="post-title">How to optimize React performance?</h3>
                            <p class="post-author">Asked by: John Doe</p>
                            <p class="post-category">Category: React</p>
                            <p class="post-votes">Upvotes: 42</p>
                        </div>
                        <button class="view-button">View Question</button>
                    </div>
                    <!-- Sample Question 2 -->
                    <div class="post-card question-post">
                        <div class="post-content">
                            <h3 class="post-title">Best practices for API security?</h3>
                            <p class="post-author">Asked by: Jane Smith</p>
                            <p class="post-category">Category: Security</p>
                            <p class="post-votes">Upvotes: 38</p>
                        </div>
                        <button class="view-button">View Question</button>
                    </div>
                    <!-- Add more questions here -->
                </div>
            </section>
        </div>
        <!-- Saved Job Posts -->

    </main>
    <style>
        /* General Styles */
        body {
            font-family: 'Inter', 'Segoe UI', 'Roboto', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .saved-posts-container {
            display: flex;
            height: 100vh;
            padding: 20px;
            gap: 20px;
            box-sizing: border-box;
        }

        /* Section Styles */
        .saved-section {
            flex: 1;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .section-title {
            font-size: 24px;
            color: #2c3e50;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }

        /* List Styles */
        .posts-list {
            overflow-y: auto;
            padding: 20px;
        }

        /* Card Styles */
        .post-card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            padding: 20px;
            margin-bottom: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .post-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .post-content {
            margin-bottom: 15px;
        }

        .post-title {
            font-size: 18px;
            color: #2c3e50;
            margin: 0 0 10px 0;
        }

        .post-company, .post-author {
            font-weight: 600;
            color: #3498db;
            margin: 5px 0;
        }

        .post-location, .post-category {
            color: #7f8c8d;
            margin: 5px 0;
        }

        .post-salary, .post-votes {
            font-weight: 600;
            color: #27ae60;
            margin: 5px 0;
        }

        /* Button Styles */
        .view-button {
            background-color: #2463eb;
            color: #ffffff;
            border: none;
            padding: 10px 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            align-self: flex-start;
        }

        .view-button:hover {
            background-color: #0e4bd0;
        }

        /* Scrollbar Styles */
        .posts-list::-webkit-scrollbar {
            width: 8px;
        }

        .posts-list::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .posts-list::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }

        .posts-list::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .saved-posts-container {
                flex-direction: column;
                height: auto;
            }

            .saved-section {
                margin-bottom: 20px;
            }

            .posts-list {
                max-height: 500px;
            }
        }
    </style>
@endsection
