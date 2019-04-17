<?php

use Illuminate\Database\Seeder;

class JournalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\Robconvery\LaravelJournal\Journal::class, 3)->create();
    }
}
