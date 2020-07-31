<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function lesson()
    {
    	return $this->hasMany('App\Lesson');
    }
}
