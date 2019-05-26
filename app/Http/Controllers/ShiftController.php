<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Employee;
use App\Team;
use App\Shift;

class ShiftController extends Controller
{
    //
    public function index(){
        if(!Auth::user()){
            return redirect('/signin');
        }
    	$teams = Team::all();
    	$shifts = Shift::all();
    	return view('shift', compact('teams', 'shifts'));
    }

    public function add(Request $request){
    	$team_id = $request->input('team_id');
    	$name = $request->input('name');
    	$hours = $request->input('hours');
        $color = $request->input('color');
    	$shift = new Shift;
    	$shift->name = $name;
    	$shift->team_id = $team_id;
    	$shift->hours = $hours;
        $shift->color = $color;
    	$shift->save();
    	return redirect('/shift');
    }
    public function delete(Request $request){
    	$shift_id = $request->input('shift_id');
    	Shift::where('id', $shift_id)->delete();
    	return redirect('/shift');
    }

    public function getById(Request $request){
    	$shift_id = $request->input('shift_id');
    	echo json_encode(Shift::find($shift_id));
    }

    public function update(Request $request){
    	$shift_id = $request->input('shift_id'); 
    	$team_id = $request->input('team_id');
    	$hours = $request->input('hours');
    	$name = $request->input('name');
        $color = $request->input('color');
    	$shift = Shift::find($shift_id);
    	$shift->name = $name;
    	$shift->team_id = $team_id;
    	$shift->hours = $hours;
        $shift->color = $color;
    	$shift->save();
    	return redirect('/shift');
    }
}
