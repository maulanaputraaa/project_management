<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubmitRequest;
use App\Models\Submit;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SubmitController extends Controller
{
    public function store(StoreSubmitRequest $request, Task $task)
    {
        $data = $request->validated();
        /** @var $image \Illuminate\Http\UploadedFile */
        $file = $data['file'] ?? null;
        $data['task_id'] = $task->id;
        $data['assigned_by'] = Auth::id();

        if ($file) {
            $data['task_path'] = $file->store('task/submit/' . Str::random(), 'public');
        }

        Submit::create($data);

        $task->status = 'in_progress';
        $task->save();

        return to_route('task.index')
            ->with('success', 'Task was created');
    }

    public function create(Task $task)
    {
        return inertia("Task/Submit", [
            'task' => $task,
            'user' => auth()->user(),
        ]);
    }
}
