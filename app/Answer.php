<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

    //入力ガード
	protected $guarded = ['id'];

	//アンサーのステータスリスト
	private static $answerStatus = [1 => 'ノーマル', 2 => 'ベストアンサー'];


	//バリデーション
	public static $rules = [
		'user_id' => 'required',
		'question_id' => 'required',
		'title' => 'required',
		'body' => 'required'
	];

	//ステータスゲッター
	public function getAnswerStatus()
    {
        return self::$answerStatus[$this->status];
    }

	//Usersテーブルとリレーション
	public function user()
	{
		return $this->belongsTo('App\User', 'user_id');
	}

	//Questionsテーブルとリレーション
    public function question()
    {
        return $this->belongsTo('App\Question', 'question_id');
    }

    //Commentsデーブルとリレーション
    public function comment()
    {
    	return $this->hasMany('App\Comment', 'answer_id');
    }
}
