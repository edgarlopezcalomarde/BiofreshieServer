<?php

namespace App\Exceptions;


use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];


    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    protected function shouldReturnJson($request, Throwable $e){
        return true;
    }

    public function register()
    {
        $this->reportable(function (Throwable $e) {


            if (request()->is('api*')) {


                if ($e instanceof ModelNotFoundException)
                    return response()->json(['error' => 'Recurso no encontrado bb'],404);
                else if ($e instanceof NotFoundHttpException)
                    return response()->json(['error' => 'Error: ' .$e->getMessage()], 500);
                else if ($e instanceof Exception)
                    return response()->json(['error' => 'Error: ' .$e->getMessage()], 500);
                else if ($e instanceof ValidationException)
                    return response()->json(['error' => 'Datos no válidos'],400);
                else if (isset($e))
                    return response()->json(['error' => 'Error: ' .$e->getMessage()], 500);

            }
        });
    }
}
