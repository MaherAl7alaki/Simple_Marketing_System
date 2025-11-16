<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarketingPageRequest;
use App\Responses\ApiResponse;
use App\Services\MarketingPageService;
use Illuminate\Http\Request;

class MarketingPageController extends Controller
{
    use ApiResponse;
    private $marketingPageService;
    public function __construct(MarketingPageService $marketingPageService)
    {
        $this->marketingPageService = $marketingPageService;
    }

    public function getAllMarketingPages()
    {
        $data = $this->marketingPageService->getAllMarketingPages();
        return $this->apiResponse($data['data'], $data['message'],$data['status']);
    }

    public function getMarketingPageDetails($id)
    {
       $data = $this->marketingPageService->getMarketingPageDetails($id);
       return $this->apiResponse($data['data'], $data['message'],$data['status']);
    }

    public function getMyMarketingPages()
    {
        $data = $this->marketingPageService->getMyMarketingPages();
        return $this->apiResponse($data['data'], $data['message'],$data['status']);
    }

    public function createMarketingPage(MarketingPageRequest $request)
    {
        $data = $this->marketingPageService->createMarketingPage($request);
        return $this->apiResponse($data['data'], $data['message'],$data['status']);
    }
}
