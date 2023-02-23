<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return \response()->json(data: Task::all(), status: 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $task = Task::create($validated);
        return \response()->json(data: $task, status: 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $user = Task::find($id);
        return \response()->json(data: $user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, string $id): JsonResponse
    {
        $validated = $request->validated();
        $task = Task::find($id);
        $task->title = $validated['title'];
        $task->description = $validated['description'];
        $task->assigned_to = $validated['assigned_to'];
        $task->due_date = $validated['due_date'];
        $task->save();
        return \response()->json(data: $task, status: 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $deleted = Task::destroy($id);
        return \response()->json(status: 202);
    }

}
