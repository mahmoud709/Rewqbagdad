<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KunInfoEdit extends Model
{
    use HasFactory;
    protected $guarded = [];

    ######### start Relation ###############

    public function translations()
    {
        return $this->hasMany(KunInfoEditTranslation::class,'parent_id','id');
    }

    public function translation()
    {
        return $this->hasOne(KunInfoEditTranslation::class,'parent_id','id')->where('locale', appLangKey());
    }

    ############ End Relation ##############
}
