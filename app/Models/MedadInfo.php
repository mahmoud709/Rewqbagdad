<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedadInfo extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function translation()
    {
        return $this->hasOne('App\Models\MedadInfoTranslation', 'parent_id', 'id')->where('locale', appLangKey());
    }
    
    public function translations()
    {
        return $this->hasMany('App\Models\MedadInfoTranslation', 'parent_id', 'id');
    }
}
