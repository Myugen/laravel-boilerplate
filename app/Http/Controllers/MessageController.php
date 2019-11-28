<?php

namespace App\Http\Controllers;

use App\Message;
use App\Notification;
use App\Receiver;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    private $headers = ["Content-Type" => "application/json;charset=utf-8"];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return reponse(Message::all(), Response::HTTP_OK)->withHeaders($this->headers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = new Message();
        $message->title = $request->title;
        $message->body = $request->body;
        $message->save();
        return response($message, Response::HTTP_CREATED)->withHeaders($this->headers);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::find($id);
        if (!isset($message)) {
            return response(null, Response::HTTP_NOT_FOUND)->withHeaders($this->headers);
        }
        return response($message, Response::HTTP_OK)->withHeaders($this->headers);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $message = Message::find($id);
        if (!isset($message)) {
            return response(null, Response::HTTP_NOT_FOUND)->withHeaders($this->headers);
        }
        $message->title = $request->title;
        $message->body = $request->body;
        $message->save();
        return response($message, Response::HTTP_OK)->withHeaders($this->headers);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display a listing of message notificacions
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function notifications($id)
    {
        $notificacions = Notification::where('message_fk', $id)->get();
        return response($notificacions, Response::HTTP_OK)->withHeaders($this->headers);
    }

    public function summary($id)
    {
        $notifications = Notification::query()->select(DB::raw("channel,
            count(*) filter(where state = 'SUCCESS') as success,
            count(*) filter(where state = 'FAILED') as failed"))
            ->where('message_fk', $id)
            ->groupBy('channel')
            ->get()
            ->map(function($notification) {
                return [$notification['channel']->value => [
                    'success' => $notification['success'],
                    'failed' => $notification['failed']
                ]];
            });

        return response($notifications, Response::HTTP_OK)->withHeaders($this->headers);
    }
}
