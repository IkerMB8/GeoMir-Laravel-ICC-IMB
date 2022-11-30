@if($post->likedByAuthUser())
    <form method="POST" action="{{ route('posts.unlike',$post) }}" enctype="multipart/form-data">
        @csrf
        @method('DELETE')
        <button type="submit" class="botonfun" ><i class="fa-sharp fa-solid fa-heart fa-2x like"></i></button>
    </form>  
@else 
    <form method="POST" action="{{ route('posts.like',$post) }}" enctype="multipart/form-data">
        @csrf
        <button type="submit" class="botonfun" ><i class="fa-regular fa-2x heart fa-heart"></i></button>
    </form>   
@endif 