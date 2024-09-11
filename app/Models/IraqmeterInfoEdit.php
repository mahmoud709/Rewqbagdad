<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\IraqmeterInfoEditTranslation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IraqmeterInfoEdit extends Model
{
    use HasFactory;

    protected $guarded = [];

    ######### start Relation ###############

    public function translations()
    {
        return $this->hasMany(IraqmeterInfoEditTranslation::class,'parent_id','id');
    }

    public function translation()
    {
        return $this->hasOne(IraqmeterInfoEditTranslation::class,'parent_id','id')->where('locale', appLangKey());
    }

    ############ End Relation ##############
}
