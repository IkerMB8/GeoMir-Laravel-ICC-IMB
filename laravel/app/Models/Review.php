<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'user_id',
        'place_id',
        'review',
        'valoracion',
    ];

    public function reviewAuthor()
    {
        $user = User::where('id',$this->user_id)->first();
        return $user->name;
    }

    public function deleteBoolReview()
    {
        if ($this->user_id == auth()->user()->id || auth()->user()->hasRole(['admin']) || $review->user_id == auth()->user()->id ){
            return true;
        }else{
            return false;
        }
    }
}
