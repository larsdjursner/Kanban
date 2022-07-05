<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Boards;

class BoardController extends Controller
{
    public function index()
    {
        $boards = Boards::all();
        return response()->json($boards);
    }

    public function store(Request $request)
    {
        $board = new Boards;
        $board->name = $request->name;
        $board->description = $request->description;
        $board->save();
        return response()->json($board, 201);
    }

    public function show($id)
    {
        $board = Boards::find($id);
        if(!empty($board))
        {
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
        if (Boards::where('id', $id)->exists()) {
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

    public function destroy($id)
    {
        if(Boards::where('id', $id)->exists()) {
            $board = Boards::find($id);
            $board->delete();

            return response()->json([
              "message" => "records deleted."
            ], 202);
        } else {
            return response()->json([
              "message" => "board not found."
            ], 404);
        }
    }
}