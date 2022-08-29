<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\EventPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventPostController extends Controller
{
    public function store(Request $request)
    {

        // validate  the form
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:191',
            'coverImage' => 'required',
            'description' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $event = new EventPost;
            //db's column name= req.name(come from frontend)
            $event->title = $request->input("title");
            $event->startDate = $request->input("startDate");
            $event->endDate = $request->input("endDate");
            $event->description = $request->input("description");
            $event->eventID = $request->input("eventID");

            //store image

            if ($request->coverImage) {
                // $folderPath = "uploads/eventCovers/";
                $eventID = $request->input("eventID");
                $base64Image = explode(";base64,", $request->coverImage);
                $explodeImage = explode("image/", $base64Image[0]);
                $imageType = $explodeImage[1];
                $image_base64 = base64_decode($base64Image[1]);
                $fileName = 'uploads/eventCovers/event-' . $eventID . '.' . $imageType;

                file_put_contents($fileName, $image_base64);
                $event->coverImage =  $fileName;
            }
            $event->save();

            return response()->json([

                "status" => 200,
                "message" => 'event created successfully',
                "eventID" => $event->eventID,
                "title" => $event->title,
                "startDate" => $event->startDate,
                "endDate" => $event->endDate,
                "description" => $event->description,
                "coverImage" => $event->coverImage,
            ]);
        }
    }
}
