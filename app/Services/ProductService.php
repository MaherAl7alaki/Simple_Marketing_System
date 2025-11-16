<?php

namespace App\Services;

use App\Http\Resources\ProductResource;
use App\Models\MarketingPage;
use App\Models\Product;
use Cloudinary\Cloudinary;

class ProductService
{
    public function getProducts()
    {
        $products = Product::all();
        return [
            'data' => ProductResource::collection($products),
            'message' => 'Get products  successfully',
            'status' => 200
        ];
    }

    public function getMarketingPageProducts($MarketingPageId)
    {
        $MarketingPage = MarketingPage::findOrFail($MarketingPageId);
        return [
            'data' => ProductResource::collection($MarketingPage->products),
            'message' => 'Get products  successfully',
            'status' => 200
        ];
    }

    public function getProduct($id)
    {
        $product = Product::query()->findOrFail($id);

        return [
            'data' => new ProductResource($product),
            'message' => 'Get product  successfully',
            'status' => 200
        ];
    }

    public function createProduct($request)
    {
        $Path = $request->file('image')->getRealPath();
        $uploaded = (new Cloudinary())->uploadApi()->upload($Path, [
            'folder' => 'Marketing_System/images',
        ]);

        $product = Product::query()->create(
            array_merge($request->validated(), ['image' => $uploaded['secure_url'],])
        );

        return [
            'data' => new ProductResource($product),
            'message' => "Create new product successfully",
            'status' => 201
        ];
    }

    public function updateProduct($request,$productId)
    {
        $product = Product::query()->findOrFail($productId);

        $data = $request->validated();

        if($request->hasFile('image')){
            $Path = $request->file('image')->getRealPath();
            $uploaded = (new Cloudinary())->uploadApi()->upload($Path, [
                'folder' => 'Marketing_System/images',
            ]);
            $data['image'] = $uploaded['secure_url'];
        }

        $product->update($data);
        return [
            'data' => new ProductResource($product),
            'message' => "Update product successfully",
            'status' => 200
        ];
    }

    public function destroy($productId)
    {
        $product = Product::query()->findOrFail($productId);
        $product->delete();
        return [
            'data' => null,
            'message' => "Delete product successfully",
            'status' => 200
        ];
    }
}
