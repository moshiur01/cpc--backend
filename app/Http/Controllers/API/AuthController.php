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
                'uid' => $request->uid,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'stu_id' => $request->id,
                'role' => 'user',
                'phone' => $request->phone,
                'user_img' => 'default',

            ]);

            $token =  $user->createToken($user->email . '_Token',)->plainTextToken;

            // user end a data pathano 

            return response()->json([
                'status' => 200,
                "display_name" => $user->display_name,
                "name" => $user->name,
                "uid" => $user->uid,
                "email" => $user->email,
                "phone" => $user->phone,
                "stu_id" => $user->stu_id,
                "role" => $user->role,
                "user_img" => $user->user_img,
                "user_cover" => $user->user_cover,
                "badges" => $user->badges,
                "created_at" => $user->created_at,
                "updated_at" => $user->updated_at,
                "token" => $token,
                "message" => 'Registered Successfully',
            ]);
        }
    }

    // login 
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [

            "email" => "required|email|max:191",
            "password" => "required",
        ]);


        if ($validator->fails()) {
            return response()->json([
                'validation_Errors' => $validator->messages(),
            ]);
        } else {
            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => 401,
                    'message' => 'Invalid Credentials',
                ]);
            } else {

                $token =  $user->createToken($user->email . '_Token',)->plainTextToken;

                // send response to frontend

                return response()->json([
                    'status' => 200,
                    "display_name" => $user->display_name,
                    "name" => $user->name,
                    "uid" => $user->uid,
                    "email" => $user->email,
                    "phone" => $user->phone,
                    "stu_id" => $user->stu_id,
                    "role" => $user->role,
                    "user_img" => $user->user_img,
                    "user_cover" => $user->user_cover,
                    "badges" => $user->badges,
                    "created_at" => $user->created_at,
                    "updated_at" => $user->updated_at,

                    "token" => $token,
                    "message" => 'Login Successfully',
                ]);
            }
        }
    }

    // logout 
    public function logout()
    {

        // ignore the tokens error it works successfully 
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => 200,
            "message" => "logout Successfully"
        ]);
    }


    //get all the user
    public function index()
    {
        $users = User::all();

        return response()->json([
            'status' => 200,
            'users' => $users
        ]);
    }

    // edit 
    public function edit($uid)
    {
        return response()->json(User::whereId($uid)->first());
    }



    //update the user role as admin
    public function update(Request $request, $uid)
    {

        if ($request->role === 'admin') {

            $user = User::whereuid($uid)->first();

            $user->update([
                'role' => $request->role,

            ]);
            return response()->json([
                'status' => 200,
                "message" => "Admin Added Successfully"
            ]);
        }elseif ($request->role === 'moderator') {
            $user = User::whereuid($uid)->first();

            $user->update([
                'role' => $request->role,

            ]);
            return response()->json([
                'status' => 200,
                "message" => "Moderator Added Successfully"
            ]);
        } elseif ($request->role === 'user') {
            $user = User::whereuid($uid)->first();

            $user->update([
                'role' => $request->role,

            ]);
            return response()->json([
                'status' => 200,
                "message" => "Demoted Successfully"
            ]);
        }
    }
}
