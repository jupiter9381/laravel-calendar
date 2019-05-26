<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    public function payrolls(){
        return $this->hasMany('App\Payroll');
    }
}
