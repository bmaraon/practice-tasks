<?php

namespace App\Http\Livewire\Projects;

use App\Repositories\ProjectRepository;
use Illuminate\View\View;
use Livewire\Component;

class Show extends Component
{
    /**
     * @var array
     *
     */
    public $project = [];

    /**
     * @var array
     *
     */
    public $projects = [];

    /**
     * @var array
     *
     * Tasks
     *
     */
    public $tasks = [];

    /**
     * @var int
     *
     * Selected Project
     *
     */
    public $selectedProject = null;

    /**
     * Mount data
     *
     * @return void
     *
     */
    public function mount()
    {
        $projectRepository = new ProjectRepository();
        $this->projects    = $projectRepository->paginateRecords($page = 1, $perPage = 100);
        $this->projects    = $this->projects ? $this->projects->toArray() : [];
    }

    /**
     * Render view
     *
     * @return View
     *
     */
    public function render()
    {
        return view('livewire.projects.show', [
            'project'         => $this->project,
            'projects'        => $this->projects,
            'tasks'           => $this->tasks,
            'selectedProject' => $this->selectedProject,
        ])->layout('layouts.main');
    }
}
