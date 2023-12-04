<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    use HasFactory;
    protected $table = "post_comments";
    protected $fillable = [
        'post_id_fk', 
        'profile_id_fk', 
        'comment_id_fk'
    ]; // Add other fields as needed

    public $timestamps = false; // Add this line to disable timestamps

}
