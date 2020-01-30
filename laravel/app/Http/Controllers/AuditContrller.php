<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;

class AuditContrller extends Controller
{
    public function index(){

    	$audits = DB::table('audits')->get();

    	$users = DB::table('users')->get();
    	return view('audits')->with(['audits'=> $audits,'users'=> $users]);
    }

public function fetch(Request $request){
if($request->ajax())
{
    if($request->dateStart != '' && $request->dateEnd != '')
    {
        if($request->user !=''){
            $data = DB::table('audits') 
                ->join('users','users.id','=','audits.user_id')
                ->whereBetween('audits.created_at', array($request->dateStart, $request->dateEnd))
                ->where('user_id',$request->user)
                ->select('audits.*','users.*','audits.created_at as date')
                ->orderBy('audits.created_at', 'desc')
                ->get();

            $data1 = DB::table('activity_audit') 
                ->join('users','users.id','=','activity_audit.user_id')
                ->whereBetween('activity_audit.time_stamp', array($request->dateStart, $request->dateEnd))
                ->where('user_id',$request->user)
                ->select('activity_audit.*','users.*','activity_audit.time_stamp as date')
                ->orderBy('activity_audit.time_stamp', 'desc')
                ->get();
        }
        else{
            $data = DB::table('audits') 
                ->join('users','users.id','=','audits.user_id')
                ->whereBetween('audits.created_at', array($request->dateStart, $request->dateEnd))
                ->select('audits.*','users.*','audits.created_at as date')
                ->orderBy('audits.created_at', 'desc')
                ->get();

            $data1 = DB::table('activity_audit') 
                ->join('users','users.id','=','activity_audit.user_id')
                ->whereBetween('activity_audit.time_stamp', array($request->dateStart, $request->dateEnd))
                ->select('activity_audit.*','users.*','activity_audit.time_stamp as date')
                ->orderBy('activity_audit.time_stamp', 'desc')
                ->get();
        }
        
    }
else
    {
        $data = DB::table('audits') 
                ->join('users','users.id','=','audits.user_id')
                ->select('audits.*','users.*','audits.created_at as date')
                ->orderBy('audits.created_at', 'desc')
                ->limit(500)
                ->get();


        $data1 = DB::table('activity_audit') 
                ->join('users','users.id','=','activity_audit.user_id')
                ->select('activity_audit.*','users.*','activity_audit.time_stamp as date')
                ->orderBy('activity_audit.time_stamp', 'desc')
                ->limit(500)
                ->get();
    }
        return response()->json(array(
            'laravel' => $data,
            'mysql' => $data1,
        ));
        
}



}



}
