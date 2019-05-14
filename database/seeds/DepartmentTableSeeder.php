<?php

use Illuminate\Database\Seeder;
use App\Department;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # Array of author data to add
        $departments = [
            ['Computer Science'],
            ['Math'],
            ['Music']
        ];
        $count = count($departments);

        # Loop through each author, adding them to the database
        foreach ($departments as $departmentData) {
            $department = new Department();

            $department->created_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $department->updated_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $department->name = $departmentData[0];

            $department->save();

            $count--;
        }
    }
}
