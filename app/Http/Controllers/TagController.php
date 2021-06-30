<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Task;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show(string $name)
    {
        $tag = Tag::where('name', $name)->first();

        $tasks = Task::all();

        return view('tags.show', ['tag' => $tag, 'tasks' => $tasks]);
    }
}
