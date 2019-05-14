<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(AuthorsTableSeeder::class);
         $this->call(BooksTableSeeder::class);
         $this->call(TagsTableSeeder::class);
         $this->call(BookTagTableSeeder::class);
         $this->call(DepartmentTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
    }
}
