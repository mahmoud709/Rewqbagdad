<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonTraining extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function translation()
    {
        return $this->hasOne('App\Models\konTrainingTranslation', 'kon_training_id', 'id')->where('locale', appLangKey());
    }
    
    public function translations()
    {
        return $this->hasMany('App\Models\konTrainingTranslation', 'kon_training_id', 'id');
    }
}
