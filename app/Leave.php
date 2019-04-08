<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    //Table Name
    protected $table = 'leaves';
    //Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    public function user() {
        return $this->belongsTo('App\User');
    }
}
