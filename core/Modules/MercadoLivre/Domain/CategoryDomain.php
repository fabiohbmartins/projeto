<?php

namespace Core\Modules\MercadoLivre\Domain;

use Core\Modules\MercadoLivre\Collections\CategoryCollection;
use Core\Modules\MercadoLivre\Entities\Category;
use Core\Modules\MercadoLivre\Entities\Request\CategoryRequest;
use Core\Modules\MercadoLivre\Gateways\CategoryGateway;

/**
 * Class CategoryDomain
 *
 * @package Core\Modules\MercadoLivre\Domain
 */
class CategoryDomain
{
    /**
     * @var CategoryGateway
     */
    private $categoryGateway;

    /**
     * CategoryDomain constructor.
     *
     * @param CategoryGateway $categoryGateway
     */
    public function __construct(CategoryGateway $categoryGateway)
    {
        $this->categoryGateway = $categoryGateway;
    }

    /**
     * @return CategoryCollection
     */
    public function getMainCategories(): CategoryCollection
    {
        return $this->categoryGateway->getMainCategories();
    }

    /**
     * @param CategoryRequest $categoryRequest
     * @return Category
     */
    public function getCategoryById(CategoryRequest $categoryRequest): Category
    {
        return $this->categoryGateway->getCategoriesById($categoryRequest);
    }
}