<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;

    protected $guarded = [];
   
    public static function leave($type_id)
    {
        return Self::where('id', $type_id)->first();
    }

}
