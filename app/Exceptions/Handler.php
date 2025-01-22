<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

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

    public function render($request, Throwable $exception)
    {
        // Handle specific exceptions differently
        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            return redirect()->route('login');
        }

        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            return redirect()->back()->withErrors($exception->validator)->withInput();
        }

        if ($exception instanceof \Illuminate\Auth\Access\AuthorizationException) {
            return response()->view('errors.403', [], 403);
        }

        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\HttpException && $exception->getStatusCode() == 503) {
            return response()->view('front-end.maintenance', [], 503);
        }

        // Render the custom 404 view for all other exceptions
        // return response()->view('front-end.404', [], 404);
        return response()->view('front-end.maintenance', [], 503);
    }
}