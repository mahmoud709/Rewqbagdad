<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activitycategory extends Model
{
    use HasFactory;

    public function translation()
    {
        return $this->hasOne('App\Models\ActivitycategoryTranslation', 'category_id', 'id')->where('locale', appLangKey());
    }
    
    public function translations()
    {
        return $this->hasMany('App\Models\ActivitycategoryTranslation', 'category_id', 'id');
    }

    public function activites()
    {
        return $this->hasMany(Activity::class,'category_id', 'id');
    }

}
