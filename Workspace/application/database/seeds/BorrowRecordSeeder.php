<?php

use Illuminate\Database\Seeder;

class BorrowRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('borrow_records')->insert([
            [
                'book_copy_id' => 7,
                'user_id' => 3,                
                'status' => 'registered',                
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
        ]);
    }
}
