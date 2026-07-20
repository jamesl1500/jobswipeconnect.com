@php
use App\Libraries\Matchmaker;
use App\Models\Companies;

$matchmaker = new Matchmaker();

// Create array of filters from query string
$filters = [
    'skills' => $_GET['skills'] ?? '',
    'education' => $_GET['education'] ?? '',
    'experience' => $_GET['experience'] ?? ''
];

// Since this is a job seeker, we will get all the job postings
$job_seeker = $matchmaker->getMatchedJobSeekers($filters);
$job_for_match = $job_seeker ? $matchmaker->resolveJobForJobSeeker($job_seeker) : null;
@endphp
<div class="matchmaker job-poster-version">
    @if(!$job_seeker || !$job_for_match)
    <div class="matchmaker-empty">
        <p>No applicants to review right now — post a job to start matching with candidates.</p>
    </div>
    @else
    <div class="matchmaker-inner">
        <div class="matchmaker-tab-bar">
            <!-- Applicant Info -->
            <div class="matchmaker-tab active" data-tab="job-seeker">
                <i class="fas fa-user-tie"></i>
                <p>Applicant</p>
            </div>
            <!-- Resume -->
            <div class="matchmaker-tab" data-tab="resume">
                <i class="fas fa-file-alt"></i>
                <p>Resume</p>
            </div>
            <!-- Cover Letter -->
            <div class="matchmaker-tab" data-tab="cover-letter">
                <i class="fas fa-envelope-open-text"></i>
                <p>Cover Letter</p>
            </div>
        </div>
        <div class="matchmaker-body">
            <!-- Applicant Info -->
            <div class="matchmaker-tab-content" id="matchmaker-tab-job-seeker">
                <div class="matchmaker-tab-content-header">
                    <p>Applicant</p>
                </div>
                <div class="matchmaker-tab-content-body">
                    <div class="matchmaker-applicant-top-info">
                        <div class="matchmaker-applicant-image">
                            <img src="{{ asset('storage/' .  $job_seeker->profile_picture ) }}" alt="{{ $job_seeker->name }}">
                        </div>
                        <div class="matchmaker-applicant-info">
                            <p class="name">{{ $job_seeker->name }}</p>
                            <p class="username">{{ '@' . $job_seeker->username }}</p>
                        </div>
                    </div>
                    <div class="matchmaker-applicant-middle-experience">
                        <p class="title-m">Experience</p>
                        @php
                            // Get the job seeker's experience
                            $experience = $job_seeker->experiences()->get();
                        @endphp
                        @if(count($experience) > 0)
                            @foreach($experience as $exp)
                                <div class="matchmaker-applicant-experience">
                                    <p class="title">{{ $exp->title }}</p>
                                    <p class="company">{{ $exp->company }}</p>
                                    <p class="date">{{ $exp->start_date }} - {{ $exp->end_date }}</p>
                                </div>
                            @endforeach
                        @else
                            <div class="matchmaker-applicant-experience">
                                <p class="title">No experience found!</p>
                            </div>
                        @endif
                    </div>
                    <div class="matchmaker-applicant-middle-education">
                        <p class="title-m">Education</p>
                        @php
                            // Get the job seeker's education
                            $education = $job_seeker->educations()->get();
                        @endphp
                        @if(count($education) > 0)
                            @foreach($education as $edu)
                                <div class="matchmaker-applicant-education">
                                    <p class="title">{{ $edu->degree }}</p>
                                    <p class="school">{{ $edu->school }}</p>
                                    <p class="date">{{ $edu->start_date }} - {{ $edu->end_date }}</p>
                                </div>
                            @endforeach
                        @else
                            <div class="matchmaker-applicant-education">
                                <p class="title">No education found!</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Resume -->
            <div class="matchmaker-tab-content hidden" id="matchmaker-tab-resume">
                <div class="matchmaker-tab-content-header">
                    <p>Resume</p>
                </div>
                <div class="matchmaker-tab-content-body">
                    <embed src="{{ asset('storage/' . $job_seeker->resume) }}" type="application/pdf" width="100%" height="600px">
                </div>
            </div>

            <!-- Cover Letter -->
            <div class="matchmaker-tab-content hidden" id="matchmaker-tab-cover-letter">
                <div class="matchmaker-tab-content-header">
                    <p>Cover Letter</p>
                </div>
                <div class="matchmaker-tab-content-body">
                    <p>{{ $job_seeker->cover_letter }}</p>
                </div>
            </div>
        </div>
        <div class="matchmaker-actions">
            <form action="{{ route('matchmaker.job_poster.like') }}" method="post">
                @csrf
                <input type="hidden" name="job_seeker_id" value="{{ $job_seeker->id }}">
                <input type="hidden" name="job_id" value="{{ $job_for_match->id }}">
                <button type="submit" class="btn btn-success">Accept</button>
            </form>
            <form action="{{ route('matchmaker.job_poster.dislike') }}" method="post">
                @csrf
                <input type="hidden" name="job_seeker_id" value="{{ $job_seeker->id }}">
                <input type="hidden" name="job_id" value="{{ $job_for_match->id }}">
                <button type="submit" class="btn btn-danger">Reject</button>
            </form>
        </div>
    </div>
    @endif
</div>
