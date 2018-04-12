<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;

class BorrowerPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $borrowerRole = (new Role())->where('name', 'borrower')->first();

        $PermissionsForSuperAdmin = (new Permission())->whereIn('name', [
            'book.show',
            'book.borrow.register.create',
            'book.borrow.register.store',
            'activate-card.showForm',
            'activate-card.handleForm',
        ])->get()->toArray();

        $borrowerRole->attachPermissions($PermissionsForSuperAdmin);
    }
}
