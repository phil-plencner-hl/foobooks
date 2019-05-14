<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function department()
    {
        # Course belongs to Department
        # Define an inverse one-to-many relationship.
        return $this->belongsTo('App\Department');
    }

    public function students()
    {
        # withTimestamps will ensure the pivot table has its created_at/updated_at fields automatically maintained
        return $this->belongsToMany('App\Student')->withTimestamps();
    }
}
