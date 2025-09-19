@extends('adminlte::page')

@section('title', 'Dashboard')
{{-- @section('plugins.Sweetalert2', true) --}}
@section('css')

@stop
@section('content_header')
    <h1>Springfield News</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg mt-2">
                <div class="card-header headerRegister">
                    <h5 class="card-title" id="titleModal">Nueva Noticia</h5>
                    <div class="card-tools">
                        <button onclick="history.back()">Regresar</button>
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <x-message></x-message>{{-- JD  resources/views/components --}}
                    <div class="row">
                        <div class="col">
                            <form action="{{ route('admin.posts.update', $post) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <x-message></x-message>{{-- JD  resources/views/components --}}
                                <div class="row">
                                    <div class="col-lg-5 col-xlg-5 col-md-5">
                                        <label for="foto">
                                            <img class="card-img border" id="img_preview"
                                                src="{{ asset($post->image->url) }}" alt="Card image">
                                        </label>
                                        <input id="foto" name="foto" type="file" accept="image/*"
                                            style="display: none;" />
                                        @error('foto')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <small class="text-muted p-t-30 db">Social Profile</small>

                                        <br>
                                        <button class="btn btn-circle btn-secondary"><i
                                                class="fab fa-facebook"></i></button>
                                        <button class="btn btn-circle btn-secondary"><i class="fab fa-twitter"></i></button>
                                        <button class="btn btn-circle btn-secondary"><i class="fab fa-youtube"></i></button>
                                    </div>
                                    <div class="col-lg-7 col-xlg-7 col-md-7">
                                        <div class="form-group">
                                            <label class="control-label" for="title">Notice<span
                                                    class="required">*</span></label>
                                            <input class="form-control" value="{{ $post->title }}" id="title"
                                                name="title" type="text" placeholder="Titulo" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Descripción <span class="required">*</span></label>
                                            <textarea class="form-control" id="description" name="body" rows="2" placeholder="Descripción de la Noticia"
                                                required>{{ $post->body }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="category">Category<span class="required">*</span></label>
                                            <select name="category" class="form-control selectpicker" id="categoria"
                                                name="categoria">
                                                <option value="">Seleccione ...</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ $post->category_id == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button id="btnActionForm" class="btn btn-primary mt-3" type="submit">
                                                <i class="fa fa-fw fa-lg fa-check-circle"></i>
                                                <span id="btnText" title="Crear Noticia">Guardar</span></button>
                                        </div>
                                        @error('category')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        // Obtener referencia al input y a la imagen
        window.onload = function() {
            const $seleccionArchivos = document.querySelector("#foto"),
                $imagenPrevisualizacion = document.querySelector("#img_preview");

            // Escuchar cuando cambie
            $seleccionArchivos.addEventListener("change", () => {
                const archivos = $seleccionArchivos
                    .files; // Los archivos seleccionados, pueden ser muchos o uno

                if (!archivos || !archivos
                    .length) { // Si no hay archivos salimos de la función y quitamos la imagen
                    $imagenPrevisualizacion.src = "";
                    return;
                }

                const primerArchivo = archivos[
                    0]; // Ahora tomamos el primer archivo, el cual vamos a previsualizar
                const objectURL = URL.createObjectURL(
                    primerArchivo); // Lo convertimos a un objeto de tipo objectURL
                $imagenPrevisualizacion.src = objectURL; // Y a la fuente de la imagen le ponemos el objectURL
            });
        }
    </script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Estás seguro de que deseas eliminar esta publicacion?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id)
                        .submit(); // Si el usuario confirma, se envía el formulario.
                }
            });
        }
        new DataTable('#posts', {
            responsive: true,
            scrollX: true,
            autoWidth: false,
            dom: 'Bfrtip', // Añade el contenedor de botones
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis'], // Botones que aparecen en la imagen
            "language": {
                "decimal": "",
                "emptyTable": "No hay datos disponibles en la tabla",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ cursos",
                "infoEmpty": "Mostrando 0 a 0 de 0 cursos",
                "infoFiltered": "(filtrado de _MAX_ cursos totales)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ cursos",
                "loadingRecords": "Cargando...",
                "processing": "",
                "search": "Buscar:",
                "zeroRecords": "No se encontraron registros coincidentes",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "aria": {
                    "orderable": "Ordenar por esta columna",
                    "orderableReverse": "Invertir el orden de esta columna"
                }
            }

        });
    </script>
@stop
