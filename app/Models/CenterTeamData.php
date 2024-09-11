<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CenterTeamData extends Model
{
    use HasFactory;
    protected $fillable = ['photo'];
    public function translation()
    {
        return $this->hasOne('App\Models\CenterTeamDataTranslation', 'center_team_data_id', 'id')->where('locale', appLangKey());
    }
    
    public function translations()
    {
        return $this->hasMany('App\Models\CenterTeamDataTranslation', 'center_team_data_id', 'id');
    }
}
