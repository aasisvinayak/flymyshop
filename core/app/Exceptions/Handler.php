<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param \Exception $e
     *
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $e
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof \RuntimeException) {
            if (strlen(env('APP_KEY')) < 20) {
                Artisan::call('key:generate');

                return redirect('/install');
            }
        }

        if ($e instanceof \PDOException) {
            $env_path = base_path('.env');
            $env = file($env_path);
            $newLinesArray = [];
            foreach ($env as $line) {
                if (! (strpos($line, 'DB_DATABASE') !== false)) {
                    array_push($newLinesArray, $line);
                }
            }
            $newFileContent = implode("\n", $newLinesArray);
            file_put_contents($env_path, $newFileContent);
            Session::flash('alert-danger', 'Incorrect database information!! Please update');

            return redirect('/install');
        }

        return parent::render($request, $e);
    }
}
