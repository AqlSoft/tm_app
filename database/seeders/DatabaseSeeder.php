<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Database\Seeders\SettingsSeeder;
use Database\Seeders\SettingsTableSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SettingsSeeder::class,
            SettingsTableSeeder::class,
        ]);

        // User::factory(10)->create();

        $admin_1 = User::factory()->create([
            'name' => 'Ali Atef',
            'email' => 'ali@atef.com',
            'password' => Hash::make('123123'),
        ]);

        $admin_2 = User::factory()->create([
            'name' => 'Mohamed Atef',
            'email' => 'mohamed@atef.com',
            'password' => Hash::make('123123'),
        ]);

        $roleAdmin = Role::create(['name' => 'admin']);
        $roleUser = Role::create(['name' => 'user']);

        // إنشاء الصلاحيات
        $permissionCreateTasks = Permission::create(['name' => 'create tasks']);
        $permissionEditTasks = Permission::create(['name' => 'edit tasks']);

        // تعيين الصلاحيات للأدوار
        $roleAdmin->givePermissionTo([$permissionCreateTasks, $permissionEditTasks]);
        
        // assign roles to users
        $admin_1->roles()->attach($roleAdmin);
        $admin_2->roles()->attach($roleAdmin);
    }

}
