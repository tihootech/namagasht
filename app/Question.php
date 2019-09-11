<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = ['id'];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function register_answer($filler_id, $body)
    {
        $answer = Answer::where('question_id', $this->id)->where('filler_id', $filler_id)->first();
        if (!$answer) {
            $answer = new Answer;
            $answer->filler_id = $filler_id;
            $answer->question_id = $this->id;
        }
        $answer->body = $body;
        $answer->save();
        return $answer;
    }

    public function raw_answer($filler_uid)
    {
        $filler = Filler::where('uid', $filler_uid)->first();
        $answer = $filler ? Answer::where('filler_id', $filler->id)->where('question_id', $this->id)->first() : null;
        return $answer->body ?? null;
    }

    public function next()
    {
        $found = self::where('form_id', $this->form_id)->where('position', $this->position+1)->first();
        return $found ?? $this->form->thanks_page;
    }

    public function prev()
    {
        return self::where('form_id', $this->form_id)->where('position', $this->position-1)->where('type', '!=', 'welcome_page')->first();
    }

    public function step()
    {
        return self::where('form_id', $this->form_id)->whereNotIn('type', Form::$filters)->where('position', '<', $this->position)->count();
    }
}
