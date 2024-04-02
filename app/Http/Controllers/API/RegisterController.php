<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    //
    public function register(Request $request): JsonResponse {
        // $validator = Validator::make($request->all(), [
        // ]);
        $validate = Validator::make($request->all(), [
            "name" =>"required",
            "email" =>"email|unique:users,email,except,id",
            "password" =>"required",
            "c_password" =>"required|same:password"
        ]);

        if ($validate->fails()) {
            return $this-> sendError($validate->errors()->first(), $validate->errors()->first());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user-> createToken('Myapp') ->accessToken;
        return $this-> sendRes( $success,"User Registered");
    }
    public function login(Request $request): JsonResponse {

        if(Auth::attempt(['email'=> $request->email ,'password' => $request->password ])){
         $user = Auth::user() ;
        $success['token'] = $user-> createToken('Myapp') ->accessToken;

         $success['user']  = $user->name;
         return $this->sendRes($success,'user logined');
        }
        else{
            return $this-> sendError("Unauthorized" , "Error unauthorized");
        }

    }
}
