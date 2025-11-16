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
        $Path = $request->file('image')->getRealPath();
        $uploaded = (new Cloudinary())->uploadApi()->upload($Path, [
            'folder' => 'Marketing_System/images',
        ]);

        $marketingPage = auth()->user()->marketingPages()->create(
            array_merge($request->validated(), ['image' => $uploaded['secure_url'],])
        );

        return [
          'data' => new MarketingPageResource($marketingPage),
            'message' => "Create Marketing page successfully",
            'status' => 201
        ];
    }

    public function updateMarketingPage($request,$marketingPageId)
    {
        $marketingPage = MarketingPage::query()->findOrFail($marketingPageId);

        $data = $request->validated();

        if($request->hasFile('image')){
            $Path = $request->file('image')->getRealPath();
            $uploaded = (new Cloudinary())->uploadApi()->upload($Path, [
                'folder' => 'Marketing_System/images',
            ]);
            $data['image'] = $uploaded['secure_url'];
        }

        $marketingPage->update($data);
        return [
            'data' => new MarketingPageResource($marketingPage),
            'message' => "Update Marketing page successfully",
            'status' => 200
        ];
    }

    public function destroy($marketingPageId)
    {
        $marketingPage = MarketingPage::query()->findOrFail($marketingPageId);
        $marketingPage->delete();
        return [
          'data' => null,
          'message' => "Delete Marketing page successfully",
          'status' => 200
        ];
    }

}
