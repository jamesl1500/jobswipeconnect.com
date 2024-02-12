<?php

use App\Http\Controllers\OnboardingController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\FollowingsController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'onboarding'])->name('dashboard.index');

Route::get('/dashboard/jobs', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'onboarding'])->name('dashboard.jobs');

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

Route::get('/settings/change_email', [SettingsController::class, 'changeEmail'])->middleware(['auth', 'verified', 'onboarding'])->name('settings.change_email');
Route::post('/settings/change_emai/post', [SettingsController::class, 'changeEmailPost'])->middleware(['auth', 'verified', 'onboarding'])->name('settings.change_email.post');

Route::get('/settings/change_password', [SettingsController::class, 'changePassword'])->middleware(['auth', 'verified', 'onboarding'])->name('settings.change_password');
Route::post('/settings/change_password/post', [SettingsController::class, 'changePasswordPost'])->middleware(['auth', 'verified', 'onboarding'])->name('settings.change_password.post');

Route::get('/settings/privacy_settings', [SettingsController::class, 'privacySettings'])->middleware(['auth', 'verified', 'onboarding'])->name('settings.privacy_settings');
Route::post('/settings/privacy_settings/post', [SettingsController::class, 'privacySettingsPost'])->middleware(['auth', 'verified', 'onboarding'])->name('settings.privacy_settings.post');

Route::get('/settings/notifications', [SettingsController::class, 'notifications'])->middleware(['auth', 'verified', 'onboarding'])->name('settings.notifications');

// Profile with username
Route::get('/profile/{username}', [ProfileController::class, 'index'])->name('profile.index');

Route::get('/profile/{username}/about', [ProfileController::class, 'about'])->name('profile.about');
Route::post('/profile/{username}/about/editCoverLetterPost', [ProfileController::class, 'editCoverLetterPost'])->name('profile.about.cover_letter.post');
Route::post('/profile/{username}/about/editSkillsPost', [ProfileController::class, 'editSkillsPost'])->name('profile.about.skills.post');
Route::post('/profile/{username}/about/addExperiencePost', [ProfileController::class, 'addExperiencePost'])->name('profile.about.add_experience.post');
Route::delete('/profile/{username}/about/deleteExperiencePost', [ProfileController::class, 'deleteExperiencePost'])->name('profile.about.delete_experience.post');
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

// Follow route
Route::post('/follow', [FollowingsController::class, 'follow'])->middleware(['auth'])->name('follow');
Route::post('/unfollow', [FollowingsController::class, 'unfollow'])->middleware(['auth'])->name('unfollow');

// Messaging routes
Route::get('messages', [MessagesController::class, 'index'])->middleware(['auth'])->name('messages.index');
Route::get('messages/{id}', [MessagesController::class, 'conversation'])->middleware(['auth'])->name('messages.conversation');
Route::get("messages/create_conversation/{id}", [MessagesController::class, 'createConversation'])->middleware(['auth'])->name('messages.create_conversation');
Route::post("messages/create_conversation/{id}", [MessagesController::class, 'createConversationPost'])->middleware(['auth'])->name('messages.create_conversation');
Route::post("messages/send", [MessagesController::class, 'sendMessagePost'])->middleware(['auth'])->name('messages.sendMessage');

// Search
Route::get('search', [SearchController::class, 'index'])->name('search.index');

require __DIR__.'/auth.php';
