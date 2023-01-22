@if($comment->deleteBool($post) == true)
    <form method="POST" action="{{ route('posts.uncomment', [$post, $comment]) }}" enctype="multipart/form-data">
        @csrf
        @method('DELETE')
        <button type="submit" class="botonfun" ><i class="fa-solid fa-trash-can"></i></button>
    </form>  
@else 
    <p class="noshow"></p>
@endif  