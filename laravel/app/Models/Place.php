<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'file_id',
        'latitude',
        'longitude',
        'category_id',
        'visibility_id',
        'author_id',
    ];
    public function user()
    {
    // foreign key does not follow conventions!!!
        return $this->belongsTo(User::class, 'author_id');
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }
    
    public function author()
    {
        return $this->belongsTo(User::class);
    } 

    public function favourites()
    {
        return $this->hasMany(Favourite::class);
    }
    
    public function favorited()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
    
    public function favoritedByUser(User $user)
    {
        $count = Favourite::where([
            ['user_id',  '=', auth()->user()->id],
            ['place_id', '=', $this->id],
        ])->count();

        return $count > 0;
    }

    public function favoritedByAuthUser()
    {
        $user = auth()->user();
        return $this->favoritedByUser($user);
    }

    public function reviews()
    {
        return Review::all()->where('place_id', $this->id);
    }

    public function valTtlReview(){
        $reviews = Review::all()->where('place_id', $this->id);
        $valoracion = 0;
        $cont = 0;
        foreach ($reviews as $review){
            $valoracion = $valoracion + $review->valoracion;
            $cont = $cont + 1;
        }
        if ($cont != 0){
            $valoracion = $valoracion/$cont;
        }else{
            $valoracion = 0;
        }
        return $valoracion;
    }

}
