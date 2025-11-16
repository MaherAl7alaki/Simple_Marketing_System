<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Responses\ApiResponse;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ApiResponse;

    private $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function getProducts()
    {
        $data = $this->productService->getProducts();
        return $this->apiResponse($data['data'],$data['message'], $data['status']);
    }

    public function getMarketingPageProducts($marketingPageId)
    {
        $data = $this->productService->getMarketingPageProducts($marketingPageId);
        return $this->apiResponse($data['data'],$data['message'], $data['status']);
    }

    public function getProduct($productId)
    {
        $data = $this->productService->getProduct($productId);
        return $this->apiResponse($data['data'],$data['message'], $data['status']);
    }

    public function createProduct(CreateProductRequest $request)
    {
        $data = $this->productService->createProduct($request);
        return $this->apiResponse($data['data'],$data['message'], $data['status']);
    }

    public function UpdateProduct(UpdateProductRequest $request,$productId)
    {
        $data = $this->productService->updateProduct($request,$productId);
        return $this->apiResponse($data['data'],$data['message'], $data['status']);
    }

    public function destroy($productId)
    {
        $data = $this->productService->destroy($productId);
        return $this->apiResponse($data['data'],$data['message'], $data['status']);
    }
}
