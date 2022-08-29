<?php

namespace App\Services;

use App\Models\UserPrediction;
use App\Models\UserPredictionCountry;
use Illuminate\Support\Facades\Http;

class UserPredictionService
{
    private UserPredictionCountry $userPredictionCountry;
    private UserPrediction $userPrediction;

    public function __construct(
        UserPrediction $userPrediction,
        UserPredictionCountry $userPredictionCountry
    )
    {
        $this->userPrediction = $userPrediction;
        $this->userPredictionCountry = $userPredictionCountry;
    }

    public function getPredictions($request,$user)
    {
        $name = $request['name'];
        $getAge = Http::get('https://api.agify.io/?name='.$name)->json();
        $getGender = Http::get('https://api.genderize.io/?name='.$name)->json();
        $getCountries = Http::get('https://api.nationalize.io/?name='.$name)->json();
        $countries = $getCountries['country'];
        $userPredictionRequest = [
            'user_id' => $user->getAuthIdentifier(),
            'name' => $name,
            'age' => $getAge['age'],
            'gender' => $getGender['gender']
        ];
        $userPredictionResponse=$this->userPrediction->saveUserPrediction($userPredictionRequest);
        foreach ($countries as $country){
            $this->userPredictionCountry->saveUserPredictionCountry([
                'user_prediction_id'=>$userPredictionResponse['id'],
                'country_id' => $country['country_id']
            ]);
        }
    }
}
