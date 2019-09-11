<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filler extends Model
{
    public function finish()
    {
    	$this->finished = true;
		$this->save();
    }
}
