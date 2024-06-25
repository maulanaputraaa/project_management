<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submit extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'task_path',
        'assigned_by',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }
}
