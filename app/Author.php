<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public function books()
    {
        # Author has many Books
        # Define a one-to-many relationship.
        return $this->hasMany('App\Book');
    }

    /**
     * Helper method to get all the authors for displaying in a dropdown
     * @return mixed
     */
    public static function getForDropdown()
    {
        return self::orderBy('last_name')->select(['first_name', 'last_name', 'id'])->get();
    }
}
