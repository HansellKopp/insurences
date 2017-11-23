<?php

namespace App\Http\Controllers\Policy;

use App\Policy;
use App\PolicyDocument;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\PolicyDocument as PolicyDocumentResource;

class PolicyDocumentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Policy  $policy
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Policy $policy)
    {
        $rules = [
            'name' => 'required|unique:policy_documents,name,' . $policy->id,
            'document' => 'required'           
        ];

        $this->validate($request, $rules);

        $data['policy_id'] = $policy->id;
        $data['name'] = $request->name;
        $data['document'] = $request->document->store('policies/documents');

        $item = PolicyDocument::create($data);

        return new PolicyDocumentResource($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Policy  $policy
     * @param  $id document_id
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Policy $policy, $id)
    {
        $item = $policy->documents()->find($id);
        
        if(!$item)
        {
            throw new ModelNotFoundException('Data not found');
        }

        return response()->download(storage_path("app/{$item->document}"));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Policy  $policy
     * @param  $id document_id
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Policy $policy, $id)
    {
        $item = $policy->documents()->find($id);
        
        if(!$item)
        {
            throw new ModelNotFoundException('Data not found');
        }

        $item->delete();

        Storage::delete($item->document);

        return new PolicyDocumentResource($item);
    }
}
