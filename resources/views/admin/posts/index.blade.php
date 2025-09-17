@extends('adminlte::page')

@section('title', 'Perfil')

@section('content_header')

@stop

@section('content')

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Creacion de Post</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Usuario Perfil</li>
                    </ol>
                </div>
            </div>
            <x-message></x-message>

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <form id="form-post" action="{{ route('admin.posts.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col mb-2">
                                        <input type="text" name="title" class="form-control" placeholder="title">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="text" name="description" class="form-control" placeholder="description">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <button type="submit" class="btn btn-success">Enviar
                                            <i class="bi bi-check-circle"></i>
                                        </button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
@stop
@section('css')
    {{-- Estilos adicionales si necesitas --}}
@stop
@section('js')

@stop
