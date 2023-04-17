<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $maxCount = 5;
        for ((int) $projectCount = 1; $projectCount <= $maxCount; $projectCount++) {
            Project::factory()->count(1)->create([
                'name' => "Project $projectCount"
            ]);
        }
    }
}
