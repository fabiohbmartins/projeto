<?php

namespace Core\Modules\MercadoLivre\Entities;

use Core\Modules\MercadoLivre\Collections\CategoryCollection;
use JsonSerializable;

/**
 * Class Category
 *
 * @package Core\Modules\MercadoLivre\Entities
 */
class Category implements JsonSerializable
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var null|array
     */
    private $children_categories;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return array|null
     */
    public function getChildrenCategories(): ?CategoryCollection
    {
        return $this->children_categories;
    }

    /**
     * @param CategoryCollection|null $children_categories
     */
    public function setChildrenCategories(?CategoryCollection $children_categories): void
    {
        $this->children_categories = $children_categories;
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'children_categories' => $this->getChildrenCategories(),
        ];
    }
}