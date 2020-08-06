<?php

namespace Core\Modules\MercadoLivre\Gateways;

use Core\Modules\MercadoLivre\Collections\CategoryCollection;
use Core\Modules\MercadoLivre\Entities\Category;
use Core\Modules\MercadoLivre\Entities\Request\CategoryRequest;

/**
 * Interface CategoryGateway
 *
 * @package Core\Modules\MercadoLivre\Gateways
 */
interface CategoryGateway
{
    /**
     * @return CategoryCollection
     */
    public function getMainCategories(): CategoryCollection;

    /**
     * @param CategoryRequest $categoryRequest
     * @return Category
     */
    public function getCategoriesById(CategoryRequest $categoryRequest): Category;
}