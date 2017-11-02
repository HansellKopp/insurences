<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Exceptions\ResourceCleanException;

class ApiController extends Controller
{
    use ApiResponser;

    public function checkClean($model)
    {
        if($model->isClean())
        {
            throw new ResourceCleanException();
        }
    }
}