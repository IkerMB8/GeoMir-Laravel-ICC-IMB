
<form style="display:flex; align-items:center;justify-content:space-between;width:100%;" method="POST" action="{{ route('places.review' , $place) }}" enctype="multipart/form-data">
    @csrf
    <div style="display: flex;flex-direction: column;margin-right: 23px;width: 100%;">
        <input id="preview" name="preview" style="border:0; float:left;" type="textarea" maxlength="140" placeholder="Escriba aquí su review"/>                                                        
        <p class="clasificacion">
            <input id="radio1{{$place->id}}" type="radio" name="estrellas" value="5">
            <label for="radio1{{$place->id}}">★</label>
            <input id="radio2{{$place->id}}" type="radio" name="estrellas" value="4">
            <label for="radio2{{$place->id}}">★</label>
            <input id="radio3{{$place->id}}" type="radio" name="estrellas" value="3">
            <label for="radio3{{$place->id}}">★</label>
            <input id="radio4{{$place->id}}" type="radio" name="estrellas" value="2">
            <label for="radio4{{$place->id}}">★</label>
            <input id="radio5{{$place->id}}" type="radio" name="estrellas" value="1">
            <label for="radio5{{$place->id}}">★</label>
        </p>
    </div>
    <button type="submit" class="botonpub" style="height:46px;padding: 10px; background-color: #7000ff; color:white; border-radius:15px;">Publicar</button>
</form>