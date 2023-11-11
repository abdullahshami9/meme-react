<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create_post(Request $request)
    {

        $request->validate([
            'description' => 'required',
            'image' => 'required',
        ]);

        if (($request->hasFile("image") != null && $request->file("image")->isValid()) || $request->description == null) {

            $privacy_levels = 1; //default pubic
            $is_allow = true;
            $is_deny = true;

            $post = new Post;
            $post->profile_id_fk = $request->profile_id_fk;
            $post->description = $request->description;
            $post->privacy = $privacy_levels;
            $post->is_allow = ($is_allow) ? $is_allow : $is_deny;
            if ($post->save() && $request->hasFile("image")) {
                # code...
                $media = MediaController::uploadImage($request->file("image"), $post->id);
                if (MediaController::saveMedia($media, $post->id)) {
                    return new JsonResponse([
                        'status' => 200,
                        'message' => 'Posted',
                        'media' => $media
                    ]);
                } else {
                    return new JsonResponse([
                        'status' => 201,
                        'message' => 'Problem while saving in Media'
                    ]);
                }
            }
        } else {
            return new JsonResponse([
                'status' => 201,
                'message' => 'Slect image or Description to go further'
            ]);
        }
    }

    public function fetch_post(Request $request)
    {

        $post = Post::select()
            ->Join('media', 'post_id_fk', '=', 'post.id')
            // ->Join('profile','id','=','profile_id_fk')
            ->where('is_allow', true)
            ->orderByDesc('created_at')
            ->get();

        if (count($post) > 0) {
            return new JsonResponse([
                'status' => 200,
                'message' => 'Post fetch Successfully',
                '$data' => $post
            ]);
        } else {
            return new JsonResponse([
                'status' => 201,
                'message' => 'No post found'
            ]);
        }
    }
}
