<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('main.main', [
            "companies" => Company::with("employees")->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        return view('main.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required",
            'email' => "required|email|unique:tbl_companies,email",
            'website' => "required|url|unique:tbl_companies,website",
            'logo' => "required|image|mimes:jpg,png,jpeg|max:2048|dimensions:min_width=100,min_height=100",
        ]);

        $companyName = $request->get("name");
        $imagePath = md5($companyName);

        $company = new Company();
        $company->setAttribute("slug", md5($request->get("email")));
        $company->setAttribute("name", $companyName);
        $company->setAttribute("email", $request->get("email"));
        $company->setAttribute("website", $request->get("website"));
        $company->setAttribute("logo", Storage::disk('public')->putFile("images/company/{$imagePath}", $request->file('logo')));
        $company->save();

        return redirect()->route("companies.index")->with('success', "Company '{$company->getAttributeValue("name")}' created successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return Renderable
     */
    public function show(Company $company)
    {
        return view("main.company", [
            "company" => $company,
            "employees" => $company->employees()->paginate(10)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return Renderable
     */
    public function edit(Company $company)
    {
        return view('main.create-edit', [
            "company" => $company
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Company  $company
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => [ "required", Rule::unique("tbl_companies", "name")->ignore($company->getAttributeValue('id')) ],
            'email' => [ "required" , Rule::unique("tbl_companies", "email")->ignore($company->getAttributeValue('id')) ],
            'website' => "required|url",
            'logo' => "image|mimes:jpg,png,jpeg|max:2048|dimensions:min_width=100,min_height=100",
        ]);

        $companyName = $request->get("name");
        $imagePath = md5($companyName);

        $company->setAttribute("name", $companyName);
        $company->setAttribute("email", $request->get("email"));
        $company->setAttribute("website", $request->get("website"));
        if ( !is_null($request->file('logo')) ) {
            $company->setAttribute("logo", Storage::disk('public')->putFile("images/company/{$imagePath}", $request->file('logo')));
        }
        $company->save();

        return redirect()->route("companies.index")->with('success', "Company details of '{$company->getAttributeValue("name")}' updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Company $company
     * @return RedirectResponse
     */
    public function destroy(Company $company)
    {
        $name = $company->getAttributeValue('name');
        $company->delete();
        return redirect()->route("companies.index")->with('success', "Company '{$name}' deleted successfully with attached Employees");
    }
}
