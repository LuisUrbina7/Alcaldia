@extends('layouts.plantilla')
@section('titulo')

<title>Vista</title>
@endsection

@section('contenido')
<section>
    
    <div class="container">
        <div class="publicaciones-todos bg-light border">
            <h3 class="text-muted text-center pt-4 ">Ingreso los datos</h3>
            <div class="row p-md-4">
                <div class="col-md-3  p-md-1 border rounded">
                    <a href="{{route('publicar')}}">

                        <div class="blog-nuevo h-100 d-flex justify-content-center align-items-center position-relative">
                                <i class="las la-redo-alt position-absolute bg-light fs-1 p-4 rounded-circle "></i>
                        </div>
                    </a>
                </div>

                @foreach ($publicaciones as $publicacion )
                <div class="col-md-3 p-md-1 border rounded">
                    <a href="{{ route('actualizar',$publicacion->id)}}">
                        <div class="border d-flex justify-content-center align-items-center position-relative h-100">
                            <span class="position-absolute w-100 top-0 bg-dark p-2 text-center "> {{$publicacion->titulo}}</span>
                                <i class="lar la-times-circle position-absolute bg-light fs-1 p-4 rounded-circle"></i>
                            <img src="{{$publicacion->img}}" alt="1">
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</section>
@endsection