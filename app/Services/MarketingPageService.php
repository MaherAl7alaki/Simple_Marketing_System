<?php

namespace App\Services;

use App\Http\Resources\MarketingPageResource;
use App\Models\MarketingPage;
use Cloudinary\Cloudinary;

class MarketingPageService
{
    public function getAllMarketingPages()
    {
        $marketingPages = MarketingPage::all();
        return [
          'data' => MarketingPageResource::collection($marketingPages),
          'message' => "Get All Marketing pages successfully",
          'status' => 200
        ];
    }

    public function getMarketingPageDetails($id)
    {
        $marketingPage = MarketingPage::query()->findOrFail($id);
        return [
          'data' => new MarketingPageResource($marketingPage),
          'message' => "Get Marketing page details successfully",
          'status' => 200
        ];
    }

    public function getMyMarketingPages()
    {
        $marketingPages = MarketingPage::query()->where('user_id',auth()->user()->id)->get();
        return [
            'data' => MarketingPageResource::collection($marketingPages),
            'message' => "Get All Marketing pages successfully",
            'status' => 200
        ];
    }

    public function createMarketingPage($request)
    {


        $tmpPath = tempnam(sys_get_temp_dir(), 'cert_') . '.png';
        file_put_contents($tmpPath, $request->image);

        $cloudinary = new Cloudinary();

        $uploaded = $cloudinary->uploadApi()->upload($tmpPath, [
            'folder' => 'Marketing_System/Marketing_Page/images',
            'resource_type' => 'image',
        ]);
        unlink($tmpPath);

        $marketingPage = MarketingPage::create([
            $request->validated(),
            'image' => $uploaded['secure_url'] ?? null,
        ]);

        return [
          'data' => new MarketingPageResource($marketingPage),
            'message' => "Create Marketing page successfully",
            'status' => 201
        ];
    }

}
