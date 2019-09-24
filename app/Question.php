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

    public function rules()
    {
        return $this->hasMany(QuestionPointRule::class);
    }

    public function assets()
    {
        $output = $this->hasMany(QuestionAsset::class);
        if ($this->randomize) {
            $output = $output->inRandomOrder();
        }elseif ($this->alphabet) {
            $output = $output->orderBy('content');
        }else {
            $output = $output->orderBy('position');
        }
        return $output;
    }

    public function assets_count_or_two()
    {
        $count = $this->assets->count();
        return $count > 2 ? $count : 2;
    }

    public function list_text()
    {
        if ($this->type == 'list') {
            $assets = QuestionAsset::where('question_id', $this->id)->orderBy('position')->pluck('content')->toArray();
            return implode("\r\n", $assets);
        }else {
            return null;
        }
    }

    public function range_end()
    {
        return $this->range ? ($this->zero_based ? $this->range-1 : $this->range) : 5;
    }

    public function range_start()
    {
        return $this->zero_based ? 0 : 1;
    }

    public function range_middle()
    {
        return $this->range ? ($this->range%2 == 0 ? null : ($this->range+1)/2) : 3 ;
    }

    public function get_asset_content($position)
    {
        $asset = QuestionAsset::where('question_id', $this->id)->where('position', $position)->first();
        return $asset ? $asset->content : null;
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

    public function update_choices($choices, $files=[])
    {
        // first delete all question assets and files if any
        foreach ($this->assets as $asset) {
            delete_file($asset->image_path);
            $asset->delete();
        }
        // store new choices
        foreach ($choices as $i => $choice) {
            $asset = New QuestionAsset;
            $asset->question_id = $this->id;
            $asset->position = $i+1;
            $asset->content = $choice;
            if (isset($files[$i])) {
                $asset->file_path = upload($files[$i]);
            }
            $asset->save();
        }
    }

    public function raw_answer($filler_uid)
    {
        $filler = Filler::where('uid', $filler_uid)->first();
        $answer = $filler ? Answer::where('filler_id', $filler->id)->where('question_id', $this->id)->first() : null;
        return $answer->body ?? null;
    }

    public function last()
    {
        return $this->position == self::where('form_id', $this->form_id)->max('position');
    }

    public function next()
    {
        if ($this->type == 'thanks_page') {
            return null;
        }else {
            $found = self::where('form_id', $this->form_id)->where('position', $this->position+1)->first();
            return $found ?? $this->form->thanks_page;
        }
    }

    public function prev()
    {
        return self::where('form_id', $this->form_id)->where('position', $this->position-1)->where('type', '!=', 'welcome_page')->first();
    }

    public function step()
    {
        if ($this->type == 'thanks_page') {
            return $this->form->questions_count();
        }else {
            return self::where('form_id', $this->form_id)->whereNotIn('type', Form::$filters)->where('position', '<', $this->position)->count();
        }
    }
}
