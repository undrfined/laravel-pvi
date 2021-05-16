<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Gamer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'login' => 'required|email|min:6|max:64|regex:/^\S+@\S+$/',
            'password' => 'required|min:6|max:32|regex:/[a-zA-Z0-9]+/'
        ]);

        if ($validator->fails()) {
            return ['ok' => false, 'messages' => $validator->messages()];
        }

        return ['ok' => true, "avatar" => "https://i.stack.imgur.com/dr5qp.jpg"];
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|email|min:6|max:64|regex:/^\S+@\S+$/',
            'password' => 'required|min:6|max:32|regex:/[a-zA-Z0-9]+/',
            'gender' => 'required|in:female,male',
            'bio' => 'max:200',
            'skillLevel' => 'required|in:beginner,pro,intermediate'
        ]);

        if ($validator->fails()) {
            return ['ok' => false, 'messages' => $validator->messages()];
        }

        if(Gamer::firstWhere('email', $request->input("login")) {
            return ['ok' => false, 'messages' => [ "a" => "email is taken" ]];
        }

        $gamer = Gamer::create([
            'name' => $request->input("login"),
            'email' => $request->input("login"),
            'gender' => $request->input("gender"),
            'bio' => $request->input("bio"),
            'skill' => $request->input("skillLevel"),
            'password' => $request->input("password"),
        ]);

        $gamer->save();

        return ['ok' => true, "avatar" => "https://i.stack.imgur.com/dr5qp.jpg", $gamer];
    }
}
