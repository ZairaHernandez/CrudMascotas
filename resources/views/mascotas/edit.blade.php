@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ url('/mascotas/' . $mascotas->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            {{ method_field('PATCH') }}
            @include('mascotas.form', ['modo' => 'Editar']);
        </form>
    </div>
@endsection
