<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
   //Table Name
    protected $table = 'leavetype';
    //Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;
}
