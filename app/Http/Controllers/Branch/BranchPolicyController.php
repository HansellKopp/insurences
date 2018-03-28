<?php

namespace App\Http\Controllers\Branch;

use App\Branch;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\Policy as PolicyResource;

class BranchPolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $branch = Branch::find($id);

        return PolicyResource::collection($branch->policies()->paginate(10));
    }

}
