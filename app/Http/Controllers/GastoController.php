<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Gasto;

class GastoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function list()
    {
        $gastos = Gasto::orderBy('fecha', 'desc')->get();
        return response()->json($gastos);
    }

    // 🔹 Obtener un gasto por ID
    public function index($id)
    {
        $gasto = Gasto::find($id);
        if (!$gasto) {
            return response()->json(['error' => 'Gasto no encontrado'], 404);
        }
        return response()->json($gasto);
    }

    // 🔹 Crear nuevo gasto
    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'monto' => 'required|numeric|min:0',
            'descripcion' => 'required|string|max:255',
        ]);

        $gasto = Gasto::create([
            'fecha' => $request->fecha,
            'monto' => $request->monto,
            'descripcion' => $request->descripcion,
        ]);

        return response()->json([
            'message' => 'Gasto agregado correctamente',
            'data' => $gasto
        ], 201);
    }

    // 🔹 Eliminar un gasto
    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:gastos,id',
        ]);

        $gasto = Gasto::find($request->id);
        $gasto->delete();

        return response()->json(['message' => 'Gasto eliminado correctamente']);
    }

    // 🔹 Editar (actualizar) un gasto
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:gastos,id',
            'fecha' => 'required|date',
            'monto' => 'required|numeric|min:0',
            'descripcion' => 'required|string|max:255',
        ]);

        $gasto = Gasto::find($request->id);
        $gasto->update($request->only('fecha', 'monto', 'descripcion'));

        return response()->json([
            'message' => 'Gasto actualizado correctamente',
            'data' => $gasto
        ]);
    }
}
