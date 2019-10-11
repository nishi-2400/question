<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	//入力ガード
	protected $guarded = ['id'];

	//質問のステータスリスト
	private static $questionStatus = [1 => '質問中', 2 => '解決済み'];

	//ステータスゲッター
	public function getquestionStatus()
    {
        return self::$questionStatus[$this->status];
    }

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
