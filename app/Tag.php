<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function books() {
        return $this->belongsToMany('App\Book')->withTimestamps();
    }

    public static function getForCheckboxes()
    {
        return self::orderBy('name')->select(['name', 'id'])->get();
    }
}
