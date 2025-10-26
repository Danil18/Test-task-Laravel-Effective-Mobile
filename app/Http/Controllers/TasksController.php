<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class TasksController extends Controller
{
    public function index(): JsonResponse
    {
        $tasks = Task::All();
        $result = [];
        if (!empty($tasks)) {
            foreach ($tasks as $task) {
                $result[] = [
                    'id' => $task->id,
                    'title' => $task->title,
                    'description' => $task->description,
                    'status' => $task->status,
                ];
            }
        } else {
            $result['error'] = 'Записи не найдены';
        }

        return response()->json($result);
    }

    public function show(Task $task): JsonResponse
    {
        if (!empty($task->id)) {
            $result = [
                'id' => $task->id,
                'title' => $task->title,
                'description' => $task->description,
                'status' => $task->status,
            ];
        } else {
            $result = [];
        }
        return response()->json($result);
    }

    public function store(): JsonResponse
    {
        $validatorResult = Validator::make(request()->all(), [
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'status' => [
                'required',
                'string',
                'max:255',
            ]
        ]);
        $messages = $validatorResult->getMessageBag()->messages();
        if (!empty($messages)) {
            $result['errors'] = $messages;
        } else {
            $data = $validatorResult->getData();
            $task = Task::create($data);
            if (isset($task->id)) {
                $result = [
                    'id' => $task->id,
                    'title' => $task->title,
                    'description' => $task->description,
                    'status' => $task->status,
                ];
            } else {
                $result = [
                    'errors' => 'Ошибка выполнения запроса',
                ];
            }
        }
        return response()->json($result);
    }


    public function update(Task $task): JsonResponse
    {
        $validatorResult = Validator::make(request()->all(), [
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'status' => [
                'required',
                'string',
                'max:255',
            ]
        ]);
        $messages = $validatorResult->getMessageBag()->messages();
        if (!empty($messages)) {
            $result['errors'] = $messages;
        } else {
            $data = $validatorResult->getData();
            $task->update($data);

            if (!empty($task->id)) {
                $result = [
                    'id' => $task->id,
                    'title' => $task->title,
                    'description' => $task->description,
                    'status' => $task->status,
                ];
            } else {
                $result = [];
            }
        }
        return response()->json($result);
    }

    public function destroy(Task $task): JsonResponse
    {
        $task->delete();
        return response()->json(['status' => 'success']);
    }
}
