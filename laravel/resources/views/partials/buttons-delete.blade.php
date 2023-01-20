@if($comment->deleteBool() == true)
    <form method="POST" action="{{ route('posts.uncomment', $post) }}" enctype="multipart/form-data">
        @csrf
        @method('DELETE')
        <input type="hidden" name="comment_id" value="{{$comment->id}}"/>
        <button type="submit" class="botonfun" ><i class="fa-solid fa-trash-can"></i></button>
    </form>  
@else 
    <p class="noshow"></p>
@endif  