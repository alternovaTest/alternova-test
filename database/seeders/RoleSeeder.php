<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $administratorPermissions = [
            'create-items',
            'update-items',
            'delete-items',
            'filter-items',
            'sort-items'
        ];

        $userPermissions = [
            'rating-items',
            'comment-items',
            'filter-items',
            'sort-items'
        ];

        DB::transaction(function() use($administratorPermissions, $userPermissions) {
            $administrator = Role::create(['name' => 'ADMINISTRATOR']);
            $user = Role::create(['name' => 'USER']);

            $administrator->givePermissionTo($administratorPermissions);
            $user->givePermissionTo($userPermissions);
        }, 2);
    }
}
