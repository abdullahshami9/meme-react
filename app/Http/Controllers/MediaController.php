<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{

    public static function uploadImage($image)
    {
        $media = new Media();
        
        $media->type = 'image'; // or other appropriate type
        $media->size = $image->getSize();
        $media->url = $image->store('media'); // You can adjust the storage path

        return $media;
    }

    public static function saveMedia($media, $post_id)
    {
        $media->post_id_fk = $post_id;
        $media->save();
    }

    public function savePostWithMedia(Request $request, $post_id)
    {
        

        if ($request->hasFile("image")) {
            $images = $request->file("image");

            foreach ($images as $image) {
                $media = $this->uploadImage($image);
                $this->saveMedia($media, $post_id);
            }
        }

        // Redirect or return a response as needed
        // Example: return redirect()->route('posts.index');
    }

    public static function create_media(Request $request, $post_id)
    {
        $mediaRecords = [];

        if ($request->hasFile("image")) {
            $images = $request->file("image");

            foreach ($images as $image) {
                $media = new Media();

                // Set attributes for the media record
                $media->type = 'image'; // or other appropriate type
                $media->size = $image->getSize();
                $media->url = $image->store('media'); // You can adjust the storage path

                // Associate the media record with the post
                $media->post_id_fk = $post_id;

                $mediaRecords[] = $media;
            }

            // Save all media records in one go
            if(Media::insert($mediaRecords)){
                return response()->json([
                    'status' => 200,
                    'message' => 'Media for post created successfully',
                    'data' => $mediaRecords
                ]);
            }
        }

        // Redirect or return a response as needed
    }
}




