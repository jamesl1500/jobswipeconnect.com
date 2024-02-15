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
                    <h2>Overview</h2>
                </div>
            </div>
        </div>
        <div class="dashboard-page-inline-navigation">
            <div class="container">
                <div class="dashboard-page-inline-navigation-inner">
                    <ul>
                        <li class="active"><a href="{{ route('dashboard.jobs') }}">Jobs</a></li>
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