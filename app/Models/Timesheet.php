<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    protected $table = 'timesheets';

    public $timestamps = false;

    protected $guarded = [];

    const PROCESSING = 'processing';
    const PENDING = 'pending';
    const DECLINED = 'declined';
    const SUCCESSFUL = 'successful'; 


}
