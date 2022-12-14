<?php

namespace App\Http\Controllers;

use App\Services\UserPredictionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private UserPredictionService $predictionService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserPredictionService $userPredictionService)
    {
        $this->middleware('auth');
        $this->predictionService = $userPredictionService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function searchPrediction(Request $request)
    {
        $user = Auth::user();
        $link=$this->predictionService->getPredictions($request->all(),$user);
        return redirect()->back()->with('link',$link);
    }

    public function getUserSearches(Request $request)
    {
        $user = Auth::user();
        $response=$this->predictionService->searchPredectionByName($request['name'],$user);
        return view('user_searches',compact('response'));
    }
}
