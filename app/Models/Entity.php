<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    protected $table = 'Entity.GenEntity';

    public $timestamps = false;

    protected $guarded = [];
   
    public function user()
    {
        return $this->belongsTo(User::class, 'GenEntityID');
    }

    public function getKeyName(){
        return "GenEntityID";
    }
}
