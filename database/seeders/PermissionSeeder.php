<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'create-items'],
            ['name' => 'update-items'],
            ['name' => 'delete-items'],
            ['name' => 'rating-items'],
            ['name' => 'comment-items'],
            ['name' => 'filter-items'],
            ['name' => 'sort-items']
        ];

        DB::transaction(function() use($permissions) {
            foreach ($permissions as $permission) {
                Permission::create($permission);
            }
        }, 2);
    }
}
