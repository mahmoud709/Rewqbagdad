<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewaqVideoTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['locale','name','video_id'];

    public $timestamps = false;
}
