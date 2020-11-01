<?php


namespace App\Repository;


use App\Models\History;
use App\Models\Product;

class ProductRepository
{
    private $model;

    /**
     * ProductRepository constructor.
     * @param  Product  $model
     */
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    /**
     * Get all products
     * @return Product[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->model::all();
    }

    public function findProduct(int $id)
    {
        return $this->model::find($id);
    }

    /**
     * Create Many products
     * @param  array  $products
     * @return Product[]|array
     */
    public function createProducts(array $products)
    {
        $createdProducts = [];
        foreach ($products as $index => $product) {
            $createdProducts[] = $this->model::create($product);
        }
        return $createdProducts;
    }

    /**
     * Update Products
     * @param  array  $product
     * @return mixed
     */
    public function updateProducts(array $product)
    {
        $updatedPproduct = $this->model::find($product['id']);
        $updatedPproduct->update($product);
        return $updatedPproduct;
    }

    /**
     * Delete Products
     * @param  array  $productsIds
     * @return bool
     */
    public function deleteProducts(array $productsIds)
    {
        $delHistory = History::query()
            ->whereIn('product_id', $productsIds)
            ->delete();
        $deleteProducts = $this->model::query()
            ->whereIn('id', $productsIds)
            ->delete();
        return $delHistory && $deleteProducts;
    }
}
