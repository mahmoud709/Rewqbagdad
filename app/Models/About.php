<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    public function translation()
    {
        return $this->hasOne('App\Models\AboutTranslation', 'about_id', 'id')->where('locale', appLangKey());
    }
    
    public function translations()
    {
        return $this->hasMany('App\Models\AboutTranslation', 'about_id', 'id');
    }
    //////////
    public function alltargets()
    {
        return $this->hasMany('App\Models\AboutData', 'about_id', 'id')->where('type','targets');
    }
    
    public function allvisions()
    {
        return $this->hasMany('App\Models\AboutData', 'about_id', 'id')->where('type','vision');
    }
    public function ourMessage()
    {
        return $this->hasMany('App\Models\AboutData', 'about_id', 'id')->where('type','our_message');
    }
    
    public function allmeans()
    {
        return $this->hasMany('App\Models\AboutData', 'about_id', 'id')->where('type','means');
    }

}
