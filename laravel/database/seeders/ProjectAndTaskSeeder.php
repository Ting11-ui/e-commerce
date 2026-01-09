<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;

class ProjectAndTaskSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        
        if (!$user) {
            $this->command->error('No users found. Please create a user first.');
            return;
        }

        $projects = [
            ['name' => 'Website Redesign', 'description' => 'Redesign company website'],
            ['name' => 'Mobile App', 'description' => 'Develop mobile application'],
        ];

        foreach ($projects as $projectData) {
            $project = Project::create([
                'name' => $projectData['name'],
                'description' => $projectData['description'],
                'manager_id' => $user->id,  // Changed from user_id to manager_id
            ]);

            Task::create([
                'title' => 'Initial Planning for ' . $project->name,
                'description' => 'Plan the project structure',
                'status' => 'pending',
                'project_id' => $project->id,
            ]);
        }
    }
}
