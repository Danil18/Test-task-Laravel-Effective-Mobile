<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class TasksController extends Controller
{
    public function index(): JsonResource
    {
        $tasks = Task::All();
        return new JsonResource($tasks);
    }

    public function show(Task $task): JsonResource
    {
        return new JsonResource($task);
    }

    public function store(CreateTaskRequest $request): Response
    {
        $data = $request->validated();
        $task = Task::create($data);

        return response(new JsonResource($task), 201);
    }


    public function update(UpdateTaskRequest $request, Task $task): JsonResource
    {
        $data = $request->validated();
        $task->update($data);

        return new JsonResource($task);
    }

    public function destroy(Task $task): Response
    {
        $task->delete();
        return response('', 204);
    }
}
