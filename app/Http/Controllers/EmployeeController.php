<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use Illuminate\Support\Facades\Hash;
use Auth;

class EmployeeController extends Controller
{
    
    public function index(){
        if(Auth::user() == NULL)
            return redirect('/signin');
    	$employees = Employee::all();
    	return view('user', compact('employees'));
    }
    public function add(Request $request){
    	$employee = new Employee;
    	$employee->name = $request->input('name');
    	$employee->address = $request->input('address');
        $employee->password = Hash::make($request->input('password'));
        $employee->email = $request->input('email');
    	$employee->zip = $request->input('zip');
    	$employee->city = $request->input('city');
    	$employee->mobile = $request->input('mobile');
    	$employee->birthday = $request->input('birthday');
    	$employee->type = $request->input('type');
    	$employee->rate_per_hour = $request->input('rate_per_hour');
    	$employee->base_salary = $request->input('base_salary');
    	$employee->extra_charge_night = $request->input('extra_charge_night');
        $employee->extra_charge_saturday = $request->input('extra_charge_saturday');
    	$employee->extra_charge_sunday = $request->input('extra_charge_sunday');
    	$employee->extra_charge_feast = $request->input('extra_charge_feast');
    	$employee->custom_field1 = $request->input('custom_field1');
    	$employee->custom_field2 = $request->input('custom_field2');
    	$employee->custom_field3 = $request->input('custom_field3');
    	$employee->custom_field4 = $request->input('custom_field4');
    	$employee->custom_field5 = $request->input('custom_field5');
        $employee->auth_type = 1;
    	$employee->save();
    	return redirect('/user');
    }

    public function getById(Request $request){
        $id = $request->input("emp_id");
        $employee = Employee::find($id);
        echo json_encode($employee);
    }

    public function update(Request $request){
        $id = $request->input('user_id');
        $employee = Employee::find($id);
        $employee->name = $request->input('name');
        $employee->address = $request->input('address');
        $employee->zip = $request->input('zip');
        $employee->city = $request->input('city');
        $employee->email = $request->input('email');
        $employee->mobile = $request->input('mobile');
        $employee->birthday = $request->input('birthday');
        $employee->type = $request->input('type');
        $employee->rate_per_hour = $request->input('rate_per_hour');
        $employee->base_salary = $request->input('base_salary');
        $employee->extra_charge_night = $request->input('extra_charge_night');
        $employee->extra_charge_saturday = $request->input('extra_charge_saturday');
        $employee->extra_charge_sunday = $request->input('extra_charge_sunday');
        $employee->extra_charge_feast = $request->input('extra_charge_feast');
        $employee->custom_field1 = $request->input('custom_field1');
        $employee->custom_field2 = $request->input('custom_field2');
        $employee->custom_field3 = $request->input('custom_field3');
        $employee->custom_field4 = $request->input('custom_field4');
        $employee->custom_field5 = $request->input('custom_field5');
        $employee->save();
        return redirect('/user');
    }

    public function delete(Request $request){
        $id = $request->input('user_id');
        $employee = Employee::find($id);
        $employee->delete();
        return redirect('/user');
    }

    public function resetPassword(Request $request){
        $user_id = $request->input('user_id');
        $new_pwd = Hash::make($request->input('new_pwd'));
        $employee = Employee::find($user_id);
        $employee->password = $new_pwd;
        $employee->save();
        echo json_encode(array("reset" => "done"));
    }
    
}
