<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $guarded = ['id'];
    public static $filters = ['welcome_page', 'thanks_page', 'string_with_no_answer', 'group_question'];

    public function welcome_page()
    {
        return $this->hasOne(Question::class)->where('type','welcome_page');
    }

    public function has_welcome_page()
    {
        return $this->welcome_page ? true : false;
    }

    public function thanks_page()
    {
        return $this->hasOne(Question::class)->where('type','thanks_page');
    }

    public function has_thanks_page()
    {
        return $this->thanks_page ? true : false;
    }

    public function first_question()
    {
        return $this->hasOne(Question::class)->where('position', 1);
    }

    public function questions()
    {
        return $this->hasMany(Question::class)->where('type','!=','welcome_page')->where('type','!=','thanks_page')->orderBy('position');
    }

    public function questions_count()
    {
        return Question::where('form_id', $this->id)->whereNotIn('type', self::$filters)->count();
    }

    public function add_filler()
    {
        $filler = new Filler;
        $filler->uid = random_sha();
        $filler->form_id = $this->id;
        $filler->save();
        return $filler;
    }

    public function sort_questions_position()
    {
        foreach ($this->questions as $i => $question) {
            $question->position = $i+1;
            $question->save();
        }
    }
}
