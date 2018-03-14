<?php

use Illuminate\Database\Seeder;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => '$2y$10$JGQIPs/IJ.vqrQBH1g2ZAOyFORZly/MTA3O9mgKChWJ8omGJS0x4G',
                'remember_token' => 'ziHdB2OH3egMCSD5gCiHmqt5qALcJBsEbEeXydAEGzKPTTpLxGRJvttQKl9a',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ]
        ]);

        DB::table('role_user')->insert([
            [
                'user_id' => 1,
                'role_id' => 1
            ],
        ]);
    }
}
