<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveDay extends Model
{
    //Table Name
    protected $table = 'leavedays';
    //Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;
}
