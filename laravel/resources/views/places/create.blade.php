@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Crear Place</div>
               <div class="card-body">
                    <form method="post" action="{{ route('places.store') }}" enctype="multipart/form-data">
                        @csrf
                        <table class="table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <label for="pname">Nom</label>
                                            <input type="text" id="pname" name="pname" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="pdescription">Descripció</label>
                                            <input type="text" id="pdescription" name="pdescription" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="upload">File</label>
                                            <input type="file" id="upload" name="upload" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="platitude">Latitude</label>
                                            <input type="text" id="platitude" name="platitude" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="plongitude">Longitude</label>
                                            <input type="text" id="plongitude" name="plongitude" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="pcatid">Category</label>
                                            <input type="text" id="pcatid" name="pcatid" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="pvisid">Visibility</label>
                                            <input type="text" id="pvisid" name="pvisid" required>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        <button type="submit" class="btn btn-primary">Create</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <a href="/places" class="btn btn-secondary">Volver</a>
                    </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
