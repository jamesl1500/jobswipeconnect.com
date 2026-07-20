<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class MarketingController extends Controller
{
    public function about(): View
    {
        return view('pages.marketing.about');
    }

    public function jobSeekers(): View
    {
        return view('pages.marketing.job_seekers');
    }

    public function employers(): View
    {
        return view('pages.marketing.employers');
    }

    public function contact(): View
    {
        return view('pages.marketing.contact');
    }

    public function contactStore(ContactRequest $request): RedirectResponse
    {
        $data = $request->validated();

        Mail::to(config('mail.from.address'))->send(new ContactMessage(
            senderName: $data['name'],
            senderEmail: $data['email'],
            topic: $data['topic'],
            messageBody: $data['message'],
        ));

        return redirect()->route('marketing.contact')->with('success', "Thanks for reaching out! We'll get back to you soon.");
    }

    public function privacy(): View
    {
        return view('pages.marketing.privacy');
    }

    public function terms(): View
    {
        return view('pages.marketing.terms');
    }
}
