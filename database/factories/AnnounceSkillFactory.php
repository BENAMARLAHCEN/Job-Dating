<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AnnounceSkill>
 */
class AnnounceSkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $announcement_ids = DB::table('announcements')->select('id')->get();
        $skill_ids = DB::table('skills')->select('id')->get();

        return [
            'skill_id' => $this->faker->randomElement($skill_ids)->id,
            'announcement_id' => $this->faker->randomElement($announcement_ids)->id,
        ];
    }
}
