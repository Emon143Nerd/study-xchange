<?php

namespace App\Http\Controllers\NormalUser;

use App\Http\Controllers\Controller;
use App\Providers\CareerRecommendationService;
use Illuminate\Http\Request;

class CareerRecommendationController extends Controller
{
    protected $careerRecommendationService;

    public function __construct(CareerRecommendationService $careerRecommendationService)
    {
        $this->careerRecommendationService = $careerRecommendationService;
    }


    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $recommendations = $this->careerRecommendationService->getRecommendations($userId);

        return view('normal-user.recommendation.index', compact('recommendations'));
    }
}
