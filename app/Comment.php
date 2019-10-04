<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //入力ガード
	protected $guarded = ['id'];

	//バリデーション
	public static $rules = [
		'user_id' => 'required',
		'question_id' => 'required',
		'answer_id' => 'required',
		'body' => 'required'
	];

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

	//Answersテーブルとリレーション
	public function answer()
	{
		return $this->belongsTo('App\Answer', 'answer_id');
	}
}
