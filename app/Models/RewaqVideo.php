<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewaqVideo extends Model
{
    use HasFactory;

    protected $fillable = ['img','video_url'];

    ########## Start Relations###########
    public function translations()
    {
        return $this->hasMany(RewaqVideoTranslation::class,'video_id','id');
    }
    public function translation()
    {
        return $this->hasOne(RewaqVideoTranslation::class,'video_id','id')->where('locale', appLangKey());
    }
    ########## Edn Relations ###########


}
