<?php

namespace App\Http\Controllers;


use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Gate;
use App\Notifications\EmployerAdd;
use App\Employer;
use App\User; 
use App\Role;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;
use App\Notifications\FollowYouth;

class EmployerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employers = Employer::with('user')->get();
        return view('Employer.employers')->with('employers', $employers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'phone' => 'required|numeric|digits:10',
            'address' => 'required',
            'email' => 'required|email|unique:employers',
            'company_type' => 'required',
            'industry' => 'required'
        ]);

        if($validator ->passes()){
            $data = $request->all();
            $roleName = 'Employer';
            $user = auth()->user();
            $added_by = auth()->user()->id;

            if($user->is($roleName)){ 
                $email = auth()->user()->email;
                $employer = Employer::create($data +['email' => $email,'added_by'=>$added_by]);
            }

            else{
                $employer = Employer::create($data+['added_by'=>$added_by]);

            }
                $dataAddUser = $request->user_id;
                $notifyTo = User::whereHas('roles', function($q){$q->whereIn('slug', ['admin' , 'branch']);})->get();

                foreach ($notifyTo as $notifyUser) {
                     $notifyUser->notify(new EmployerAdd($employer));
                }
               
            
            }
        else{
            return response()->json(['error' => $validator->errors()->all()]);
        }
        

         
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function profile(Employer $employer)
    {
        $email = auth()->user()->email;
        
       $employer = Employer::where('email',$email)->orWhere('user_id', auth()->user()->id)->first();
       $vacancies = Employer::with('vacancies')->count();

       $applications = DB::table('youths_vacancies')
                       ->join('vacancies','vacancies.id','=','youths_vacancies.vacancy_id')
                       ->join('employers','employers.id','=','vacancies.employer_id')
                       ->where('employers.email',$email)
                       ->count();
       return view('Employer.profile')->with(['employer'=> $employer , 'vacancies_count' => $vacancies,'applications_count'=> $applications]);
    }

    public function profileUpdate(Request $request)
    {
       $email = auth()->user()->email;
    
       $validator = Validator::make($request->all(),[
            'name' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
            'company_type' => 'required',
            'industry' => 'required'
        ]);

        if($validator->passes()){
            $employer = Employer::firstOrNew(['email'=> $email]);
            $employer->name = $request->name;
            $employer->phone = $request->phone;
            $employer->address = $request->address;
            $employer->company_type = $request->company_type;
            $employer->industry = $request->industry;
            $employer->user_id = $request->user_id;

            $employer->save();
        }

        else{
            return response()->json(['error' => $validator->errors()->all()]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $employer = Employer::find($id);
        return response($employer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
            'email' => 'required|email',
            'company_type' => 'required',
            'industry' => 'required'
        ]);

        if($validator->passes()){
            $added_by = auth()->user()->id;

            $employer = Employer::find($request->id);
            $employer->name = $request->name;
            $employer->phone = $request->phone;
            $employer->email = $request->email;
            $employer->address = $request->address;
            $employer->company_type = $request->company_type;
            $employer->industry = $request->industry;
            $employer->added_by = $added_by;

            $employer->save();
        }

        else{
            return response()->json(['error' => $validator->errors()->all()]);
        }

        


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
         
        $id = Input::get('id');
        $employer = Employer::find($id);
        $employer->delete();

    }

    public function select(Request $request){
        $employer_id = Auth::id();   
        $employer = Employer::findOrFail($employer_id);
        $employer->youths()->sync($request->youth_id);

        //notify to relevent branch
        $youth_table = DB::table('youths')
                       ->join('users','users.branch','=','youths.branch_id')
                        ->where('youths.id', $request->youth_id)
                        ->select('users.id as user_id')
                        ->first(); 
        $notify_branch_id = $youth_table->user_id;               
        $notify_branch = User::where('id',$notify_branch_id)->first();

        $notify_branch->notify(new FollowYouth($employer));

        //notify to admin
        $notifyToAdmin = User::whereHas('roles', function($q){$q->whereIn('slug', ['admin']);})->get();
        foreach ($notifyToAdmin as $notifyUser) {
        $notifyUser->notify(new FollowYouth($employer));
        } 
    }

    public function followers(){
        $branch = auth()->user()->branch;

        if(is_null($branch)){
        $followers = DB::table('employers_follow_youths')
                     ->join('youths','youths.id','=','employers_follow_youths.youth_id')
                     ->join('employers','employers.id','=','employers_follow_youths.employer_id')
                     ->join('families','families.id','=','youths.family_id')
                     ->select('employers_follow_youths.*','employers_follow_youths.id as employers_follow_youths_id','youths.*','youths.name as youth_name','youths.phone as youth_phone','youths.email as youth_email','employers.*','employers.name as employer_name','employers.address as employer_address','employers.phone as employer_phone','employers.email as employer_email','families.*','families.address as family_address')
                     ->orderBy('employers_follow_youths_id', 'DESC')
                     ->get();   
        $new_count = DB::table('employers_follow_youths')->where('status', null)->count();
        }
        else{
            $followers = DB::table('employers_follow_youths')
                     ->join('youths','youths.id','=','employers_follow_youths.youth_id')
                     ->join('employers','employers.id','=','employers_follow_youths.employer_id')
                     ->join('families','families.id','=','youths.family_id')
                     ->select('employers_follow_youths.*','employers_follow_youths.id as employers_follow_youths_id','youths.*','youths.name as youth_name','youths.phone as youth_phone','youths.email as youth_email','employers.*','employers.name as employer_name','employers.address as employer_address','employers.phone as employer_phone','employers.email as employer_email','families.*','families.address as family_address')
                     ->where('youths.branch_id',$branch)
                     ->orderBy('employers_follow_youths_id', 'DESC')
                     ->get();   
        $new_count = DB::table('employers_follow_youths')
                     ->join('youths','youths.id','=','employers_follow_youths.youth_id')
                     ->where('youths.branch_id',$branch)
                     ->where('status', null)->count();
        }
        return view('Youth.view-youth-followers')->with(['followers'=> $followers,'new_count'=>$new_count]);
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

        $application = DB::table('employers_follow_youths')->whereid($id)->update($data);

    }
}
