<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPredictionCountry extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $guarded = ['id', '_token'];

    public function saveUserPredictionCountry($request){
        return $this::create([
           'user_prediction_id'=>''
        ]);
    }
}
