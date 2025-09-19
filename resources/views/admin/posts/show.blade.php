@extends('adminlte::page')

@section('title', $post->title)

@section('content_header')
@stop

@section('content')
    <div class="row">
        <div class="col">
            <div class="card shadow mt-2">
                <div class="card-header">
                    <h1>{{ $post->title }}</h1>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="post">
                            <div class="user-block">
                                {{-- Imagen del autor --}}
                                <img class="img-circle img-bordered-sm"
                                    src="{{ asset('storage/' . $post->user->profile_photo_path) ?? asset('dist/img/default-user.png') }}"
                                    alt="{{ $post->user->name }}">


                                <span class="username">
                                    <a href="#">{{ $post->user->name }}</a>
                                    <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                </span>
                                <span class="description">
                                    Publicado {{ $post->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <!-- /.user-block -->

                            {{-- Si el post tiene imágenes --}}
                            {{-- @if ($post->images && $post->images->count() > 0) --}}
                                <div class="row mb-3">
                                    {{-- @foreach ($post->images->take(2) as $image) --}}
                                        <div class="col-sm-6">
                                            <img class="img-fluid mb-3 rounded" src="{{ asset($post->image->url) }}" alt="{{ $post->title }}">
                                        </div>
                                    {{-- @endforeach --}}
                                </div>
                            {{-- @endif --}} 
                            {{-- Contenido del post --}}
                            <p>{{ $post->body }}</p>

                            {{-- Acciones --}}
                            <p>
                                <a href="#" class="link-black text-sm mr-2">
                                    <i class="fas fa-share mr-1"></i> Compartir
                                </a>
                                <a href="#" class="link-black text-sm">
                                    <i class="far fa-thumbs-up mr-1"></i> Me gusta
                                </a>
                                <span class="float-right">
                                    <a href="#" class="link-black text-sm">
                                        <i class="far fa-comments mr-1"></i> Comentarios (
                                        {{-- {{ $post->comments->count() ?? 0 }} --}}
                                        )
                                    </a>
                                </span>
                            </p>

                            {{-- Caja de comentarios --}}
                            <input class="form-control form-control-sm" type="text" placeholder="Escribe un comentario">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
