<div x-data="{
        taskName: '',
        taskDetails: @entangle('selectedTask') ?? [],
        openEditTaskForm : @entangle('showEditTaskForm') ?? false,
        openCreateTaskForm : @entangle('showCreateTaskForm') ?? false,
        openDeleteConfirmation: @entangle('confirmDeleteTask') ?? false
    }">
    <button
        type="button"
        id="create-task"
        class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-10 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:w-auto">
        Create
    </button> <br/><br/>
    <ul project-task-list class="overflow-hidden rounded shadow w-100 divide-y">
        @foreach ($tasks as $task)
            <li project-task-item="{{ $task['id'] }}"
                draggable="true"
                wire:key={{ $task['id'] }}
                class="w-100 p-4 bg-white">
                <span id="task-name-{{$task['id']}}">{{ $task['name'] }}</span>
                <span id="delete-task-{{$task['id']}}" style="float: right; padding: 5px; cursor: pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                </span>
                <span id="edit-task-{{$task['id']}}" style="float: right; padding: 5px; cursor: pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>
                </span>
            </li>
        @endforeach
    </ul>

    @if ($showCreateTaskForm)
        <div
            role="dialog"
            aria-modal="true"
            class="relative z-10"
            aria-labelledby="modal-title"
            x-show="openCreateTaskForm">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <form create-selected-task-form x-on:submit.prevent>
                            <div class="space-y-12">
                                <div class="pb-5">
                                    <div class="sm:flex sm:items-start">
                                        <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                                            </svg>
                                        </div>
                                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                            <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Create New Task</h3>
                                        </div>
                                    </div>
                                    {{-- <h2 class="text-base font-semibold leading-7 text-gray-900">Edit Task Details</h2> --}}
                                    <br/>
                                    <div class="col-span-full">
                                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Task Name: </label>
                                        <div class="mt-2">
                                            <input
                                                id="name"
                                                type="text"
                                                name="name"
                                                autocomplete="name"
                                                value=""
                                                class="block w-full rounded-md border-0 px-5 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button
                        type="button"
                        create-task-button
                        @click="createTask($el)"
                        class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto">
                        Create
                    </button>
                    <button
                        type="button"
                        @click="openCreateTaskForm = false"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                        Cancel
                    </button>
                    </div>
                </div>
                </div>
            </div>
        </div>
    @endif

    @if ($showEditTaskForm)
        <div
            role="dialog"
            aria-modal="true"
            class="relative z-10"
            aria-labelledby="modal-title"
            x-show="openEditTaskForm">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <form update-selected-task-form x-on:submit.prevent>
                            <div class="space-y-12">
                                <div class="pb-5">
                                    <div class="sm:flex sm:items-start">
                                        <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                        </div>
                                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                            <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Edit Task Details</h3>
                                        </div>
                                    </div>
                                    {{-- <h2 class="text-base font-semibold leading-7 text-gray-900">Edit Task Details</h2> --}}
                                    <br/>
                                    <div class="col-span-full">
                                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Task Name: </label>
                                        <div class="mt-2">
                                            <input
                                                id="name"
                                                type="text"
                                                name="name"
                                                autocomplete="name"
                                                value="{{isset($selectedTask['name']) ? $selectedTask['name'] : ''}}"
                                                class="block w-full rounded-md border-0 px-5 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button
                        type="button"
                        update-selected-task-button
                        selected-task-id="{{isset($selectedTask['id']) ? $selectedTask['id'] : null}}"
                        selected-task-project-id="{{isset($selectedTask['project_id']) ? $selectedTask['project_id'] : null}}"
                        @click="editTask($el)"
                        class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto">
                        Update
                    </button>
                    <button
                        type="button"
                        @click="openEditTaskForm = false"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                        Cancel
                    </button>
                    </div>
                </div>
                </div>
            </div>
        </div>
    @endif
    
    @if ($confirmDeleteTask)
        <div
            role="dialog"
            aria-modal="true"
            class="relative z-10"
            aria-labelledby="modal-title"
            x-show="openDeleteConfirmation">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                        </div>
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                        <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Delete Task</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">Do you want to delete {{isset($selectedTask['name']) ? $selectedTask['name'] : ''}}</p>
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button
                        type="button"
                        delete-selected-task-button
                        selected-task-id="{{isset($selectedTask['id']) ? $selectedTask['id'] : null}}"
                        selected-task-project-id="{{isset($selectedTask['project_id']) ? $selectedTask['project_id'] : null}}"
                        @click="deleteTask($el)"
                        class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">
                        Delete
                    </button>
                    <button
                        type="button"
                        @click="openDeleteConfirmation = false"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                        Cancel
                    </button>
                    </div>
                </div>
                </div>
            </div>
        </div>
    @endif
</div>

