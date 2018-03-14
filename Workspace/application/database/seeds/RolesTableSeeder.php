<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'admin',
                'display_name' => 'Admin'
            ],

            [
                'name' => 'librarian',
                'display_name' => 'Librarian'
            ],

            [
                'name' => 'borrower',
                'display_name' => 'Borrower'
            ],
        ]);
    }
}
