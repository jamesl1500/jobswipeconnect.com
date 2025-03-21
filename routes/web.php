<?php

use App\Http\Controllers\OnboardingController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FollowingsController;
use App\Http\Controllers\MatchmakerController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\SearchController;

use App\Models\Companies;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'jobsFeeds'])->middleware(['auth', 'verified', 'onboarding'])->name('dashboard.jobs');

Route::get('/dashboard/feed', [DashboardController::class, 'postsFeed'])->middleware(['auth', 'verified', 'onboarding'])->name('dashboard.feed');

// Search
Route::get('/search', function () {
    return view('pages.search');
})->middleware(['auth', 'verified', 'onboarding'])->name('search');

// Onboarding routes
Route::get('/onboarding/step1', [OnboardingController::class, 'showStep1'])->middleware(['auth', 'verified'])->name('onboarding.step1');
Route::post('/onboarding/step1', [OnboardingController::class, 'processStep1'])->middleware(['auth', 'verified'])->name('onboarding.step1.post');

Route::get('/onboarding/step2', [OnboardingController::class, 'showStep2'])->middleware(['auth', 'verified'])->name('onboarding.step2');
Route::post('/onboarding/step2', [OnboardingController::class, 'processStep2'])->middleware(['auth', 'verified'])->name('onboarding.step2.post');

// Settings routes
Route::get('/settings', [SettingsController::class, 'index'])->middleware(['auth', 'verified', 'onboarding'])->name('settings.index');
Route::post('/settings/post', [SettingsController::class, 'indexPost'])->middleware(['auth', 'verified', 'onboarding'])->name('settings.index.post');

Route::get('/settings/social_media', [SettingsController::class, 'socialMedia'])->middleware(['auth', 'verified', 'onboarding'])->name('settings.social_media');
Route::post('/settings/social_media/post', [SettingsController::class, 'socialMediaPost'])->middleware(['auth', 'verified', 'onboarding'])->name('settings.social_media.post');

Route::get('/settings/change_email', [SettingsController::class, 'changeEmail'])->middleware(['auth', 'verified', 'onboarding'])->name('settings.change_email');
Route::post('/settings/change_emai/post', [SettingsController::class, 'changeEmailPost'])->middleware(['auth', 'verified', 'onboarding'])->name('settings.change_email.post');

Route::get('/settings/change_password', [SettingsController::class, 'changePassword'])->middleware(['auth', 'verified', 'onboarding'])->name('settings.change_password');
Route::post('/settings/change_password/post', [SettingsController::class, 'changePasswordPost'])->middleware(['auth', 'verified', 'onboarding'])->name('settings.change_password.post');

Route::get('/settings/privacy_settings', [SettingsController::class, 'privacySettings'])->middleware(['auth', 'verified', 'onboarding'])->name('settings.privacy_settings');
Route::post('/settings/privacy_settings/post', [SettingsController::class, 'privacySettingsPost'])->middleware(['auth', 'verified', 'onboarding'])->name('settings.privacy_settings.post');

Route::get('/settings/notifications', [SettingsController::class, 'notifications'])->middleware(['auth', 'verified', 'onboarding'])->name('settings.notifications');
Route::post('/settings/notifications/post', [SettingsController::class, 'notificationsPost'])->middleware(['auth', 'verified', 'onboarding'])->name('settings.notifications.post');

Route::get('/settings/change_resume', [SettingsController::class, 'changeResume'])->middleware(['auth', 'verified', 'onboarding'])->name('settings.change_resume');
Route::post('/settings/change_resume/post', [SettingsController::class, 'changeResumePost'])->middleware(['auth', 'verified', 'onboarding'])->name('settings.change_resume.post');

Route::post('/settings/change_role', [SettingsController::class, 'changeRole'])->middleware(['auth', 'verified', 'onboarding'])->name('settings.change_role');
// Profile with username
Route::get('/profile/{username}', [ProfileController::class, 'index'])->name('profile.index');

Route::get('/profile/{username}/about', [ProfileController::class, 'about'])->name('profile.about');
Route::post('/profile/{username}/about/editCoverLetterPost', [ProfileController::class, 'editCoverLetterPost'])->name('profile.about.cover_letter.post');
Route::post('/profile/{username}/about/editSkillsPost', [ProfileController::class, 'editSkillsPost'])->name('profile.about.skills.post');
Route::post('/profile/{username}/about/addExperiencePost', [ProfileController::class, 'addExperiencePost'])->name('profile.about.add_experience.post');
Route::delete('/profile/{username}/about/deleteExperiencePost', [ProfileController::class, 'deleteExperiencePost'])->name('profile.about.delete_experience.post');
Route::post('/profile/{username}/about/editExperiencePost', [ProfileController::class, 'editExperiencePost'])->name('profile.about.edit_experience.post');
Route::post('/profile/{username}/about/updateExperienceOrder', [ProfileController::class, 'updateExperienceOrder'])->name('profile.about.updateExperienceOrder.post');
Route::get('/profile/{username}/about/getExperiencePost', [ProfileController::class, 'getExperiencePost'])->name('profile.about.get_experience.post');
Route::post('/profile/{username}/about/addEducationPost', [ProfileController::class, 'addEducationPost'])->name('profile.about.add_education.post');
Route::delete('/profile/{username}/about/deleteEducationPost', [ProfileController::class, 'deleteEducationPost'])->name('profile.about.delete_education.post');

