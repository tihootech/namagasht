<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $guarded = ['id'];

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

    public function questions()
    {
        return $this->hasMany(Question::class)->where('type','!=','welcome_page')->where('type','!=','thanks_page');
    }
}
