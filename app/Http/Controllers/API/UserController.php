<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    //update the user data
    public function update(Request $request, $uid)
    {
        if ($request->event === 'proImgChange') {
            $user = User::whereuid($uid)->first();
            //store image
            if ($request->image) {
                // $folderPath = "uploads/eventCovers/";
                $userID = $uid;
                $base64Image = explode(";base64,", $request->image);
                $explodeImage = explode("image/", $base64Image[0]);
                $imageType = $explodeImage[1];
                $image_base64 = base64_decode($base64Image[1]);
                $fileName = 'uploads/users/userImg/user-' . $userID . '.' . $imageType;

                file_put_contents($fileName, $image_base64);
                $user->update([
                    'user_img' => $fileName,

                ]);
            }
            $user->save();
            return response()->json([
                'status' => 200,
                "message" => "Profile Image Updated Successfully"
            ]);
        } elseif ($request->event === 'coverImgChange') {
            $user = User::whereuid($uid)->first();

            //store image
            if ($request->image) {
                // $folderPath = "uploads/eventCovers/";
                $userID = $uid;
                $base64Image = explode(";base64,", $request->image);
                $explodeImage = explode("image/", $base64Image[0]);
                $imageType = $explodeImage[1];
                $image_base64 = base64_decode($base64Image[1]);
                $fileName = 'uploads/users/userCoverImg/user-' . $userID . '.' . $imageType;

                file_put_contents($fileName, $image_base64);
                $user->update([
                    'user_cover' => $fileName,

                ]);
            }
            $user->save();
            return response()->json([
                'status' => 200,
                "message" => "Cover Image Updated Successfully"
            ]);
        } elseif ($request->event === 'displayNameChange') {
            $user = User::whereuid($uid)->first();
            $user->update([
                'display_name' => $request->display_name,

            ]);
            return response()->json([
                'status' => 200,
                "message" => "Display Name Updated Successfully"
            ]);
        }
    }
}
