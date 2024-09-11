<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upcomingtraining extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function translation()
    {
        return $this->hasOne('App\Models\UpcomingtrainingTranslation', 'upcomingtraining_id', 'id')->where('locale', appLangKey());
    }
    
    public function translations()
    {
        return $this->hasMany('App\Models\UpcomingtrainingTranslation', 'upcomingtraining_id', 'id');
    }
}
