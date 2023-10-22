<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create_post(Request $request){
        dd($request);

        if (($request->hasFile("image") != null && $request->file("image")->isValid()) || $request->description == null){
            # code...
        }
        else{
            return new JsonResponse([
                'status' => 201,
                'message' => 'Slect image or Description to go further'
            ]);
        }
    }
}
