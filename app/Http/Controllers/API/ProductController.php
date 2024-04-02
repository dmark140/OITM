<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProducResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index() :JsonResponse{
        $product = Product::all();
        return $this-> sendRes(CategoryResource::collection($product),'Category retrieved!');
    }

    public function store(Request $request) : JsonResponse{
        $input = $request-> all();
        $validate = Validator::make($input, [
            'itemCode'=> 'required',
            'itemName'=> 'required',
            'cid'   => 'required',
            'quantity'=> 'required|integer',
            'min'=> 'required|integer',
            'max'=> 'required|integer',
        ]);
        if($validate->fails())  { return $this->sendRes($validate->errors(),'');  }

        $product = Product::create($request->all());
        return $this->sendRes(new ProducResource($product),'Item Created');

    }

    public function show($id) : JsonResponse{
        $product = Product::findOrFail($id);
        return $this->sendRes(new ProducResource($product),'200');
    }

    public function update(Request $request, Category $product) : JsonResponse{
        $input = $request-> all();

        $validate = Validator::make($input, [
            'name'=> 'required|unique:category,name,except,id',
        ]);
        if($validate->fails()){
         return $this->sendError($validate->errors(),'');
        }
        $product->name= $input['name'];
        $product->save();
        return $this->sendRes(new ProducResource($product),'updated! 200');
    }
    public function destroy(Category $product) : JsonResponse{
        $product->delete();
        return $this->sendRes("","Deleted");
    }

}