Route::get('/profile/{username}/resume', [ProfileController::class, 'resume'])->name('profile.resume');
Route::post('/profile/{username}/resume/saveResume', [ProfileController::class, 'resumePost'])->name('profile.resume.post');

// Posts
Route::post('/posts/create', [PostsController::class, 'createPost'])->name('posts.create');

// Companies
Route::get('/companies', [CompaniesController::class, 'index'])->name('companies.index');

Route::get('/companies/v/{company}', [CompaniesController::class, 'show'])->name('companies.show');
Route::get('/companies/v/{company}/jobs', [CompaniesController::class, 'jobs'])->name('companies.jobs');

Route::get('/companies/create', [CompaniesController::class, 'create'])->middleware(['auth', 'verified', 'onboarding'])->name('companies.create');
Route::post('/companies/create/post', [CompaniesController::class, 'store'])->middleware(['auth', 'verified', 'onboarding'])->name('companies.store');

Route::get('/companies/my-companies', [CompaniesController::class, 'myCompanies'])->middleware(['auth', 'verified', 'onboarding'])->name('companies.my_companies');

Route::get('/companies/edit/{company}', [CompaniesController::class, 'edit'])->middleware(['auth', 'verified', 'onboarding'])->name('companies.edit');
Route::post('/companies/edit/{company}', [CompaniesController::class, 'editSave'])->middleware(['auth', 'verified', 'onboarding'])->name('companies.edit.post');

Route::get('/companies/edit/{company}/address', [CompaniesController::class, 'edit_address'])->middleware(['auth', 'verified', 'onboarding'])->name('companies.edit.address');
Route::post('/companies/edit/{company}/address/post', [CompaniesController::class, 'edit_addressPost'])->middleware(['auth', 'verified', 'onboarding'])->name('companies.edit.address.post');

Route::get('/companies/edit/{company}/contact', [CompaniesController::class, 'edit_contact'])->middleware(['auth', 'verified', 'onboarding'])->name('companies.edit.contact');
Route::post('/companies/edit/{company}/contact/post', [CompaniesController::class, 'edit_contactPost'])->middleware(['auth', 'verified', 'onboarding'])->name('companies.edit.contact.post');

// Jobs
Route::get('/jobs', [JobsController::class, 'index'])->name('jobs.index');

Route::get('/jobs/view/{job}', [JobsController::class, 'show'])->name('jobs.show');

// Apply
Route::post('/jobs/view/{job}/apply', [JobsController::class, 'apply'])->middleware(['auth', 'verified', 'onboarding'])->name('jobs.apply');
Route::get('/jobs/view/{job}/apply', [JobsController::class, 'applyPage'])->middleware(['auth', 'verified', 'onboarding'])->name('jobs.apply.get');

Route::get('/jobs/view/{job}/applicants', [JobsController::class, 'applicants'])->middleware(['auth', 'verified', 'onboarding'])->name('jobs.show.applicants');
Route::get('/jobs/view/{job}/applicants/v/{applicant}', [JobsController::class, 'viewApplicant'])->middleware(['auth', 'verified', 'onboarding'])->name('jobs.show.applicants.view_applicant');

Route::get('/jobs/view/{job}/applicants/interviewing', [JobsController::class, 'applicantsInterviewing'])->middleware(['auth', 'verified', 'onboarding'])->name('jobs.show.applicants.interviewing');
Route::get('/jobs/view/{job}/applicants/hires', [JobsController::class, 'applicantsHired'])->middleware(['auth', 'verified', 'onboarding'])->name('jobs.show.applicants.hires');
Route::get('/jobs/view/{job}/applicants/rejected', [JobsController::class, 'applicantsRejected'])->middleware(['auth', 'verified', 'onboarding'])->name('jobs.show.applicants.rejected');

Route::get('/jobs/view/{job}/applicants/{applicant}', [JobsController::class, 'viewApplicant'])->middleware(['auth', 'verified', 'onboarding'])->name('jobs.show.applicant');

Route::get('/jobs/create', [JobsController::class, 'create'])->middleware(['auth', 'verified', 'onboarding'])->name('jobs.create');
Route::post('/jobs/create/post', [JobsController::class, 'store'])->middleware(['auth', 'verified', 'onboarding'])->name('jobs.create.post');
Route::get('/jobs/my-jobs', [JobsController::class, 'myJobs'])->middleware(['auth', 'verified', 'onboarding'])->name('jobs.my_jobs');
Route::get('/jobs/liked-jobs', [JobsController::class, 'likedJobs'])->middleware(['auth', 'verified', 'onboarding'])->name('jobs.liked_jobs');

