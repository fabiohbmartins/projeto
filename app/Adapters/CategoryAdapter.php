<?php

namespace App\Adapters;

use Core\Modules\MercadoLivre\Collections\CategoryCollection;
use Core\Modules\MercadoLivre\Entities\Category;
use Core\Modules\MercadoLivre\Entities\Request\CategoryRequest;
use Core\Modules\MercadoLivre\Gateways\CategoryGateway;
use Illuminate\Support\Facades\Http;
use stdClass;

/**
 * Class CategoryAdapter
 *
 * @package App\Adapters
 */
class CategoryAdapter implements CategoryGateway
{
    /**
     * @const string
     */
    public const BASE_URI = 'https://api.mercadolibre.com';

    /**
     * @const string
     */
    public const CATEGORIES_URI = '/categories/%s';

    /**
     * @const string
     */
    public const MAIN_CATEGORIES_URI = '/sites/MLB/categories';

    /**
     * @return CategoryCollection
     */
    public function getMainCategories(): CategoryCollection
    {
        $endpoint = self::BASE_URI . self::MAIN_CATEGORIES_URI;
        $response = Http::get($endpoint);
        $categoriesMeli = json_decode($response->getBody()->getContents());

        $categoryCollection = new CategoryCollection();
        foreach ($categoriesMeli as $categoryMeli) {
            $categoryCollection->add($this->makeCategory($categoryMeli));
        }

        return $categoryCollection;
    }

    /**
     * @param CategoryRequest $categoryRequest
     * @return Category
     */
    public function getCategoriesById(CategoryRequest $categoryRequest): Category
    {
        $endpoint = sprintf(self::BASE_URI . self::CATEGORIES_URI, $categoryRequest->getCategoryId());
        $response = Http::get($endpoint);
        $categoryMeli = json_decode($response->getBody()->getContents());

        return $this->makeCategory($categoryMeli);
    }

    /**
     * @param $categoryMeli
     * @return Category
     */
    private function makeCategory(stdClass $categoryMeli): Category
    {
        $category = new Category();
        $category->setName($categoryMeli->name);
        $category->setId($categoryMeli->id);

        if (isset($categoryMeli->children_categories) && count($categoryMeli->children_categories)) {
            $categoryCollection = new CategoryCollection();
            foreach ($categoryMeli->children_categories as $childrenCategory) {
                $subCategory = new Category();
                $subCategory->setId($childrenCategory->id);
                $subCategory->setName($childrenCategory->name);
                $categoryCollection->add($subCategory);
            }
            $category->setChildrenCategories($categoryCollection);
        }

        return $category;
    }
}