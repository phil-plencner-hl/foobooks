<?php

use Illuminate\Database\Seeder;
use App\Course;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        # Array of author data to add
        $courses = [
            ['Dynamic Web Applications','spring','Dynamic Web Applications', 1],
            ['Advanced Calculus','spring','Advanced Calculus',2],
            ['Physics Of Music', 'fall', 'Physics Of Music', 3]
        ];
        $count = count($courses);

        # Loop through each author, adding them to the database
        foreach ($courses as $courseData) {
            $course = new Course();

            $course->created_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $course->updated_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $course->name = $courseData[0];
            $course->semester = $courseData[1];
            $course->description = $courseData[2];
            $course->department_id = $courseData[3];

            $course->save();

            $count--;
        }

    }
}
