<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AnnounceCompany>
 */
class AnnounceCompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $announcement_ids = DB::table('announcements')->select('id')->get();
        $company_ids = DB::table('companies')->select('id')->get();

        return [
            'company_id' => $this->faker->randomElement($company_ids)->id,
            'announcement_id' => $this->faker->randomElement($announcement_ids)->id,
        ];
    }
}
