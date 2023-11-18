<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function response($msg, $data, $status = true, $statusCode = 200) {
        $response = [
            'success' => $status,
            'message' => $msg,
            'data' => $data,
        ];

        return response($response, $statusCode);
    }
}
