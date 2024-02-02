<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AnnounceCompany;
use App\Models\Announcement;
use App\Models\AnnounceSkill;
use App\Models\Company;
use App\Models\Skill;
use Illuminate\Database\Seeder;

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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
