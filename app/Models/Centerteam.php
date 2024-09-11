<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centerteam extends Model
{
    use HasFactory;

    public function translation()
    {
        return $this->hasOne('App\Models\CenterteamTranslation', 'centerteam_id', 'id')->where('locale', appLangKey());
    }
    
    public function translations()
    {
        return $this->hasMany('App\Models\CenterteamTranslation', 'centerteam_id', 'id');
    }

}
