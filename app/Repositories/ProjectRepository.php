<?php

namespace App\Repositories;

use App\Models\Project;
use App\Repositories\BaseRepository;

class ProjectRepository extends BaseRepository
{
    /**
     * Class Constructor
     *
     * @return void
     *
     */
    public function __construct()
    {
        parent::__construct(Project::class);
    }
}
