@if($place->favoritedByAuthUser())
    <form method="POST" action="{{ route('places.unfavourite',$place) }}" enctype="multipart/form-data">
        @csrf
        @method('DELETE')
        <button type="submit" style="border: none;background-color: transparent;"><i class="fa-sharp fa-solid fa-star fa-2x fav"></i></button>
    </form>  
@else 
    <form method="POST" action="{{ route('places.favourite',$place) }}" enctype="multipart/form-data">
        @csrf
        <button type="submit" style="border: none;background-color: transparent;"><i class="fa-regular fa-2x fa-star"></i></button>
    </form>   
@endif  