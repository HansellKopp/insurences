<?php

namespace App\Traits;

use \Illuminate\Database\Eloquent;
use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Collection;

/**
 *  Handles standard API responses
 * 
 */
trait ApiResponser
{
    /**
     * response sorter
     */
    protected function sortBy($model, $query, $parameters) 
    {
        $columns = $model::firstOrFail()->getFillable();

        if(isset($parameters['sort_by']) && in_array($parameters['sort_by'], $columns)) {
            $query = $query->orderBy($parameters['sort_by']);
        }

        return $query;
    }

    protected function filterBy($model, $query, $parameters)
    {           
        $columns = $model::firstOrFail()->getFillable();
        
        foreach ($parameters as $param => $value) {
            if(isset($param, $value) && in_array($param, $columns)) {
                $query = $query->where($param,$value);
            }
        }

        return $query;
    }
    
    /**
     * Error Response
     * 
     */
    protected function errorResponse($message, $code = 500)
    {
        return response()->json(['errors' => $message], $code);
    }
}


