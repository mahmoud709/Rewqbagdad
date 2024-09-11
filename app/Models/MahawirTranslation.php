<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahawirTranslation extends Model
{
    use HasFactory;

    
    protected $gaurded = [];

    protected $fillable = ['title','description','locale','mahawir_id'];

    public $timestamps = false;
}
