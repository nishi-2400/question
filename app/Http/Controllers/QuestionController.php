<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest;
use App\Http\Requests\PostRequest;
use App\Question;
use App\User;
use App\Answer;
use App\Comment;
use Log;


class QuestionController extends Controller
{
    //Topを表示
    public function top()
    {
        return view('top');
    }

    //質問ページ
    public function question(Request $request)
    {
        //質問表示(ページネーション)
        $questions = Question::orderBy('created_at', 'desc')->simplepaginate(5);
        return view('/question', ['questions' => $questions]);
    }

    //質問投稿
    public function questionPost(QuestionRequest $request)
    {
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

    //質問編集
    public function questionForm(Request $request)
    {
        $question = Question::find($request->id);
        if(isset($request->msg)){
            return view('questionForm', ['question' => $question, 'msg' =>$request->msg]);
        }
        return view('questionForm', ['question' => $question, 'from' => $request->from]);
    }
    
    //質問更新
    public function questionEdit(QuestionRequest $request)
    {
        $question = Question::find($request->id);
        $question->title = $request->title;
        $question->category = $request->category;
        $question->body = $request->body;
        $question->status = $request->status;
        $question->save();
        
        return redirect()->route('questionForm', ['id' => $question->id, 'msg' => '※※質問を更新しました※※']);
    }

    //質問詳細ページ
    public function detail(Request $request)
    {
        $question_id = $request->id;

        //質問詳細を取得
        $question = Question::find($question_id);
        $question->body = str_replace("\r\n", '<br>', $question->body);

        //回答詳細を取得
        $answers = Answer::where('question_id', $question_id)->get();
        
        Log::debug($answers);
        //アンサーの有り ＋ ベストアンサー有り
        if(count($answers) > 0 && isset($request->bestAnswer)) { //.length
            //アンサーのステータス更新
            $bestAnswer_id = $request->bestAnswer;
            $bestAnswer = Answer::find($bestAnswer_id);
            $bestAnswer->status = 2;
            $bestAnswer->save();

            //コメント詳細を取得
            $comments = Comment::where('question_id', $question_id)->get();

            //質問のステータス更新
            $question->status = 2;
            $question->save();
            return view('q-detail', ['question' => $question, 'answers' => $answers, 'comments' => $comments]);

        //アンサーの有り ＋ ベストアンサーリセット有り
        } elseif(count($answers) > 0 && isset($request->bestAnswerReset)) {
            //アンサーステータスのリセット
            $bestAnswerReset_id = $request->bestAnswerReset;
            $bestAnswerReset = Answer::find($bestAnswerReset_id);
            $bestAnswerReset->status = 1;
            $bestAnswerReset->save();

            //コメント詳細を取得
            $comments = Comment::where('question_id', $question_id)->get();

            //質問のステータス更新
            $question->status = 1;
            $question->save();
            return view('q-detail', ['question' => $question, 'answers' => $answers, 'comments' => $comments]);

        //　アンサーの有り + ベストアンサー未選択
        } elseif(count($answers) > 0) {
            //コメント詳細を取得
            $comments = Comment::where('question_id', $question_id)->get();
            return view('q-detail', ['question' => $question, 'answers' => $answers, 'comments' => $comments]);

        //回答無し
        } else {
            return view('q-detail', ['question' => $question]);
        }
    }

    //回答・コメントの投稿処理
    public function post(PostRequest $request)
    {
        //回答の投稿があった場合
        if($request->submit == '回答'){
            //回答を保存
            $answer = new Answer();
            $answer->user_id = $request->user_id;
            $answer->question_id = $request->question_id;
            $answer->title = $request->title;
            $answer->body = $request->body;
            $answer->status = $request->status;
            $answer->save();

            return back();
        }
        
        //コメントの投稿があった場合
        if($request->submit == 'コメント') {
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

    //質問検索
    public function search()
    {
        $questions = Question::orderBy('created_at', 'desc')->simplepaginate(10);
        return view('questionSearch', ['questions' => $questions]);
    }

    public function result(Request $request)
    {
        $keyword = $request->search;
        $questions = Question::where('title', 'like', '%'.$keyword.'%')->orWhere('category', 'like', '%'.$keyword.'%')->orderBy('created_at', 'desc')->simplepaginate(10);

        return view('questionSearch', ['questions' => $questions]);
    }

    //質問削除
    public function delete(Request $request)
    {
        $question = Question::find($request->id);
        return view('questionDelete', ['question' => $question, 'msg' => 'この質問を削除しますか？']);
    }

    public function remove(Request $request)
    {
        Question::find($request->id)->delete();
        $user = User::find(auth()->id());
        return redirect()->route('account', ['id' => $user->id]);
    }
}
