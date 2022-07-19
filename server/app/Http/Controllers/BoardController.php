<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Boards;
use App\Models\Task;

class BoardController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $boards = Boards::where('user_id', $userId)->get();

        return response()->json($boards);
    }

    public function store(Request $request)
    {
        $userId = $request->user()->id;

        $board = new Boards;
        $board->name = $request->name;
        $board->description = $request->description;
        $board->user_id = $userId;

        $board->save();
        return response()->json($board, 201);
    }

    public function show(Request $request, $id)
    {
        $userId = $request->user()->id;

        $board = Boards::where('user_id', $userId)->find($id);
        if(!empty($board))
        {
            $stories = Story::where('user_id', $userId)
                ->where('board_id', $board->id)
                ->get();

            $board->stories = $stories;

            return response()->json($board);
        }
        else
        {
           
            return response()->json([
                "message" => "board not found"
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $userId = $request->user()->id;

        if (Boards::where('user_id', $userId)->where('id', $id)->exists()) {
            $board = Boards::find($id);
            $board->name = is_null($request->name) ? $board->name : $request->name;
            $board->description = is_null($request->description) ? $board->description : $request->description;
            $board->save();
            return response()->json([
                "message" => "Board Updated."
            ], 404);
        }else{
            return response()->json([
                "message" => "Board Not Found."
            ], 404);
        }
    }

    public function destroy(Request $request, $id)
    {
        $userId = $request->user()->id;

        if(Boards::where('user_id', $userId)->where('id', $id)->exists()) {
            $board = Boards::find($id);
            $board->delete();

            return response()->json([
              "message" => "board deleted."
            ], 202);
        } else {
            return response()->json([
              "message" => "board not found."
            ], 404);
        }
    }
}