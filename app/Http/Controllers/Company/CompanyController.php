<?php

namespace App\Http\Controllers\Company;

use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Company as CompanyResource;

class CompanyController extends ApiController
{
    /**
     * Search
     */
    public function search()
    {
        $results = Company::orderBy('name')
            ->when(request('q'), function($query) {
                $query->where('name', 'like', '%'.request('q').'%')
                      ->orWhere('dni', 'like', '%'.request('q').'%')
                      ->orWhere('contact_name', 'like', '%'.request('q').'%');
            })
            ->limit(6)
            ->get();
        return response()
            ->json(['data' => $results], 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Company::query();

        $parameters =  $parameters = request()->query->all();

        $this->sortBy(Company::class, $query, $parameters);

        $this->filterBy(Company::class, $query, $parameters);
        
        return CompanyResource::collection($query->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:company',
            'dni' => 'required|unique:company',
            'email' => 'email'
        ];

        $this->validate($request, $rules);

        $item = Company::create($request->all());

        return new CompanyResource($item, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return new CompanyResource($company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $rules = [
            'name' => 'required|unique:companies,name,' . $company->id
        ];

        $this->validate($request, $rules);

        $company->fill($request->all());
        
        if($company->isClean()) {
            throw new ResourceCleanException();
        }

        $company->save();
        
        return new CompanyResource($company);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        
        return new CompanyResource($company);
    }
}
