@extends('layouts.app')
@section('content')
    <div class="jumbotron text-center">
        <h1> Mascotas </h1>
        <p>Zaira Hernández Martínez</p>
    </div>


    <div class="container">
        @if (Session::has('mensaje'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ Session::get('mensaje') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif


        <a href="{{ url('mascotas/create') }}" class="btn btn-success"> Registrar nueva mascota </a>
        <br />
        <br />

        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Edad(meses)</th>
                    <th>Enfermedades</th>

                    <th>Acciones</th>
                </tr>
            </thead>


            <tbody>
                @foreach ($mascotas as $mascota)
                    <tr>
                        <td>{{ $mascota->id }} </td>
                        <td>
                            <img class="img-thumbnail img-fluid" src="{{ asset('storage') . '/' . $mascota->Foto }}"
                                width="100" alt="">
                        </td>
                        <td>{{ $mascota->Nombre }}</td>
                        <td>{{ $mascota->Tipo }}</td>
                        <td>{{ $mascota->Edad . ' ' . 'meses' }}</td>
                        <td>{{ $mascota->Enfermedades }}</td>

                        <td>

                            <a href="{{ url('/mascotas/' . $mascota->id . '/edit') }}" class="btn btn-warning">
                                Editar <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                </svg>
                            </a>
                            |
                            <form action="{{ url('/mascotas/' . $mascota->id) }}" class="d-inline" method="post">
                                @csrf
                                {{ method_field('DELETE') }}
                                <input class="btn btn-danger" type="submit" onclick="return confirm('¿Quieres borrar?')"
                                    value="Borrar">

                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>


        </table>
        {!! $mascotas->links() !!}
    </div>
@endsection
