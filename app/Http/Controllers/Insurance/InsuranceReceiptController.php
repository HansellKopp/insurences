<?php

namespace App\Http\Controllers\Insurance;

use App\Insurance;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;


class InsuranceReceiptController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Insurance $insurance)
    {
        $receipts = $insurance->receipts;
        
        return $this->showAll($receipts);
    }
}
