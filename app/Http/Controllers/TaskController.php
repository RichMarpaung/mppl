<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::latest()->get();
        return view('adminpage.task.index', compact('tasks'));
    }
    public function approve($id)
    {
        $task = Task::findOrFail($id);
        $task->status = 'accepted';
        $task->catatan = null; // reset catatan jika ada
        $task->save();

        return redirect()->route('admin.tasks.index')->with('success', 'Task berhasil di-approve.');
    }
   public function revisi(Request $request, $id)
{
    $task = Task::findOrFail($id);

    $request->validate([
        'catatan' => 'required|string|max:255',
        'file_ask' => 'nullable|file|max:2048',
    ]);

    // Jika ada file_ask baru, hapus file lama lalu simpan yang baru
    if ($request->hasFile('file_ask')) {
        if ($task->file_ask && Storage::disk('public')->exists($task->file_ask)) {
            Storage::disk('public')->delete($task->file_ask);
        }
        $task->file_ask = $request->file('file_ask')->store('tasks/file_ask', 'public');
    }

    $task->status = 'revisi';
    $task->catatan = $request->catatan;
    $task->save();

    return redirect()->route('admin.tasks.index')->with('success', 'Task berhasil dikembalikan untuk revisi.');
}

    public function create()
    {
        $teams = Team::with('user')->get();
        return view('adminpage.task.create', compact('teams'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_selesai' => 'nullable|date|after:now',
            'file_ask' => 'nullable|file|max:2048',
            'team_id' => 'required|exists:teams,id',
            'status' => 'required|in:in-progres,completed,revisi,accepted,late',
            'catatan' => 'nullable|string|max:255',
        ], [
            'tanggal_selesai.after' => 'Tanggal selesai harus setelah waktu saat ini.',
        ]);

        if ($request->hasFile('file_ask')) {
            $validated['file_ask'] = $request->file('file_ask')->store('tasks/file_ask', 'public');
        }

        $validated['file_task'] = null;

        Task::create($validated);

        return redirect()->route('admin.tasks.index')->with('success', 'Task berhasil ditambahkan.');
    }
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $teams = Team::with('user')->get();
        return view('adminpage.task.edit', compact('task', 'teams'));
    }


    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_selesai' => 'nullable|date|after:now',
            'file_ask' => 'nullable|file|max:2048',
            'team_id' => 'required|exists:teams,id',
            'status' => 'required|in:in-progres,completed,revisi,accepted,late',
            'catatan' => 'nullable|string|max:255',
        ], [
            'tanggal_selesai.after' => 'Tanggal selesai harus setelah waktu saat ini.',
        ]);

        if ($request->hasFile('file_ask')) {
            $validated['file_ask'] = $request->file('file_ask')->store('tasks/file_ask', 'public');
        } else {
            $validated['file_ask'] = $task->file_ask;
        }

        $validated['file_task'] = $task->file_task;

        $task->update($validated);

        return redirect()->route('admin.tasks.index')->with('success', 'Task berhasil diupdate.');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('admin.tasks.index')->with('success', 'Task berhasil dihapus.');
    }
}
