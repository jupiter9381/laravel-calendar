<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Employee;
use App\Team;

class TeamController extends Controller
{
    //
    public function index(){
        if(!Auth::user()){
            return redirect('/signin');
        }
    	$employees = Employee::where('auth_type', '1')->get();
    	$teams = Team::all();
    	$team_data = array();
    	foreach ($teams as $key => $value) {
    		$employee_ids = json_decode($value->employee_id);
    		$name_data = "";
    		for($i = 0; $i < count($employee_ids); $i++){
    			$employee_name = Employee::find($employee_ids[$i])->name . ';  ';
    			$name_data .= $employee_name;
    		}
    		$item = array(
    			"id" => $value->id,
    			"name" => $value->name,
    			"employees" => $name_data
    		);
    		array_push($team_data, $item);
    	}
    	$teams = $team_data;
    	return view('team', compact('employees', 'teams'));
    }

    public function add(Request $request){
    	$employees = $request->input('employees');
    	$name = $request->input('name');
    	$team = new Team;
    	$team->name = $name;
    	$team->employee_id = json_encode($employees);
    	$team->save();
    	return redirect('/team');
    }
    public function delete(Request $request){
    	$team_id = $request->input('team_id');
    	Team::where('id', $team_id)->delete();
    	return redirect('/team');
    }

    public function getById(Request $request){
    	$team_id = $request->input('team_id');
    	echo json_encode(Team::find($team_id));
    }

    public function update(Request $request){
    	$team_id = $request->input('team_id'); 
    	$employees = $request->input('employees');
    	$name = $request->input('name');
    	$team = Team::find($team_id);
    	$team->name = $name;
    	$team->employee_id = json_encode($employees);
    	$team->save();
    	return redirect('/team');
    }
}
