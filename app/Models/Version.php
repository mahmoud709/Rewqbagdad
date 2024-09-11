<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    use HasFactory;

    public function translation()
    {
        return $this->hasOne('App\Models\VersionTranslation', 'version_id', 'id')->where('locale', appLangKey());
    }
    
    public function translations()
    {
        return $this->hasMany('App\Models\VersionTranslation', 'version_id', 'id');
    }
    
    public function category()
    {
        return $this->hasOne('App\Models\VersioncategoryTranslation', 'category_id', 'category_id')->where('locale', appLangKey());
    }
    
    public function categorymain()
    {
        return $this->hasOne('App\Models\Versioncategory', 'id', 'category_id');
    }
    
    public function writermain()
    {
        return $this->hasOne('App\Models\Bookteam', 'id', 'writer_id');
    }

    public function writer()
    {
        return $this->hasOne('App\Models\BookteamTranslation', 'bookteam_id', 'writer_id')->where('locale', appLangKey());
    }

}
