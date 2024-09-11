<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtmamNews extends Model
{
    use HasFactory;

    public function translation()
    {
        return $this->hasOne('App\Models\EtmamNewsTranslation', 'etmam_id', 'id')->where('locale', appLangKey());
    }
    
    public function translations()
    {
        return $this->hasMany('App\Models\EtmamNewsTranslation', 'etmam_id', 'id');
    }

    public function category()
    {
        return $this->hasOne('App\Models\EtmamcategoryTranslation', 'category_id', 'category_id')->where('locale', appLangKey());
    }

    public function categorymain()
    {
        return $this->hasOne('App\Models\Etmamcategory', 'id', 'category_id');
    }
}
