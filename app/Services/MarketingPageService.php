<?php

namespace App\Services;

use App\Http\Resources\MarketingPageResource;
use App\Models\MarketingPage;

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

    }

}
