<?php

namespace App\Http\Controllers\Branch;

use App\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class BranchController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Branch::all();

        return $this->showAll($branches);
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
            'name' => 'required|unique:branches'
        ];

        $this->validate($request, $rules);

        $item = Branch::create($request->all());

        return $this->showOne($item, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        return $this->showOne($branch);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
        $rules = [
            'name' => 'required|unique:branches,name,' . $branch->id
        ];

        $this->validate($request, $rules);

        $branch->fill($request->all());
        
        $this->checkClean($branch);

        $branch->save();

        return $this->showOne($branch);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();
        
        return $this->showOne($branch);
    }
}
