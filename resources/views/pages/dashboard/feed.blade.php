@php($title = "Dashboard")
@extends('layouts.authorized')

@section('content')
    <div class="dashboard-page page">
        <div class="dashboard-header page-header">
            <div class="container page-header-container">
                <div class="page-header-title">
                    <h1>Dashboard</h1>
                </div>
                <div class="page-header-subtext">
                    <h2>View posts from your connections</h2>
                </div>
            </div>
        </div>
        <div class="dashboard-page-inline-navigation">
            <div class="container">
                <div class="dashboard-page-inline-navigation-inner">
                    <ul>
                        <?php
                            $role = auth()->user()->role;

                            if($role == "job-seeker") {
                        ?>
                            <li><a href="{{ route('dashboard.jobs') }}">Job Matching</a></li>
                        <?php }else{ ?>
                            <li><a href="{{ route('dashboard.jobs') }}">Applicant Matching</a></li>
                        <?php } ?>

                        <li class="active"><a href="{{ route('dashboard.feed') }}">Feed</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container dashboard-page-content page-content">
           <div class="row page-row">
                <div class="dashboard-content user-profile col-lg-3">
                    <div class="dashboard-content-inner">
                        <div class="dashboard-current-user">
                            <div class="dashboard-current-user-inner">
                                <div class="dashboard-current-user-image">
                                    <img src="{{ asset('storage/' . Auth()->user()->profile_picture) }}" alt="{{ Auth()->user()->name }}">
                                </div>
                                <div class="dashboard-current-user-name">
                                    <h2>{{ Auth()->user()->name }}</h2>
                                    <h4>{{ Auth()->user()->username }}</h4>
                                </div>
                                <div class="dashboard-current-user-bio">
                                    <p>{{ Auth()->user()->cover_letter }}</p>
                                </div>
                                <div class="dashboard-current-user-stats">
                                    <div class="dashboard-current-user-stats-inner">
                                        <div class="dashboard-current-user-stats-item profile-views">
                                            <h3>Profile views</h3>
                                            <p><?php echo count(Auth()->user()->profileViews); ?></p>
                                        </div>
                                        <div class="dashboard-current-user-stats-item followers">
                                            <h3>Followers</h3>
                                            <p><?php echo count(Auth()->user()->followings); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dashboard-content posts-container col-lg-6">
                    <div class="dashboard-content-inner">
                        <div class="dashboard-content-creator">
                            <div class="dashboard-content-creator-inner">
                                <div class="dashboard-content-creator-top">
                                    <div class="dashboard-content-creator-image">
                                        <img src="{{ asset('storage/' . Auth()->user()->profile_picture) }}" alt="{{ Auth()->user()->name }}">
                                    </div>
                                    <div class="dashboard-content-creator-name">
                                        <h2>{{ Auth()->user()->name }}</h2>
                                        <h4>{{ auth()->user()->username }}</h4>
                                    </div>
                                </div>
                                <div class="dashboard-content-creator-input">
                                    <form action="{{ route('posts.create') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ Auth()->user()->id }}">
                                        <input type="hidden" name="post_type" value="text">
                                        <input autocomplete="off" type="text" name="post_title" id="post_title" placeholder="Title (Optional)">
                                        <textarea id="dashboard-post" name="content" id="post" cols="30" rows="10" placeholder="Whats on your mind?"></textarea>

                                        <div class="content-creator-bottom hidden">
                                            <div class="content-creator-bottom-left">
                                                <div class="content-creator-bottom-left-photo">
                                                    <input type="file" name="post_image" id="post_image" class="d-none" accept="image/png, image/jpeg, image/jpg">
                                                    <label for="post_image" class="content-creator-bottom-left-inner-image">
                                                        <i class="fas fa-camera"></i>
                                                    </label>
                                                </div>
                                                <div class="content-creator-bottom-left-file">
                                                    <input type="file" name="post_file" id="post_file" class="d-none" accept=".pdf">
                                                    <label for="post_file" class="content-creator-bottom-left-inner-file">
                                                        <i class="fas fa-file"></i>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="content-creator-bottom-right">
                                                <button type="submit" class="btn primary">Post</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>  
                        </div>
                        <div class="dashboard-content-header">
                            <h2>Posts</h2>
                        </div>
                        <div class="dashboard-content-posts">
                            <div class="dashboard-content-posts-inner">
                                <?php
                                    if(count($posts) > 0)
                                    {
                                        foreach($posts as $post => $post_value) {
                                            echo view('components.post', ['post' => $post_value]);
                                        }
                                    }else{
                                        echo "<p>No posts found!</p>";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dashboard-content col-lg-3">
                    <div class="dashboard-content-inner">

                    </div>
                </div>
           </div>
        </div>
    </div>
@endsection