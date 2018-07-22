<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
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
        //zzt 将验证异常值进行处理
        if($exception instanceof ValidationException){
            if ($request->ajax() || $request->wantsJson()) {

                $errMessage=$exception->getMessage();
                foreach($exception->errors() as $errors) {
                    foreach ($errors as $err)
                        $errMessage .= '<br>'.$err;
                }

                return response()->json(__ajax('fail',$errMessage));
            }
        }

        return parent::render($request, $exception);
    }
}