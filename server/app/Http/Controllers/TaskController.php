<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $boardId = $request->boardId();

        $tasks = Task::where('user_id', $userId)
            ->where('board_id', $boardId)
            ->get();

        return response()->json($tasks);
      
    }

    public function store(Request $request)
    {
        $userId = $request->user()->id;
        $boardId = $request->boardId();

        $task = new task;
        $task->name = $request->name;


        $task->user_id = $userId;
        $task->board_id = $boardId;

        $task->save();
        return response()->json($task, 201);

    }

    public function show(Request $request, $id)
    {
        $userId = $request->user()->id;
        $boardId = $request->boardId();

        $task = Task::where('user_id', $userId)
        ->where('board_id', $boardId)
        ->find($id);

        if(!empty($task))
        {
            return response()->json($task);
        }
        else
        {
            return response()->json([
                "message" => "task not found"
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $userId = $request->user()->id;
        $boardId = $request->boardId();


        if (Task::where('user_id', $userId)
            ->where('board_id', $boardId)
            ->where('id', $id)
            ->exists()) {

            $task = tasks::find($id);
            $task->name = is_null($request->name) ? $task->name : $request->name;

            $task->save();
            return response()->json([
                "message" => "Task Updated."
            ], 404);
        }else{
            return response()->json([
                "message" => "Task Not Found."
            ], 404);
        }

    }

    public function destroy($id)
    {
        $userId = $request->user()->id;
        $boardId = $request->boardId();


        if(Task::where('user_id', $userId)
            ->where('board_id', $boardId)
            ->where('id', $id)->exists()) {
            $task = Task::find($id);
            $task->delete();

            return response()->json([
              "message" => "task deleted."
            ], 202);
        } else {
            return response()->json([
              "message" => "task not found."
            ], 404);
        }
      
    }
}
