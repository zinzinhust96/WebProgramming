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

            'issue-card.create',
            'issue-card.searchUser',
            'issue-card.store',
            'issue-card.user-detail',

            'borrow-card.index',
            'borrow-card.search',
            'borrow-card.show',
            'borrow-card.update',
            'borrow-card.deactivate'
        ])->get()->toArray();

        $superAdminRole->attachPermissions($PermissionsForSuperAdmin);
    }
}
