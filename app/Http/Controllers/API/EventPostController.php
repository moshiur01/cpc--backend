<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\EventPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventPostController extends Controller
{

    //add a new event in DB
    public function store(Request $request)
    {

        // validate  the form
        $validator = Validator::make($request->all(), [

            // frontend data validation
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
            $event->start_date = $request->input("startDate");
            $event->end_date = $request->input("endDate");
            $event->description = $request->input("description");
            $event->event_id = $request->input("eventID");

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
                $event->cover_image =  $fileName;
            }
            $event->save();

            return response()->json([

                "status" => 200,
                "message" => 'event created successfully',
                "event_id" => $event->event_id,
                "title" => $event->title,
                "start_date" => $event->start_date,
                "end_date" => $event->end_date,
                "description" => $event->description,
                "cover_image" => $event->cover_image,
            ]);
        }
    }

    //get all events


    //get all the user
    public function index()
    {
        $events = EventPost::all();

        return response()->json([
            'status' => 200,
            'events' => $events
        ]);
    }
}
