<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\PostComment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function createComment(Request $request)
    {
        // Assuming you are passing post_id and profile_id in the request
        // dd($request);
        $data = $request->validate([
            'post_id' => 'required|exists:post,id',
            'profile_id' => 'required|exists:profile,id',
            'description' => 'required',
        ]);
        $comment = Comment::create([
            'description' => $data['description'],
            'is_allow' => 1, // You can adjust this based on your logic
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        PostComment::create([
            'post_id_fk' => $data['post_id'],
            'profile_id_fk' => $data['profile_id'],
            'comment_id_fk' => $comment->id,
        ]);

        return response()->json(['message' => 'Comment created successfully']);
    }

    public function getCommentsByPost($postId)
    {
        // $post = Comment::find($postId);
        $comments = Comment::select()
        ->join('post_comments', 'comment_id_fk', '=', 'comments.id')
        ->where([
            'post_id_fk' => $postId
        ])
        ->get();
// dd($postId);
        if (!$comments) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        // $comments = $post->postComments;


        return response()->json(['comments' => $comments]);
    }
}
