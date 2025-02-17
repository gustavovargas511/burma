<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;


class TaskController extends Controller
{
    //

    public function show()
    {
        return Inertia::render('User/Show', [
          'tasks' => Task::all()
        ]);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'max:255'],
            'description' => ['nullable'],
            'status' => ['required', 'in:pending,in_progress,completed']
        ]);

        Task::create($data);

        return redirect()->route('tasks.index');
    }

    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'title' => ['required', 'max:255'],
            'description' => ['nullable'],
            'status' => ['required', 'in:pending,in_progress,completed']
        ]);

        $task->update($data);

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index');
    }

}
