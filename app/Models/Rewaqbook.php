<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rewaqbook extends Model
{
    use HasFactory;

    public function translation()
    {
        return $this->hasOne('App\Models\RewaqbookTranslation', 'parent_id', 'id')->where('locale', appLangKey());
    }
    
    public function translations()
    {
        return $this->hasMany('App\Models\RewaqbookTranslation', 'parent_id', 'id');
    }

}
