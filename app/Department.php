<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function courses()
    {
        # Department has many Courses
        # Define a one-to-many relationship.
        return $this->hasMany('App\Course');
    }
}
