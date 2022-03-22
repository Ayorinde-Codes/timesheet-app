<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Entity;
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'Security.VIPUser';

    // public $timestamps = false;

    // protected $guarded = [];
   
    // protected $primaryKey = 'VIPUserID';





    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'deleted_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function entity()
    // {
    //     return $this->hasOne(Entity::class, 'GenEntityID');
    // }

    public static function entity($entityID)
    {
        return Entity::where('GenEntityID', $entityID)->first();
    }


    public static function userRole($entityID)
    {
        return UserRole::where('GenEntityID', $entityID)->first();
    }

    // public function userRole()
    // {
    //     return $this->hasOne(UserRole::class, 'GenEntityID');
    // }


    public function getKeyName(){
        return "VIPUserID";
    }
}
