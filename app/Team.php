<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    //
    public function shifts()
    {
        return $this->hasMany('App\Shift');
    }
    public function roasters()
    {
        return $this->hasMany('App\Roaster');
    }
}
