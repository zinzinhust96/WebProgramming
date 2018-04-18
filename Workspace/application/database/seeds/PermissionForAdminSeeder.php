<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;

class PermissionForAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdminRole = (new Role())->where('name', 'admin')->first();

        $PermissionsForSuperAdmin = (new Permission())->whereIn('name', [
            'book.index',
            'book.create',
            'book.store',
            'book.show',
            'book.edit',
            'book.update',
            'book.destroy',

            'book.copy.create',
            'book.copy.store',

            'borrow-book.create',
            'borrow-book.store',

            'return-book.create',
            'return-book.store',

            'issue-borrowing-card.create',
            'issue-borrowing-card.searchUser',
            'issue-borrowing-card.store',
        ])->get()->toArray();

        $superAdminRole->attachPermissions($PermissionsForSuperAdmin);
    }
}
