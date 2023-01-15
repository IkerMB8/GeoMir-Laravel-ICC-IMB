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

    public function commentedBy()
    {
        $user = User::where('id',$this->user_id)->first();
        return $user->name;
    }

    public function deleteBool()
    {
        if (auth()->user()->id == $this->user_id){
            return true;
        }else{
            return false;
        }
    }
}
