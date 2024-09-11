<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IraqmeterSurvey extends Model
{
    use HasFactory;

    protected $guarded = [];

    ######### start Relation ###############

    public function translations()
    {
        return $this->hasMany(IraqmeterSurveyTranslation::class,'iraqmeter_survey_id','id');
    }

    public function translation()
    {
        return $this->hasOne(IraqmeterSurveyTranslation::class,'iraqmeter_survey_id','id')->where('locale', appLangKey());
    }

    ############ End Relation ##############
}
