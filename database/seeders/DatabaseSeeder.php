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
        AnnounceSkill::factory(90)->create();
        AnnounceCompany::factory(70)->create();


        Role::create(['name' => 'admin'],['name' => 'learner']);

        Permission::create(['name' => 'edit skills']);
        Permission::create([ 'name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
