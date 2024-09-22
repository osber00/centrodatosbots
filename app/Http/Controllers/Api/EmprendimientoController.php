<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AsistenciaEmprendimiento;
use Illuminate\Http\Request;

class EmprendimientoController extends Controller
{
    public function registrarAsistencia(Request $request){
        
        $validacion = AsistenciaEmprendimiento::where('identificacion', $request->identificacion)->exists();

        if ($validacion) {
            return response()->json([
                'message'=> 'duplicado'
            ], 200);
        }

        $datos = $request->all();

        AsistenciaEmprendimiento::create([
            'nombre' => $request->nombre,
            'identificacion' => $request->identificacion,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'emprendimiento' => $request->emprendimiento
        ]);

        return response()->json([
            'message' => 'registrado',
            'data' => $datos
        ],200);
    }
}
