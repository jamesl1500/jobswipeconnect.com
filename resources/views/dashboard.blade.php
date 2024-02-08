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
                        <li class="active"><a href="{{ route('dashboard.index', Auth()->user()->username) }}">Dashboard</a></li>
                        <li><a href="{{ route('dashboard.index', Auth()->user()->username) }}">Jobs</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container page-content">
           
        </div>
    </div>
@endsection