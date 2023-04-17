<?php

namespace App\Criterias\Task;

use App\Contracts\CriteriaInterface;

class FilterByCategory implements CriteriaInterface
{
    /**
     * @var int
     *
     * What orderBy the priority will be
     *
     */
    protected $orderBy;

    /**
     * Class Constructor
     *
     * @param int $orderBy
     * @return void
     *
     */
    public function __construct($orderBy = 'asc')
    {
        $this->orderBy = (string) $orderBy;
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
        $orderBy = $this->orderBy;
        return $model->when(!empty($orderBy), function ($query) use ($orderBy) {
            $query->orderBy('priority', $orderBy);
        });
    }
}
