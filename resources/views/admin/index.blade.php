@extends('adminlte::page')

@section('title', 'Dashboard')
{{-- @section('plugins.Sweetalert2', true) --}}
@section('css')

@stop
@section('content_header')
    <h1>Sistema de reservas </h1>
@stop

@section('content')
    <div class="row">
        <h3><b>Bienvenido:</b> {{ Auth::user()->email }} / <b>Rol:</b> {{ Auth::user()->roles->pluck('name')->first() }}
        </h3>
    </div>

    <div class="row">
        {{-- CONFIGURACION --}}
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3></h3>
                    <p>Configuracion</p>
                </div>
                <div class="icon">
                    <i class="bi bi-gear"></i>
                </div>
                <a href="#" class="small-box-footer">Mas info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        {{-- PROGRAMADOR --}}
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3></h3>
                    <p>Programador</p>
                </div>
                <div class="icon">
                    <i class="fas fa-laptop"></i>
                </div>
                <a href="#" class="small-box-footer">Mas info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        {{-- CLIENTES --}}
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3></h3>
                    <p>Clientes</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users mr-2"></i>
                </div>
                <a href="#" class="small-box-footer">Mas info <ibclass="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        {{-- CURSOS --}}
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3></h3>
                    <p>Cursos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-book"></i>
                </div>
                <a href="#" class="small-box-footer">Mas info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        {{-- PROFESORES --}}
        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3></h3>

                    <p>Profesores</p>
                </div>
                <div class="icon">
                    <i class="ion fas bi bi-person-lines-fill"></i>
                </div>
                <a href="#" class="small-box-footer">Mas info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        {{-- HORARIOS --}}
        <div class="col-lg-3 col-6">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3></h3>

                    <p>{{ __('actions.schedules') }}</p>
                </div>
                <div class="icon">
                    <i class="ion fas bi bi-calendar2-week"></i>
                </div>
                <a href="#" class="small-box-footer">Mas info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        {{-- RESERVAS --}}
        <div class="col-lg-3 col-6">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3></h3>

                    <p>Reservas</p>
                </div>
                <div class="icon">
                    <i class="ion fas bi bi-calendar2-week"></i>
                </div>
                <a href="" class="small-box-footer"> <i class="fas fa-calendar-alt"></i></a>
            </div>
        </div>

        {{-- VEHICULOS --}}
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3></h3>

                    <p>Vehiculos</p>
                </div>
                <div class="icon">
                    <i class="bi bi-car-front"></i>
                </div>
                <a href="#" class="small-box-footer">Mas info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        {{-- COMPLETADOS --}}
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3></h3>

                    <p>Cursos completados</p>
                </div>
                <div class="icon">
                    <i class="bi bi-check-circle"></i>
                </div>
                <a href="#" class="small-box-footer">Mas info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div> {{-- CALENDARIO --}}
    <div class="card card-primary card-outline card-tabs">
        <div class="card-header p-0 pt-1 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">

                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-three-profile-tab" data-toggle="pill"
                        href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile"
                        aria-selected="false">Calendario de reserva</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link " id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home"
                        role="tab" aria-controls="custom-tabs-three-home" aria-selected="false">Horario de
                        profesores</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-three-tabContent">
                <div class="tab-pane fade" id="custom-tabs-three-home" role="tabpanel"
                    aria-labelledby="custom-tabs-three-home-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="card-title">Calendario de atencion de profesores </h3>
                        </div>
                        <div class="col-md d-flex justify-content-end">
                            <label for="curso_id">Cursos </label><b class="text-danger">*</b>
                        </div>
                        <div class="col-md-4">
                            <select name="curso_id" id="profesor_select" class="form-control">
                                <option value="" selected disabled>Seleccione una opción</option>
                                <option value=""> </option>
                            </select>
                        </div>
                        <div class="col-md">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#claseModal">
                                Agendar
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                            <div id="curso_info"></div>
                        </div>

                    </div>
                </div>
                <div class="tab-pane fade active show" id="custom-tabs-three-profile" role="tabpanel"
                    aria-labelledby="custom-tabs-three-profile-tab">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#claseModal">
                                Agendar Clase
                            </button>

                            <a href="#" class="btn btn-success"> <i class="bi bi-calendar-check"></i>Ver las reservas </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="profesor_info"></div>
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @stop
