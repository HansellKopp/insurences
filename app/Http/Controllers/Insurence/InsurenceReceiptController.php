<?php

namespace App\Http\Controllers\Insurence;

use App\Insurence;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class InsurenceReceiptController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Insurence $insurence)
    {
        $receipts = $insurence->receipts;
        
        return $this->showAll($receipts);
    }

}
