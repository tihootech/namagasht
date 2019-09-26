<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionAsset extends Model
{
	public function question()
	{
		return $this->belongsTo(Question::class);
	}

    public function is_checked($filler_uid)
    {
    	$raw_answer = $this->question->raw_answer($filler_uid) ?? null;
		if ($raw_answer) {
			$answers = explode('&&&', $raw_answer);
			return in_array($this->content, $answers);
		}else {
			return false;
		}
    }
}
