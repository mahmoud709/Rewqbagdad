<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewaqteamTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function pminfo() // مدير المشروع 
    {
        return $this->hasOne('App\Models\Rewaqteam', 'id', 'rewaq_id');
    }
    
    public function aminfo() // مساعد المدير 
    {
        return $this->hasOne('App\Models\Rewaqteam', 'id', 'rewaq_id');
    }
    
    public function psinfo() // المشرف على المشروع 
    {
        return $this->hasOne('App\Models\Rewaqteam', 'id', 'rewaq_id');
    }

}
