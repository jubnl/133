<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return \response(content: Task::all(), status: 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request): Response
    {
        $validated = $request->validated();

        $task = Task::create($validated);
        return \response(content: $task, status: 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        $user = Task::find($id);
        return \response(content: $user, status: 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, string $id): Response
    {
        $validated = $request->validated();
        $task = Task::find($id);
        $task->title = $validated['title'];
        $task->description = $validated['description'];
        $task->assigned_to = $validated['assigned_to'];
        $task->due_date = $validated['due_date'];
        $task->save();
        return \response(content: $task, status: 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        $deleted = Task::destroy($id);
        return \response(status: 202);
    }

}
