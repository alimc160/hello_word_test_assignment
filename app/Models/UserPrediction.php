<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPrediction extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $guarded = ['id','_token'];

    public function saveUserPrediction($request)
    {
        return $this->create([
            'user_id'=> $request['user_id'],
            'name'=> $request['name'],
            'age' => $request['age'],
            'gender' => $request['gender']
        ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function countries()
    {
        return $this->hasMany(UserPredictionCountry::class,'user_prediction_id');
    }

    /**
     * @param $name
     * @param $userId
     * @return mixed
     */
    public function getPredectionsByName($name,$userId)
    {
        return $this::where('name',$name)
            ->where('user_id',$userId)
            ->with('countries')
            ->first();
    }
}
