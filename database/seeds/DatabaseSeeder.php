<?php

use Illuminate\Database\Seeder;

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
                'text' => 'Cheater report'
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

        /*
         * fill default navbar
         */

        DB::table('navbar')->insert([
            [
                'id' => 1,
                'description' => 'Main page',
                'shortcode' => '/',
                'navbar' => 'home'
            ],
            [
                'id' => 2,
                'description' => 'Start',
                'shortcode' => 'start',
                'navbar' => 'start'
            ],
            [
                'id' => 3,
                'description' => 'Rules',
                'shortcode' => 'rules',
                'navbar' => 'rules'
            ],
            [
                'id' => 4,
                'description' => 'Faq',
                'shortcode' => 'faq',
                'navbar' => 'faq'
            ],
            [
                'id' => 5,
                'description' => 'Donate',
                'shortcode' => 'donate',
                'navbar' => 'donate'
            ],
            [
                'id' => 6,
                'description' => 'Account',
                'shortcode' => 'home',
                'navbar' => 'account'
            ],
        ]);

        $this->command->info('Successfully added !');
    }
}
