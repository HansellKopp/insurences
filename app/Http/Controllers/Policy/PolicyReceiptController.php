<?php

namespace App\Http\Controllers\Policy;

use App\Policy;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;


class PolicyReceiptController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Policy $policy)
    {
        $receipts = $policy->receipts;
        
        return $this->showAll($receipts);
    }
}
