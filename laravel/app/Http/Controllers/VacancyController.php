<?php

namespace App\Http\Controllers;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Notifiable;
use App\Vacancy;
use Illuminate\Http\Request;
use DB;
use App\Notifications\vacancyAdd;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Employer;
use Auth;
use Noifiable;
use App\Youth;
use App\Notifications\applyVacancy;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

class VacancyController extends Controller
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
    public function index(){
        $roleName = 'Employer';
        $user = auth()->user();
        if($user->is($roleName)){
            $email = auth()->user()->email;
            $employer = Employer::where('email',$email)->first();
            if(!$employer){
                return redirect()->route('e-profile')->withErrors(['msg', 'Please complete the profile before add vacancies']);
            }
            else{

               $employer_id = $employer->id;
               $vacancies = Vacancy::with('employer')
                            ->where('employer_id', $employer_id)
                            ->get();
               return view('Employer.vacancies')->with('vacancies', $vacancies);

            }
            
        }
        else{
           
               if (Gate::allows('apply-vacancy')) {
                    $vacancies = Vacancy::with('employer')->where('dedline', '>', Carbon::now())->get();
               } 

               else{
                  $vacancies = Vacancy::with('employer')->get();
               }
                
                //dd($vacancy->toArray());
                return view('Employer.vacancies')->with('vacancies', $vacancies);
            
        }

        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function locationList(Request $request){
        if($request->get('query')){
          $query = $request->get('query');
          $data = DB::table('cities')
            ->where('name_en', 'LIKE', "%{$query}%")
            ->get();
          $output = '<ul class="dropdown-menu" id="autocomplete" style="display:block; position:relative">';
          foreach($data as $row)
          {
           $output .= '
           <li><a href="#" id="">'.$row->name_en.'</a></li>
           ';
          }
          $output .= '</ul>';
          echo $output;
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
        $roleName = 'Employer';
        $user = auth()->user();
        if($user->is($roleName)){
            $validator = Validator::make($request->all(),[
                'title' => 'required',
                'description' => 'required',
                'job_type' => 'required',
                'business_function' => 'required',
                'location' => 'required',
                'dedline' => 'required',
                'min_qualification' => 'required',
                'specializaion' => 'required',
                'gender' => 'required',
            ]);

            if($validator->passes()){
                $data = $request->all();
                $user_id = auth()->user()->id;
                $email = auth()->user()->email;
                $employer = Employer::where('email',$email)->orWhere('user_id', auth()->user()->id)->first();
                $employer_id = $employer->id;
                $vacancy = Vacancy::create($data+['user_id'=> $user_id, 'employer_id'=> $employer_id]);

                //send notofications 
                $notifyTo = User::whereHas('roles', function($q){$q->whereIn('slug', ['branch' , 'trainers' , 'youth' , 'guest','admin']);})->get();
                foreach ($notifyTo as $notifyUser) {
                    $notifyUser->notify(new vacancyAdd($vacancy));
                }
            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
        }

        else{
            $validator = Validator::make($request->all(),[
                'title' => 'required',
                'description' => 'required',
                'job_type' => 'required',
                'business_function' => 'required',
                'location' => 'required',
                'dedline' => 'required',
                'min_qualification' => 'required',
                'specializaion' => 'required',
                'gender' => 'required',
                'employer_id' =>'required'
            ]);

            if($validator->passes()){
                $data = $request->all();
                $user_id = auth()->user()->id;
                $vacancy = Vacancy::create($data+['user_id'=> $user_id]);

                //send notifications
                $notifyTo = User::whereHas('roles', function($q){$q->whereIn('slug', ['branch' , 'trainers' , 'youth' , 'guest','admin']);})->get();
                foreach ($notifyTo as $notifyUser) {
                    $notifyUser->notify(new vacancyAdd($vacancy));
                }
            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function show(Vacancy $vacancy){
        $user = auth()->user();
        $roleName = 'Employer';
        $email = auth()->user()->email;
        $employer = Employer::where('email',$email)->orWhere('user_id', auth()->user()->id)->first();
        if($user->is($roleName)){
            if($employer){
                return view('Employer.newVacancy');
            }
            else{
                return redirect()->route('e-profile')->withErrors(['msg', 'Please complete the profile before add vacancies']);

            }
        
        }
        else{
            $employers = Employer::with('user')->get();
            return view('Employer.newVacancy')->with('employers', $employers);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vacancy = Vacancy::with('employer')->where('id', $id)->first();
        $employers = Employer::get();
        //dd($vacancy->toArray());
        return view('Employer.edit-vacancy')->with(['vacancy'=> $vacancy, 'employers' => $employers]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->all();
        $row = Vacancy::findOrFail($request->id);


        $update = $row->fill($data)->save();
        if($update){
            \Session::flash('success','Vacancy Successfully updated.');
            return redirect()->back();
        }

        else{
            \Session::flash('error','Something Error.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = $request->id;
        $employer = Vacancy::find($id);
        $employer->delete();
    }

    public function view($id){

        $vacancy = Vacancy::where('id', $id)->with('employer')->first();
        return view('Employer.view-vacancy')->with('vacancy', $vacancy);
            
    }

    public function apply(Request $request){
      $user_id = Auth::id();
      if (Youth::where('user_id', $user_id)->exists()) {
        $roleName = 'Youth';
        $user = auth()->user();
        if($user->is($roleName)){
            $user_id = Auth::id();
            $youth = Youth::where('user_id',$user_id)->first();
            $youth_id =  $youth->id;
            if (DB::table('youths_vacancies')->where('vacancy_id', '=', $request->id)
                ->where('youth_id','=',$youth_id)
                ->exists()) {
                return response()->json(['error' => 'You have already apply for this vacancy.']);
            }
            else{
                $data = array(
                'youth_id' => $youth_id,
                'vacancy_id' => $request->id,
                'applied_on' => date("Y-m-d"),
                );

                $vacancy = Vacancy::findOrFail($request->id);
                $vacancy->youths()->attach($youth_id);

                //$vacancy = DB::table('youths_vacancies')->insert($data);

                //notify to releven employer
                $vacancies = DB::table('vacancies')
                ->join('employers','employers.id','=','vacancies.employer_id')
                ->where('vacancies.id',$request->id)->first();
                $employer_id = $vacancies->employer_id;

                $employer = DB::table('employers')
                            ->join('users','users.email','=','employers.email')
                            ->where('employers.id',$employer_id)
                            ->select('users.id as user_id')
                            ->first();
                $user = User::where('id',$employer->user_id)->first();

                $user->notify(new applyVacancy($vacancy));

                //notify to relevent branch

                $youth_table = DB::table('youths')
                               ->join('users','users.branch','=','youths.branch_id')
                               ->where('youths.id', $youth_id)
                               ->select('users.id as user_id')
                               ->first(); 
                $notify_branch_id = $youth_table->user_id;               
                $notify_branch = User::where('id',$notify_branch_id)->first();

                $notify_branch->notify(new applyVacancy($vacancy));

                //notify to admin
                $notifyToAdmin = User::whereHas('roles', function($q){$q->whereIn('slug', ['admin']);})->get();
                foreach ($notifyToAdmin as $notifyUser) {
                    $notifyUser->notify(new applyVacancy($vacancy));
                }

            }

        }
        else{
            return response()->json(['error' => 'You are not authorize to apply job vacancies.']);
        }

      }
      else{
         return response()->json(['error' => 'Please create your profile before apply vacancies.']);
            
      }

    }

    public function vacancies_api(){
      $vacancies = Vacancy::with('employer')->get();

      return response()->json($vacancies);
    }
}
