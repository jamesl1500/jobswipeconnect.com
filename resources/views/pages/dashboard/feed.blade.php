@php($title = "Dashboard")
@extends('layouts.authorized')

@section('content')
    @php($role = auth()->user()->role)
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
                        @if(auth()->user()->role == "job-seeker")
                            <li><a href="{{ route('dashboard.jobs') }}">Job Matching</a></li>
                        @else
                            <li><a href="{{ route('dashboard.jobs') }}">Applicant Matching</a></li>
                        @endif

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
                                            <p>{{ count(Auth()->user()->profileViews) }}</p>
                                        </div>
                                        <div class="dashboard-current-user-stats-item followers">
                                            <h3>Followers</h3>
                                            <p>{{ count(Auth()->user()->followings) }}</p>
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
                                @if(count($posts) > 0)
                                    @foreach($posts as $post_value)
                                        @include('components.post', ['post' => $post_value])
                                    @endforeach
                                @else
                                    <div class="simple-alert warning">
                                        <div class="title">
                                            <h1>Your timeline is quiet</h1>
                                        </div>
                                        <div class="subtitle">
                                            <h2>Follow people or share an update above to get things moving.</h2>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dashboard-content col-lg-3">
                    <div class="dashboard-content-inner">
                        <div class="sidebar-widget">
                            <div class="sidebar-widget-header">
                                <h2>People to follow</h2>
                                <p>Grow your network on JobSwipe</p>
                            </div>
                            @if(count($suggestedUsers) > 0)
                                @foreach($suggestedUsers as $suggested)
                                    <div class="suggested-user">
                                        <a href="{{ route('profile.index', ['username' => $suggested->username]) }}">
                                            <img src="{{ asset('storage/' . $suggested->profile_picture) }}" alt="{{ $suggested->name }}">
                                        </a>
                                        <div class="suggested-user-info">
                                            <h3><a href="{{ route('profile.index', ['username' => $suggested->username]) }}">{{ $suggested->name }}</a></h3>
                                            <p>{{ '@' . $suggested->username }}</p>
                                        </div>
                                        <form action="{{ route('follow') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $suggested->id }}">
                                            <button type="submit" class="btn primary skinny">Follow</button>
                                        </form>
                                    </div>
                                @endforeach
                            @else
                                <p>You're following everyone on JobSwipe already!</p>
                            @endif
                        </div>

                        <div class="sidebar-widget">
                            <div class="sidebar-widget-header">
                                <h2>Quick links</h2>
                            </div>
                            <ul class="widget-links">
                                @if($role == 'job-seeker')
                                    <li><a href="{{ route('jobs.index') }}"><i class="fas fa-briefcase"></i> Browse jobs</a></li>
                                    <li><a href="{{ route('jobs.liked_jobs') }}"><i class="fas fa-heart"></i> Liked jobs</a></li>
                                @else
                                    <li><a href="{{ route('jobs.create') }}"><i class="fas fa-plus"></i> Post a job</a></li>
                                    <li><a href="{{ route('jobs.my_jobs') }}"><i class="fas fa-briefcase"></i> My jobs</a></li>
                                @endif
                                <li><a href="{{ route('companies.index') }}"><i class="fas fa-building"></i> Companies</a></li>
                                <li><a href="{{ route('messages.index') }}"><i class="fas fa-comment-dots"></i> Messages</a></li>
                                <li><a href="{{ route('settings.index') }}"><i class="fas fa-gear"></i> Settings</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>
@endsection