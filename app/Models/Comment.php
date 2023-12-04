<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = "comments";

    protected $fillable = [
        'description',
        'is_allow',
        'created_at',
        'updated_at',
        // Add other fields that you want to allow for mass assignment
    ];

    // public function postComments()
    // {
    //     return $this->hasMany(PostComment::class, 'comment_id_fk', 'id');
    // }
}
