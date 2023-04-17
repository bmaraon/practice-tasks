<?php

namespace App\Repositories;

use App\Contracts\RepositoryInterface;

class BaseRepository implements RepositoryInterface
{
    /**
     * @var class
     *
     */
    protected $model = null;

    /**
     * Class Constructor
     *
     * @param class
     * @return void
     *
     */
    public function __construct($model)
    {
        $this->model = new $model;
    }

    /**
     * Push Criteria
     *
     * @param $criteria
     * @return void
     *
     */
    public function pushCriteria($criteria)
    {
        return $this->model = $criteria->apply($this->model);
    }

    /**
     * Paginate Records
     *
     * @param int $page
     * @param int $perPage
     * @return $model
     *
     */
    public function paginateRecords(int $page = 1, int $perPage = 10)
    {
        $limit  = $page * $perPage;
        $offset = $limit - $perPage;

        return $this->model->offset($offset)->limit($limit)->get();
    }

    /**
     * Get Record by Id
     *
     * @param int $id
     * @return $model
     *
     */
    public function getRecordbyId(int $id)
    {
        return $this->model->where('id', $id)->first();
    }

    /**
     * Get Record by Id with Trash
     *
     * @param int $id
     * @return $model
     *
     */
    public function getRecordByIdWithTrash(int $id)
    {
        return $this->model->where('id', $id)->withTrash()->first();
    }

    /**
     * Create Record
     *
     * @param int $id
     * @return $model
     *
     */
    public function createRecord(array $details)
    {
        return $this->model->create($details);
    }

    /**
     * Update Record
     *
     * @param int $id
     * @return $model
     *
     */
    public function updateRecord(int $id, array $details)
    {
        return $this->model->where('id', $id)->update($details);
    }

    /**
     * Delete Record
     *
     * @param int $id
     * @return bool
     *
     */
    public function deleteRecord(int $id): bool
    {
        return $this->model->where('id', $id)->delete();
    }
}
