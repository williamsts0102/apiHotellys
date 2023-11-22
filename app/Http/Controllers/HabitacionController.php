<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Habitacion;
use Illuminate\Http\Request;


class HabitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @OA\Get(
     *     path="/api/habitaciones/{tipo}",
     *     summary="Obtiene las habitaciones por tipo",
     *     operationId="obtenerHabitacionesPorTipo",
     *     tags={"Habitaciones"},
     *     @OA\Parameter(
     *         name="tipo",
     *         in="path",
     *         required=true,
     *         description="Tipo de la categoría",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Operación exitosa",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="habitaciones", type="array", @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="estilo", type="string", description="Estilo de la habitación")
     *             ))
     *         )
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Categoría no encontrada",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", description="Mensaje de error")
     *         )
     *     )
     * )
     */
    public function obtenerHabitacionesPorTipo($tipo)
    {
        // Obtener el ID de la categoría basándonos en el tipo
        $categoria = Categoria::where('tipo', $tipo)->first();

        if (!$categoria) {
            // Manejar el caso en que no se encuentre la categoría
            return response()->json(['error' => 'Categoría no encontrada'], 404);
        }

        // Obtener las habitaciones basándonos en el ID de la categoría
        $habitaciones = Habitacion::where('tipo_h', $categoria->id)->get(['estilo']);

        return response()->json(['habitaciones' => $habitaciones], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
