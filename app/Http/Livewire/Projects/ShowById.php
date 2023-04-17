<?php

namespace App\Http\Livewire\Projects;

use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Livewire\Component;

class ShowById extends Component
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
     * Mount lifecycle
     *
     * @param Request
     * @return void
     *
     */
    public function mount(Request $request)
    {
        $this->selectedProject = (int) $request->id;

        // get data
        $projectRepository = new ProjectRepository();
        $this->projects    = $projectRepository->paginateRecords($page = 1, $perPage = 100);
        $this->projects    = $this->projects ? $this->projects->toArray() : [];

        // tasks
        $projectRepository = new ProjectRepository();
        $seletedProject    = $projectRepository->getRecordbyId($this->selectedProject);
        $this->tasks       = $seletedProject && $seletedProject->tasks ? $seletedProject->tasks->toArray() : [];
        $this->project     = $seletedProject ? $seletedProject->toArray() : [];
    }

    /**
     * Render view
     *
     * @return View
     *
     */
    public function render()
    {
        return view('livewire.projects.show-by-id', [
            'project'         => $this->project,
            'projects'        => $this->projects,
            'tasks'           => $this->tasks,
            'selectedProject' => $this->selectedProject,
        ])->layout('layouts.main');
    }
}
