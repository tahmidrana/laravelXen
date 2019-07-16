<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    /**
     * The attributes that are mass assignable
     */
    protected $table = 'activity_logs';

    public $timestamps = false;

    protected $fillable = [
       'log_name','log_details','url','ip','agent','created_by'
    ];
}
