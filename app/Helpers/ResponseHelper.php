<?php

namespace App\Helpers;

trait ResponseHelper
{
    public static function generateResponse($data, $status, $message = false)
    {
        $response['status'] = $status;

        if ($message) {
            $response['message'] = $data;
        } else {
            $response['data'] = $data;
        }

        return response()->json($response, $status);
    }

}
