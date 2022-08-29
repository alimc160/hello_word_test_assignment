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

    public function searchPredectionByName($name,$user)
    {
        $userId = $user->getAuthIdentifier();
        return $this->userPrediction->getPredectionsByName($name,$userId);
    }

    /**
     * @param $request
     * @param $user
     * @return string
     */
    public function getPredictions($request,$user)
    {
        $name = $request['name'];
        $userId = $user->getAuthIdentifier();
        $getPredectionByName = $this->userPrediction->getPredectionsByName($name,$userId);
        if (!$getPredectionByName){
            $getAge = Http::get('https://api.agify.io/?name='.$name)->json();
            $getGender = Http::get('https://api.genderize.io/?name='.$name)->json();
            $getCountries = Http::get('https://api.nationalize.io/?name='.$name)->json();
            $countries = $getCountries['country'];
            $userPredictionRequest = [
                'user_id' => $userId,
                'name' => $name,
                'age' => $getAge['age'],
                'gender' => $getGender['gender']
            ];
            $userPredictionResponse=$this->userPrediction->saveUserPrediction($userPredictionRequest);
            if (count($countries) > 0){
                foreach ($countries as $country){
                    $this->userPredictionCountry->saveUserPredictionCountry([
                        'user_prediction_id'=>$userPredictionResponse['id'],
                        'country_id' => $country['country_id']
                    ]);
                }
            }
        }
        $link=route('user.prediction.searches');
        return $link.'?name='.$name;
    }
}
