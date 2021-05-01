<?php

use Illuminate\Database\Seeder;
use App\Task;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++)
        {
            $param = [
            'title' => 'title' . $i,
            'content' => 'content' . $i,
            'person_in_charge' => 'person_in_charge' . $i,
            ];
            $task = new Task();
            
            $task->fill($param)->save();
        }
    }
}
