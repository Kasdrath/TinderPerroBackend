<?php

namespace App\Http\Controllers;

use App\Repositories\PerroRepository;
use Illuminate\Http\Request;
use App\Http\Requests\interaccionRequest;
use App\Http\Requests\perroRequest;

class PerroController extends Controller
{
    protected PerroRepository $perroRepo;
    public function __construct(PerroRepository $perroRepo)
    {
        $this->perroRepo = $perroRepo;
    }

    public function listarPerros()
    {
        return $this->perroRepo->listarPerros();
    }

    public function guardarPreferPerros(interaccionRequest $request)
    {
        return $this->perroRepo->guardarPreferPerros($request);
    }

    public function crearPerro(perroRequest $request)
    {
        return $this->perroRepo->crearPerro($request);
    }

    public function actualizarPerro(Request $request)
    {
        return $this->perroRepo->actualizarPerro($request);
    }

    public function eliminarPerro(Request $request)
    {
        return $this->perroRepo->eliminarPerro($request);
    }

    public function consultarPerroInteresado(Request $request)
    {
        return $this->perroRepo->consultarPerroInteresado($request);
    }

    //Funciones agregadas de tutorial CRUD:
    /*
    public function index()
    {
        $perros = Perro::latest()->paginate(5);

        return view('perro.index', compact('perros'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('perro.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_perro' => 'required',
        ]);

        Perro::create($request->all());

        return redirect()->route('perro.index')->with('success', 'Perro creado exitosamente');
    }

    public function show(Perro $perro)
    {
        return view('perro.show', compact('perros'));
    }

    public function edit(Perro $perro)
    {
        return view('perro.edit', compact('perros'));
    }

    public function update(Request $request, Perro $perro)
    {
        $request->validate([
            'id_perro' => 'required',
        ]);

        $perro->update($request->all());

        return redirect()->route('perro.index')->with('success', 'Perro actualizado exitosamente');
    }

    public function destroy(Perro $perro)
    {
        $perro->delete();

        return redirect()->route('perro.index')->with('success', 'Perro eliminado exitosamente');
    }*/
}
