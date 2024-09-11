<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    public function translation()
    {
        return $this->hasOne('App\Models\ActivityTranslation', 'activity_id', 'id')->where('locale', appLangKey());
    }
    
    public function translations()
    {
        return $this->hasMany('App\Models\ActivityTranslation', 'activity_id', 'id');
    }

    public function category()
    {
        return $this->hasOne('App\Models\ActivitycategoryTranslation', 'category_id', 'category_id')->where('locale', appLangKey());
    }

    public function categorymain()
    {
        return $this->hasOne('App\Models\Activitycategory', 'id', 'category_id');
    }
}
