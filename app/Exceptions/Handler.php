<?php

namespace App\Exceptions;

use Exception;
use App\Exceptions\ResourceCleanException;
use App\Traits\ApiResponser;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    use ApiResponser;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if($exception instanceof ValidationException)
        {
            $errors = $exception->validator->getMessageBag();
            return $this->errorResponse($errors, 422);
        }

        if($exception instanceof ModelNotFoundException)
        {
            $model = strtolower(class_basename($exception->getModel()));
            return $this->errorResponse("{$model} instance not found", 404);
        }

        if($exception instanceof AuthenticationException)
        {
            return $this->errorResponse('user not authenticated', 401);
        }

        if($exception instanceof AuthorizationException)
        {
            return $this->errorResponse('no authorization for these action', 403);
        }

        if($exception instanceof NotFoundHttpException)
        {
            return $this->errorResponse('url not found', 404);
        }

        if($exception instanceof MethodNotAllowedHttpException)
        {
            return $this->errorResponse('request method not allowed', 405);
        }

        if($exception instanceof HttpException)
        {
            return $this->errorResponse($exception->getMessage(), $exception->getStatusCode());
        }
        
        if($exception instanceof QueryException)
        {
            dd($exception);
            $errorCode = $exception->errorInfo[1];
            if($errorCode = 1451)
            {
                return $this->errorResponse('action not possible, integrity reference', 409);
            }
        }

        if($exception instanceof ResourceCleanException)
        {
            return $this->errorResponse($exception->getMessage(),422);
        }

        if(!config('app.debug'))
        {
            return $this->errorResponse('internal error', 500);
        }
        
        return parent::render($request, $exception);
    }
}
