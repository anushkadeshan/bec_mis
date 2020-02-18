<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Youth;
use DB;
use Illuminate\Support\Facades\Validator;
use App\CareerGuidance;
use Auth;

class ProgressController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cg(Request $request){
    	$id = Input::get('youth_id');
        $cg = Youth::findOrFail($id);
        $cg->cg = !$cg->cg;
        $cg->save();
    }

    public function soft(Request $request){
    	$id = Input::get('youth_id');
        $soft = Youth::findOrFail($id);
        $soft->soft_skills = !$soft->soft_skills;
        $soft->save();
    }

    public function vt(Request $request){
    	$id = Input::get('youth_id');
        $vt = Youth::findOrFail($id);
        $vt->vt = !$vt->vt;
        $vt->save();
    }

    public function prof(Request $request){
    	$id = Input::get('youth_id');
        $prof = Youth::findOrFail($id);
        $prof->prof = !$prof->prof;
        $prof->save();
    }

    public function jobs(Request $request){
    	$id = Input::get('youth_id');
        $jobs = Youth::findOrFail($id);
        $jobs->jobs = !$jobs->jobs;
        $jobs->save();
    }

    public function bss(Request $request){
      $id = Input::get('youth_id');
        $bss = Youth::findOrFail($id);
        $bss->bss = !$bss->bss;
        $bss->save();
    }

    public function view($id){

    	$youth = Youth::with('family')
               ->with('branch')
               ->where('id',$id)
               ->first();
      $cg = DB::table('cg_youths')
            ->join('career_guidances','career_guidances.id','=','cg_youths.career_guidances_id')
            ->join('dsd_office','dsd_office.id','=','career_guidances.dsd')
            ->where('cg_youths.youth_id',$id)
            ->get();
      $soft = DB::table('provide_soft_skills_youths')
            ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
            ->join('institutes','institutes.id','=','provide_soft_skills.institute_id')
            ->join('dsd_office','dsd_office.id','=','provide_soft_skills.dsd')
            ->where('provide_soft_skills_youths.youth_id',$id)
            ->get();
      $vt = DB::table('youths_courses')
            ->join('courses','courses.id','=','youths_courses.course_id')
            ->where('courses.course_type','Vocational Training')
            ->where('youths_courses.youth_id',$id)
            ->where('youths_courses.provided_by_bec',1)
            ->get();
      $jobs = DB::table('placements_youths')
              ->join('placements','placements.id','=','placements_youths.placements_id')
              ->where('placements_youths.youth_id',$id)
              ->get();
    	return view('Progress.view-progress')->with(['youth'=>$youth,'cg'=>$cg,'soft'=>$soft,'vt'=>$vt,'jobs'=>$jobs]);
      //dd($jobs);
    }

    public function cgList(Request $request){
        if($request->get('query')){
          $query = $request->get('query');
          $data = DB::table('career_guidances')
            ->where('date', 'LIKE', "%{$query}%")
            ->join('dsd_office','dsd_office.id','=','career_guidances.dsd')
            ->get();
          $output = '<ul class="dropdown-menu" id="autocomplete" style="display:block; position:relative">';
          foreach($data as $row)
          {
           $output .= '
           <li id="'.$row->id.'"><a href="#" >'.$row->date.' at '.$row->venue.' in '.$row->DSD_Name.' </a></li>
           ';
          }
          $output .= '</ul>';
          echo $output;
         }
    }

    
    public function add(Request $request){
        $validator = Validator::make($request->all(),[
                'careerGuidance_id' => 'required',
            ]);
        if($validator->passes()){

              $careerGuidance_id = $request->careerGuidance_id;
              $youth_id = $request->youth_id;
              $branch = DB::table('youths_career_guidances')->insert(['careerGuidance_id' => $careerGuidance_id, 'youth_id' => $youth_id ]);

        }

        else{
               return response()->json(['error' => $validator->errors()->all()]);
        }
    }

    public function softCourseList(Request $request){
        if($request->get('query')){
          $query = $request->get('query');
          $data = DB::table('courses')
            ->where('name', 'LIKE', "%{$query}%")->where('course_type', 'Soft Skills')
            ->get();
          $output = '<ul class="dropdown-menu" id="autocomplete1" style="display:block; position:relative">';
          foreach($data as $row)
          {
           $output .= '
           <li id="'.$row->id.'"><a href="#" >'.$row->name.'</a></li>
           ';
          }
          $output .= '</ul>';
          echo $output;
         }
    }

    public function add_soft(Request $request){
        $validator = Validator::make($request->all(),[
                'course_id' => 'required',
                'status' => 'required',
            ]);
        if($validator->passes()){

              $course_id = $request->course_id;
              $status = $request->status;
              $completed_at = $request->completed_at;              
              $youth_id = $request->youth_id;
              $soft_skills = DB::table('youths_courses')->insert(['course_id' => $course_id, 'youth_id' => $youth_id, 'status'=> $status,'completed_at'=> $completed_at ]);
        }

        else{
               return response()->json(['error' => $validator->errors()->all()]);
        }
    }
