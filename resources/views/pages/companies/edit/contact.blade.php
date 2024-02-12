@php($title = "Edit Company")
@extends('layouts.authorized')

@section('content')
    <div class="companies-page page">
        <div class="companies-header page-header">
            <div class="container page-header-container">
                <div class="page-header-title">
                    <h1>Edit Company</h1>
                </div>
                <div class="page-header-subtext">
                    <h2>Edit {{ $company->name }}!</h2>
                </div>
            </div>
        </div>
        <div class="container companies-page-content page-content">
           <div class="row page-row">
                <div class="companies-content col-lg-3">
                    <div class="companies-content-inner">
                        <div class="companies-content-navigation">
                            <div class="companies-content-navigation-header">
                                <h2>Navigation</h2>
                            </div>
                            <div class="companies-content-navigation-inner">
                                <ul>
                                    <li><a href="{{ route('companies.edit', $company->id) }}">Basic Details</a></li>
                                    <li><a href="{{ route('companies.edit.address', $company->id) }}">Address</a></li>
                                    <li class="active"><a href="{{ route('companies.edit.contact', $company->id) }}">Contact Info</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="companies-content posts-container col-lg-9">
                    <div class="companies-content-inner">
                        <div class="companies-content-form">
                            <div class="companies-content-inner-header">
                                <h2>Edit Address</h2>
                            </div>
                            <form action="{{ route('companies.edit.contact.post', $company->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="form-input">
                                        <label for="address">Email</label>
                                        <input type="text" name="email" id="email" class="form-control" value="{{ $company->email }}">
                                    </div>
                                    <div class="form-input">
                                        <label for="city">Phone</label>
                                        <input type="text" name="phone" id="phone" class="form-control" value="{{ $company->phone }}">
                                    </div>
                                    <div class="form-input">
                                        <input type="submit" value="Save Company" class="btn primary">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>
@endsection