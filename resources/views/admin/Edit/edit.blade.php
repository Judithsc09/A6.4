@extends('layouts.admin')
@section('title', $viewData["title"])
@section('content')


<div class="card mb-4">
  <div class="card-header">
   Editar producto
  </div>
  <div class="card-body">

    <form method="post" action="{{route ('admin.product.update')}}" enctype="multipart/form-data" >
      @method('PUT')
      @csrf
      <div class="row">
        <div class="col">
          <input type="hidden" name="id" value="{{$viewData['product']['id']}}">
          <div class="mb-3 row">
            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Nombre:</label>
            <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="name" value="{{$viewData['product']['nombre']}}"type="text" class="form-control">
            </div>
          </div>
        </div>
        <div class="col">
          <div class="mb-3 row">
            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Precio:</label>
          
            <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="price" value="{{$viewData['product']['precio']}}" type="number" class="form-control">
            </div>
          </div>
        </div>
      </div>
      <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">imagen:</label>
     <div class="col-lg-10 col-md-6 col-sm-12">
        <img src="{{asset('/storage/'.$viewData['product']['imagen'])}}">
      <input type="file" name="image">
        </div>
      <div class="mb-3">
        <label class="form-label">Descripción</label>
        <textarea class="form-control" name="description" rows="3" >{{$viewData['product']['descripcion']}}</textarea>
 
      </div>
   
     
      <br>
      <button type="submit" class="btn btn-primary">Aceptar</button>
    </form>
  </div>
</div>
@endsection