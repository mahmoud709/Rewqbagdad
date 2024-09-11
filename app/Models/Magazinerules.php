<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magazinerules extends Model
{
    use HasFactory;

    public function translation()
    {
        return $this->hasOne('App\Models\MagazinerulesTranslation', 'parent_id', 'id')->where('locale', appLangKey());
    }
    
    public function translations()
    {
        return $this->hasMany('App\Models\MagazinerulesTranslation', 'parent_id', 'id');
    }

}
