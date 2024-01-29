<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            //$post->is_reel = $request->is_reel; // one to one hierarchy (uncommented)
            if ($post->save() && $request->hasFile("image")) {
                # code...   
                $media = MediaController::uploadImage($request->file("image"), $post->id);
                if (MediaController::saveMedia($media, $post->id, $request->is_reel)) {
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

        // $post = Post::select()
        //     ->Join('media', 'post_id_fk', '=', 'post.id')
        //     ->Join('profile','profile.id','=','post.profile_id_fk')
        //     ->where([
        //         'is_allow' => true,
        //         'media.is_reel' => $request->is_reel
        //     ])
        //     ->orderByDesc('post.created_at')
        //     ->limit(4)
        //     ->get();

            $post = Post::select(
                'post.id',
                'media.post_id_fk',
                'post.profile_id_fk',
                'post.description',
                'post.created_at',
                'post.updated_at',
                'post.is_reel',
                'media.extention',
                'media.url',
                'profile.username',
                'profile.profile_img_url',
                'media.id as media_image_id',
                'post_reaction.reaction_type_id_fk'
            )
            ->join('media', 'post.id', '=', 'media.post_id_fk')
            ->join('profile', 'profile.id', '=', 'post.profile_id_fk')
            ->leftJoin('post_reaction', function ($join) {
                $join->on('post.id', '=', 'post_reaction.post_id_fk')
                    ->where('post_reaction.profile_id_fk', 2);
            })
            ->where('post.is_allow', true)
            ->where('post.privacy', 1)
            ->where('media.is_reel', $request->is_reel)
            ->orderBy('post.id', 'desc')
            ->limit(7)
            ->get();
// dd($post->toSql());
//         if($post->id){
//             $media = PostController::fetch_media($post->id);
//         }

        if (count($post) > 0) {
            return new JsonResponse([
                'status' => 200,
                'message' => 'Post fetch Successfully',
                '$data' => $post,
                // 'url' => $media
            ]);
        } else {
            return new JsonResponse([
                'status' => 201,
                'message' => 'No post found'
            ]);
        }
    }

    
}
