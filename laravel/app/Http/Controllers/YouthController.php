<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use App\Youth;
use App\User;
use App\Result;
use App\Notifications\youthAdd;
use Session;
use App\Progress;
use App\IntrestingJob;
use Auth;
use Illuminate\Support\Facades\Input;
use App\Vacancy;



class YouthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
      $districts = DB::table('districts')->get();
      $branch = auth()->user()->branch;

      if(is_null($branch)){
        $youths = Youth::with('family')
                  ->join('branches','branches.id','=','youths.branch_id')
                  ->select('youths.*','youths.name as youth_name','branches.*','youths.id as youth_id')
                  ->latest()
                  ->get();
        
      }
      else{
        $youths = Youth::with('family')
                  ->where('branch_id',$branch)
                  ->join('branches','branches.id','=','youths.branch_id')
                  ->select('youths.*','youths.name as youth_name','branches.*','youths.id as youth_id')
                  ->get(); 
      }
      //dd($youths->toArray());
      return view('Youth.view-youth')->with(['youths'=> $youths,'districts'=> $districts]);
    } 

    public function create(){
      $course_categories = DB::table('course_categories')->get();
      $branches = DB::table('branches')->get();
       
    	return view('Youth.add-youth')->with(['course_categories'=> $course_categories, 'branches' => $branches]);
    }

    public function familyList(Request $request){
          $branch_id = auth()->user()->branch;

        if($request->get('query')){
          $query = $request->get('query');
          $data = DB::table('families')
            ->where('head_of_household', 'LIKE', "%{$query}%")
            ->get();
          $output = '<ul class="dropdown-menu" id="family" style="display:block; position:relative">';
          foreach($data as $row)
          {
           $output .= '
           <li class="nav-item" id="'.$row->id.'"><a href="#" >'.$row->head_of_household.' ('.$row->nic_head_of_household.')</a></li>
           ';
          }
          $output .= '</ul>';
          echo $output;
         }
    }

    public function create_personal(Request $request){
    	$validator = Validator::make($request->all(),[
                'name' => 'required',
                'full_name' => 'required|unique:youths',
                'gender' => 'required',
                'phone' => 'required',
                'nic' => 'required|unique:youths',
                'birth_date' => 'required',
                'maritial_status' => 'required',
                'nationality' => 'required',
                'family_id' => 'required',
                'highest_qualification' => 'required',
                'branch_id' => 'required',
            ]);

            if($validator->passes()){
                $data = $request->all();
                $added_by = auth()->user()->id;
                $youth = Youth::create($data+['added_by'=> $added_by]);

                $data1 = array(
                  'youth_id' => $youth->id
                );

                $progres = Progress::create($data1);

                Session::forget('youth_id');
                $youth_id = $youth->id;
                Session::put('youth_id', $youth_id);
                

                //send notofications 
                $notifyTo = User::whereHas('roles', function($q){$q->whereIn('slug', ['admin']);})->get();
                foreach ($notifyTo as $notifyUser) {
                    $notifyUser->notify(new youthAdd($youth));
                }

                return response()->json(['youth_id' => $youth_id]);
            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    }

    public function changeStatus(Request $request){
      $status = Youth::find($request->id);
      $status->current_status = $request->current_status;
      $status->save();
    }

    public function create_permanant_jobs(Request $request){
      $validator = Validator::make($request->all(),[
                'title' => 'required',
                'employer_name' => 'required',
                'youth_id' => 'required',
                'career_plan' => 'required',
                'step_forward' => 'required',
                'description' => 'required'
            ]);

            if($validator->passes()){
                $title = $request->title;
                $youth_id = $request->youth_id;
                $employer_name = $request->employer_name;
                $career_plan = $request->career_plan;
                $step_forward = $request->step_forward;
                $description = $request->description;
                $nature_job = $request->nature_job;
                $courses = DB::table('jobs_details')->insert(
                    array('title' => $title, 'youth_id' => $youth_id, 'employer_name' => $employer_name, 'career_plan' => $career_plan, 'step_forward' => $step_forward,'description' => $description, 'nature_job' => $nature_job )
                );

            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    }

    public function create_tempory_jobs(Request $request){
      $validator = Validator::make($request->all(),[
                'youth_id' => 'required',
            ]);

            if($validator->passes()){
              $location= json_encode($request->location);
              $intresting_courses= json_encode($request->intresting_courses);
              $industry= json_encode($request->industry);
              $data = array(
                  'intresting_business' => $request->intresting_business,
                  'need_help' => $request->need_help,
                  'type_of_help' => $request->type_of_help,

              );
              $data1 = array(
                'industry' => $industry,
                'location' => $location,
                'intresting_courses' => $intresting_courses,
                'min_salary' => $request->min_salary,
                'youth_id' => $request->youth_id,
                'experience' => $request->experience,
              );

              $data2 = array(
                'bank_account' => $request->bank_account,
                'smart_phone' => $request->smart_phone,
                'training' => $request->training,
                'when' => $request->when,
                'youth_id' => $request->youth_id,
              );
                $intresting_business = DB::table('intresting_business')->insert($data);

                $intresting_jobs = DB::table('intresting_jobs')->insert($data1);
                $common = DB::table('youth_common_details')->insert($data2);

            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    }

    public function create_following_course(Request $request){
      $validator = Validator::make($request->all(),[
                
                'youth_id' => 'required',
                'course_id' => 'required',
                'completed_at' => 'required',
            ]);

            if($validator->passes()){
              $location= json_encode($request->location);
              $industry= json_encode($request->industry);

              $data = array(
                  'course_id' => $request->course_id,
                  'completed_at' => $request->completed_at,
                  'status' => $request->status,
                  'youth_id' => $request->youth_id,
              );
              $data1 = array(
                'industry' => $industry,
                'location' => $location,
                'min_salary' => $request->min_salary,
                'youth_id' => $request->youth_id,
                'experience' => $request->experience,
                'profession_adequate' => $request->profession_adequate,
                'plan_to_meet_qualifications' => $request->plan_to_meet_qualifications,
                'details' => $request->details
              );

              $data2 = array(
                'bank_account' => $request->bank_account,
                'smart_phone' => $request->smart_phone,
                'training' => $request->training,
                'when' => $request->when,
                'youth_id' => $request->youth_id,
              );

              $data3 = array(
                  'intresting_business' => $request->intresting_business,
                  'need_help' => $request->need_help,
                  'type_of_help' => $request->type_of_help,
                  'youth_id' => $request->youth_id,

              );
                $intresting_business = DB::table('intresting_business')->insert($data3);
                $course = DB::table('youths_courses')->insert($data);
                $intresting_jobs = DB::table('intresting_jobs')->insert($data1);
                $common = DB::table('youth_common_details')->insert($data2);

            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    }

    public function create_no_jobs(Request $request){
      $validator = Validator::make($request->all(),[
                'youth_id' => 'required',
            ]);

            if($validator->passes()){
              $location= json_encode($request->location);
              $intresting_courses= json_encode($request->intresting_courses);
              $industry= json_encode($request->industry);


              $data = array(
                  'intresting_business' => $request->intresting_business,
                  'need_help' => $request->need_help,
                  'type_of_help' => $request->type_of_help,
                  'youth_id' => $request->youth_id,


              );
              $data1 = array(
                'location' => $location,
                'min_salary' => $request->min_salary,
                'youth_id' => $request->youth_id,
                'experience' => $request->experience,
              );

              $data2 = array(
                'bank_account' => $request->bank_account,
                'smart_phone' => $request->smart_phone,
                'training' => $request->training,
                'when' => $request->when,
                'youth_id' => $request->youth_id,
              );
                $intresting_business = DB::table('intresting_business')->insert($data);
                $intresting_jobs = DB::table('intresting_jobs')->insert($data1);
                $common = DB::table('youth_common_details')->insert($data2);

            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    }
    

    public function create_self(Request $request){
      $validator = Validator::make($request->all(),[
                'title' => 'required',
                'youth_id' => 'required',
            ]);

            if($validator->passes()){

              $data = array(
                  'title' => $request->title,
                  'youth_id' => $request->youth_id,
                  'nature_job' => $request->nature_job,


              );
            
              $data2 = array(
                'bank_account' => $request->bank_account,
                'smart_phone' => $request->smart_phone,
                'training' => $request->training,
                'when' => $request->when,
                'youth_id' => $request->youth_id,
              );
                $self = DB::table('jobs_details')->insert($data);
                $common = DB::table('youth_common_details')->insert($data2);

            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    }

    public function create_feedback(Request $request){
      $validator = Validator::make($request->all(),[
                'like_to_feedback' => 'required',
                'youth_id' => 'required',
            ]);

            if($validator->passes()){
              $how_to_feedback= json_encode($request->how_to_feedback);

              $data = array(
                  'like_to_feedback' => $request->like_to_feedback,
                  'youth_id' => $request->youth_id,
                  'how_to_feedback' => $how_to_feedback,


              );
            
          
                $youth_feedback = DB::table('youth_feedback')->insert($data);
                

            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    }

    public function create_language(Request $request){
      

              $data = array(
                  'reading_tamil' => $request->has('reading_tamil'),
                  'reading_sinhala' => $request->has('reading_sinhala'),
                  'reading_english' => $request->has('reading_english'),
                  'writing_tamil' => $request->has('writing_tamil'),
                  'writing_sinhala' => $request->has('writing_sinhala'),
                  'writing_english' => $request->has('writing_english'),
                  'speaking_tamil' => $request->has('speaking_tamil'),
                  'speaking_sinhala' => $request->has('speaking_sinhala'),
                  'speaking_english' => $request->has('speaking_english'),
                  'youth_id' => $request->youth_id,
              );          
                $language = DB::table('language')->insert($data);
    }

    //edith youth details

    public function edit($id){
      $course_categories = DB::table('course_categories')->get();
      $branches = DB::table('branches')->get();

      $youth_data = Youth::with('family')->whereid($id)->first();
      $results = DB::table('results')->whereyouth_id($id)->first();
      $language = DB::table('language')->whereyouth_id($id)->first();



      $followed_courses = DB::table('youths_courses')
                  ->join('courses','courses.id','=','youths_courses.course_id')
                  ->where('youths_courses.youth_id', $id)
                  ->where('youths_courses.status','Followed')
                  ->select('youths_courses.*','courses.*','courses.id as course_id', 'youths_courses.id as ys_id')
                  ->get();
                  //dd($followed_courses->toArray());

      //get status data
      $current_status= $youth_data->current_status;

      switch ($current_status) {
        case 'Permanent Job After Vocational/Prof Training':
          $jobs_details = DB::table('jobs_details')->whereyouth_id($id)->first();
          $intresting_jobs = null;
          $intresting_business = null;
          $youth_common_details = null;
          $following_course = null;
          break;

          case 'Permanent Job without Vocational/Prof Training':
          $jobs_details = DB::table('jobs_details')->whereyouth_id($id)->first();
          $intresting_jobs = null;
          $intresting_business = null;
          $youth_common_details = null;
          $following_course = null;
          break;

          case 'Temporary Job After Vocational/Prof Training':
          $intresting_jobs = IntrestingJob::with('youth')->whereyouth_id($id)->first();
          
          $intresting_business = DB::table('intresting_business')->whereyouth_id($id)->first();
          $youth_common_details = DB::table('youth_common_details')->whereyouth_id($id)->first();
          $jobs_details = null;
          $following_course = null;
          break;

          case 'Temporary Job without Vocational/Prof Training':
          $intresting_jobs = IntrestingJob::with('youth')->whereyouth_id($id)->first();
          
          $intresting_business = DB::table('intresting_business')->whereyouth_id($id)->first();
          $youth_common_details = DB::table('youth_common_details')->whereyouth_id($id)->first();
          $jobs_details = null;
          $following_course = null;
          break;

          case 'Following a course':
          $following_course = DB::table('youths_courses')
                  ->join('courses','courses.id','=','youths_courses.course_id')
                  ->where('youths_courses.youth_id', $id)
                  ->where('youths_courses.status','Following')
                  ->select('youths_courses.*','courses.*','courses.id as course_id', 'youths_courses.id as ys_id')
                  ->first();
          $intresting_jobs = IntrestingJob::with('youth')->whereyouth_id($id)->first();
          
          $intresting_business = DB::table('intresting_business')->whereyouth_id($id)->first();
          $youth_common_details = DB::table('youth_common_details')->whereyouth_id($id)->first();
          $jobs_details = null;
          
          break;

          case 'Self Employed':
          $intresting_jobs = IntrestingJob::with('youth')->whereyouth_id($id)->first();
          
          $youth_common_details = DB::table('youth_common_details')->whereyouth_id($id)->first();
          $jobs_details = DB::table('jobs_details')->whereyouth_id($id)->where('nature_job','Self Employed')->first();
          $following_course = null;
          $intresting_business = null;
          
          break;
        
        default:
          $intresting_jobs = IntrestingJob::with('youth')->whereyouth_id($id)->first();
          
          $intresting_business = DB::table('intresting_business')->whereyouth_id($id)->first();
          $youth_common_details = DB::table('youth_common_details')->whereyouth_id($id)->first();
          $jobs_details = null;
          $following_course = null;
          break;
      }

      return view('Youth.edit-youth')->with(['course_categories'=> $course_categories, 'branches' => $branches, 'youth' => $youth_data, 'followed_courses' => $followed_courses, 'results' => $results, 'language' => $language, 'jobs_details' =>$jobs_details, 'intresting_jobs' => $intresting_jobs, 'intresting_business' => $intresting_business,'youth_common_details' => $youth_common_details,'following_course' => $following_course ]);
    }


    public function update_personal(Request $request){
      $validator = Validator::make($request->all(),[
                'name' => 'required',
                'full_name' => 'required',
                'gender' => 'required',
                'phone' => 'required',
                'birth_date' => 'required',
                'maritial_status' => 'required',
                'nationality' => 'required',
                'family_id' => 'required',
                'highest_qualification' => 'required',
                'branch_id' => 'required',
            ]);

            if($validator->passes()){
              $added_by = auth()->user()->id;

              $youth = Youth::find($request->id);
              $youth->name = $request->name;
              $youth->full_name = $request->full_name;
              $youth->gender = $request->gender;
              $youth->phone = $request->phone;
              $youth->email = $request->email;
              $youth->birth_date = $request->birth_date;
              $youth->maritial_status = $request->maritial_status;
              $youth->nationality = $request->nationality;
              $youth->family_id = $request->family_id;
              $youth->highest_qualification = $request->highest_qualification;
              $youth->driving_licence = $request->driving_licence;
              $youth->disability = $request->disability;
              $youth->branch_id = $request->branch_id;
              $youth->reason = $request->reason;
              $youth->added_by = $added_by;
              $youth->save();

            }

            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    }


    public function update_language(Request $request){
              if (DB::table('jobs_details')->where('id', '=', $request->id)->exists()) {
              $language = DB::table('language')->whereid($request->id)->update(['reading_tamil' => $request->has('reading_tamil'),
                  'reading_sinhala' => $request->has('reading_sinhala'),
                  'reading_english' => $request->has('reading_english'),
                  'writing_tamil' => $request->has('writing_tamil'),
                  'writing_sinhala' => $request->has('writing_sinhala'),
                  'writing_english' => $request->has('writing_english'),
                  'speaking_tamil' => $request->has('speaking_tamil'),
                  'speaking_sinhala' => $request->has('speaking_sinhala'),
                  'speaking_english' => $request->has('speaking_english')]);
            }

            else{
              $data = array(
                  'reading_tamil' => $request->has('reading_tamil'),
                  'reading_sinhala' => $request->has('reading_sinhala'),
                  'reading_english' => $request->has('reading_english'),
                  'writing_tamil' => $request->has('writing_tamil'),
                  'writing_sinhala' => $request->has('writing_sinhala'),
                  'writing_english' => $request->has('writing_english'),
                  'speaking_tamil' => $request->has('speaking_tamil'),
                  'speaking_sinhala' => $request->has('speaking_sinhala'),
                  'speaking_english' => $request->has('speaking_english'),
                  'youth_id' => $request->youth_id,
              );          
                $language = DB::table('language')->insert($data);
            }
    }
public function update_followed_course(Request $request){
      $validator = Validator::make($request->all(),[
                'provided_by_bec' => 'required',
                'course_id' => 'required',
                'completed_at' => 'required'
            ]);

            if($validator->passes()){
              
              $followed_courses = DB::table('youths_courses')->whereid($request->id)->update(['provided_by_bec'=> $request->provided_by_bec, 'course_id' => $request->course_id,'completed_at'=> $request->completed_at,'status'=> $request->status]);

            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    }

    public function update_permanant_jobs(Request $request){
      $validator = Validator::make($request->all(),[
                'title' => 'required',
                'employer_name' => 'required',
                'career_plan' => 'required',
                'step_forward' => 'required',
                'description' => 'required',
                'youth_id' => 'required'
            ]);

            if($validator->passes()){
                $title = $request->title;
                $employer_name = $request->employer_name;
                $career_plan = $request->career_plan;
                $step_forward = $request->step_forward;
                $description = $request->description;
                $nature_job = $request->nature_job;
                $youth_id = $request->youth_id;
                if (DB::table('jobs_details')->where('id', '=', $request->id)->exists()) {
                      $courses = DB::table('jobs_details')->whereid($request->id)->update(
                      array('title' => $title, 'employer_name' => $employer_name, 'career_plan' => $career_plan, 'step_forward' => $step_forward,'description' => $description, 'nature_job' => $nature_job )
                );
                }
                else{
                    $courses = DB::table('jobs_details')->insert(
                      array('title' => $title, 'employer_name' => $employer_name, 'career_plan' => $career_plan, 'step_forward' => $step_forward,'description' => $description, 'nature_job' => $nature_job,'youth_id'=> $youth_id )
                );
                }
                

            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    }


public function update_tempory_jobs(Request $request){
      $validator = Validator::make($request->all(),[
                
                'youth_id' => 'required',
            ]);

            if($validator->passes()){
              $location= json_encode($request->location);
              $intresting_courses= json_encode($request->intresting_courses);
              $industry= json_encode($request->industry);

              $data = array(
                  'intresting_business' => $request->intresting_business,
                  'need_help' => $request->need_help,
                  'type_of_help' => $request->type_of_help,
                  'youth_id' => $request->youth_id,

              );

              $data1 = array(
                'industry' => $industry,
                'location' => $location,
                'intresting_courses' => $intresting_courses,
                'min_salary' => $request->min_salary,
                'experience' => $request->experience,
                'youth_id' => $request->youth_id,

              );

              $data2 = array(
                'bank_account' => $request->bank_account,
                'smart_phone' => $request->smart_phone,
                'training' => $request->training,
                'when' => $request->when,
                'youth_id' => $request->youth_id,


              );

                if (DB::table('intresting_jobs')->where('id', '=', $request->i_jobs_id)->exists()) {
                    $intresting_jobs = DB::table('intresting_jobs')->whereid($request->i_jobs_id)->update($data1);
                }

                else{
                    $intresting_jobs = DB::table('intresting_jobs')->insert($data1);

                }

                if (DB::table('intresting_business')->where('id', '=', $request->i_business_id)->exists()) {
                    $intresting_business = DB::table('intresting_business')->whereid($request->i_business_id)->update($data);  
                }
                else{
                    $common = DB::table('intresting_business')->insert($data);     

                }
                if (DB::table('youth_common_details')->where('id', '=', $request->common_details_id)->exists()) {
                    $common = DB::table('youth_common_details')->whereid($request->common_details_id)->update($data2);     
                }
                else{
                    $common = DB::table('youth_common_details')->insert($data2);     
                    
                }
                

            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    }

public function update_following_course(Request $request){
      $validator = Validator::make($request->all(),[
                
                'course_id' => 'required',
                'completed_at' => 'required',
                'youth_id' => 'required',
            ]);

            if($validator->passes()){
              $location= json_encode($request->location);
              $industry= json_encode($request->industry);

              $data = array(
                  'course_id' => $request->course_id,
                  'completed_at' => $request->completed_at,
                  'status' => $request->status,
                  'provided_by_bec' => $request->provided_by_bec,
                  'youth_id' => $request->youth_id,
              );
              $data1 = array(
                'industry' => $industry,
                'location' => $location,
                'min_salary' => $request->min_salary,
                'experience' => $request->experience,
                'profession_adequate' => $request->profession_adequate,
                'plan_to_meet_qualifications' => $request->plan_to_meet_qualifications,
                'details' => $request->details,
                'youth_id' => $request->youth_id,

              );

              $data2 = array(
                'bank_account' => $request->bank_account,
                'smart_phone' => $request->smart_phone,
                'training' => $request->training,
                'when' => $request->when,
                 'youth_id' => $request->youth_id,

              );

              $data3 = array(
                  'intresting_business' => $request->intresting_business,
                  'need_help' => $request->need_help,
                  'type_of_help' => $request->type_of_help,
                  'youth_id' => $request->youth_id,
                  


              );
                if (DB::table('intresting_jobs')->where('id', '=', $request->i_jobs_id)->exists()) {
                    $intresting_jobs = DB::table('intresting_jobs')->whereid($request->i_jobs_id)->update($data1);
                }

                else{
                    $intresting_jobs = DB::table('intresting_jobs')->insert($data1);

                }

                if (DB::table('intresting_business')->where('id', '=', $request->i_business_id)->exists()) {
                    $intresting_business = DB::table('intresting_business')->whereid($request->i_business_id)->update($data3);  
                }
                else{
                    $common = DB::table('intresting_business')->insert($data3);     

                }
                if (DB::table('youth_common_details')->where('id', '=', $request->common_details_id)->exists()) {
                    $common = DB::table('youth_common_details')->whereid($request->common_details_id)->update($data2);     
                }
                else{
                    $common = DB::table('youth_common_details')->insert($data2);     
                    
                }
                echo "<script>console.log('Debug Objects: " . $request->youth_following_course_id . "' );</script>";
                if (DB::table('youths_courses')->where('id', '=', $request->youth_following_course_id)->exists()) {
                    $course = DB::table('youths_courses')->whereid($request->youth_following_course_id)->update($data);     
                }
                else{
                    $course = DB::table('youths_courses')->insert($data);     
                    
                }
                

            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    }

    public function update_no_jobs(Request $request){
      $validator = Validator::make($request->all(),[
                
                  'youth_id' => 'required',

            ]);

            if($validator->passes()){
              $location= json_encode($request->location);
              $intresting_courses= json_encode($request->intresting_courses);
              $industry= json_encode($request->industry);

              $data = array(
                  'intresting_business' => $request->intresting_business,
                  'need_help' => $request->need_help,
                  'type_of_help' => $request->type_of_help,
                  'youth_id' => $request->youth_id,



              );
              $data1 = array(
                'industry' => $industry,
                'location' => $location,
                'intresting_courses' => $intresting_courses,
                'min_salary' => $request->min_salary,
                'experience' => $request->experience,
                'youth_id' => $request->youth_id,

              );

              $data2 = array(
                'bank_account' => $request->bank_account,
                'smart_phone' => $request->smart_phone,
                'training' => $request->training,
                'when' => $request->when,
                'youth_id' => $request->youth_id,

              );

                if (DB::table('intresting_jobs')->where('id', '=', $request->i_jobs_id)->exists()) {
                    $intresting_jobs = DB::table('intresting_jobs')->whereid($request->i_jobs_id)->update($data1);
                }

                else{
                    $intresting_jobs = DB::table('intresting_jobs')->insert($data1);

                }

                if (DB::table('intresting_business')->where('id', '=', $request->i_business_id)->exists()) {
                    $intresting_business = DB::table('intresting_business')->whereid($request->i_business_id)->update($data);  
                }
                else{
                    $intresting_business = DB::table('intresting_business')->insert($data);     

                }

                if (DB::table('youth_common_details')->where('id', '=', $request->common_details_id)->exists()) {
                    $common = DB::table('youth_common_details')->whereid($request->common_details_id)->update($data2);     
                }
                else{
                    $common = DB::table('youth_common_details')->insert($data2);     
                    
                }
                

            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    }

    public function update_self(Request $request){
      $validator = Validator::make($request->all(),[
                'title' => 'required',
            ]);

            if($validator->passes()){

              $data = array(
                  'title' => $request->title,
                  'nature_job' => $request->nature_job,
                  'youth_id' => $request->youth_id,



              );
            
              $data2 = array(
                'bank_account' => $request->bank_account,
                'smart_phone' => $request->smart_phone,
                'training' => $request->training,
                'when' => $request->when,
                'youth_id' => $request->youth_id,
              );

                if (DB::table('jobs_details')->where('id', '=', $request->jobs_detials_id)->exists()) {
                    $self = DB::table('jobs_details')->whereid($request->jobs_detials_id)->update($data);  
                }
                else{
                    $self = DB::table('jobs_details')->insert($data);     

                }
                if (DB::table('youth_common_details')->where('id', '=', $request->common_details_id)->exists()) {
                    $common = DB::table('youth_common_details')->whereid($request->common_details_id)->update($data2);     
                }
                else{
                    $common = DB::table('youth_common_details')->insert($data2);     
                    
                }
                
            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
    }

    public function delete(Request $request)
      {
          $id = $request->id;
          $youth = Youth::find($id);
          $youth->delete();
      }

    public function profile_add(){
      $user_id = Auth::id();
      if (Youth::where('user_id', $user_id)->exists()) {
        return redirect('home')->with('success', 'You have already create the profile.');
      }

      else{
        $course_categories = DB::table('course_categories')->get();
        $branches = DB::table('branches')->get();
       
        return view('Youth.add-youth-profile')->with(['course_categories'=> $course_categories, 'branches' => $branches]);
      }
    }


    public function profile_edit(){
      $user_id = Auth::id();
      if (Youth::where('user_id', $user_id)->exists()) {
        $youth = Youth::where('user_id',$user_id)->first();
      $youth = Youth::where('user_id',$user_id)->first();
      $id = $youth->id;
      $course_categories = DB::table('course_categories')->get();
      $branches = DB::table('branches')->get();

      $youth_data = Youth::with('family')->whereid($id)->first();
      $results = DB::table('results')->whereyouth_id($id)->first();
      $language = DB::table('language')->whereyouth_id($id)->first();



      $followed_courses = DB::table('youths_courses')
                  ->join('courses','courses.id','=','youths_courses.course_id')
                  ->where('youths_courses.youth_id', $id)
                  ->where('youths_courses.status','Followed')
                  ->select('youths_courses.*','courses.*','courses.id as course_id', 'youths_courses.id as ys_id')
                  ->get();
                  //dd($followed_courses->toArray());

      //get status data
      $current_status= $youth_data->current_status;

      switch ($current_status) {
        case 'Permanent Job After Vocational/Prof Training':
          $jobs_details = DB::table('jobs_details')->whereyouth_id($id)->first();
          $intresting_jobs = null;
          $intresting_business = null;
          $youth_common_details = null;
          $following_course = null;
          break;

          case 'Permanent Job without Vocational/Prof Training':
          $jobs_details = DB::table('jobs_details')->whereyouth_id($id)->first();
          $intresting_jobs = null;
          $intresting_business = null;
          $youth_common_details = null;
          $following_course = null;
          break;

          case 'Temporary Job After Vocational/Prof Training':
          $intresting_jobs = IntrestingJob::with('youth')->whereyouth_id($id)->first();
          
          $intresting_business = DB::table('intresting_business')->whereyouth_id($id)->first();
          $youth_common_details = DB::table('youth_common_details')->whereyouth_id($id)->first();
          $jobs_details = null;
          $following_course = null;
          break;

          case 'Temporary Job without Vocational/Prof Training':
          $intresting_jobs = IntrestingJob::with('youth')->whereyouth_id($id)->first();
          
          $intresting_business = DB::table('intresting_business')->whereyouth_id($id)->first();
          $youth_common_details = DB::table('youth_common_details')->whereyouth_id($id)->first();
          $jobs_details = null;
          $following_course = null;
          break;

          case 'Following a course':
          $following_course = DB::table('youths_courses')
                  ->join('courses','courses.id','=','youths_courses.course_id')
                  ->where('youths_courses.youth_id', $id)
                  ->where('youths_courses.status','Following')
                  ->select('youths_courses.*','courses.*','courses.id as course_id', 'youths_courses.id as ys_id')
                  ->first();
          $intresting_jobs = IntrestingJob::with('youth')->whereyouth_id($id)->first();
          
          $intresting_business = DB::table('intresting_business')->whereyouth_id($id)->first();
          $youth_common_details = DB::table('youth_common_details')->whereyouth_id($id)->first();
          $jobs_details = null;
          
          break;

          case 'Self Employed':
          $intresting_jobs = IntrestingJob::with('youth')->whereyouth_id($id)->first();
          
          $youth_common_details = DB::table('youth_common_details')->whereyouth_id($id)->first();
          $jobs_details = DB::table('jobs_details')->whereyouth_id($id)->where('nature_job','Self Employed')->first();
          $following_course = null;
          $intresting_business = null;
          
          break;
        
        default:
          $intresting_jobs = IntrestingJob::with('youth')->whereyouth_id($id)->first();
          
          $intresting_business = DB::table('intresting_business')->whereyouth_id($id)->first();
          $youth_common_details = DB::table('youth_common_details')->whereyouth_id($id)->first();
          $jobs_details = null;
          $following_course = null;
          break;
      }

      return view('Youth.edit-youth')->with(['course_categories'=> $course_categories, 'branches' => $branches, 'youth' => $youth_data, 'followed_courses' => $followed_courses, 'results' => $results, 'language' => $language, 'jobs_details' =>$jobs_details, 'intresting_jobs' => $intresting_jobs, 'intresting_business' => $intresting_business,'youth_common_details' => $youth_common_details,'following_course' => $following_course ]);

      }

      else{
        return redirect('youth/profile-add')->with('error', 'Please create your profile first.');
      }
    }

    public function profile_view(){
    
      $user_id = Auth::id();
      if (Youth::where('user_id', $user_id)->exists()) {
        $youth = Youth::where('user_id',$user_id)->first();
      $id = $youth->id;

      $course_categories = DB::table('course_categories')->get();
      $branches = DB::table('branches')->get();

      $youth_data = Youth::with('family')->whereid($id)->first();
      $results = DB::table('results')->whereyouth_id($id)->first();
      $language = DB::table('language')->whereyouth_id($id)->first();



      $followed_courses = DB::table('youths_courses')
                  ->join('courses','courses.id','=','youths_courses.course_id')
                  ->join('courses_institutes','courses_institutes.course_id','=','youths_courses.course_id')
                  ->join('institutes','institutes.id','=','courses_institutes.institute_id')
                  ->where('youths_courses.youth_id', $id)
                  ->where('youths_courses.status','Followed')
                  ->select('youths_courses.*','courses.*','courses.id as course_id', 'youths_courses.id as ys_id','courses_institutes.*','institutes.*','institutes.name as institute_name','courses.name as course_name')
                  ->get();
                  //dd($followed_courses->toArray());

      //get status data
      $current_status= $youth_data->current_status;

      switch ($current_status) {
        case 'Permanent Job After Vocational/Prof Training':
          $jobs_details = DB::table('jobs_details')->whereyouth_id($id)->first();
          $intresting_jobs = null;
          $intresting_business = null;
          $youth_common_details = null;
          $following_course = null;
          break;

          case 'Permanent Job without Vocational/Prof Training':
          $jobs_details = DB::table('jobs_details')->whereyouth_id($id)->first();
          $intresting_jobs = null;
          $intresting_business = null;
          $youth_common_details = null;
          $following_course = null;
          break;

          case 'Temporary Job After Vocational/Prof Training':
          $intresting_jobs = IntrestingJob::with('youth')->whereyouth_id($id)->first();
          
          $intresting_business = DB::table('intresting_business')->whereyouth_id($id)->first();
          $youth_common_details = DB::table('youth_common_details')->whereyouth_id($id)->first();
          $jobs_details = null;
          $following_course = null;
          $intresting_courses = DB::table('intresting_jobs')
                        ->where('intresting_jobs.youth_id', $id)
                        ->first();
          if(!is_null($intresting_courses)){
          $courses_ids = json_decode($intresting_courses->intresting_courses);
          
          //dd($courses_ids);

          $courses = DB::table('course_categories') 
                    ->whereIn('id', $courses_ids)
                    ->get();
          }
          else{
            $courses = null;
          }
          break;

          case 'Temporary Job without Vocational/Prof Training':
          $intresting_jobs = IntrestingJob::with('youth')->whereyouth_id($id)->first();
          
          $intresting_business = DB::table('intresting_business')->whereyouth_id($id)->first();
          $youth_common_details = DB::table('youth_common_details')->whereyouth_id($id)->first();
          $jobs_details = null;
          $following_course = null;
          $intresting_courses = DB::table('intresting_jobs')
                        ->where('intresting_jobs.youth_id', $id)
                        ->first();
          if(!is_null($intresting_courses)){
          $courses_ids = json_decode($intresting_courses->intresting_courses);
          
          //dd($courses_ids);

          $courses = DB::table('course_categories')
                    ->whereIn('id', $courses_ids)
                    ->get();
          }
          else{
            $courses = null;
          }
          break;

          case 'Following a course':
          $following_course = DB::table('youths_courses')
                  ->join('courses','courses.id','=','youths_courses.course_id')
                  ->join('courses_institutes','courses_institutes.course_id','=','youths_courses.course_id')
                  ->join('institutes','institutes.id','=','courses_institutes.institute_id')
                  ->where('youths_courses.youth_id', $id)
                  ->where('youths_courses.status','Following')
                  ->select('youths_courses.*','courses.*','courses.id as course_id', 'youths_courses.id as ys_id','courses_institutes.*','institutes.*','institutes.name as institute_name','courses.name as course_name')
                  ->first();
          $intresting_jobs = IntrestingJob::with('youth')->whereyouth_id($id)->first();
          
          $intresting_business = DB::table('intresting_business')->whereyouth_id($id)->first();
          $youth_common_details = DB::table('youth_common_details')->whereyouth_id($id)->first();
          $jobs_details = null;
          $intresting_courses = DB::table('intresting_jobs')
                        ->where('intresting_jobs.youth_id', $id)
                        ->first();
          if(!is_null($intresting_courses)){
          $courses_ids = json_decode($intresting_courses->intresting_courses);
          
          //dd($courses_ids);

          $courses = DB::table('course_categories')
                    ->whereIn('id', $courses_ids)
                    ->get();
          }
          else{
            $courses = null;
          }
          
          break;

          case 'Self Employed':
          $intresting_jobs = IntrestingJob::with('youth')->whereyouth_id($id)->first();
          
          $youth_common_details = DB::table('youth_common_details')->whereyouth_id($id)->first();
          $jobs_details = DB::table('jobs_details')->whereyouth_id($id)->where('nature_job','Self Employed')->first();
          $following_course = null;
          $intresting_business = null;
          $intresting_courses = DB::table('intresting_jobs')
                        ->where('intresting_jobs.youth_id', $id)
                        ->first();
          if(!is_null($intresting_courses)){
          $courses_ids = json_decode($intresting_courses->intresting_courses);
          
          //dd($courses_ids);

          $courses = DB::table('course_categories')
                    ->whereIn('id', $courses_ids)
                    ->get();
          }
          else{
            $courses = null;
          }
          
          break;
        
        default:
          $intresting_jobs = IntrestingJob::with('youth')->whereyouth_id($id)->first();
          
          $intresting_business = DB::table('intresting_business')->whereyouth_id($id)->first();
          $youth_common_details = DB::table('youth_common_details')->whereyouth_id($id)->first();
          $jobs_details = null;
          $following_course = null;
          $intresting_courses = DB::table('intresting_jobs')
                        ->where('intresting_jobs.youth_id', $id)
                        ->first();
          if(!is_null($intresting_courses)){
          $courses_ids = json_decode($intresting_courses->intresting_courses);
          
          //dd($courses_ids);

          $courses = DB::table('course_categories')
                    ->whereIn('id', $courses_ids)
                    ->get();
          }
          else{
            $courses = null;
          } 
          break;
      }

      return view('Youth.view-youth-profile')->with(['course_categories'=> $course_categories, 'branches' => $branches, 'youth' => $youth_data, 'followed_courses' => $followed_courses, 'results' => $results, 'language' => $language, 'jobs_details' =>$jobs_details, 'intresting_jobs' => $intresting_jobs, 'intresting_business' => $intresting_business,'youth_common_details' => $youth_common_details,'following_course' => $following_course, 'intresting_courses'=> $courses ]);
        
      }

      else{
        return redirect('youth/profile-add')->with('error', 'Please create your profile first.');
      }
      
    }

    public function profile_view_by_branch($id){

      $course_categories = DB::table('course_categories')->get();
      $branches = DB::table('branches')->get();

      $youth_data = Youth::with('family')->whereid($id)->first();
      $results = DB::table('results')->whereyouth_id($id)->first();
      $language = DB::table('language')->whereyouth_id($id)->first();



      $followed_courses = DB::table('youths_courses')
                  ->join('courses','courses.id','=','youths_courses.course_id')
                  ->join('courses_institutes','courses_institutes.course_id','=','youths_courses.course_id')
                  ->join('institutes','institutes.id','=','courses_institutes.institute_id')
                  ->where('youths_courses.youth_id', $id)
                  ->where('youths_courses.status','Followed')
                  ->select('youths_courses.*','courses.*','courses.id as course_id', 'youths_courses.id as ys_id','courses_institutes.*','institutes.*','institutes.name as institute_name','courses.name as course_name')
                  ->get();
                  //dd($followed_courses->toArray());

      //get status data
      $current_status= $youth_data->current_status;

      switch ($current_status) {
        case 'Permanent Job After Vocational/Prof Training':
          $jobs_details = DB::table('jobs_details')->whereyouth_id($id)->first();
          $intresting_jobs = null;
          $intresting_business = null;
          $youth_common_details = null;
          $following_course = null;
          $courses = null;
          break;

          case 'Permanent Job without Vocational/Prof Training':
          $jobs_details = DB::table('jobs_details')->whereyouth_id($id)->first();
          $intresting_jobs = null;
          $intresting_business = null;
          $youth_common_details = null;
          $following_course = null;
          $courses = null;
          break;

          case 'Temporary Job After Vocational/Prof Training':
          $intresting_jobs = IntrestingJob::with('youth')->whereyouth_id($id)->first();
          $intresting_courses = DB::table('intresting_jobs')
                        ->where('intresting_jobs.youth_id', $id)
                        ->first();
          if(!is_null($intresting_courses)){
          $courses_ids = json_decode($intresting_courses->intresting_courses);
          
          //dd($courses_ids);

          $courses = DB::table('course_categories')
                    ->whereIn('id', $courses_ids)
                    ->get();
          }
          else{
            $courses = null;
          }
          $intresting_business = DB::table('intresting_business')->whereyouth_id($id)->first();
          $youth_common_details = DB::table('youth_common_details')->whereyouth_id($id)->first();
          $jobs_details = null;
          $following_course = null;
          break;

          case 'Temporary Job without Vocational/Prof Training':
          $intresting_jobs = IntrestingJob::with('youth')->whereyouth_id($id)->first();
          $intresting_courses = DB::table('intresting_jobs')
                        ->where('intresting_jobs.youth_id', $id)
                        ->first();
          if(!is_null($intresting_courses)){
          $courses_ids = json_decode($intresting_courses->intresting_courses);
          
          //dd($courses_ids);

          $courses = DB::table('course_categories')
                    ->whereIn('id', $courses_ids)
                    ->get();
          }
          else{
            $courses = null;
          }
          $intresting_business = DB::table('intresting_business')->whereyouth_id($id)->first();
          $youth_common_details = DB::table('youth_common_details')->whereyouth_id($id)->first();
          $jobs_details = null;
          $following_course = null;
          break;

          case 'Following a course':
          $following_course = DB::table('youths_courses')
                  ->join('courses','courses.id','=','youths_courses.course_id')
                  ->join('courses_institutes','courses_institutes.course_id','=','youths_courses.course_id')
                  ->join('institutes','institutes.id','=','courses_institutes.institute_id')
                  ->where('youths_courses.youth_id', $id)
                  ->where('youths_courses.status','Following')
                  ->select('youths_courses.*','courses.*','courses.id as course_id', 'youths_courses.id as ys_id','courses_institutes.*','institutes.*','institutes.name as institute_name','courses.name as course_name')
                  ->first();
          $intresting_jobs = IntrestingJob::with('youth')->whereyouth_id($id)
          ->first();
          
          $intresting_business = DB::table('intresting_business')->whereyouth_id($id)->first();
          $youth_common_details = DB::table('youth_common_details')->whereyouth_id($id)->first();
          $jobs_details = null;
          $intresting_courses = DB::table('intresting_jobs')
                        ->where('intresting_jobs.youth_id', $id)
                        ->first();
          if(!is_null($intresting_courses)){
          $courses_ids = json_decode($intresting_courses->intresting_courses);
          
          //dd($courses_ids);

          $courses = DB::table('course_categories')
                    ->whereIn('id', $courses_ids)
                    ->get();
          }
          else{
            $courses = null;
          }
          
          break;

          case 'Self Employed':
          $intresting_jobs = IntrestingJob::with('youth')->whereyouth_id($id)->first();
          $intresting_courses = DB::table('intresting_jobs')
                        ->where('intresting_jobs.youth_id', $id)
                        ->first();
          if(!is_null($intresting_courses)){
          $courses_ids = json_decode($intresting_courses->intresting_courses);
          
          //dd($courses_ids);

          $courses = DB::table('course_categories')
                    ->whereIn('id', $courses_ids)
                    ->get();
          }
          else{
            $courses = null;
          }
          $youth_common_details = DB::table('youth_common_details')->whereyouth_id($id)->first();
          $jobs_details = DB::table('jobs_details')->whereyouth_id($id)->where('nature_job','Self Employed')->first();
          $following_course = null;
          $intresting_business = null;
          
          break;
        
        default:
          $intresting_jobs = IntrestingJob::with('youth')->whereyouth_id($id)->first();
          $intresting_courses = DB::table('intresting_jobs')
                        ->where('intresting_jobs.youth_id', $id)
                        ->first();
          if(!is_null($intresting_courses)){
          $courses_ids = json_decode($intresting_courses->intresting_courses);
          
          //dd($courses_ids);

          $courses = DB::table('course_categories')
                    ->whereIn('id', $courses_ids)
                    ->get();
          }
          else{
            $courses = null;
          }
          //dd($courses->toArray());
          $intresting_business = DB::table('intresting_business')->whereyouth_id($id)->first();
          $youth_common_details = DB::table('youth_common_details')->whereyouth_id($id)->first();
          $jobs_details = null;
          $following_course = null;
          break;
      }


      return view('Youth.view-youth-profile')->with(['course_categories'=> $course_categories, 'branches' => $branches, 'youth' => $youth_data, 'followed_courses' => $followed_courses, 'results' => $results, 'language' => $language, 'jobs_details' =>$jobs_details, 'intresting_jobs' => $intresting_jobs, 'intresting_business' => $intresting_business,'youth_common_details' => $youth_common_details,'following_course' => $following_course,'intresting_courses'=> $courses ]);
        
      
      
    }

    public function applications(){
      $branch = auth()->user()->branch;

      if(is_null($branch)){

      $applications = DB::table('youths_vacancies')
                      ->join('youths','youths.id','=','youths_vacancies.youth_id')
                      ->join('vacancies','vacancies.id','=','youths_vacancies.vacancy_id')
                      ->join('employers','employers.id','=','vacancies.employer_id')
                      ->select('youths_vacancies.*','youths.*','youths.name as youth_name','vacancies.*','employers.*','employers.name as employer_name','employers.email as employer_email','employers.phone as employer_phone','youths_vacancies.id as application_id')
                      ->orderBy('application_id', 'DESC')
                      ->get();
      $new_count = DB::table('youths_vacancies')->where('status', null)->count();
      }
      else{
        $applications = DB::table('youths_vacancies')
                      ->join('youths','youths.id','=','youths_vacancies.youth_id')
                      ->join('vacancies','vacancies.id','=','youths_vacancies.vacancy_id')
                      ->join('employers','employers.id','=','vacancies.employer_id')
                      ->select('youths_vacancies.*','youths.*','youths.name as youth_name','vacancies.*','employers.*','employers.name as employer_name','employers.email as employer_email','employers.phone as employer_phone','youths_vacancies.id as application_id')
                      ->where('youths.branch_id',$branch)
                      ->orderBy('application_id', 'DESC')
                      ->get();
      $new_count = DB::table('youths_vacancies')
                   ->join('youths','youths.id','=','youths_vacancies.youth_id')
                   ->where('youths.branch_id',$branch)
                  ->where('status', null)->count();
      }
      return view('Youth.applications')->with(['applications'=> $applications,'new_count' => $new_count]);
    }

    public function application_status(Request $request){
        $id = Input::get('id');
        $status = Input::get('status');
        $change_date = date('Y-m-d');

        //echo "<script>console.log( 'Debug Objects: " . $role_id . "' );</script>";
        

        $data = array(
            'status' => $status,
            'status_change_date' => $change_date
        );

        $application = DB::table('youths_vacancies')->whereid($id)->update($data);

    }

   

}
