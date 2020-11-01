<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Services\ProductService;

class ProductController extends Controller
{
    private $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function getAll(ProductRequest $request)
    {
        return $this->productService->getAll();
    }

    public function findProduct(int $id)
    {
        $product = $this->productService->findProduct($id);
        return $product ? response($product, 200) : response(null,204);
    }

    public function createProducts(ProductRequest $request)
    {
        return $this->productService->createProducts($request->json()->all());
    }

    public function updateProducts(ProductRequest $request)
    {
        return $this->productService->updateProducts($request->except(['*.qtd']));
    }

    public function deleteProducts(ProductRequest $request)
    {
        return $this->productService->deleteProducts($request->json()->all());
    }
}
