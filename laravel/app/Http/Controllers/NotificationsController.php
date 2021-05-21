<?php

namespace App\Http\Controllers;

use App\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
Use Auth;

class NotificationsController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        return view('notifications');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function unread()
    {
        return view('unreadNotifications');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notifications  $notifications
     * @return \Illuminate\Http\Response
     */
    public function show(Notifications $notifications)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notifications  $notifications
     * @return \Illuminate\Http\Response
     */
    public function edit(Notifications $notifications)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notifications  $notifications
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notifications $notifications)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notifications  $notifications
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notifications $notifications)
    {
        //
    }

    public function markAsRead(Request $request)
    {


        $id = Input::get('id');
        echo("<script>console.log('PHP: ".$id."');</script>");
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        return redirect()->back();
        
    }

    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
   
}
