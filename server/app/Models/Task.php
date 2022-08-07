<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table = 'tasks';
    protected $fillable = ['name', 'completed'];

    /**
     * Get the story that owns the task.
     */
    public function story()
    {
        return $this->belongsTo(Story::class, 'id');
    }

    /**
     * If a subtask, get the parent task.
     */
    public function task()
    {
        return $this->belongsTo(Task::class, 'id');
    }

    /**
     * Get the user that owns the task.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
