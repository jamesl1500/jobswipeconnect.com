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
                                    <li class="active"><a href="{{ route('companies.edit.address', $company->id) }}">Address</a></li>
                                    <li><a href="{{ route('companies.edit.contact', $company->id) }}">Contact Info</a></li>
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
                            <form action="{{ route('companies.edit.address.post', $company->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="inline-form-group">
                                        <div class="form-input">
                                            <label for="address">Address</label>
                                            <input type="text" name="address" id="address" class="form-control" value="{{ $company->address }}">
                                        </div>
                                        <div class="form-input">
                                            <label for="city">City</label>
                                            <input type="text" name="city" id="city" class="form-control" value="{{ $company->city }}">
                                        </div>
                                    </div>
                                    <div class="inline-form-group">
                                        <div class="form-input">
                                            <label for="state">State</label>
                                            <input type="text" name="state" id="state" class="form-control" value="{{ $company->state }}">
                                        </div>
                                        <div class="form-input">
                                            <label for="zip">Zip</label>
                                            <input type="text" name="zip" id="zip" class="form-control" value="{{ $company->zip }}">
                                        </div>
                                        <div class="form-input">
                                            <label for="country">Country</label>
                                            <input type="text" name="country" id="country" class="form-control" value="{{ $company->country }}">
                                        </div>
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