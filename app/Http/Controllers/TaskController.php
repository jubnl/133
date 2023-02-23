<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET /api/tasks
     * HEAD /api/tasks
     */
    public function index(): JsonResponse
    {
        return \response()->json(data: Task::all());
    }

    /**
     * Store a newly created resource in storage.
     * POST /api/tasks
     */
    public function store(TaskRequest $request): JsonResponse
    {
        $validated = $request->validated();

        // the TaskRequest array keys correspond the Task model
        // properties, so I can directly pass it to the create method
        $task = Task::create($validated);
        return \response()->json(data: $task, status: 201);
    }

    /**
     * Display the specified resource.
     * GET /api/tasks/:id
     * HEAD /api/tasks/:id
     */
    public function show(string $id): JsonResponse
    {
        // throw NotFoundHttpException (previous is ModelNotFound)
        $user = Task::findOrFail($id);
        return \response()->json(data: $user);
    }

    /**
     * Update the specified resource in storage.
     * PUT /api/tasks/:id
     * PATCH /api/tasks/:id
     */
    public function update(TaskRequest $request, string $id): JsonResponse
    {
        $validated = $request->validated();

        // throw NotFoundHttpException (previous is ModelNotFound)
        $task = Task::findOrFail($id);

        // update properties
        $task->title = $validated['title'];
        $task->description = $validated['description'];
        $task->assigned_to = $validated['assigned_to'];
        $task->due_date = $validated['due_date'];

        // save the model
        $task->save();

        return \response()->json(data: $task, status: 201);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /api/tasks/:id
     */
    public function destroy(string $id): JsonResponse
    {
        // check if exists
        $task = Task::findOrFail($id);

        // delete task
        $task->delete();

        return \response()->json(status: 202);
    }

}
