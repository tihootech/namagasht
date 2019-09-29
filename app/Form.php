<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $guarded = ['id'];
    public static $filters = ['welcome_page', 'thanks_page', 'string_with_no_answer', 'group_question'];

    public function fillers()
    {
        return $this->hasMany(Filler::class);
    }

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

    public function all_questions()
    {
        return $this->hasMany(Question::class);
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
        $filler->client_ip = request()->getClientIp();
        $filler->device = isMobileDevice() ? 'mobile' : 'laptop';
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

    public function visits()
    {
        return Filler::where('form_id', $this->id)->count();
    }

    public function mobile_visits($type)
    {
        $count = Filler::where('form_id', $this->id)->where('device', 'mobile')->count();
        $percent = $this->visits() == 0 ? 0 : $count/$this->visits()*100;
        return $$type;
    }

    public function laptop_visits($type)
    {
        $count = Filler::where('form_id', $this->id)->where('device', 'laptop')->count();
        $percent = $this->visits() == 0 ? 0 : $count/$this->visits()*100;
        return $$type;
    }

    public function answers()
    {
        return Filler::where('form_id', $this->id)->whereNotNull('finished_at')->count();
    }

    public function ratio()
    {
        return $this->visits() == 0 ? 0 : $this->answers()/$this->visits()*100;
    }

    public function answer_average_time()
    {
        $ave = round(Filler::where('form_id', $this->id)->whereNotNull('time')->avg('time'));
        return gmdate("i:s", $ave);
    }

    public function update_points($filler)
    {
        foreach ($this->questions as $question) {
            if ($question->rules->count()) {
                $raw_answer = $question->raw_answer($filler->uid);
                if ($raw_answer) {
                    foreach ($question->rules as $rule) {
                        $rule->apply($filler, $raw_answer);
                    }
                }
            }
        }
    }
}
