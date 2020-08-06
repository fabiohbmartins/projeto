<?php

namespace Unit\Core\Modules\MercadoLivre\Collections;

use Core\Modules\MercadoLivre\Collections\CategoryCollection;
use Core\Modules\MercadoLivre\Entities\Category;
use stdClass;
use Tests\TestCase;
use TypeError;

/**
 * Class CategoryCollectionTest
 *
 * @package Unit\Core\Modules\MercadoLivre\Collections
 */
class CategoryCollectionTest extends TestCase
{
    public function testAddItem()
    {
        $category = new Category();
        $category->setName('Category name');
        $category->setId('ML123');

        $categoryCollection = new CategoryCollection();
        $categoryCollection->add($category);

        $this->assertEquals($category, $categoryCollection->get(0));
    }

    public function testAddItemError()
    {
        $this->expectException(TypeError::class);

        $category = new stdClass();
        $category->name = 'Category name';
        $category->id = 'ML123';

        $categoryCollection = new CategoryCollection();
        $categoryCollection->add($category);
    }

    public function testIterator()
    {
        $category0 = new Category();
        $category0->setName('Category name 1');
        $category0->setId('ML1231');

        $category1= new Category();
        $category1->setName('Category name 2');
        $category1->setId('ML1232');

        $categoryCollection = new CategoryCollection();
        $categoryCollection->add($category0);
        $categoryCollection->add($category1);

        foreach ($categoryCollection as $index => $category) {
            $obj = 'category'.$index;
            $this->assertEquals($$obj, $category);
        }
    }
}