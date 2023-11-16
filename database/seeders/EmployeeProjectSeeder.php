<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::all()->each(function ($employee) {
            $projects = Project::inRandomOrder()->limit(rand(1, 3))->get();
            $employee->projects()->attach($projects);
        });
    }
}
