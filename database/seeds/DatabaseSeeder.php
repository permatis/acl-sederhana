<?php

use Illuminate\Database\Seeder;
use App\Models\Task;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Task::create([
            'name' => 'Task 1',
            'description' => 'Create migration table and new records.',
        ]);

        Task::create([
            'name' => 'Task 2',
            'description' => 'Create a CRUD is working.',
        ]);
        
        // $this->call(UserTableSeeder::class);
    }
}
