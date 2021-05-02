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
        DB::table('tasks')->delete();
        $faker = Faker\Factory::create('ja_JP');
     
        for ($i = 0; $i < 1000; $i++)
        {
            Task::create([
                'title' => $faker->word,
                'content' => $faker->sentence,
                'person_in_charge' => $faker->name,
            ]);
        }
    }
}
