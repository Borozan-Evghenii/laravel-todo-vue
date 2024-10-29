<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Exception;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function all(Request $request)
    {
        $categoryId = $request->query('categoryId');
        $completed = $request->query('completed');

        if ($categoryId && $completed) {
            $filtered = Task::where('categoryId', $categoryId)->where('completed', $completed)->get();
            return response()->json(["info" => ["message" => "Filtered by Category and Completed"], "results" => $filtered], 200);
        }
        if (!empty($categoryId)) {
            $filtered = Task::where('categoryId', $categoryId)->get();
            return response()->json(["info" => ["message" => "Filtered by Category"], "results" => $filtered], 200);
        }
        if (!empty($completed)) {
            $filtered = Task::where('completed', $completed)->get();
            return response()->json(["info" => ["message" => "Filtered by Completed"], "results" => $filtered], 200);
        }

        $tasks = Task::all();

        return response()->json(["info" => ["message" => "TTasks List"], "results" => $tasks], 200);
    }

    public function create(Request $request)
    {

        try {

            $request->validate([
                'title' => 'required|string',
                'categoryId' => 'required|integer|exists:categories,id',
            ]);

            Task::create($request->all());


            return response()->json(["info" => ["message" => "Task is Created"], "results" => Task::all()], 200);
        } catch (Exception $error) {

            return response()->json([
                "info" => ["message" => "Invalide fields"],
                "error" => $error->getMessage()
            ], 500);
        }
    }

    public function getById($id)
    {
        $findedTask = Task::find($id);

        if (!empty($findedTask)) {
            return response()->json(["info" => ["message" => "Finded Task"], "results" => $findedTask], 200);
        } else {
            return response()->json(["info" => ["message" => "Item not found"]], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $findedTask = Task::find($id);
        if (!empty($findedTask)) {
            $findedTask->title = is_null($request->title) ? $findedTask->title :  $request->title;
            $findedTask->completed = is_null($request->completed) ? $findedTask->completed : $request->completed;
            $findedTask->save();

            return response()->json(["message" => ["message" => "Item is updated"], "results" => $findedTask], 200);
        } else {
            return response()->json(["message" => "Item not found"], 404);
        }
    }
    public function delete($id)
    {
        $findedTask = Task::find($id);
        if (!empty($findedTask)) {
            $findedTask->delete();
            return response()->json(["info" => ["message" => "Item is deleted"], "results" => $findedTask], 200);
        } else {
            return response()->json(["info" => ["message" => "Item not found"]], 404);
        }
    }
}
