<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *   title="API de Hotellys",
 *   version="1.0.0",
 *   description="API de Hotellys",
 * )
 *
 * @OA\Server(
 *     url="https://apihotellys.wendyhuaman.com",
 *     description="Dominio base de la API"
 * )
 */
class CategoriaController extends Controller
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
     *     path="/api/categorias",
     *     summary="Obtiene la lista de categorías",
     *     tags={"Categorías"},
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="tipo", type="string", description="Tipo de la categoría"),
     *                 @OA\Property(property="descripcion", type="string", description="Descripción de la categoría"),
     *             )
     *         )
     *     )
     * )
     */
    public function listarCategorias(): JsonResponse
    {
        // Obtener todas las categorías
        $categorias = Categoria::all();

        // Preparar un array con solo el tipo y la descripción de cada categoría
        $categoriasReducidas = $categorias->map(function ($categoria) {
            return [
                'tipo' => $categoria->tipo,
                'descripcion' => $categoria->descripcion,
            ];
        });

        // Devolver la colección reducida como JSON
        return response()->json($categoriasReducidas);
    }
}
