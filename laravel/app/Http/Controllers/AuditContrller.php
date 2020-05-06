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
public function get_api_data(){
        $url = 'http://testingbec.southeastasia.cloudapp.azure.com/api/person/';
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiZDM1NTc3MzI1MGQ1ZTdmNGMxNjYxOGU3ZTU1Nzg4YzVkNTcwNjg2ZjBlODRiZTkwNDQ3NzY4OGQyMjZkZjQ3ODVhMDIxNjQ1MzNkN2E3MTUiLCJpYXQiOjE1ODM3NTE3MDEsIm5iZiI6MTU4Mzc1MTcwMSwiZXhwIjoxNjE1Mjg3NzAxLCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.LG1wA312cyDlnFvNKAPTYxBE-1cAtXGPTC-z6Ex0DtqoWtcqBZCzv9ytWF9fmheRCc89rwh-_y99gmbiX0C1CpdOMMsTwpyR_NLjA2zSL68yGjWnrtZ0ev6Vqts_yOWQt3O382QxHDT1CNPyngtaprEMSWWj_TkAAmasuPkh0fBSHkcyLPkUoJNPkSpfRrSEJm7NsF5smb0w-uZO9s3jffvile4O4TR5p8UbnpLBKoy6EJ-uEWZHG2CpI0cXoCe9h8_t88t0nuw4dDBRHlbHm537BdJJdjsAu9te0-jrKV-u2SMbyQuVQW414QjYDufpNgyFdHNvE9ckZaqxgTAYAspJvxzNG7abTzMAZecVh5YeIW95yQ34BH_DUJWZVw1QHflr8XPJAuSmH8vaVksC-Pmlw18CmgRpH2lNEugegRiBWODzGdIgJ7FRgAVybSCGCI0ifD1cnoTvG9mbMJK7wTH0UE81pVbqA_T2MF4icTc-qfvB2vnbsyKelnzl3nXhln4pQGG7KMGi_LiSSESijLK9x_I7HvDOu2AyJ9822f3ANr6UFtOlSZjgGorVyCdZEghNxOG1fpAlTkExYygcNUcxVu3RLJwh06bLApNEi1p3VbQ7mfsPi4eFxjspu7HYBbCuggPF0RKxZ276U_u9keIy58mtUVJ-E7IcLurxHCk';
        $options = array('http' => array(
            'method'  => 'GET',
            'header' => 'Authorization: Bearer '.$token
        ));
        $context  = stream_context_create($options);
        $response = file_get_contents($url, false, $context);

        //$json = json_decode(file_get_contents('http://testingbec.southeastasia.cloudapp.azure.com/api/person/'));
    
        echo $response;
        //dd($response);
    
    }




}
