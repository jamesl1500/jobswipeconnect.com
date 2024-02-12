<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pages.companies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        /**
         * Form validation
         * ----------------
         * Here we validate the form data
         */
        $validated = request()->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
            'schedule_type' => 'required|string|max:255',
        ]);

        // If the user uploaded a new logo
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('company_logos', 'public');
        }

        /**
         * Create the new company
         * --------------------------
         * Here we create the new company
         */
        $request->user()->companies()->create($validated);

        /**
         * Redirect back to the companies page
         */
        return redirect()->route('companies.my_companies')->with('success', 'Company created successfully');

    }

    /**
     * Display the user's companies
     * ---------------------
     */
    public function myCompanies()
    {
        return view('pages.companies.my_companies');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function show(Companies $companies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function edit(Companies $companies, $id)
    {
        // Get the company
        $company = Companies::where('id', $id)->first();

        // See if the company exists
        if (!$company) {
            return abort(404);
        }

        // See if the company belongs to the user
        if ($company->user_id != auth()->user()->id) {
            return abort(403);
        }

        return view('pages.companies.edit.edit', [
            'company' => $company,
        ]);
    }

    /**
     * Save edited company
     * ---------------------
     */
    public function editSave(Request $request, $id)
    {
        // Get the company
        $company = Companies::where('id', $id)->first();

        // See if the company exists
        if (!$company) {
            return abort(404);
        }

        // See if the company belongs to the user
        if ($company->user_id != auth()->user()->id) {
            return abort(403);
        }

        /**
         * Form validation
         * ----------------
         * Here we validate the form data
         */
        $validated = request()->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
            'schedule_type' => 'required|string|max:255',
        ]);

        // If the user uploaded a new logo
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('company_logos', 'public');
        }

        /**
         * Update the company
         * --------------------------
         * Here we update the company
         */
        $company->update($validated);

        /**
         * Redirect back to the companies page
         */
        return redirect()->route('companies.edit', $id)->with('success', 'Company updated successfully');
    }

    public function edit_address(Companies $companies, $id)
    {
        // Get the company
        $company = Companies::where('id', $id)->first();

        // See if the company exists
        if (!$company) {
            return abort(404);
        }

        // See if the company belongs to the user
        if ($company->user_id != auth()->user()->id) {
            return abort(403);
        }

        return view('pages.companies.edit.address', [
            'company' => $company,
        ]);
    }

    public function edit_addressPost(Request $request, $id)
    {
        // Get the company
        $company = Companies::where('id', $id)->first();

        // See if the company exists
        if (!$company) {
            return abort(404);
        }

        // See if the company belongs to the user
        if ($company->user_id != auth()->user()->id) {
            return abort(403);
        }

        /**
         * Form validation
         * ----------------
         * Here we validate the form data
         */
        $validated = request()->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|numeric',
            'country' => 'required|string|max:255',
        ]);

        /**
         * Update the company
         * --------------------------
         * Here we update the company
         */
        $company->update($validated);

        /**
         * Redirect back to the companies page
         */
        return redirect()->route('companies.edit.address', $id)->with('success', 'Company address updated successfully');
    }

    public function edit_contact(Companies $companies, $id)
    {
        // Get the company
        $company = Companies::where('id', $id)->first();

        // See if the company exists
        if (!$company) {
            return abort(404);
        }

        // See if the company belongs to the user
        if ($company->user_id != auth()->user()->id) {
            return abort(403);
        }

        return view('pages.companies.edit.contact', [
            'company' => $company,
        ]);
    }

    public function edit_contactPost(Request $request, $id)
    {
        // Get the company
        $company = Companies::where('id', $id)->first();

        // See if the company exists
        if (!$company) {
            return abort(404);
        }

        // See if the company belongs to the user
        if ($company->user_id != auth()->user()->id) {
            return abort(403);
        }

        /**
         * Form validation
         * ----------------
         * Here we validate the form data
         */
        $validated = request()->validate([
            'phone' => 'string|max:255',
            'email' => 'string|email|max:255',
        ]);

        /**
         * Update the company
         * --------------------------
         * Here we update the company
         */
        $company->update($validated);

        /**
         * Redirect back to the companies page
         */
        return redirect()->route('companies.edit.contact', $id)->with('success', 'Company contact updated successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Companies $companies)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Companies $companies)
    {
        //
    }
}
