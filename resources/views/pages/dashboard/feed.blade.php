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
                        <li class="active"><a href="{{ route('dashboard.jobs') }}">Job Matching</a></li>
                        <li><a href="{{ route('dashboard.feed') }}">Feed</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container dashboard-page-content page-content">
           <div class="row page-row">
                <div class="dashboard-content col-lg-3">
                    <div class="dashboard-content-inner">

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
                                        <textarea id="dashboard-post" name="post" id="post" cols="30" rows="10" placeholder="Whats on your mind?"></textarea>

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