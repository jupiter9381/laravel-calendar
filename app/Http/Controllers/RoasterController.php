<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Team;
use App\Roaster;
use DB;

class RoasterController extends Controller
{
    //
    public function index(){
        if(!Auth::user()){
            return redirect('/signin');
        }
    	$teams = Team::all();

        if(Auth::user()->auth_type == 0){
            $data = DB::select('
                SELECT a.*, teams.name team_name
                FROM (
                SELECT roasters.*, IF(hours IS NULL, 0, hours) hours
                FROM roasters LEFT JOIN ( 
                SELECT SUM(shifts.hours) hours, roaster_id
                FROM roasterdetails INNER JOIN shifts ON shifts.id = roasterdetails.shift_id
                GROUP BY roaster_id )a ON a.roaster_id = roasters.id ) a INNER JOIN teams ON teams.id = a.team_id
            ');
        } else {
            $employee_id = Auth::user()->id;
            $data = DB::select("
                SELECT a.*, teams.name team_name
                FROM (
                SELECT roasters.*, IF(hours IS NULL, 0, hours) hours
                FROM roasters LEFT JOIN ( 
                SELECT SUM(shifts.hours) hours, roaster_id
                FROM roasterdetails INNER JOIN shifts ON shifts.id = roasterdetails.shift_id
                WHERE employee_id = '$employee_id'
                GROUP BY roaster_id )a ON a.roaster_id = roasters.id ) a INNER JOIN teams ON teams.id = a.team_id
            ");
        }
    	
        $roasters = array();
        foreach ($data as $key => $value) {
            if(Auth::user()->auth_type == 1){
                $team_id = $value->team_id;
                $team = json_decode(Team::find($team_id)->employee_id);
                if(in_array(Auth::user()->id, $team)){
                    array_push($roasters, $value);
                }
            } else {
                array_push($roasters, $value);
            }
        } 
        //var_dump($roasters);
    	return view('roaster', compact('teams', 'roasters'));
    }

    public function add(Request $request){
    	$team_id = $request->input('team_id');
    	$month = $request->input('month');
    	$message = $request->input('message');
    	$team = new Roaster;
    	$team->month = $month;
    	$team->team_id = $team_id;
    	$team->message = $message;
    	$team->save();
    	return redirect('/roaster');
    }
    public function delete(Request $request){
        $roaster_id = $request->input('roaster_id');
        Roaster::where('id', $roaster_id)->delete();
        return redirect('/roaster');
    }
}
