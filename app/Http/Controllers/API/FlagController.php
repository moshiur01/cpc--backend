<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Flag;
use Illuminate\Http\Request;

class FlagController extends Controller
{

    //get all the flags
    public function index()
    {
        $flags = Flag::all();

        return response()->json([
            'status' => 200,
            'flags' => $flags
        ]);
    }


    // add initial flag status 
    public function store(Request $request)
    {



        $flag = Flag::create([

            // DB's column name=> value 
            'uid' => $request->uid,


        ]);
    }


    // // //update the flag table 
    // public function update(Request $request, $uid)
    // {

    //     if ($request->role === 'admin') {

    //         $user = Flag::whereuid($uid)->first();

    //         $user->update([
    //             'role' => $request->role,

    //         ]);
    //         return response()->json([
    //             'status' => 200,
    //             "message" => "Admin  Added Successfully"
    //         ]);
    //     } elseif ($request->role === 'user') {
    //         $user = Flag::whereuid($uid)->first();

    //         $user->update([
    //             'role' => $request->role,

    //         ]);
    //         return response()->json([
    //             'status' => 200,
    //             "message" => "Admin  Removed Successfully"
    //         ]);
    //     }
    // }
}
