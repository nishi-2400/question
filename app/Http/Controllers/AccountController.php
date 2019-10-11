<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AccountRequest;
use App\User;
use App\Question;
use App\Answer;

class AccountController extends Controller
{
    public function __construct()
    {
        //Auth認証
        $this->middleware('auth');
    }

    //アカウント情報表示
    public function account(Request $request)
    {   
        //アカウント情報の取得
        $user = User::find(auth()->id());

        //質問履歴
        if(isset($request->questionSort)) {
            $question_sort = $request->questionSort;
            $questions = Question::where('user_id', auth()->id())->orderBy($question_sort, 'desc')->simplepaginate(5);
        } else {
            $question_sort = 'id';
            $questions = Question::where('user_id', auth()->id())->orderBy($question_sort, 'desc')->simplepaginate(5);
        }
        
        //回答履歴
        if (isset($request->answerSort)) {
            $answer_sort = $request->answerSort;
            $answers = Answer::where('user_id', auth()->id())->orderBy($answer_sort, 'desc')->simplepaginate(5);
        } else {
            $answer_sort = 'id';
            $answers = Answer::where('user_id', auth()->id())->orderBy($answer_sort, 'desc')->simplepaginate(5);
        }
        return view('account', ['user' => $user, 'questions' => $questions, 'answers' => $answers, 'question_sort' => $question_sort, 'answer_sort' => $answer_sort]);
    }
    
    public function accountForm()
    {
        //アカウント編集フォーム
        $user = User::find(auth()->id());
        return view('accountForm', ['user' => $user]);
    }
    
    public function accountEdit(AccountRequest $request)
    {
        //アカウント更新
        $user = User::find(auth()->id());
        $user->name = $request->name;
        $user->email = $request->mail;
        $user->password = $request->password;
        $user->save();
        
        return redirect()->route('account', ['id' => $user->id]);
    }
}
