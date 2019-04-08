<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //Table Name
    protected $table = 'departments';
    //Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    public function users() {
        return $this->hasMany('App\User');
    }
}
