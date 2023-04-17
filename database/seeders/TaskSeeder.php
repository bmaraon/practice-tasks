<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $maxCount = 5;
        $projects = Project::all();

        foreach ($projects as $project) {
            $projectName = $project->name;

            for ((int) $taskCount = 1; $taskCount <= $maxCount; $taskCount++) {
                Task::factory()->count(1)->create([
                    'name'       => "Task $taskCount - $projectName",
                    'project_id' => $project->id,
                    'priority'   => $taskCount,
                ]);
            }
        }
    }
}
