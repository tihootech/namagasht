<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionPointRule extends Model
{
    protected $guarded = ['id'];

    public function apply($filler, $answer)
    {
        switch ($this->type) {
            case '==': $result = $answer == $this->value; break;
            case '!=': $result = $answer != $this->value; break;
            case '<': $result = $answer < $this->value; break;
            case '>': $result = $answer > $this->value; break;
            case '>=': $result = $answer >= $this->value; break;
            case '<=': $result = $answer <= $this->value; break;
        }
        if ($result) {
            $points = $filler->points;
            switch ($this->action) {
                case '+': $points += $this->target; break;
                case '-': $points -= $this->target; break;
                case '*': $points *= $this->target; break;
                case '/': $points /= $this->target; break;
            }
            $filler->points = $points;
            $filler->save();
        }
    }
}
