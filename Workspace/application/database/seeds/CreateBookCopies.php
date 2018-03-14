<?php

use Illuminate\Database\Seeder;

class CreateBookCopies extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('book_copies')->insert([
            'copy_number' => 'TE0001001',
            'type_of_copy' => 'borrowable',
            'price' => 2200,
            'copy_status' => 'available',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'book_id' => 2
        ]);
        DB::table('book_copies')->insert([
            'copy_number' => 'TE0001002',
            'type_of_copy' => 'borrowable',
            'price' => 2200,
            'copy_status' => 'available',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'book_id' => 2
        ]);
        DB::table('book_copies')->insert([
            'copy_number' => 'TE0002001',
            'type_of_copy' => 'borrowable',
            'price' => 3300,
            'copy_status' => 'available',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'book_id' => 3
        ]);
        DB::table('book_copies')->insert([
            'copy_number' => 'TE0002002',
            'type_of_copy' => 'borrowable',
            'price' => 3300,
            'copy_status' => 'available',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'book_id' => 3
        ]);
        DB::table('book_copies')->insert([
            'copy_number' => 'TE0002003',
            'type_of_copy' => 'borrowable',
            'price' => 3300,
            'copy_status' => 'available',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'book_id' => 3
        ]);
        DB::table('book_copies')->insert([
            'copy_number' => 'TE0003001',
            'type_of_copy' => 'referenced',
            'price' => 3400,
            'copy_status' => 'available',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'book_id' => 4
        ]);
        DB::table('book_copies')->insert([
            'copy_number' => 'HI0003001',
            'type_of_copy' => 'borrowable',
            'price' => 12000,
            'copy_status' => 'available',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'book_id' => 8
        ]);
        DB::table('book_copies')->insert([
            'copy_number' => 'HI0003002',
            'type_of_copy' => 'borrowable',
            'price' => 12000,
            'copy_status' => 'available',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'book_id' => 8
        ]);
        DB::table('book_copies')->insert([
            'copy_number' => 'HI0003003',
            'type_of_copy' => 'borrowable',
            'price' => 12000,
            'copy_status' => 'available',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'book_id' => 8
        ]);
        DB::table('book_copies')->insert([
            'copy_number' => 'HI0003004',
            'type_of_copy' => 'borrowable',
            'price' => 12000,
            'copy_status' => 'available',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'book_id' => 8
        ]);
        DB::table('book_copies')->insert([
            'copy_number' => 'HI0003005',
            'type_of_copy' => 'borrowable',
            'price' => 12000,
            'copy_status' => 'available',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'book_id' => 8
        ]);
        DB::table('book_copies')->insert([
            'copy_number' => 'HI0003006',
            'type_of_copy' => 'borrowable',
            'price' => 12000,
            'copy_status' => 'available',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'book_id' => 8
        ]);
    }
}
