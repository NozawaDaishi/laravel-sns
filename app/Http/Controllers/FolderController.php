<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests\CreateFolder;
use App\Http\Requests\EditFolder;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    public function create()
    {
        return view('folders/create');
    }

    public function store(CreateFolder $request)
    {
        $folder = new Folder();

        $folder->title = $request->title;

        Auth::user()->folders()->save($folder);
        session()->flash('flash_color', 'alert-success');
        session()->flash('flash_icon', 'fas fa-folder-plus mr-2 fa-lg');
        session()->flash('flash_message', 'フォルダを作成しました');
        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }

    public function edit(int $id)
    {
        $folder = Folder::find($id);

        return view('folders.edit', [
            'folder' => $folder,
        ]);
    }

    public function update(int $id, EditFolder $request)
    {
        $folder = Folder::find($id);

        $folder->title = $request->title;
        $folder->save();
        session()->flash('flash_color', 'alert-success');
        session()->flash('flash_icon', 'fas fa-edit mr-2 fa-lg');
        session()->flash('flash_message', 'フォルダ名を変更しました');
        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }

    public function destroy(int $id)
    {
        $folder = Folder::find($id);
        $tasks = Task::all();
        $folder->delete();

        $folder_first = Folder::all()->first();
        session()->flash('flash_color', 'alert-danger');
        session()->flash('flash_icon', 'fas fa-folder-minus mr-2 fa-lg');
        session()->flash('flash_message', 'フォルダを削除しました');

        if (is_null($folder_first)) {
            return redirect()->route('folders.create');
        }

        return redirect()->route('tasks.index', [
            'id' => $folder_first->id,
        ]);
    }
}