<script type="text/javascript">
    // initialize events window onload
    window.onload = function () {
        initializeTaskListEvents();
    }

    // initialize task list events
    function initializeTaskListEvents () {
        const projectTaskList = document.querySelector('[project-task-list]');
        const projectTaskItem = projectTaskList.querySelectorAll('[project-task-item]');

        // walkthrough the set of project tasks
        projectTaskItem.forEach( (el, index) => {
            const taskId = el.getAttribute('wire:key');
            const createTaskButton = document.getElementById(`create-task`);
            const editTaskButton = document.getElementById(`edit-task-${taskId}`);
            const deleteTaskButton = document.getElementById(`delete-task-${taskId}`);

            // show create task form
            createTaskButton.removeEventListener('click', () => {});
            createTaskButton.addEventListener('click', e => {
                const component = Livewire.find(e.target.closest('[wire\\:id]').getAttribute('wire:id'));
                component.call('toggleCreateTaskForm', true);
            });

            // show edit task form
            editTaskButton.removeEventListener('click', () => {});
            editTaskButton.addEventListener('click', e => {
                const component = Livewire.find(e.target.closest('[wire\\:id]').getAttribute('wire:id'));
                component.call('toggleEditTaskForm', true, taskId);
            });

            // show delete task confirmation
            deleteTaskButton.removeEventListener('click', () => {});
            deleteTaskButton.addEventListener('click', e => {
                const component = Livewire.find(e.target.closest('[wire\\:id]').getAttribute('wire:id'));
                component.call('toggleDeleteTaskConfirmation', true, taskId);
            });

            // initialize dragging of the item
            el.removeEventListener('dragstart', () => {});
            el.addEventListener('dragstart', e => {
                // set element directive when dragged
                e.target.setAttribute('dragged-item', true);
            });
            
            // when dragged item is dropped
            el.removeEventListener('drop', () => {});
            el.addEventListener('drop', e => {
                e.target.classList.remove('bg-yellow-100');

                // get the dragged item
                const draggedItem = projectTaskList.querySelector('[dragged-item]');

                // insert the dragged item before the target item
                e.target.before(draggedItem);

                // refresh livewire component
                const newProjectTaskItem = projectTaskList.querySelectorAll('[project-task-item]');
                const component = Livewire.find(e.target.closest('[wire\\:id]').getAttribute('wire:id'));
                const newProjectTaskIds = Array.from(newProjectTaskItem).map(taskItem => taskItem.getAttribute('project-task-item'));

                // Reorder tasklist
                component.call('reorder', newProjectTaskIds);
            });

            el.removeEventListener('dragenter', () => {});
            el.addEventListener('dragenter', e => {
                e.target.classList.add('bg-yellow-100');
                e.preventDefault();
            });

            el.removeEventListener('dragover', () => {});
            el.addEventListener('dragover', e => {
                e.preventDefault();
            });

            el.removeEventListener('dragleave', () => {});
            el.addEventListener('dragleave', e => {
                e.target.classList.remove('bg-yellow-100');
            });

            el.removeEventListener('dragend', () => {});
            el.addEventListener('dragend', e => {
            });
        });
    }

    // create task event
    function createTask($el) {
        const createTaskForm = document.querySelector('[create-selected-task-form]');
        const createTaskButton = document.querySelector('[create-task-button]');
        const taskNameField = document.querySelector('input[name="name"]');
        const wireId = $el.closest('[wire\\:id]').getAttribute('wire:id');
        const createTaskComponent = Livewire.find(wireId);

        // set form data then create task
        createTaskComponent.call('createTask', { name: taskNameField.value });

        // clear form field
        setTimeout(() => {
            createTaskForm.reset();
            initializeTaskListEvents();
        }, 1000); 
    }

    // edit task event
    function editTask($el) {
        const updateSelectedTaskButton = document.querySelector('[update-selected-task-button]');
        const selectedTaskId = updateSelectedTaskButton.getAttribute('selected-task-id');
        const taskNameField = document.querySelector('input[name="name"]');
        const selectedTaskProjectId = updateSelectedTaskButton.getAttribute('selected-task-project-id');
        const wireId = $el.closest('[wire\\:id]').getAttribute('wire:id');
        const updateTaskComponent = Livewire.find(wireId);

        // set form data then update task
        updateTaskComponent.call('updateTask', selectedTaskProjectId, selectedTaskId, { name: taskNameField.value });
    }

    // delete task event
    function deleteTask($el) {
        const deleteSelectedTaskButton = document.querySelector('[delete-selected-task-button]');
        const selectedTaskId = deleteSelectedTaskButton.getAttribute('selected-task-id');
        const selectedTaskProjectId = deleteSelectedTaskButton.getAttribute('selected-task-project-id');
        const wireId = $el.closest('[wire\\:id]').getAttribute('wire:id');
        const deleteTaskComponent = Livewire.find(wireId);

        // invoke livewire method
        deleteTaskComponent.call('deleteTask', selectedTaskProjectId, selectedTaskId);
    }
    
</script>
