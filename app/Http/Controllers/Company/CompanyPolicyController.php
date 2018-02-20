<?php

namespace App\Http\Controllers\Company;

use App\Company;
use App\Policy;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\Policy as PolicyResource;
use App\Http\Resources\Company as CompanyResource;

class CompanyPolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Company  $company
     * 
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $company = Company::find($id);

        return $company->policies;
    }

}
