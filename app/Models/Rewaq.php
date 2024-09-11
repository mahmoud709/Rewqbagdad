<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rewaq extends Model
{
    use HasFactory;

    public function translation()
    {
        return $this->hasOne('App\Models\RewaqTranslation', 'parent_id', 'id')->where('locale', appLangKey());
    }
    
    public function translations()
    {
        return $this->hasMany('App\Models\RewaqTranslation', 'parent_id', 'id');
    }
    //==============================//
    
    public function pm() // مدير المشروع 
    {
        return $this->hasOne('App\Models\RewaqteamTranslation', 'rewaq_id', 'pm_id')->where('locale', appLangKey());
    }
    
    public function am() // مساعد المدير 
    {
        return $this->hasOne('App\Models\RewaqteamTranslation', 'rewaq_id', 'am_id')->where('locale', appLangKey());
    }
    
    public function ps() // المشرف على المشروع
    {
        return $this->hasOne('App\Models\RewaqteamTranslation', 'rewaq_id', 'ps_id')->where('locale', appLangKey());
    }

}
