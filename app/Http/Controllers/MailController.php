<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\PayrollConfirmation;
use Mail;
use App\Payroll;
use App\Employee;

class MailController extends Controller
{
    //
    public $payroll_id;
    public $employee_id;

    public function __construct($payroll_id, $employee_id)
    {
        $this->payroll_id = $payroll_id;
        $this->employee_id = $employee_id;
    }

    public function send(){
    	$payroll = Payroll::find($this->payroll_id);
        $employee = Employee::find($this->employee_id);
    	Mail::to($employee->email)->send(new PayrollConfirmation($payroll));
    	return response()->json("Hello world");
    }
}
