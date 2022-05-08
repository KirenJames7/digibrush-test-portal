<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
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
            "employees" => Employee::with("company")->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        return view('main.create-edit', [
            "companies" => Company::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     *
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => "required",
            'last_name' => "required",
            'email' => "required|email|unique:tbl_employees,email",
            'phone' => "required|unique:tbl_employees,phone",
            'company_id' => "required",
        ]);

        $employee = new Employee();
        $employee->setAttribute("slug", md5($request->get("email")));
        $employee->setAttribute("first_name", $request->get("first_name"));
        $employee->setAttribute("last_name", $request->get("last_name"));
        $employee->setAttribute("email", $request->get("email"));
        $employee->setAttribute("phone", $request->get("phone"));
        $employee->setAttribute("company_id",$request->get("company_id"));
        $employee->save();

        return redirect()->route("employees.show", [ $employee ])->with('success', "Employee '{$employee->getAttributeValue("first_name")} {$employee->getAttributeValue("last_name")}' created successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  Employee  $employee
     *
     * @return Renderable
     */
    public function show(Employee $employee)
    {
        return view("main.employee", [
            "employee" => $employee
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return Renderable
     */
    public function edit(Employee $employee)
    {
        return view('main.create-edit', [
            "employee" => $employee,
            "companies" => Company::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EmployeeRequest  $request
     * @param  Employee  $employee
     *
     * @return RedirectResponse
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $request->validate([
            'first_name' => "required",
            'last_name' => "required",
            'email' => [ "required", Rule::unique("tbl_employees", "email")->ignore($employee->getAttributeValue('id')) ],
            'phone' => [ "required", Rule::unique("tbl_employees", "phone")->ignore($employee->getAttributeValue('id')) ],
            'company_id' => "required",
        ]);

        $employee->setAttribute("first_name", $request->get("first_name"));
        $employee->setAttribute("last_name", $request->get("last_name"));
        $employee->setAttribute("email", $request->get("email"));
        $employee->setAttribute("phone", $request->get("phone"));
        $employee->setAttribute("company_id", $request->get("company_id"));
        $employee->save();

        return redirect()->route("employees.show", [ $employee ])->with('success', "Employee details of '{$employee->getAttributeValue("first_name")} {$employee->getAttributeValue("last_name")}' updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Employee $employee
     *
     * @return RedirectResponse
     */
    public function destroy(Employee $employee)
    {
        $name = $employee->getAttributeValue('first_name') . " "  . $employee->getAttributeValue('last_name');
        $employee->delete();
        return redirect()->route("employees.index")->with('success', "Employee '{$name}' deleted successfully.");
    }
}
