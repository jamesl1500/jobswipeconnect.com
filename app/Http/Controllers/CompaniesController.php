<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CompaniesController extends Controller
{
    public function index(): View
    {
        return view('pages.companies.index');
    }

    public function create(): View
    {
        return view('pages.companies.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
            'schedule_type' => 'required|string|max:255',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('company_logos', 'public');
        }

        $request->user()->companies()->create($validated);

        return redirect()->route('companies.my_companies')->with('success', 'Company created successfully');
    }

    public function myCompanies(): View
    {
        return view('pages.companies.my_companies');
    }

    public function show(Companies $companies): void
    {
        //
    }

    public function edit(int $id): View
    {
        $company = Companies::find($id);

        if (!$company) {
            abort(404);
        }

        if ($company->user_id != auth()->user()->id) {
            abort(403);
        }

        return view('pages.companies.edit.edit', [
            'company' => $company,
        ]);
    }

    public function editSave(Request $request, int $id): RedirectResponse
    {
        $company = Companies::find($id);

        if (!$company) {
            abort(404);
        }

        if ($company->user_id != auth()->user()->id) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
            'schedule_type' => 'required|string|max:255',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('company_logos', 'public');
        }

        $company->update($validated);

        return redirect()->route('companies.edit', $id)->with('success', 'Company updated successfully');
    }

    public function edit_address(int $id): View
    {
        $company = Companies::find($id);

        if (!$company) {
            abort(404);
        }

        if ($company->user_id != auth()->user()->id) {
            abort(403);
        }

        return view('pages.companies.edit.address', [
            'company' => $company,
        ]);
    }

    public function edit_addressPost(Request $request, int $id): RedirectResponse
    {
        $company = Companies::find($id);

        if (!$company) {
            abort(404);
        }

        if ($company->user_id != auth()->user()->id) {
            abort(403);
        }

        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|numeric',
            'country' => 'required|string|max:255',
        ]);

        $company->update($validated);

        return redirect()->route('companies.edit.address', $id)->with('success', 'Company address updated successfully');
    }

    public function edit_contact(int $id): View
    {
        $company = Companies::find($id);

        if (!$company) {
            abort(404);
        }

        if ($company->user_id != auth()->user()->id) {
            abort(403);
        }

        return view('pages.companies.edit.contact', [
            'company' => $company,
        ]);
    }

    public function edit_contactPost(Request $request, int $id): RedirectResponse
    {
        $company = Companies::find($id);

        if (!$company) {
            abort(404);
        }

        if ($company->user_id != auth()->user()->id) {
            abort(403);
        }

        $validated = $request->validate([
            'phone' => 'string|max:255',
            'email' => 'string|email|max:255',
        ]);

        $company->update($validated);

        return redirect()->route('companies.edit.contact', $id)->with('success', 'Company contact updated successfully');
    }

    public function update(Request $request, Companies $companies): void
    {
        //
    }

    public function destroy(Companies $companies): void
    {
        //
    }
}
