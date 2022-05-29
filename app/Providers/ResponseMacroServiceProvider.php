<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Response::macro('success', function ($data, $status = 200) {
            return Response::json([
                'data' => $data,
                'status' => true
            ], $status);
        });

        Response::macro('error', function ($message, $status = 422) {
            return Response::json([
                'message' => $message,
                'status'  => false,
            ], $status);
        });
    }
}
