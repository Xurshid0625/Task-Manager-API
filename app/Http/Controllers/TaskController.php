<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $tasks = $user->tasks()->get();

        return response()->json($tasks);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        $task = $user->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status ?? 'pending',
        ]);

        return response()->json([
            'message' => 'vazifa muvaffaqiyatli qoshildi',
            'task' => $task
        ], 201);
    }


    public function show($id, Request $request)
    {
        $user = $request->user();

        $task = $user->tasks()->find($id);

        if (!$task) {
            return response()->json([
                'message' => 'Vazifa topilmadi'
            ], 404);
        }

        return response()->json($task);
    }

    public function update(Request $request, $id)
    {
        $user = $request->user();

        $task = $user->tasks()->find($id);

        if (!$task) {
            return response()->json(['messsage' => 'vazifa topilmadi'], 404);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        $task->update($request->all());

        return response()->json(
            [
                'message' => 'vazifa mivaffaqiyatli yangilandi',
                'task' => $task
            ]
        );
    }

    public function destroy(Request $request, $id)
    {
        $user = $request->user();

        $task = $user->tasks()->find($id);

        if (!$task) {
            return response()->json(['message' => 'vazifa topilmadi'], 404);
        }

        $task->delete();

        return response()->json(['message' => 'vazifa muvaffaqiyatli ochirildi']);
    }
}
