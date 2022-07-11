<?php

namespace App\Http\Controllers;

use App\Models\Mascotas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MascotasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['mascotas'] = Mascotas::paginate(3);
        return view('mascotas.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('mascotas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $campos = [
            'Nombre' => 'required|string|max:100',
            'Tipo' => 'required|string|max:50',
            'Edad' => 'required|integer|max:100',
            'Enfermedades' => 'required|string|max:150',
            'Foto' => 'required|max:10000|mimes:jpeg,png,jpg',
        ];
        $mensaje = [
            'required' => 'El :attribute es requerido',
            'Foto.required' => 'La foto es requerida',
            'Edad.required' => 'La edad es requerida',
            'Enfermedades.required' => 'Las enfermedades son requeridas',
        ];

        $this->validate($request, $campos, $mensaje);

        //$datosMascotas = request()->all();
        $datosMascotas = request()->except('_token');

        if ($request->hasFile('Foto')) {
            $datosMascotas['Foto'] = $request->file('Foto')->store('uploads', 'public');
        }

        Mascotas::insert($datosMascotas);
        // return response()->json($datosMascotas);
        return redirect('mascotas')->with('mensaje', 'Mascota agregada con éxito');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mascotas  $mascotas
     * @return \Illuminate\Http\Response
     */
    public function show(Mascotas $mascotas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mascotas  $mascotas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $mascotas = Mascotas::findOrFail($id);

        return view('mascotas.edit', compact('mascotas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mascotas  $mascotas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campos = [
            'Nombre' => 'required|string|max:100',
            'Tipo' => 'required|string|max:50',
            'Edad' => 'required|integer|max:100',
            'Enfermedades' => 'required|string|max:150',

        ];
        $mensaje = [
            'required' => 'El :attribute es requerido',
            'Edad.required' => 'La edad es requerida',
            'Enfermedades.required' => 'Las enfermedades son requeridas',
        ];

        if ($request->hasFile('Foto')) {
            $campos = ['Foto' => 'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje = ['Foto.required' => 'La foto es requerida'];
        }

        $this->validate($request, $campos, $mensaje);

        //
        $datosMascotas = request()->except(['_token', '_method']);
        if ($request->hasFile('Foto')) {
            $mascotas = Mascotas::findOrFail($id);
            Storage::delete(['public/' . $mascotas->Foto]);
            $datosMascotas['Foto'] = $request->file('Foto')->store('uploads', 'public');
        }

        Mascotas::where('id', '=', $id)->update($datosMascotas);
        $mascotas = Mascotas::findOrFail($id);
        // return view('mascotas.edit', compact('mascotas') );
        return redirect('mascotas')->with('mensaje', 'Mascota editada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mascotas  $mascotas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $mascotas = Mascotas::findOrFail($id);
        if (Storage::delete('public/' . $mascotas->Foto)) {
            Mascotas::destroy($id);
        }

        return redirect('mascotas')->with('mensaje', 'Mascota borrada');
    }
}
