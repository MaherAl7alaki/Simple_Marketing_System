<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Responses\ApiResponse;

class CategoryController extends Controller
{
    use ApiResponse;
    public function index()
    {
        $categories = Category::query()->get();
        return $this->apiResponse(CategoryResource::collection($categories),"Get Successfully",200);
    }
}
