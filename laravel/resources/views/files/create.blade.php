@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Crear File</div>
               <div class="card-body">
                <form method="post" action="{{ route('files.store') }}" enctype="multipart/form-data">
                        @csrf
                        <table class="table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <label for="upload">File:</label>
                                            <input type="file" class="form-control" name="upload"/>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        <button type="submit" class="btn btn-primary">Create</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <a href="/files" class="btn btn-secondary">Volver</a>
                    </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