public function vtCourseList(Request $request){
        if($request->get('query')){
          $query = $request->get('query');
          $data = DB::table('courses')
            ->where('name', 'LIKE', "%{$query}%")
            ->get();
          $output = '<ul class="dropdown-menu" id="autocomplete2" style="display:block; position:relative">';
          foreach($data as $row)
          {
           $output .= '
           <li id="'.$row->id.'"><a href="#" >'.$row->name.'</a></li>
           ';
          }
          $output .= '</ul>';
          echo $output;
         }
    }

    public function add_vt(Request $request){
        $validator = Validator::make($request->all(),[
                'course_id' => 'required',
                'status' => 'required',
            ]);
        if($validator->passes()){

              $course_id = $request->course_id;
              $status = $request->status;
              $completed_at = $request->completed_at;              
              $youth_id = $request->youth_id;
              $vt = DB::table('youths_courses')->insert(['course_id' => $course_id, 'youth_id' => $youth_id, 'status'=> $status,'completed_at'=> $completed_at ]);

              if(!$vt){
                return response()->json(['error' => 'mysql_error()']);
              }
        }

        else{
               return response()->json(['error' => $validator->errors()->all()]);
        }
    }

    public function add_job(Request $request){
        $validator = Validator::make($request->all(),[
                'title' => 'required',
                'employer_name' => 'required',
            ]);
        if($validator->passes()){

              $title = $request->title;
              $employer_name = $request->employer_name;
              $provided_by = $request->provided_by;              
              $youth_id = $request->youth_id;
              $job = DB::table('jobs_details')->insert(['title' => $title, 'youth_id' => $youth_id, 'employer_name'=> $employer_name,'provided_by'=> $provided_by ]);
        }

        else{
               return response()->json(['error' => $validator->errors()->all()]);
        }
    }

    public function view_completion(){

      $branches = DB::table('branches')->get();
      $branch_id = Auth::user()->branch;

        if(is_null($branch_id)){                    

            $data = DB::table('youths') 
                ->join('branches','branches.id','=','youths.branch_id')
                ->join('families','families.id','=','youths.family_id')
                ->join('dsd_office','dsd_office.ID','=','families.ds_division')
                ->join('gn_office','gn_office.GN_ID','=','families.gn_division') 
                ->select('youths.*','families.*','dsd_office.*','gn_office.*','youths.name as youth_name','branches.ext as name','branches.id as branch_id')
                ->get();                     
               // echo '<script>console.log("'.$request->vt.'")</script>';
        }
        else{
            $data = DB::table('youths') 
                ->join('branches','branches.id','=','youths.branch_id')
                ->join('families','families.id','=','youths.family_id')
                ->join('dsd_office','dsd_office.ID','=','families.ds_division')
                ->join('gn_office','gn_office.GN_ID','=','families.gn_division') 
                ->select('youths.*','families.*','dsd_office.*','gn_office.*','youths.name as youth_name','branches.ext as name','branches.id as branch_id')
                ->where('youths.branch_id','=',$branch_id)
                ->get();  
        }

      return view('Progress.completion')->with(['branches'=>$branches,'youths'=>$data]);
    }

    public function verify(Request $request){
        $verify = DB::table($request->table)
                  ->whereid($request->id)
                  ->update(['verified'=>1]);
    }

    public function completion_targets(){
      $branches = DB::table('branches')->get();
      $activities = DB::table('activities')->get();
      $reports = DB::table('completion_targets')
                ->join('branches','branches.id','=','completion_targets.branch_id')
                 ->get();
      $activities_reports = DB::table('activities')->whereNotNull('report')->get();

      return view('Progress.completion_targets')->with(['branches'=>$branches,'activities'=>$activities,'reports'=>$reports,'activities_reports' =>$activities_reports]);
    }

    public function completion_targets_add(Request $request){

        $data = DB::table('completion_targets')->insert(['report' => $request->report, 'year' => $request->year, 'target'=> $request->target,'branch_id'=> $request->branch_id, 'table_name' => $request->table_name, 'table_name_youth' => $request->table_name_youth, 'table_name_youth_id' => $request->table_name_youth_id, 'created_at' => date('Y-m-d H:i:s') ]);
    }

    public function completion_targets_update(Request $request){
         $data = array(
            'report' => $request->report, 
            'year' => $request->year, 
            'target'=> $request->target,
            'table_name'=> $request->table_name,
            'table_name_youth' => $request->table_name_youth,
            'table_name_youth_id' => $request->table_name_youth_id,
            'branch_id'=> $request->branch_id
         );
        $data = DB::table('completion_targets')->where('id',$request->c_id)->update($data);
    }


     public function completion_reports(){
      
      $branch_id = Auth::user()->branch;

      if(is_null($branch_id)){    

        $reports = DB::table('completion_targets')
                  ->join('branches','branches.id','=','completion_targets.branch_id')
                  ->where('year','Reports')
                  ->get();

        $youths = DB::table('completion_targets')
                  ->join('branches','branches.id','=','completion_targets.branch_id')
                  ->where('year','Youths')
                  ->get();

        $baselines = Youth::count();

      }
      else{
        $reports = DB::table('completion_targets')
                ->join('branches','branches.id','=','completion_targets.branch_id')
                ->where('year','Reports')
                ->where('branch_id',$branch_id)
                ->get();

        $youths = DB::table('completion_targets')
                  ->join('branches','branches.id','=','completion_targets.branch_id')
                  ->where('year','Youths')
                  ->where('branch_id',$branch_id)
                  ->get();
      }
      $branches = DB::table('branches')->get();
      

       return view('Activities.landing')->with(['branches'=>$branches,'reports'=> $reports,'youths' =>$youths ]);
    }

    public function baselines(){

        $cg_youths = DB::table('completion_targets')
                  ->join('branches','branches.id','=','completion_targets.branch_id')
                  ->where('table_name','career_guidances')
                  ->get();      
      
    
      $branches = DB::table('branches')->get();
      

       return view('reports.baselines')->with(['branches'=>$branches ,'cg_youths'=> $cg_youths]);
    }

} 
