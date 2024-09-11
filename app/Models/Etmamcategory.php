<?php

namespace App\Models;

use App\Models\EtmamNews;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Etmamcategory extends Model
{
    use HasFactory;

    public function translation()
    {
        return $this->hasOne('App\Models\EtmamcategoryTranslation', 'category_id', 'id')->where('locale', appLangKey());
    }
    
    public function translations()
    {
        return $this->hasMany('App\Models\EtmamcategoryTranslation', 'category_id', 'id');
    }

    public function emamnews()
    {
        return $this->hasMany(EtmamNews::class,'category_id','id');
    }
}
