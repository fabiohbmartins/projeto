<?php

namespace Core\Modules\MercadoLivre\Collections;

use Core\Modules\MercadoLivre\Entities\Category;
use Countable;
use Iterator;
use JsonSerializable;

/**
 * Class CategoryCollection
 *
 * @package Core\Modules\MercadoLivre\Collections
 */
class CategoryCollection implements Iterator, Countable, JsonSerializable
{
    /**
     * @var array
     */
    private $container = [];

    /**
     * @var array
     */
    private $keys = [];

    /**
     * @var int
     */
    private $position = 0;

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->keys);
    }

    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return $this->container[$this->keys[$this->position]];
    }

    /**
     * @return mixed
     */
    public function key()
    {
        return $this->keys[$this->position];
    }

    public function next()
    {
        ++$this->position;
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return isset($this->keys[$this->position]);
    }

    /**
     * @param Category $category
     */
    public function add(Category $category)
    {
        $this->container[] = $category;
        $this->keys[] = $this->arrayKeyLast($this->container);
    }

    /**
     * @param mixed $offset
     * @return Category|null
     */
    public function get($offset): ?Category
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * @param array $array
     * @return array|null
     */
    private function arrayKeyLast(array $array)
    {
        if (empty($array)) {
            return null;
        }
        return array_keys($array)[count($array)-1];
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        $categoryCollection = [];
        foreach ($this->container as $item) {
            $category = [];
            $category['id'] = $item->getId();
            $category['name'] = $item->getName();
            if (! is_null($item->getChildrenCategories())) {
                $category['children_categories'] =  $item->getChildrenCategories();
            }
            $categoryCollection[] = $category;
        }

        return $categoryCollection;
    }
}