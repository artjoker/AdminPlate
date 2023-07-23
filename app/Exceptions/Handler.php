<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

/**
 * Class Handler.
 */
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
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
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * @param                                                  $request
     * @param  Throwable                                       $e
     * @throws Throwable
     * @return \Illuminate\Http\Response|JsonResponse|Response
     */
    public function render($request, Throwable $e): \Illuminate\Http\Response|JsonResponse|Response
    {
        if ($e instanceof HttpExceptionInterface) {
            $status = $e->getStatusCode();

            if (Str::contains($request->getRequestUri(), 'admin')) {
                if (view()->exists('backend.errors.' . $status)) {
                    return response()->view('backend.errors.' . $status, [], $status);
                }
            } else {
                if (view()->exists('frontend.errors.' . $status)) {
                    return response()->view('frontend.errors.' . $status, compact('e'), $status);
                }
            }
        }

        return parent::render($request, $e);
    }
}
