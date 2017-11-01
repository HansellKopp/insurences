<?php

namespace App\Traits;

use \Illuminate\Support\Collection;
use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent;

/**
 *  Handles standard API responses
 * 
 */
trait ApiResponser
{
    /**
     * Success Response
     * 
     */
    private function successResponse($data, $code = 200)
    {
        return response()->json($data, $code);
    }
    
    /**
     * Error Response
     * 
     */
    protected function errorResponse($message, $code = 500)
    {
        return response()->json(['errors' => $message], $code);
    }

    /**
     * Show Colletion of Elements
     * 
     */
    protected function showAll(Collection $collection, $code = 200 )
    {
        return $this->successResponse(['data' => $collection], $code);
    }

    /**
     * Show one model
     * 
     */
    protected function showOne(Model $instance, $code = 200 )
    {
        return $this->successResponse(['data' => $instance], $code);
    }
}


