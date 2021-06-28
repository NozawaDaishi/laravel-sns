<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(int $id)
    {
        $user = Auth::user();
        $folders = Auth::user()->folders()->get();
        $folder = $user->folders()->first();

        $current_folder = Folder::find($id);

        $tasks = $current_folder->tasks()->get()->sortBy('due_date');

        if (is_null($folder)) {
            return redirect()->route('folders.create');
        }

        return view('tasks/index', [
            'folders' => $folders,
            'id' => $folder->id,
            'current_folder_id' => $id,
            'tasks' => $tasks,
        ]);
    }

    public function create(int $id)
    {
        return view('tasks/create', [
            'folder_id' =>$id,
        ]);
    }

    public function store(int $id, CreateTask $request)
    {
        $current_folder = Folder::find($id);

        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;
        $task->important = $request->important;
        $task->urgent = $request->urgent;

        $current_folder->tasks()->save($task);
        session()->flash('flash_message', 'タスクを作成しました');
        return redirect()->route('tasks.index', [
            'id' => $current_folder->id,
        ]);
    }

    public function edit(int $id, int $task_id)
    {
        $task = Task::find($task_id);

        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    public function update(int $id, int $task_id, EditTask $request)
    {
        $task = Task::find($task_id);

        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->important = $request->important;
        $task->urgent = $request->urgent;
        $task->save();
        session()->flash('flash_message', 'タスクを更新しました');
        return redirect()->route('tasks.index', [
            'id' => $task->folder_id,
        ]);
    }

    public function destroy(int $task_id)
    {
        $task = \App\Task::find($task_id);
        $task->delete();
        session()->flash('flash_message', 'タスクを削除しました');

        return redirect()->route('tasks.index', [
            'id' => $task->folder_id,
        ]);
    }
}
