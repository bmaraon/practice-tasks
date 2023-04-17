<?php

namespace App\Http\Livewire\Projects;

use Illuminate\View\View;
use Livewire\Component;

class Dropdown extends Component
{
    /**
     * @var bool
     *
     * Open project list
     *
     */
    public $openProjectList = false;

    /**
     * @var array
     *
     * Dropdown display status
     *
     */
    public $projects = [];

    /**
     * @var int
     *
     * Selected project option
     *
     */
    public $selectedProject = null;

    /**
     * Mount data
     *
     * @return void
     *
     */
    public function mount($projects, $selectedProject)
    {
        $this->projects        = $projects;
        $this->selectedProject = $selectedProject;
    }

    /**
     * Show project list
     *
     * @param int $openProjectList
     * @return void
     *
     */
    public function toggleProjectListDisplay($openProjectList)
    {
        $this->openProjectList = $openProjectList;
    }

    /**
     * Set hovered project id
     *
     * @param int $projectId
     * @return void
     *
     */
    public function setHoveredProject($projectId)
    {
        $this->selectedProject = $projectId;
    }

    /**
     * Render view
     *
     * @return View
     *
     */
    public function render()
    {
        return view('livewire.projects.dropdown', [
            'selectedProject' => $this->selectedProject,
            'openProjectList' => $this->openProjectList,
            'projects'        => $this->projects,
        ]);
    }
}
