<?php
use App\Libraries\Matchmaker;

use App\Models\Companies;

$matchmaker = new Matchmaker();

// Lets get all filter query strings from url


// Create array of filters
$filters = [
    'skills' => '',
    'education' => '',
    'experience' => ''
];

if(isset($_GET['education']))
{
    $filters['education'] = $_GET['education'];
}

if(isset($_GET['experience']))
{
    $filters['experience'] = $_GET['experience'];
}

if(isset($_GET['skills']))
{
    $filters['skills'] = $_GET['skills'];
}

// Since this is a job seeker, we will get all the job postings
$job_seeker = $matchmaker->getMatchedJobSeekers($filters);
?>
<div class="matchmaker job-poster-version">
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
                            <p class="name"><?php echo $job_seeker->name; ?></p>
                            <p class="username">@<?php echo $job_seeker->username; ?></p>
                        </div>
                    </div>
                    <div class="matchmaker-applicant-middle-experience">
                        <p class="title-m">Experience</p>
                        <?php
                        // Get the job seeker's experience
                        $experience = $job_seeker->experiences()->get();

                        if(count($experience) > 0)
                        {
                            foreach($experience as $exp)
                            {
                                echo '<div class="matchmaker-applicant-experience">';
                                echo '<p class="title">' . $exp->title . '</p>';
                                echo '<p class="company">' . $exp->company . '</p>';
                                echo '<p class="date">' . $exp->start_date . ' - ' . $exp->end_date . '</p>';
                                echo '</div>';
                            }
                        }
                        else
                        {
                            echo '<div class="matchmaker-applicant-experience">';
                            echo '<p class="title">No experience found!</p>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                    <div class="matchmaker-applicant-middle-education">
                        <p class="title-m">Education</p>
                        <?php
                        // Get the job seeker's education
                        $education = $job_seeker->educations()->get();

                        if(count($education) > 0)
                        {
                            foreach($education as $edu)
                            {
                                echo '<div class="matchmaker-applicant-education">';
                                echo '<p class="title">' . $edu->degree . '</p>';
                                echo '<p class="school">' . $edu->school . '</p>';
                                echo '<p class="date">' . $edu->start_date . ' - ' . $edu->end_date . '</p>';
                                echo '</div>';
                            }
                        }
                        else
                        {
                            echo '<div class="matchmaker-applicant-education">';
                            echo '<p class="title">No education found!</p>';
                            echo '</div>';
                        }
                        ?>
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
                    <p><?php echo $job_seeker->cover_letter; ?></p>
                </div>
            </div>
        </div>
        <div class="matchmaker-actions">
            <form action="" method="post">
                <button type="submit" name="accept" class="btn btn-success">Accept</button>
                <button type="submit" name="reject" class="btn btn-danger">Reject</button>
            </form>
        </div>
    </div>
</div>
