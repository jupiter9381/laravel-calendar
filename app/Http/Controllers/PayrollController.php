<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Payroll;

use App\Http\Controllers\MailController;
use Mail;
use DB;
use Auth;

class PayrollController extends Controller
{
    //
    public function index(){
        if(!Auth::user()){
            return redirect('/signin');
        }
    	$employees = Employee::where('auth_type', '1')->get();
    	$payrolls = Payroll::all();
    	return view('payroll', compact('employees', 'payrolls'));
    }

    public function add(Request $request){

    	$payroll = new Payroll;
    	$payroll->employee_id = $request->input('employee_id');
    	$payroll->month = $request->input('month');
        $payroll->type = $request->input('type');
    	$payroll->working_hours = $request->input('working_hours');
    	$payroll->saturday_hours = $request->input('saturday_hours');
    	$payroll->sunday_hours = $request->input('sunday_hours');
    	$payroll->night_hours = $request->input('night_hours');
    	$payroll->feast_hours = $request->input('feast_hours');
    	$payroll->total_amount = $request->input('total_amount');
    	$payroll->note = $request->input('note');
    	$payroll->status = "Draft";
    	$payroll->save();
        

        $mail_controller = new MailController($payroll->id, $payroll->employee_id);
        $mail_controller->send();
    	return redirect('/payroll');
    }

    public function confirm($id){
        $payroll = Payroll::find($id);
        return view('confirm', compact('payroll'));
    }

    public function setStatus(Request $request){
        $id = $request->input('id');
        $status = $request->input('status');
        $comment = $request->input('comment');
        $payroll = Payroll::find($id);
        $payroll->status = $status;
        if($comment != "")
            $payroll->note = $comment;
        $payroll->save();
        $result = array("status" => "accepted");
        echo json_encode($result);
    }

    // set status billed
    public function status(Request $request){
        $id = $request->input('payroll_id');
        $payroll = Payroll::find($id);
        $payroll->status = "Billed";
        $payroll->save();
        return redirect('/payroll');
    }

    public function getAskingRequests(Request $request){
        $user_id = Auth::user()->id;
        $type = Auth::user()->auth_type;
        if($type == '0'){
            $asking_requests = DB::table('payrolls')->join('employees', 'employees.id', '=', 'payrolls.employee_id')->select('payrolls.*', 'employees.name as employee_name')->where("status", "Ask for change")->get();
            echo json_encode($asking_requests);
        } /*else {
             $asking_requests = DB::table('payrolls')->join('employees', 'employees.id', '=', 'payrolls.employee_id')->select('payrolls.*', 'employees.name as employee_name')->where("status", "Ask for change")->where('employee_id', $user_id)->get();
        }*/
        
        //$asking_requests = Payroll::where("status", 'Ask for change')->get();
        
    }

    public function edit($id){
        $payroll = Payroll::find($id);
        $employees = Employee::where('auth_type', '1')->where('id', $payroll->employee_id)->get();
        return view('payroll_edit', compact('employees', 'payroll'));
    }

    public function update(Request $request){

        $payroll = Payroll::find($request->input("payroll_id"));
        $payroll->employee_id = $request->input('employee_id');
        $payroll->month = $request->input('month');
        $payroll->type = $request->input('type');
        $payroll->working_hours = $request->input('working_hours');
        $payroll->saturday_hours = $request->input('saturday_hours');
        $payroll->sunday_hours = $request->input('sunday_hours');
        $payroll->night_hours = $request->input('night_hours');
        $payroll->feast_hours = $request->input('feast_hours');
        $payroll->total_amount = $request->input('total_amount');
        $payroll->note = $request->input('note');
        $payroll->status = "Draft";
        $payroll->save();
        
        $mail_controller = new MailController($payroll->id, $payroll->employee_id);
        $mail_controller->send();
        return redirect('/payroll');
    }

    public function getDetail(Request $request){
        $id = $request->input("payroll_id");
        $payroll = Payroll::find($id);
        echo json_encode($payroll);
    }

    public function user(){
        $employees = Employee::where('auth_type', '1')->where('id', Auth::user()->id)->get();
        $payrolls = Payroll::where('employee_id', Auth::user()->id)->get();
        return view('payroll', compact('employees', 'payrolls'));
    }
}
