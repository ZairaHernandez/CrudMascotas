<div class="jumbotron text-center">
    <h1>{{ $modo }} Mascota </h1>
    <p>Zaira Hernández Martínez</p>
</div>

@if (count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    <label for="Nombre"> Nombre </label>
    <input type="text" class="form-control" name="Nombre"
        value="{{ isset($mascotas->Nombre) ? $mascotas->Nombre : old('Nombre') }}" id="Nombre">
    <br>
</div>

<div class="form-group">
    <label for="Tipo"> Tipo Animal </label>
    <input type="text" class="form-control" name="Tipo"
        value="{{ isset($mascotas->Tipo) ? $mascotas->Tipo : old('Tipo') }}" id="Tipo">
    <br>
</div>

<div class="form-group">
    <label for="Edad"> Edad(meses) </label>
    <input type="integer" class="form-control" name="Edad"
        value="{{ isset($mascotas->Edad) ? $mascotas->Edad : old('Edad') }}" id="Edad">
    <br>
</div>

<div class="form-group">
    <label for="Enfermedades"> Enfermedades </label>
    <input type="text" class="form-control" name="Enfermedades"
        value="{{ isset($mascotas->Enfermedades) ? $mascotas->Enfermedades : old('Enfermedades') }}"
        id="Enfermedades">
    <br>
</div>

<div class="form-group">
    <label for="Foto"> Foto </label>
    @if (isset($mascotas->Foto))
        <img class="img-thumbnail img-fluid" src="{{ asset('storage') . '/' . $mascotas->Foto }}" width="100"
            alt="">
    @endif
    <input type="file" class="form-control" name="Foto" value="" id="Foto">
    <br>
</div>

<input class="btn btn-success" type="submit" value="{{ $modo }} datos">

<a class="btn btn-primary" href="{{ url('mascotas/') }}"> Regresar </a>
<br>
