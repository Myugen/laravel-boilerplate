<?php

namespace App\Http\Controllers;

use App\Receiver;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReceiverController extends Controller
{
    private $headers = ["Content-Type" => "application/json;charset=utf-8"];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return reponse(Receiver::all(), Response::HTTP_OK)->withHeaders($this->headers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $receiver = new Receiver();
        $receiver->name = $request->name;
        $receiver->surname = $request->surname;
        $receiver->email = $request->email;
        $receiver->telephone_number = $request->telephone_number;
        $receiver->telegram_account = $request->telegram_account;
        $receiver->save();
        return response($receiver, Response::HTTP_CREATED)->withHeaders($this->headers);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $receiver = Receiver::find("id", $id);
        if (!isset($receiver)) {
            return response(null, Response::HTTP_NOT_FOUND)->withHeaders($this->headers);
        }
        return response($receiver, Response::HTTP_OK)->withHeaders($this->headers);
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
        $receiver = Receiver::find("id", $id);
        if (!isset($receiver)) {
            return response(null, Response::HTTP_NOT_FOUND)->withHeaders($this->headers);
        }
        $receiver->name = $request->name;
        $receiver->surname = $request->surname;
        $receiver->email = $request->email;
        $receiver->telephone_number = $request->telephone_number;
        $receiver->telegram_account = $request->telegram_account;
        $receiver->save();
        return response($receiver, Response::HTTP_OK)->withHeaders($this->headers);
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
}
