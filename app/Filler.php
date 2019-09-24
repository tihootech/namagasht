<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Filler extends Model
{
    protected $dates = ['created_at', 'updated_at', 'finished_at'];

    public function finish()
    {
        $now = Carbon::now();
        $this->time = $now->diffInSeconds($this->created_at);
    	$this->finished_at = $now;
		$this->save();
    }
}
