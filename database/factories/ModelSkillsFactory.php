<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ModelSkillsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $user_ids = DB::table('users')->select('id')->get();
        $skill_ids = DB::table('skills')->select('id')->get();

        return [
            'skill_id' => $this->faker->randomElement($skill_ids)->id,
            'user_id' => $this->faker->randomElement($user_ids)->id,
        ];
    }
}
