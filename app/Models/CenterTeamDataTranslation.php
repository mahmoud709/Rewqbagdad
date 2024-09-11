<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CenterTeamDataTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['content','locale','center_team_data_id'];

    public $timestamps = false;
}
