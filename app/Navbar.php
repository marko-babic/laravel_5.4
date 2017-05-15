<?php

namespace L2;

use Illuminate\Database\Eloquent\Model;

class Navbar extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'description','shortcode','navbar'
    ];

    protected $table = 'navbar';
}
