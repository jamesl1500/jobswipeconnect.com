@php($title = "Contact Us")
@extends('layouts.both')

@section('content')
<div class="marketing-page page">
    <div class="page-header">
        <div class="container page-header-container">
            <div class="page-header-title">
                <h1>Contact Us</h1>
            </div>
            <div class="page-header-subtext">
                <h2>Questions, feedback, or just want to say hi?</h2>
            </div>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <div class="marketing-form-card">
                <form method="POST" action="{{ route('marketing.contact.post') }}">
                    @csrf

                    <div class="form-group">
                        <div class="inline-form-group">
                            <div class="form-input">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus>
                            </div>
                            <div class="form-input">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                            </div>
                        </div>

                        <div class="form-input">
                            <label for="topic">What's this about?</label>
                            <select name="topic" id="topic" required>
                                <option value="">Select a topic</option>
                                <option value="job-seeker" {{ old('topic') == 'job-seeker' ? 'selected' : '' }}>I'm looking for a job</option>
                                <option value="employer" {{ old('topic') == 'employer' ? 'selected' : '' }}>I'm hiring</option>
                                <option value="support" {{ old('topic') == 'support' ? 'selected' : '' }}>I need help with my account</option>
                                <option value="other" {{ old('topic') == 'other' ? 'selected' : '' }}>Something else</option>
                            </select>
                        </div>

                        <div class="form-input">
                            <label for="message">Message</label>
                            <textarea name="message" id="message" rows="6" required>{{ old('message') }}</textarea>
                        </div>

                        <div class="form-input">
                            <button type="submit" class="btn primary">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
