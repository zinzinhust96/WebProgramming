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
            'full_name' => 'Borrower',
            'gender' => 'F',
            'contact' => '0123456789',
            'is_student' => false,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

        DB::table('role_user')->insert([
            [
                'user_id' => 3,
                'role_id' => 3
            ],
        ]);

        DB::table('users')->insert([
            'name' => 'notstudent',
            'email' => 'notstudent@gmail.com',
            'password' => bcrypt('notstudent'),
            'full_name' => 'Not Student',
            'gender' => 'F',
            'contact' => '0123456789',
            'is_student' => false,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

        DB::table('role_user')->insert([
            [
                'user_id' => 4,
                'role_id' => 3
            ],
        ]);

        DB::table('users')->insert([
            'name' => 'student',
            'email' => 'student@gmail.com',
            'password' => bcrypt('student'),
            'full_name' => 'Student',
            'gender' => 'M',
            'contact' => '0123456789',
            'is_student' => true,
            'student_id' => '20143012',
            'expired_at' => '30/05/2019',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

        DB::table('role_user')->insert([
            [
                'user_id' => 5,
                'role_id' => 3
            ],
        ]);
    }
}
