<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    //add a new event in DB
    public function store(Request $request)
    {

        // validate  the form
        $validator = Validator::make($request->all(), [

            // frontend data validation
            'stu_id' => 'required',
            'stu_name' => 'required',
            'stu_email' => 'required',
            'program_name' => 'required',
            'certificate_image' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $certificate = new Certificate;
            //db's column name= req.name(come from frontend)
            $certificate->certificate_id = $request->input("certificate_id");
            $certificate->stu_id = $request->input("stu_id");
            $certificate->stu_name = $request->input("stu_name");
            $certificate->stu_email = $request->input("stu_email");
            $certificate->program_name = $request->input("program_name");
            $certificate->approved_by = $request->input("approved_by");
            $certificate->approved_by = $request->input("approved_by");

            //store image

            if ($request->certificate_image) {

                $certificate_id = $request->input("certificate_id");
                $base64Image = explode(";base64,", $request->certificate_image);
                $explodeImage = explode("image/", $base64Image[0]);
                $imageType = $explodeImage[1];
                $image_base64 = base64_decode($base64Image[1]);
                $fileName = 'uploads/certificates/certificate-' . $certificate_id . '.' . $imageType;

                file_put_contents($fileName, $image_base64);
                $certificate->certificate_image =  $fileName;
            }
            $certificate->save();

            return response()->json([

                "status" => 200,
                "message" => 'Certificate Created Successfully',

            ]);
        }
    }
}
