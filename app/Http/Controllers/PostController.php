<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create_post(Request $request){

        if (($request->hasFile("image") != null && $request->file("image")->isValid()) || $request->description == null){
            
            $privacy_levels = 1;//default pubic
            $is_allow = true;
            $is_deny = true;

            $post = new Post;
            $post->profile_id_fk = $request->profile_id_fk;
            $post->description = $request->description;
            $post->privacy = $privacy_levels;
            $post->is_allow = ($is_allow) ? $is_allow : $is_deny;
            if ($post->save() && $request->hasFile("image")) {
                # code...
                $media = MediaController::uploadImage($request->file("image"));
                MediaController::saveMedia($media, $post->id);
            }
        }
        else{
            return new JsonResponse([
                'status' => 201,
                'message' => 'Slect image or Description to go further'
            ]);
        }
    }
}
