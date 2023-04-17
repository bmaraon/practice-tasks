<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get the tasks.
     *
     * @param string $orderPriorityBy
     * @return void
     *
     */
    public function tasks($orderPriorityBy = 'asc'): HasMany
    {
        return $this->hasMany(Task::class, 'project_id', 'id')
            ->when(!empty($orderPriorityBy), function ($query) use ($orderPriorityBy) {
                $query->orderBy('priority', $orderPriorityBy);
            });
    }
}
