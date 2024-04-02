<?php

namespace App\Http\Controllers\API\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ItemListPerCategoryController extends Controller
{

    public function show($id) : JsonResponse{
        // $product = Category::findOrFail($id);
        $getNOtes = DB::table('categories as A')
        ->leftJoin('products as B', 'A.id', '=', 'B.cid')
        ->where('A.id','=', $id)
        ->get();
        return $this->sendRes([$getNOtes],'200');
    }

}
