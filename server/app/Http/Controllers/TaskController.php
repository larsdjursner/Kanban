<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $storyId = $request->storyId;

        $tasks = Task::where('user_id', $userId)
            ->where('story_id', $storyId)
            ->get();

        return response()->json($tasks);

        return null;
      
    }

    public function store(Request $request)
    {
        $userId = $request->user()->id;
        $storyId = $request->storyId;

        $story = Story::where('id', $storyId)->get();
        if($story->isEmpty())
        {
            return response()->json([
                "message" => "Story does not exist"
            ], 404);
        }

        $task = new task;

        $task->name = $request->name;
        $task->completed = $request->completed;

        $task->user_id = $userId;
        $task->story_id = $storyId;
        // If subtask
        $task->task_id = $request->task_id ? $request->task_id : null;

        $task->save();
        return response()->json($task, 201);

    }

    public function show(Request $request, $id)
    {
        $userId = $request->user()->id;
        $storyId = $request->storyId;

        $task = Task::where('user_id', $userId)
            ->where('story_id', $storyId)
            ->find($id);

        $subtasks = Task::where('task_id', $id)
            ->get();
        
        if($subtasks) {
            $task->subtasks = $subtasks;
        }

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
        $storyId = $request->storyId;

        if (Task::where('user_id', $userId)
            ->where('story_id', $storyId)
            ->where('id', $id)
            ->exists()) {

            $task = tasks::find($id);

            $task->name = is_null($request->name) ? $task->name : $request->name;
            $task->completed = is_null($request->completed) ? $task->completed : $request->completed;
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
        $storyId = $request->storyId;

        if(Task::where('user_id', $userId)
            ->where('story_id', $storyId)
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
