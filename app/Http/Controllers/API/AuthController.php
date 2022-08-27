<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // registration 
    public function register(Request $request)
    {


        // validate  the form
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191',
            'email' => 'required|email|max:191|unique:users,email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validation_Errors' => $validator->messages(),
            ]);
        } else {
            $user = User::create([

                // DB's column name=> value 

                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'stu_id' => $request->id,
                'phone' => $request->phone,

            ]);


            //generate user token

            // return $user->createToken('token-name', ['server:update'])->plainTextToken;

            $token =  $user->createToken($user->email . '_Token',)->plainTextToken;

            // user end a data pathano 

            return response()->json([
                'status' => 200,
                "userName" => $user->name,
                "email" => $user->email,
                "phone" => $user->phone,
                "stuId" => $user->stu_id,
                "userImg" => $user->user_img,
                "token" => $token,
                "message" => 'Registered Successfully',
            ]);
        }
    }
}
