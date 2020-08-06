<?php

namespace Unit\App\Adapters;

use App\Adapters\CategoryAdapter;
use Core\Modules\MercadoLivre\Collections\CategoryCollection;
use Core\Modules\MercadoLivre\Entities\Category;
use Core\Modules\MercadoLivre\Entities\Request\CategoryRequest;
use Tests\TestCase;
use InvalidArgumentException;
use Illuminate\Support\Facades\Http;

/**
 * Class CategoryAdapterTest
 *
 * @package Unit\App\Adapters
 */
class CategoryAdapterTest extends TestCase
{
    public function testMainCategories()
    {
        Http::fake([
            'api.mercadolibre.com/sites/MLB/categories' => Http::response($this->getFakeMainCategoriesJson(), 200, ['Headers']),
        ]);

        $adapter = new CategoryAdapter();
        $categoryCollection = $adapter->getMainCategories();

        # expected:

        $expectedCategoryCollection = new CategoryCollection();
        $category1 = new Category();
        $category1->setId('MLB5672');
        $category1->setName('Acessórios para Veículos');
        $category2 = new Category();
        $category2->setId('MLB271599');
        $category2->setName('Agro');
        $expectedCategoryCollection->add($category1);
        $expectedCategoryCollection->add($category2);

        $this->assertEquals($categoryCollection, $expectedCategoryCollection);
    }

    public function testCategoriesById()
    {
        Http::fake([
            'api.mercadolibre.com/categories/MLB5672' => Http::response($this->getFakeCategoryById('MLB5672'), 200, ['Headers']),
        ]);

        $categoryRequest = new CategoryRequest();
        $categoryRequest->setCategoryId('MLB5672');

        $adapter = new CategoryAdapter();
        $category = $adapter->getCategoriesById($categoryRequest);

        # expected:

        $expectedCategory = new Category();
        $expectedCategory->setId('MLB5672');
        $expectedCategory->setName('Acessórios para Veículos');

        $this->assertEquals($category, $expectedCategory);
    }

    /**
     * @return array
     */
    private function getFakeMainCategoriesJson(): array
    {
        return [
            [
                "id" => "MLB5672",
                "name" => "Acessórios para Veículos"
            ],
            [
                "id" => "MLB271599",
                "name" => "Agro",
            ]
        ];
    }

    /**
     * @param string $meliCategoryId
     * @return array|mixed
     */
    private function getFakeCategoryById(string $meliCategoryId)
    {
        switch ($meliCategoryId) {
            case 'MLB5672':
                return [
                    'id' => 'MLB5672',
                    'name' => 'Acessórios para Veículos',
                ];
            default:
                throw new InvalidArgumentException('Invalid Meli category Id');
                break;
        }
    }
}