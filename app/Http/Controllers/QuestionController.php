<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\User;
use App\Answer;
use App\Comment;


class QuestionController extends Controller
{
    //質問ページ
    public function question(Request $request)
    {
    	
        //質問一覧表示
        $questions = Question::all();
    	return view('/question', ['questions' => $questions]);
    }

    public function questionPost(Request $request)
    {
    	//バリデーション実行
    	$this->validate($request, Question::$rules);

        //質問保存
    	$question = new Question();
    	$question->user_id = $request->user_id;
    	$question->title = $request->title;
        $question->category = $request->category;
    	$question->body = $request->body;
        $question->status = $request->status;
    	$question->save();

    	return redirect('/question');
    }

    //質問詳細ページ
    public function detail(Request $request)
    {
        $question_id = $request->id;

        //質問詳細を取得
        $question = Question::find($question_id);

        //回答詳細を取得
        $answers = Answer::where('question_id', $question_id)->get();

        //コメント詳細を取得
        $comments = Comment::where('question_id', $question_id)->get();

        return view('/q-detail', ['question' => $question, 'answers' => $answers, 'comments' => $comments]);
    }

    public function post(Request $request)
    {
        //回答の投稿があった場合
        if($request->submit == 'answer'){
            //バリデーション実行
            $this->validate($request, Answer::$rules);

            //回答を保存
            $answer = new Answer();
            $answer->user_id = $request->user_id;
            $answer->question_id = $request->question_id;
            $answer->title = $request->title;
            $answer->body = $request->body;
            $answer->save();

            return back();
        }
        
        //コメントの投稿があった場合
        if($request->submit == 'comment') {
            //バリデーション実行
            $this->validate($request, Comment::$rules);
            //コメントを保存
            $comment = new Comment();
            $comment->user_id = $request->user_id;
            $comment->question_id = $request->question_id;
            $comment->answer_id = $request->answer_id;
            $comment->body = $request->body;
            $comment->save();

            return back();
        }        
    }
}
