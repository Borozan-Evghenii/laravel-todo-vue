<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function all()
    {
        $category = Category::all();
        return response()->json(["info" => ["message" => "All Category"], "results" => $category], 200);
    }

    public function create(Request $request)
    {

        try {
            $validate = $request->validate([
                'name' => 'required|string',
            ]);


            if ($validate) {
                Category::create($request->all());
                return response()->json(["info" => ["message" => "Category is added",], "results" => Category::all()], 200);
            }
        } catch (Exception $error) {
            return response()->json(["info" => ["message" => "Category is added"], "error" => $error->getMessage()], 500);
        }
    }

    public function getById($id)
    {
        $findedCategory = Category::find($id);

        if (!empty($findedCategory)) {
            return response()->json(["info" => ["message" => "Finded Category"], "results" => $findedCategory], 200);
        } else {
            return response()->json(["info" => ["message" => "Item not found"]], 404);
        }
    }

    public function update(Request $request, $id)
    {


        $findedCategory = Category::find($id);
        if (!empty($findedCategory)) {
            $findedCategory->name = is_null($request->name) ? $findedCategory->name :  $request->name;
            $findedCategory->save();

            return response()->json(["message" => ["message" => "Category is updated"], "results" => $findedCategory], 200);
        } else {
            return response()->json(["message" => "category is not found"], 404);
        }
    }
    public function delete($id)
    {
        $findedCategory = Category::find($id);

        if (!empty($findedCategory)) {

            $findedCategory->delete();

            return response()->json(["info" => ["message" => "Category is deleted"], "results" => $findedCategory], 200);
        } else {
            return response()->json(["info" => ["message" => "Category is not found"]], 404);
        }
    }
}
