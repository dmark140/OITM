<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    public function index() :JsonResponse{
        $products = Category::all();
        return $this-> sendRes(CategoryResource::collection($products),'Products retrieved!');
    }

    public function store(Request $request) : JsonResponse{

        $input = $request-> all();

        $validate = Validator::make($input, [
            'category'=> 'required',
        ]);
        if($validate->fails()){
         return response()->sendRes($validate->errors(),'');
        }
        $product = Category::create($request->all());
        return $this->sendRes(new CategoryResource($product),'Item Created');

    }

    public function show($id) : JsonResponse{
        $product = Product::findOrFail($id);
        return $this->sendRes(new CategoryResource($product),'200');
    }

    public function update(Request $request, Product $product) : JsonResponse{
        $input = $request-> all();

        $validate = Validator::make($input, [
            'itemCode'=> 'required',
            'itemName'=> 'required',
            'cid'   => 'required',
            'quantity'=> 'required|integer',
            'min'=> 'required|integer',
            'max'=> 'required|integer',
        ]);
        if($validate->fails()){
         return $this->sendError($validate->errors(),'');
        }
        $product->itemCode= $input['itemCode'];
        $product->cid= $input['cid'];
        $product->itemName= $input['itemName'];
        $product->quantity= $input['quantity'];
        $product->min= $input['min'];
        $product->max= $input['max'];
        $product->save();
        return $this->sendRes(new CategoryResource($product),'updated! 200');
    }
    public function destroy(Product $product) : JsonResponse{
        $product->delete();
        return $this->sendRes("","Deleted");
    }

}
