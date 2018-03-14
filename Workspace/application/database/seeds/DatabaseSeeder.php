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
        // $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PermissionForAdminSeeder::class);
        $this->call(UserAdminSeeder::class);
        $this->call(CreateABook::class);
        $this->call(CreateAUser::class);
        $this->call(LibrarianPermissionsSeeder::class);
        $this->call(BorrowerPermissionsSeeder::class);
        $this->call(CreateBookCopies::class);
        $this->call(BorrowCardsTableSeeder::class);
        $this->call(BorrowRecordSeeder::class);
    }
}
