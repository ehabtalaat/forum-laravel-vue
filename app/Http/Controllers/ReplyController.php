<?php

namespace App\Http\Controllers;

use App\Model\Question;
use App\Model\Reply;
use Illuminate\Http\Request;
use App\Http\Resources\ReplyResource;
use App\Notifications\newReplyNotification;
use App\Events\DeleteReplyEvent;
class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['index', 'show']]);
    }
    public function index(Question $question)
    {

        return ReplyResource::collection($question->replies()->get());
    }

    public function store(Question $question, Request $request)
    {
        $reply = $question->replies()->create($request->all());
        $user = $question->user;
        if($reply->user_id !== $question->user_id){
              $user->notify(new newReplyNotification($reply));
        }
      
        return response()->json(['reply' => new ReplyResource($reply)], 201);
    }

    public function show(Question $question, Reply $reply)
    {
        return new ReplyResource($reply);
    }
    public function update(Question $question, Request $request, Reply $reply)
    {
        $reply->update($request->all());
        return response()->json(['message' => 'the reply just updated'], 200);
    }

    public function destroy(Question $question, Reply $reply)
    {
        $reply->delete();
          broadcast(new DeleteReplyEvent($reply->id))->toOthers();
        return response()->json(["message" => "the reply is  deleted"], 200);
    }
}
