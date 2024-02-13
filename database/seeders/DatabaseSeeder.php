<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AnnounceCompany;
use App\Models\Announcement;
use App\Models\AnnounceSkill;
use App\Models\Company;
use App\Models\Skill;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        Company::factory(10)->create();
        Announcement::factory(40)->create();
        Skill::factory(40)->create();
        // AnnounceSkill::factory(90)->create();
        // AnnounceCompany::factory(70)->create();


        Role::create(['name' => 'user']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'learner']);



        // Permissions for user management
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);

        // Permissions for announcement management
        Permission::create(['name' => 'view announcements']);
        Permission::create(['name' => 'create announcements']);
        Permission::create(['name' => 'edit announcements']);
        Permission::create(['name' => 'delete announcements']);

        // Permissions for role management
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'edit roles']);
        Permission::create(['name' => 'delete roles']);

        // Permissions for skill management
        Permission::create(['name' => 'view skills']);
        Permission::create(['name' => 'create skills']);
        Permission::create(['name' => 'edit skills']);
        Permission::create(['name' => 'delete skills']);
        // Permissions for companies management
        Permission::create(['name' => 'view companies']);
        Permission::create(['name' => 'create companies']);
        Permission::create(['name' => 'edit companies']);
        Permission::create(['name' => 'delete companies']);

        // Permissions for profile management
        Permission::create(['name' => 'view profile']);
        Permission::create(['name' => 'edit profile']);
        Permission::create(['name' => 'update password']);
        Permission::create(['name' => 'delete account']);
        // Permissions for dashboard access
        Permission::create(['name' => 'access dashboard']);
        // Permissions for attendance management
        Permission::create(['name' => 'view attendances']);
        Permission::create(['name' => 'record attendance']);
        Permission::create(['name' => 'unrecord attendance']);
        Permission::create(['name' => 'delete attendance']);
        Permission::create(['name' => 'generate attendance reports']);

        Permission::create(['name' => 'delete user skills']);
        Permission::create(['name' => 'add user skills']);



        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
