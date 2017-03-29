<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->command->info('Adding fixed data ..');
        /*
         * fill ticket topics
         */

        DB::table('topics')->insert([
            [
                'id' => 1,
                'text' => 'General question'
            ],
            [
                'id' => 2,
                'text' => 'Bug report'
            ],
            [
                'id' => 3,
                'text' => 'Cheater repor'
            ],
            [
                'id' => 4,
                'text' => 'Technical question'
            ]
        ]);

        /*
         * fill ticket status
         */

        DB::table('ticket_status')->insert([
            [
                'id' => 1,
                'text' => 'Active'
            ],
            [
                'id' => 2,
                'text' => 'Closed'
            ],
            [
                'id' => 3,
                'text' => 'Solved'
            ]
        ]);

        $this->command->info('Successfully added !');
    }
}
