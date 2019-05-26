<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Roasterdetail;
use App\Roaster;
use App\Team;
use App\Employee;
use App\Shift;
use DB;

class RoasterDetailController extends Controller
{
    //
    public function index($id){
        if(!Auth::user()){
            return redirect('/signin');
        }
        $roaster = Roaster::find($id);
        $team_id = $roaster->team_id;
        $team = Team::find($team_id);
        $employee_id = json_decode($team->employee_id);
        $employees = array();

        $shifts = Shift::where('team_id', $team_id)->get();
        if(Auth::user()->auth_type == 0){
            foreach ($employee_id as $key => $value) {
                $employee = Employee::find($value);
                $item = array("name" => $employee->name, "id" => $value);
                array_push($employees, $item);
            }
        } else {
            $employee_id = Auth::user()->id;
            $employee = Employee::find($employee_id);
            $item = array("name" => $employee->name, "id" => $employee_id);
            array_push($employees, $item);
        }
        

    	return view('roasterdetail', compact('employees', 'shifts', 'roaster'));
    }

    public function set_shift(Request $request){
    	$shift_id = $request->input('shift_id');
    	$employee_id = $request->input('employee_id');
    	$date = $request->input('date');
    	$roaster_id = $request->input('roaster_id');
    	$check = Roasterdetail::where('shift_id', $shift_id)->where('date', $date)->where('roaster_id', $roaster_id)->get();
    	if(count($check) > 0){
    		echo json_encode(array("result" => "existed"));
    	} else {
    		$detail = new Roasterdetail;
	    	$detail->roaster_id = $roaster_id;
	    	$detail->employee_id = $employee_id;
	    	$detail->shift_id = $shift_id;
	    	$detail->date = $date;
	    	$detail->save();
	    	echo json_encode(array("result" => "Successfully!"));
    	}
    	

    }

    public function getDetails(Request $request){
    	$roaster_id = $request->input('roaster_id');
    	$details = DB::table('roasterdetails')->join('shifts', 'shifts.id', '=','roasterdetails.shift_id')->join('employees', 'roasterdetails.employee_id', '=', 'employees.id')->select('roasterdetails.*', 'shifts.name as shift_name', 'shifts.color as shift_color', 'employees.name as employee_name', 'shifts.hours as hours')->where('roaster_id', $roaster_id)->get();
    	echo json_encode($details);
    }

    public function delete(Request $request){
        $id = $request->input('id');
        $detail = Roasterdetail::find($id);
        $detail->delete();
        echo json_encode(array('result' => "deleted"));
    }
}
