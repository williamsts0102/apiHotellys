<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Habitacion;
use App\Models\Reserva;
use Illuminate\Http\Request;

class ReservaController extends Controller
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
     * Verifica la disponibilidad de una habitación para reservas en un rango de fechas.
     *
     * @OA\Post(
     *     path="/api/verificar-disponibilidad",
     *     summary="Verificar disponibilidad de habitación",
     *     description="Verifica si una habitación está disponible para reservas en un rango de fechas especificado.",
     *     tags={"Reservas"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"tipoCategoria", "estiloHabitacion", "fechaInicio", "fechaFin"},
     *             @OA\Property(property="tipoCategoria", type="string", description="Tipo de categoría de la habitación."),
     *             @OA\Property(property="estiloHabitacion", type="string", description="Estilo de la habitación."),
     *             @OA\Property(property="fechaInicio", type="string", format="date", description="Fecha de inicio del rango de reserva (Formato: YYYY-MM-DD)."),
     *             @OA\Property(property="fechaFin", type="string", format="date", description="Fecha de fin del rango de reserva (Formato: YYYY-MM-DD)."),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="La habitación está disponible para reservas en el rango de fechas especificado.",
     *         @OA\JsonContent(
     *             @OA\Property(property="estado", type="string", example="Disponible", description="Estado de la habitación: 'Disponible'."),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="La categoría o la habitación no fueron encontradas.",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Categoría no encontrada", description="Mensaje de error detallado."),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=409,
     *         description="La habitación está ocupada en el rango de fechas especificado.",
     *         @OA\JsonContent(
     *             @OA\Property(property="estado", type="string", example="Ocupada", description="Estado de la habitación: 'Ocupada'."),
     *         ),
     *     ),
     * )
     */
    public function verificarDisponibilidad(Request $request)
    {
        $request->validate([
            'tipoCategoria' => 'required|string',
            'estiloHabitacion' => 'required|string',
            'fechaInicio' => 'required|date_format:Y-m-d',
            'fechaFin' => 'required|date_format:Y-m-d',
        ]);

        // Obtener el ID de la categoría basándonos en el tipo
        $categoria = Categoria::where('tipo', $request->tipoCategoria)->first();

        if (!$categoria) {
            return response()->json(['error' => 'Categoría no encontrada'], 404);
        }

        // Obtener la habitación basándonos en el estilo y el ID de la categoría
        $habitacion = Habitacion::where('estilo', $request->estiloHabitacion)
            ->where('tipo_h', $categoria->id)
            ->first();

        if (!$habitacion) {
            return response()->json(['error' => 'Habitación no encontrada'], 404);
        }

        // Verificar disponibilidad en el rango de fechas
        $ocupada = Reserva::where('id_habitacion', $habitacion->id_h)
            ->where(function ($query) use ($request) {
                $query->whereBetween('fecha_ingreso', [$request->fechaInicio, $request->fechaFin])
                    ->orWhereBetween('fecha_salida', [$request->fechaInicio, $request->fechaFin]);
            })
            ->exists();

        if ($ocupada) {
            return response()->json(['estado' => 'Ocupada']);
        } else {
            return response()->json(['estado' => 'Disponible']);
        }
    }

}
