<?php

namespace App\Repositories;

use Illuminate\Http\Response;
use App\Models\Perro;
use App\Models\Interaccion;
use Illuminate\Support\Facades\Log;
use Exception;

class PerroRepository
{

    public function crearPerro($request)
    {
        $perros = Perro::create([
            "nombre_perro" => $request->nombreperro,
            "url_foto" => $request->urlfoto,
            "descripcion" => $request->descripcion,
        ]);
        return response()->json(["perros" => $perros], Response::HTTP_OK);
    }

    public function listarPerros()
    {
        $perros = Perro::all();
        return response()->json(["perros" => $perros], Response::HTTP_OK);
    }

    public function guardarPreferPerros($request)
    {
        try {
            $interaccion = Interaccion::all();
            foreach ($interaccion as $aux) {
                if ($request->idperrointeresado == $aux->id_perro_interesado && $request->idperrocandidato == $aux->id_perro_candidato) {
                    throw new Exception("PARA LOCO !!!");
                } else {
                    if ($request->idperrointeresado == $request->idperrocandidato) {
                        throw new Exception("PARA LOCO !!!");
                    }
                    $aux = new Interaccion();
                    $aux->preferencia = $request->preferencia;
                    $aux->id_perro_interesado = $request->idperrointeresado;
                    $aux->id_perro_candidato = $request->idperrocandidato;
                    $aux->save();
                    return response()->json(["interaccions" => $aux], Response::HTTP_OK);
                }
            }
        } catch (Exception $e) {
            return response()->json(["error" => $e], Response::HTTP_BAD_REQUEST);
        }
    }

    public function consultarPerroInteresado($request)
    {
        try {
            $interaccion = Interaccion::all();
            foreach ($interaccion as $aux) {
                if ($aux->id_perro_interesado == $request->idperrointeresado) {
                    //return response()->json(["Perro interesado: " => $aux->id_perro_candidato, "Preferencia: " => $aux->preferencia], Response::HTTP_OK);
                    echo "\nID Perro candidato:\n";
                    echo $aux['id_perro_candidato'];
                    echo "\nPreferencias:\n";
                    echo $aux['preferencia'];
                }
            }
        } catch (Exception $e) {
            return response()->json(["error" => $e], Response::HTTP_BAD_REQUEST);
        }
    }

    public function actualizarPerro($request)
    {
        try {
            $perros = Perro::findorFail($request->idperro);
            isset($request->nombreperro) && $perros->nombre_perro = $request->nombreperro;
            isset($request->urlfoto) && $perros->url_foto = $request->urlfoto;
            isset($request->descripcion) && $perros->descripcion = $request->descripcion;

            $perros->save();

            $perros = Perro::where('id', $request->idperro)
                ->update([
                    'nombre_perro' => $request->nombreperro,
                    'url_foto' => $request->urlfoto,
                    'descripcion' => $request->descripcion
                ]);

            //return response()->json(["perros" => $perros], Response::HTTP_OK);
            echo "\ncambiado!\n";
        } catch (Exception $e) {
            Log::info([
                "error" => $e,
                "mensaje" => $e->getMessage(),
                "linea" => $e->getLine(),
                "archivo" => $e->getFile(),
            ]);
            return response()->json(["error" => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function eliminarPerro($request)
    {
        try {
            $perro = Perro::find($request->id);
            if (!$perro) {
                throw new Exception("PARA LOCO !!!");
            }
            $perro->delete();

            return response()->json(["eliminados" => "chao"], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(["error" => $e], Response::HTTP_BAD_REQUEST);
        }
    }
}
