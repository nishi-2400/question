<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	//入力ガード
	protected $guarded = ['id'];

	//バリデーション
	public static $rules = [
		'user_id' => 'required',
		'title' => 'required',
		'category' => 'required',
		'body' => 'required'
	];

	//Usersテーブルとリレーション
	public function user()
	{
		return $this->belongsTo('App\User', 'user_id');
	}

	//Answersテーブルとリレーション
	public function answer()
	{
		return $this->hasMany('App\Answer', 'question_id');
	}

	//Commentsデーブルとリレーション
    public function comment()
    {
    	return $this->hasMany('App\Comment', 'question_id');
    }
}