Route::get('/jobs/edit/{job}', [JobsController::class, 'edit'])->middleware(['auth', 'verified', 'onboarding'])->name('jobs.edit');

Route::get('jobs/edit/{job}/responsibilities', [JobsController::class, 'editResponsibilities'])->middleware(['auth', 'verified', 'onboarding'])->name('jobs.edit.responsibilities');
Route::post('jobs/edit/{job}/responsibilities/post', [JobsController::class, 'updateResponsibilities'])->middleware(['auth', 'verified', 'onboarding'])->name('jobs.edit.responsibilities.post');

Route::get('/jobs/edit/{job}/requirements', [JobsController::class, 'editRequirements'])->middleware(['auth', 'verified', 'onboarding'])->name('jobs.edit.requirements');
Route::post('/jobs/edit/{job}/requirements/post', [JobsController::class, 'updateRequirements'])->middleware(['auth', 'verified', 'onboarding'])->name('jobs.edit.requirements.post');

Route::get('/jobs/edit/{job}/benefits', [JobsController::class, 'editBenefits'])->middleware(['auth', 'verified', 'onboarding'])->name('jobs.edit.benefits');
Route::post('/jobs/edit/{job}/benefits/post', [JobsController::class, 'updateBenefits'])->middleware(['auth', 'verified', 'onboarding'])->name('jobs.edit.benefits.post');

Route::post('/jobs/edit/{job}', [JobsController::class, 'update'])->middleware(['auth', 'verified', 'onboarding'])->name('jobs.edit.update');

Route::get('/jobs/view/{job}/my_application', [JobsController::class, 'myApplication'])->middleware(['auth', 'verified', 'onboarding'])->name('jobs.my_application');

Route::delete('/jobs/delete/{job}', [JobsController::class, 'delete'])->middleware(['auth', 'verified', 'onboarding'])->name('jobs.delete');

Route::post('/jobs/{job}/applicants/{applicant}/startInterview', [JobsController::class, 'startInterview'])->middleware(['auth', 'verified', 'onboarding'])->name('jobs.applicants.startInterview');



// Follow route
Route::post('/follow', [FollowingsController::class, 'follow'])->middleware(['auth'])->name('follow');
Route::post('/unfollow', [FollowingsController::class, 'unfollow'])->middleware(['auth'])->name('unfollow');

// Messaging routes
Route::get('messages', [MessagesController::class, 'index'])->middleware(['auth'])->name('messages.index');
Route::get('messages/conversation/{id}', [MessagesController::class, 'conversation'])->middleware(['auth'])->name('messages.conversation');
Route::get("messages/create_conversation/{id}", [MessagesController::class, 'createConversation'])->middleware(['auth'])->name('messages.create_conversation');
Route::post("messages/create_conversation/{id}", [MessagesController::class, 'createConversationPost'])->middleware(['auth'])->name('messages.create_conversation');
Route::post("messages/send", [MessagesController::class, 'sendMessagePost'])->middleware(['auth'])->name('messages.sendMessage');

// Search
Route::get('search', [SearchController::class, 'index'])->name('search.index');
Route::get('search/users', [SearchController::class, 'users'])->name('search.users');
Route::get('search/jobs', [SearchController::class, 'jobs'])->name('search.jobs');
Route::get('search/companies', [SearchController::class, 'companies'])->name('search.companies');

// Matchmaker
Route::post('matchmaker/job_seeker/like', [MatchmakerController::class, 'job_seeker_like'])->middleware(['auth', 'verified', 'onboarding'])->name('matchmaker.job_seeker.like');
Route::post('matchmaker/job_seeker/dislike', [MatchmakerController::class, 'job_seeker_dislike'])->middleware(['auth', 'verified', 'onboarding'])->name('matchmaker.job_seeker.dislike');

// Posts
Route::post('posts/create', [PostsController::class, 'createPost'])->middleware(['auth', 'verified', 'onboarding'])->name('posts.create');
Route::delete('posts/delete/{id}', [PostsController::class, 'deletePost'])->middleware(['auth', 'verified', 'onboarding'])->name('posts.delete');
Route::post('posts/like/{id}', [PostsController::class, 'likePost'])->middleware(['auth', 'verified', 'onboarding'])->name('posts.like');
Route::delete('posts/unlike/{id}', [PostsController::class, 'unlikePost'])->middleware(['auth', 'verified', 'onboarding'])->name('posts.unlike');
Route::post('posts/comment/{id}', [PostsController::class, 'commentPost'])->middleware(['auth', 'verified', 'onboarding'])->name('posts.comment');
Route::get('posts/{id}', [PostsController::class, 'show'])->middleware(['auth', 'verified', 'onboarding'])->name('posts.show');

// Conversations
Route::get('conversations', [MessagesController::class, 'index'])->middleware(['auth', 'verified', 'onboarding'])->name('conversations.index');

require __DIR__.'/auth.php';
