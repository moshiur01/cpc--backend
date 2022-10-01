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


    // //update the flag table 
    public function update(Request $request, $uid)
    {

        if ($request->event === 'new_admin_false') {

            $flag = Flag::whereuid($uid)->first();

            $flag->update([
                'new_admin' => $request->status,

            ]);
            return response()->json([
                'status' => 200,
                "message" => "Admin status Updated Successfully"
            ]);
        } elseif ($request->event === 'new_admin_true') {
            $user = Flag::whereuid($uid)->first();

            $user->update([
                'new_admin' => $request->status,

            ]);
            return response()->json([
                'status' => 200,
                "message" => "Admin status Updated Successfully"
            ]);
        }
    }
}
