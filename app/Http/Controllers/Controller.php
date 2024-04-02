<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function sendRes($result, $message =""){
        $res = [
            'success' => true,
            'message'=> $message,
            'data' => $result
        ];
            return response()->json($res,200);
    }

    public function sendError($result, $message =""){
        $res = [
            'success' => false,
            'message'=> $message,
            'data' => $result
        ];
            return response()->json($res,400);
    }
}
