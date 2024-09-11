<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mediavideo extends Model
{
    use HasFactory;

    public function translation()
    {
        return $this->hasOne('App\Models\MediavideoTranslation', 'video_id', 'id')->where('locale', appLangKey());
    }
    
    public function translations()
    {
        return $this->hasMany('App\Models\MediavideoTranslation', 'video_id', 'id');
    }

    public function category()
    {
        return $this->hasOne('App\Models\MediavideocategoryTranslation', 'category_id', 'category_id')->where('locale', appLangKey());
    }

}
