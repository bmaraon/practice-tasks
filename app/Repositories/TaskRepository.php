<?php

namespace App\Repositories;

use App\Models\Task;
use App\Repositories\BaseRepository;

class TaskRepository extends BaseRepository
{
    /**
     * Class Constructor
     *
     * @return void
     *
     */
    public function __construct()
    {
        parent::__construct(Task::class);
    }
}
