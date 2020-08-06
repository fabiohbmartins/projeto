<?php

namespace Core\Modules\MercadoLivre\Entities\Request;

/**
 * Class CategoryRequest
 *
 * @package Core\Modules\MercadoLivre\Entities\Request
 */
class CategoryRequest
{
    /**
     * @var string
     */
    private $categoryId;

    /**
     * @return mixed
     */
    public function getCategoryId(): string
    {
        return $this->categoryId;
    }

    /**
     * @param mixed $categoryId
     */
    public function setCategoryId(string $categoryId): void
    {
        $this->categoryId = $categoryId;
    }
}