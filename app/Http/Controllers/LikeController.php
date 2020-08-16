<?php

namespace App\Http\Controllers;

use App\Model\Reply;
use Illuminate\Http\Request;
use App\Model\Like;
use App\Events\LikeEvent;
class LikeController extends Controller
{

    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['like', 'destroy']]);
    }
    public function like(Reply $reply)
    {
        $reply->likes()->create([
            'user_id' => auth()->id()
        ]);
        // $reply->like()->
        broadcast(new LikeEvent($reply->id,1))->toOthers();
    }

    public function show($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy(Reply $reply)
    {
        //  $reply->likes()->where('user_id', auth()->id())->first()->delete();         
        $reply->likes()->where('user_id', auth()->id())->first()->delete();
        broadcast(new LikeEvent($reply->id,0))->toOthers();
    }
}
