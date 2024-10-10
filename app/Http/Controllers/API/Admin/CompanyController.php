<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
   
    public function index(Request $request)
    {
        $companies = Company::all();

        return ok('Companies retrieved successfully', $companies);
    }

    public function store(Request $request) {
        
        $request->validate([
            'name'    => 'required|string',
            'email'   => 'required|email|unique:companies,email',
            'website' => 'nullable|url',
            'logo'    => 'nullable',
            'address' => 'nullable',
        ]);

        $company = Company::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'website'   => $request->website,
            'logo'      => $request->logo,
            'address'   => $request->address,
        ]);

        return ok('Company created successfully.', $company);
    }

    public function show($id)
    {
        $company = Company::find($id);

        if (!$company) {
            return error('Company not found.!', [], "notfound");
        }

        return ok('Company retrieved successfully.', $company);
    }

    public function update(Request $request, $id)
    {
        $company = Company::find($id);

        if (!$company) {
            return error('Company not found.!', [], "notfound");
        }

        $request->validate([
            'name'    => 'required|string',
            'email'   => 'required|email|unique:companies,email,'.$company->id,
            'website' => 'nullable|url',
            'logo'    => 'nullable',
            'address' => 'nullable',
        ]);

        $company->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'website'   => $request->website,
            'logo'      => $request->logo,
            'address'   => $request->address,
        ]);

        return ok('Company updated successfully.', $company);
    }

    public function destroy($id)
    {
        $company = Company::find($id);

        if (!$company) {
            return error('Company not found.!', [], "notfound");
        }

        $company->delete();

        return ok('Company deleted successfully.');
    }
}
