<?php

namespace App\Traits;

trait ApiResponse
{
    protected function apiSuccess($params = [])
    {
        $data = [
            'success' => true,
            'errcode' => 0,
            'errmsg' => '',
        ];
        $data = array_merge($data, $params);
        return response()->json($data);
    }

    protected function apiError($errmsg, $errcode=40001, $httpStatusCode=200)
    {
        $data = [
            'success' => false,
            'errcode' => $errcode,
            'errmsg' => $errmsg,
        ];
        return response()->json($data, $httpStatusCode);
    }

}