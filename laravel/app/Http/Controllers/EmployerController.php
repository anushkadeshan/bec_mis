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
            if($user->is($roleName)){ 
                $email = auth()->user()->email;
                $employer = Employer::create($data +['email' => $email]);
            }

            else{
                $employer = Employer::create($data);

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
       return view('Employer.profile')->with(['employer'=> $employer , 'vacancies_count' => $vacancies]);
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
            $employer = Employer::find($request->id);
            $employer->name = $request->name;
            $employer->phone = $request->phone;
            $employer->email = $request->email;
            $employer->address = $request->address;
            $employer->company_type = $request->company_type;
            $employer->industry = $request->industry;

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
}
