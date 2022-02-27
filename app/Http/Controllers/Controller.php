<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\MessageBag;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function set_error($message) {
        $data = [
            'errors' =>
                $message

        ];
        return new MessageBag($data);
    }

    protected function set_response($message) {
        $data = [
            'data' =>
                $message

        ];
        return new MessageBag($data);
    }
}
