<?php


namespace App\Services;


use App\Repository\ProductRepository;

class ProductService
{
    private $repository;
    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get All products
     * @return \App\Models\Product[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function findProduct(int $id)
    {
        return $this->repository->findProduct($id);
    }

    /**
     * Create products
     * @param  array  $products
     * @return \App\Models\Product[]|array
     */
    public function createProducts(array $products)
    {
        return $this->repository->createProducts($products);
    }

    /**
     * Updated Products
     * @param  array  $products
     * @return array
     */
    public function updateProducts(array $products)
    {
        $updatedProducts = [];
        foreach ($products as $index => $product) {
            // cant update balance directly
            if (isset($product['qtd'])) unset($product['qtd']);
            $updatedProducts[] = $this->repository->updateProducts($product);
        }
        return $updatedProducts;
    }

    /**
     * Delete products
     * @param  array  $productsIds
     * @return bool
     */
    public function deleteProducts(array $productsIds)
    {
        return $this->repository->deleteProducts($productsIds);
    }
}
