<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificiationResource;
use Illuminate\Notifications\HasDatabaseNotifications;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

//use Tymon\JWTAuth\Contracts\Providers\Auth;
class notificationcontroller extends Controller
{
	 public function __construct()
    {
        $this->middleware('JWT');
    }
	public function index()
	{
		return [
			'read' => NotificiationResource::collection(auth()->user()->readNotifications()->get()),
			'unread' => NotificiationResource::collection(auth()->user()->unreadNotifications()->get()),
		];
	}
	public function markAsRead(Request $request)
	{
		auth()->user()->notifications->where('id', $request->id)->markAsRead();
	}
}
