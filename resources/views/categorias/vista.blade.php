@extends('layouts.plantilla')
@section('titulo')

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Categoria</title>
@endsection

@section('contenido')
<section>

    <div class="container">
        <div class="categorias-todos bg-light border">
            <div class="row p-md-4 justify-content-center">
                @if (session('msg'))
                <div class="alert alert-primary" role="alert">
                    {{session('msg')}}
                </div>
                @endif
                <h4 class="text-muted text-center"> Categorias <a href="" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal"> + Agregar</a></h4>
                <div class="col-md-10 ">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Editar</th>
                                <th scope="col">Borrar</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($categorias as $categoria )
                            <tr>
                                <th scope="row">1</th>
                                <td>{{$categoria->nombre}}</td>
                                <td><button href="#" value="{{route('categoriaActualizar',$categoria->id)}}" class="btn btn-primary bottom"></button></td>
                                <td><a href="#" class="btn btn-danger"></a></td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="{{route('agregar.actualizar',5)}}" method="post" id="formulario-actualizar">
                        <div class="row border mb-3">
                            <div class="col-md-12 mb-3">
                                @csrf
                                <label for="" class="form-label">Actualizar</label>
                                <input type="hidden" id="id" name="id">
                                <input type="text" name="nombre" class="form-control" id="nombre">
                            </div>
                            <div class="col-md-12 mb-3 text-end">
                                <a type="submit" class="btn btn-warning" id="btn-actualizar">Actualzar</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="" class="form-label">Categoria</label>
                            <input type="text" name="nombre" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
    $(document).on('click', '.bottom', function() {
        var ruta = $(this).val();

        $('#id').val('');
        $('#nombre').val('');
        $.ajax({
            type: 'GET',
            url: ruta,
            dataType: 'json',
            success: function(response) {

                $('#id').val(response['id']);
                $('#nombre').val(response['nombre']);

            },
            error: function(response) {
                console.log('errorr ago mal');
            }
        });
    });

    $('#btn-actualizar').click(function() {
        var rutaActualizar = '{{route("agregar.actualizar",0)}}';
        var datos = $('#formulario-actualizar').serialize(),
            id = $('#id').val();
        rutaActualizar = rutaActualizar.replace('0', id);
        console.log(datos);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: rutaActualizar,
            data: datos,
            dataType: 'json',
            success: function(response) {
                console.log(response);
            },
            error: function(response) {
                console.log(response);
            }
        });
    });
</script>

@endsection