<?php

namespace App\Http\Controllers\MercadoLivre;

use App\Adapters\CategoryAdapter;
use App\Http\Controllers\Controller;
use Core\Modules\MercadoLivre\Domain\CategoryDomain;
use Core\Modules\MercadoLivre\Entities\Request\CategoryRequest;
use Illuminate\Http\JsonResponse;

/**
 * Class CategoryController
 *
 * @package App\Http\Controllers\MercadoLivre
 */
class CategoryController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index()
    {
        $adapter = new CategoryAdapter();
        $domain = new CategoryDomain($adapter);

        $mainCategories = $domain->getMainCategories();

        return response()->json($mainCategories);
    }

    /**
     * @param string $categoryId
     * @return JsonResponse
     */
    public function show(string $categoryId)
    {
        $adapter = new CategoryAdapter();
        $domain = new CategoryDomain($adapter);

        $categoryRequest = new CategoryRequest();
        $categoryRequest->setCategoryId($categoryId);

        $category = $domain->getCategoryById($categoryRequest);

        return response()->json($category);
    }
}