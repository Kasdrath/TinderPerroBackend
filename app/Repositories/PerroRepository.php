<?php

namespace App\Repositories;

use Illuminate\Http\Response;
use App\Models\Perro;
use App\Models\Interaccion;
use Illuminate\Support\Facades\Log;
use Exception;

use function PHPUnit\Framework\isEmpty;

class PerroRepository
{


    /*Parametros en Postman
    1.-nombreperro
    2.-urlfoto
    3.-descripcion
    */
    public function crearPerro($request)
    {
        $perros = Perro::create([
            "nombre_perro" => $request->nombreperro,
            "url_foto" => $request->urlfoto,
            "descripcion" => $request->descripcion,
        ]);
        return response()->json(["perros" => $perros], Response::HTTP_OK);
    }


    /*Parametros en Postman
    Ninguno
    */
    public function listarPerros()
    {
        $perros = Perro::all();
        return response()->json(["perros" => $perros], Response::HTTP_OK);
    }


    /*Parametros en Postman
    1.-idperrointeresado
    2.-idperrocandidato
    3.-preferencia
    */
    public function guardarPreferPerros($request)
    {
        try {
            $interaccionvacio = Interaccion::first();
            if (is_null($interaccionvacio)) {
                if ($request->idperrointeresado == $request->idperrocandidato) {
                    echo "\nLos ID no pueden ser iguales!\n";
                    throw new Exception("PARA LOCO !!!");
                }
                $aux = new Interaccion();
                $aux->preferencia = $request->preferencia;
                $aux->id_perro_interesado = $request->idperrointeresado;
                $aux->id_perro_candidato = $request->idperrocandidato;
                $aux->save();
                return response()->json(["interaccions" => $aux], Response::HTTP_OK);
            } else {
                if ($request->idperrointeresado == $request->idperrocandidato) {
                    echo "\nLos ID no pueden ser iguales!\n";
                    throw new Exception("PARA LOCO !!!");
                }
                $interaccion = Interaccion::all();
                foreach ($interaccion as $aux) {
                    if ($request->idperrointeresado == $aux->id_perro_interesado && $request->idperrocandidato == $aux->id_perro_candidato) {
                        echo "\nYa existe en la tabla!\n";
                        throw new Exception("PARA LOCO !!!");
                    } else {
                        if ($request->idperrointeresado == $request->idperrocandidato) {
                            echo "\nLos ID no pueden ser iguales!\n";
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
            }
        } catch (Exception $e) {
            return response()->json(["error" => $e], Response::HTTP_BAD_REQUEST);
        }
    }


    /*Parametros en Postman
    1.-idperrointeresado
    */
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
                } else {
                    throw new Exception("PARA LOCO !!!");
                }
            }
        } catch (Exception $e) {
            return response()->json(["error" => $e], Response::HTTP_BAD_REQUEST);
        }
    }

    /*Parametros en Postman
    1.-idperro
    2.-nombreperro
    3.-urlfoto
    4.-descripcion
    */
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


    /*Parametros en Postman
    1.-id
    */
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
