<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class BorrowCardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('borrow_cards')->insert([
            [
                'card_number' => '0001',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'expired_date' => new DateTime('2019-01-01'),
                'activation_code' => 'tO7wmZKdY3',
                'is_activated' => false,
                'user_id' => 3
            ],

            [
                'card_number' => '0002',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'expired_date' => new DateTime('2017-01-01'),
                'activation_code' => '1oJvoNlt9l',
                'is_activated' => true,
                'user_id' => 3
            ],

            [
                'card_number' => '0003',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'expired_date' => new DateTime('2018-01-01'),
                'activation_code' => 'TRXRxtU1gV',
                'is_activated' => true,
                'user_id' => 2
            ],

        ]);
    }
}
