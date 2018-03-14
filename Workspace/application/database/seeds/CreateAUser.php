<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CreateAUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Librarian',
            'email' => 'librarian@gmail.com',
            'password' => bcrypt('librarian'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

        DB::table('role_user')->insert([
            [
                'user_id' => 2,
                'role_id' => 2
            ],
        ]);

        DB::table('users')->insert([
            'name' => 'Borrower',
            'email' => 'borrower@gmail.com',
            'password' => bcrypt('borrower'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

        DB::table('role_user')->insert([
            [
                'user_id' => 3,
                'role_id' => 3
            ],
        ]);
    }
}
