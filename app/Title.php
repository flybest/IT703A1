<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    protected $table='dic_titles';
}
