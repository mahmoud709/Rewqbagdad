<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahawir extends Model
{
    use HasFactory;

    protected $gaurded = [];
    protected $fillable = ['photo'];

    ########## Start Relations ###########
    public function translations()
    {
        return $this->hasMany(MahawirTranslation::class,'mahawir_id','id');
    }
    public function translation()
    {
        return $this->hasOne(MahawirTranslation::class,'mahawir_id','id')->where('locale',appLangKey());
    }
    ########## End Relations ###########
}
