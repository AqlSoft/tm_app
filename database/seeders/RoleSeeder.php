<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // إضافة الأدوار
        $adminRole = Role::create(['name' => 'admin', 'description' => 'Administrator role']);
        $userRole = Role::create(['name' => 'user', 'description' => 'User role']);

        // إضافة الأدوار للمستخدم الحالي
        $currentUser = User::first(); // الحصول على أول مستخدم
        if ($currentUser) {
            $currentUser->roles()->attach($adminRole); // إضافة دور المدير للمستخدم الحالي
        }
    }
}
