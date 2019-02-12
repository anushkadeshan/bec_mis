<?php

namespace App\Http\Controllers;

use App\Vacancy;
use Illuminate\Http\Request;
use DB;
use App\Notifications\vacancyAdd;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Employer;

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
               $vacancies = Vacancy::with('employer')->where('employer_id', $employer_id)->get();
               return view('Employer.vacancies')->with('vacancies', $vacancies);

            }
            
        }
        else{
            $vacancies = Vacancy::with('employer')->get();
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
        //dd($vacancy->toArray());
        return view('Employer.view-vacancy')->with('vacancy', $vacancy);
    }

    public function apply(){
        
    }
}
