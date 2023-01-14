<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'user_id',
        'post_id',
        'comment',
    ];

    public function commentedBy(Comment $comment)
    {
        $user = User::where('id',$comment->user_id)->first();
        return $user->name;
    }
}
