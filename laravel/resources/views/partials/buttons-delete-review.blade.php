@if($review->deleteBoolReview() == true)
    <form method="POST" action="{{ route('places.unreview', $place) }}" enctype="multipart/form-data">
        @csrf
        @method('DELETE')
        <input type="hidden" name="id" value="{{ $review->id }}"/>
        <button type="submit" class="botonfun" ><i class="fa-solid fa-trash-can"></i></button>
    </form>  
@else 
    <p class="noshow"></p>
@endif  