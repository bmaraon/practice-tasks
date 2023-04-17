<?php

namespace App\Criterias\Task;

use App\Contracts\CriteriaInterface;

class FilterByCategory implements CriteriaInterface
{
    /**
     * @var int
     *
     * What project the task to displpay
     *
     */
    protected $projectId;

    /**
     * Class Constructor
     *
     * @param $projectId
     * @return void
     *
     */
    public function __construct($projectId)
    {
        $this->projectId = (int) $projectId;
    }

    /**
     * Apply
     *
     * @param $model
     * @return $model
     *
     */
    public function apply($model)
    {
        $projectId = $this->projectId;
        return $model->when(!empty($projectId), function ($query) use ($projectId) {
            $query->where('project_id', $projectId);
        });
    }
}
