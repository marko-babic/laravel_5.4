<?php

namespace L2;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title','content','author','description_id'
    ];

    public function navbar()
    {
        return $this->hasOne(Navbar::class ,'id','description_id');
    }

}
