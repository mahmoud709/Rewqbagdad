<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Versioncategory extends Model
{
    use HasFactory;

    public function translation()
    {
        return $this->hasOne('App\Models\VersioncategoryTranslation', 'category_id', 'id')->where('locale', appLangKey());
    }
    
    public function translations()
    {
        return $this->hasMany('App\Models\VersioncategoryTranslation', 'category_id', 'id');
    }

    public function versions()
    {
        return $this->hasMany(Version::class,'category_id','id');
    }

}
