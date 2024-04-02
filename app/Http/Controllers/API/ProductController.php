<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index() :JsonResponse{
        $products = Product::all();
        return response()->sendRes($products::collection($products),'Products retrieved!');
    }

}
