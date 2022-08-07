<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;
use App\Models\Boards;
use App\Models\Task;


class StoryController extends Controller
{
    
    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $boardId = $request->boardId;

        $stories = Story::where('user_id', $userId)
            ->where('board_id', $boardId)
            ->get();

        // Better solution for this?
        foreach ($stories as $story) {
            $tasks = Task::where('user_id', $userId)
            ->where('story_id', $story->id)
            ->get();

            $story->tasks = $tasks;
        }

        return response()->json($stories);

        return null;
      
    }

    public function store(Request $request)
    {
        $userId = $request->user()->id;
        $boardId = $request->boardId;

        $board = Boards::where('id', $boardId)->get();
        if($board->isEmpty())
        {
            return response()->json([
                "message" => "Board does not exist"
            ], 404);
        }

        $story = new Story;
        $story->name = $request->name;

        $story->user_id = $userId;
        $story->board_id = $boardId;

        $story->save();
        return response()->json($story, 201);

    }

    public function show(Request $request, $id)
    {
        $userId = $request->user()->id;
        $boardId = $request->boardId;

        $story = Story::where('user_id', $userId)
        ->where('board_id', $boardId)
        ->find($id);

        if(!empty($story))
        {
            $tasks = Task::where('user_id', $userId)
                ->where('story_id', $story->id)
                ->get();

            $story->tasks = $tasks;
                
            return response()->json($story);
        }
        else
        {
            return response()->json([
                "message" => "story not found"
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $userId = $request->user()->id;
        $boardId = $request->boardId;


        if (Story::where('user_id', $userId)
            ->where('board_id', $boardId)
            ->where('id', $id)
            ->exists()) {

            $story = Story::find($id);
            $story->name = is_null($request->name) ? $story->name : $request->name;

            $story->save();
            return response()->json([
                "message" => "story Updated."
            ], 404);
        }else{
            return response()->json([
                "message" => "story Not Found."
            ], 404);
        }

    }

    public function destroy(Request $request, $id)
    {
        $userId = $request->user()->id;
        $boardId = $request->boardId;


        if(Story::where('user_id', $userId)
            ->where('board_id', $boardId)
            ->where('id', $id)->exists()) {
            $story = Story::find($id);
            $story->delete();

            return response()->json([
              "message" => "story deleted."
            ], 202);
        } else {
            return response()->json([
              "message" => "story not found."
            ], 404);
        }
      
    }
}
