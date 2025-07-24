<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="API de Filmes",
 *     version="1.0.0",
 *     description="Documentação da API para gerenciamento de filmes"
 * )
 * @OA\Schema(
 *     schema="Movie",
 *     type="object",
 *     title="Filme",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="O Poderoso Chefão"),
 *     @OA\Property(property="year", type="integer", example=1972),
 *     @OA\Property(property="director", type="string", example="Francis Ford Coppola")
 * )
 */
class MovieController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/movies",
     *     summary="Lista todos os filmes",
     *     tags={"Filmes"},
     *     @OA\Parameter(
     *         name="title",
     *         in="query",
     *         description="Título do filme",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="year",
     *         in="query",
     *         description="Ano de lançamento",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="director",
     *         in="query",
     *         description="Nome do diretor",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operação bem-sucedida",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="current_page", type="integer"),
     *             @OA\Property(property="data", type="array", items=@OA\Items(ref="#/components/schemas/Movie")),
     *             @OA\Property(property="first_page_url", type="string"),
     *             @OA\Property(property="from", type="integer"),
     *             @OA\Property(property="last_page", type="integer"),
     *             @OA\Property(property="last_page_url", type="string"),
     *             @OA\Property(property="links", type="array", items=@OA\Items(
     *                 type="object",
     *                 @OA\Property(property="url", type="string"),
     *                 @OA\Property(property="label", type="string"),
     *                 @OA\Property(property="active", type="boolean")
     *             )),
     *             @OA\Property(property="next_page_url", type="string"),
     *             @OA\Property(property="path", type="string"),
     *             @OA\Property(property="per_page", type="integer"),
     *             @OA\Property(property="prev_page_url", type="string"),
     *             @OA\Property(property="to", type="integer"),
     *             @OA\Property(property="total", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Requisição inválida"
     *     )
     * )
     */
    public function index(Request $request)
    {
        $query = Movie::query();

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        if ($request->filled('director')) {
            $query->where('director', 'like', '%' . $request->director . '%');
        }

        return response()->json($query->paginate(10));
    }

    /**
     * @OA\Get(
     *     path="/api/movies/{id}",
     *     summary="Exibe os detalhes de um filme",
     *     tags={"Filmes"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do filme",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalhes do filme",
     *         @OA\JsonContent(ref="#/components/schemas/Movie")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Filme não encontrado"
     *     )
     * )
     */
    public function show($id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json([
                'success' => false,
                'message' => 'Filme não encontrado.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $movie,
        ], 200);
    }
}
