<?php

namespace App\Exceptions;
use Illuminate\Http\Request;
use Illuminate\Http\Response;   
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    //added by navid
    public function render($request, Throwable $exception)
{
    if (Request::is('http://127.0.0.1:8000/*')) {
        $message = get_class($exception) . ":: message: " . $exception->getMessage();       
        return Redirect::back()->withErrors(['msg' =>$message]);
    }

    return parent::render($request, $exception);
}



    
  

}
