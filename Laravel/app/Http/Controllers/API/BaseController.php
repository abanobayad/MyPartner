<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function SendResponse($result , $message , $code = 200)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message
        ];
        return response()->json($response , $code);
    }

    public function SendError($error , $errorMessage=[] , $code=404)
    {
        $response = [
            'success' => false,
            'data' => $error,
        ];
        if(!empty($errorMessage))
        {
            $response['data'] = $errorMessage;
        }
        return response()->json($response , $code);
    }
}
