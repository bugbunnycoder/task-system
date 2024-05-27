<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        // Define the data to be inserted
        $employees = [
            ['username' => 'johnDoe', 'email' => 'binodpalthedev@gmail.com'],
            ['username' => 'janeSmith', 'email' => 'manojku0308@gmail.com'],
            // Add more employee data as needed
        ];

        // Insert data into the employees table
        DB::table('employees')->insert($employees);
    }
}
