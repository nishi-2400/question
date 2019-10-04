<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Question;
use App\Answer;
use Validator;


class TopController extends Controller
{
    public function top()
    {
    	return view('top');
    }

    public function account(Request $request)
    {
        //バリデーション
        $messages = [
            'id.required' => 'ログインしていません。'
        ];

        $rules = [
            'id' => 'required'
        ];

        $validator = Validator::make($request->query(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('/top')->withErrors($validator);
        }
        
        //アカウント情報の取得
    	$user_id = $request->id;
    	$user = User::find($user_id);
        $questions = Question::where('user_id', $user_id)->get();
        $answers = Answer::where('user_id', $user_id)->get();

    	return view('account', ['user' => $user, 'questions' => $questions, 'answers' => $answers]);
    }
}
