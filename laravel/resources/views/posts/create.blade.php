@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Crear Post</div>
               <div class="card-body">
                    <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf
                        <table class="table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <label for="pname">Body</label>
                                            <input type="text" id="pname" name="pname">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="pdescription">File</label>
                                            <input type="text" id="pdescription" name="pdescription">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="pfileid">Latitude</label>
                                            <input type="text" id="pfileid" name="pfileid">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="platitude">Longitude</label>
                                            <input type="text" id="platitude" name="platitude">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="plongitude">Visibility</label>
                                            <input type="text" id="plongitude" name="plongitude">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="pcatid">Author</label>
                                            <input type="text" id="pcatid" name="pcatid">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        <button type="submit" class="btn btn-primary">Create</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection