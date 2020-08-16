<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Model\Category;
use App\Model\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['index', 'show']]);
    } 

    public function index()
    {
        return QuestionResource::collection(Question::latest()->get());
    }

    public function store(Request $request)
    {
         $v1 = Validator::make($request->all(), [
            'title' => 'required|string',
            'body' => 'required',
            'category_id' => 'required'
        ]);
        if ($v1->fails()) {
            return response()->json([
                "status" => "error",
                "errors" => $v1->errors()
            ], 422);
        }
        $question = Question::create([ 
           'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'user_id' => auth()->id(),
            'body' => $request->body,
            'category_id' => $request->category_id]);
        return response()->json(new QuestionResource($question), 201);
    }
    public function show(Question $question)
    {
        return new QuestionResource($question);
    }

    public function update(Request $request, Question $question)
    {
          $question->update($request->all());
        $question->update(['slug' => Str::slug($request->title, '-')]);
        $question->save();
        return response()->json(new QuestionResource($question), 200);
    }



    public function destroy(Question $question)
    {
        $question->delete();
        return response()->json(["message" => "the question with id: $question->id deleted"], 200);
    }
}
