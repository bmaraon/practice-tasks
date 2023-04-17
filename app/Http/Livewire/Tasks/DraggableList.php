<?php

namespace App\Http\Livewire\Tasks;

use App\Repositories\ProjectRepository;
use App\Repositories\TaskRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Livewire\Component;

class DraggableList extends Component
{
    /**
     * @var array
     *
     * Project Tasks
     *
     */
    public $tasks = [];

    /**
     * @var array
     *
     * Selected Tasks
     *
     */
    public $selectedTask = [];

    /**
     * @var bool
     *
     * Confirm delete task
     *
     */
    public $confirmDeleteTask = false;

    /**
     * @var bool
     *
     * Show create task form
     *
     */
    public $showCreateTaskForm = false;

    /**
     * @var bool
     *
     * Show edit task form
     *
     */
    public $showEditTaskForm = false;

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
     * @param array $tasks
     * @param Request $request
     * @return void
     *
     */
    public function mount($tasks, Request $request)
    {
        $this->tasks           = $tasks;
        $this->selectedProject = (int) $request->id;
    }

    /**
     * Reorder event
     *
     * @param array $newProjectTaskIds
     * @return void
     *
     */
    public function reorder($newProjectTaskIds)
    {
        $taskRepository = new TaskRepository();

        // update data
        foreach ($newProjectTaskIds as $priority => $newProjectTaskId) {
            $newPriority = $priority + 1;
            $projectTask = collect($this->tasks)->where('id', $newProjectTaskId)->first();
            $oldPriority = !empty($projectTask) ? $projectTask['priority'] : 0;

            // skip task
            if (0 == $oldPriority || (0 != $oldPriority && ($oldPriority == $newPriority))) {
                continue;
            }

            // update task
            $taskRepository->updateRecord((int) $projectTask['id'], ['priority' => $newPriority]);
        }

        // get new tasks
        $projectRepository = new ProjectRepository();
        $selectedProject   = $projectRepository->getRecordbyId($this->selectedProject);
        $this->tasks       = $selectedProject && $selectedProject->tasks ? $selectedProject->tasks->toArray() : [];
    }

    /**
     * Toggle create task confirmation
     *
     * @param bool $showCreateTaskForm
     * @return void
     *
     */
    public function toggleCreateTaskForm($showCreateTaskForm)
    {
        $this->showCreateTaskForm = $showCreateTaskForm;
    }

    /**
     * Toggle edit task confirmation
     *
     * @param bool $showEditTaskForm
     * @param array $selectedTaskId
     * @return void
     *
     */
    public function toggleEditTaskForm($showEditTaskForm, $selectedTaskId)
    {
        $this->showEditTaskForm = $showEditTaskForm;
        $this->selectedTask     = collect($this->tasks)->where('id', (int) $selectedTaskId)->first();
    }

    /**
     * Toggle delete task confirmation
     *
     * @param bool $confirmDeleteTask
     * @param array $selectedTaskId
     * @return void
     *
     */
    public function toggleDeleteTaskConfirmation($confirmDeleteTask, $selectedTaskId)
    {
        $this->confirmDeleteTask = $confirmDeleteTask;
        $this->selectedTask      = collect($this->tasks)->where('id', (int) $selectedTaskId)->first();
    }

    /**
     * Create task
     *
     * @param object $taskDetails
     * @return void
     *
     */
    public function createTask($taskDetails)
    {
        // set priority
        $taskDetails['project_id'] = $this->selectedProject;
        $taskDetails['priority']   = count($this->tasks) + 1;

        // create task
        $taskRepository = new TaskRepository();
        $taskRepository->createRecord((array) $taskDetails);

        // get new tasks
        $projectRepository = new ProjectRepository();
        $selectedProject   = $projectRepository->getRecordbyId($this->selectedProject);
        $this->tasks       = $selectedProject && $selectedProject->tasks ? $selectedProject->tasks->toArray() : [];

        // // cloise modal
        $this->showCreateTaskForm = false;
    }

    /**
     * Update task
     *
     * @param int $projectId
     * @param int $selectedTaskId
     * @param object $newTaskDetails
     * @return void
     *
     */
    public function updateTask($projectId, $selectedTaskId, $newTaskDetails)
    {
        // update task
        $taskRepository = new TaskRepository();
        $taskRepository->updateRecord((int) $selectedTaskId, (array) $newTaskDetails);

        // get new tasks
        $projectRepository = new ProjectRepository();
        $selectedProject   = $projectRepository->getRecordbyId($this->selectedProject);
        $this->tasks       = $selectedProject && $selectedProject->tasks ? $selectedProject->tasks->toArray() : [];

        // // cloise modal
        $this->showEditTaskForm = false;
    }

    /**
     * Delete task
     *
     * @param int $projectId
     * @param int $taskId
     * @return void
     *
     */
    public function deleteTask($projectId, $taskId)
    {
        // delete task
        $taskRepository = new TaskRepository();
        $taskRepository->deleteRecord((int) $taskId);

        // get project tasks
        $projectRepository = new ProjectRepository();
        $seletedProject    = $projectRepository->getRecordbyId($projectId);
        $this->tasks       = $seletedProject && $seletedProject->tasks ? $seletedProject->tasks->toArray() : [];

        // cloise modal
        $this->confirmDeleteTask = false;
    }

    /**
     * Render view
     *
     * @return View
     *
     */
    public function render()
    {
        return view('livewire.tasks.draggable-list', [
            'showCreateTaskForm' => $this->showCreateTaskForm,
            'showEditTaskForm'   => $this->showEditTaskForm,
            'selectedTask'       => $this->selectedTask,
            'confirmDeleteTask'  => $this->confirmDeleteTask,
            'tasks'              => $this->tasks,
        ]);
    }
}
