<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * Retorna uma lista de todas as categorias.
     *
     * Este método consulta a tabela de categorias e retorna todos os registros
     * em formato JSON.
     *
     * @return JsonResponse retorna uma resposta JSON contendo todas as categorias e um status: HTTP 200 (OK).
     */
    public function index(): JsonResponse
    {
        return response()->json(data: Category::all(), status: Response::HTTP_OK);
    }

    /**
     * Adiciona uma nova categoria ao sistema.
     *
     * Este método valida a requisição utilizando `CategoryRequest`, cria uma nova
     * categoria com os dados validados e retorna uma resposta JSON contendo os
     * detalhes da nova categoria e uma mensagem de sucesso.
     *
     * @param CategoryRequest $request Os dados da categoria a serem criados.
     *
     * @return JsonResponse Retorna uma resposta JSON contendo a nova categoria,
     *                      mensagem de sucesso e um status: HTTP 201 (CREATED).
     */
    public function store(CategoryRequest $request): JsonResponse
    {
        $category = Category::create($request->validated());

        return response()->json(data: [
            'category' => $category,
            'message' => 'Categoria criada com sucesso'
        ], status: Response::HTTP_CREATED);
    }


    /**
     * Exibe os detalhes de uma categoria específica.
     *
     * Este método retorna uma resposta JSON contendo os dados da categoria fornecida.
     *
     * @param Category $category A instância da categoria que será exibida.
     *
     * @return JsonResponse Retorna uma resposta JSON contendo os dados da categoria e umstatus: HTTP 200 (OK).
     */
    public function show(Category $category)
    {
        return response()->json($category);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
