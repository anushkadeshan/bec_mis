<?php

namespace App\Http\Controllers;

use App\Family;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Session;
use App\Notifications\FamilyAdd;
use App\User;

class FamilyController extends Controller
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
        $districts = DB::table('districts')->get();
     return view('Youth.add-family')->with('districts', $districts);
    }

    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $validator = Validator::make($request->all(),[
                'district' => 'required',
                'ds_division' => 'required',
                'gn_division' => 'required',
                'head_of_household' => 'required|unique:families',
                'address' => 'required',
                'family_type' => 'required',
            ]);
        if($validator->passes()){
              $added_by = auth()->user()->name;
              $data = $request->all();
              $family = Family::create($data+['added_by'=>$added_by]);

              $family_id = $family->id;
              Session::put('family_id', $family_id);

              //send notofications 
               $notifyTo = User::whereHas('roles', function($q){$q->whereIn('slug', ['admin']);})->get();
               foreach ($notifyTo as $notifyUser) {
                   $notifyUser->notify(new FamilyAdd($added_by));
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
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $family = DB::table('families')
                  ->join('dsd_office','dsd_office.ID','=','families.ds_division')
                  ->join('gn_office','gn_office.GN_ID','=','families.gn_division')
                  ->where('families.id',$id)
                  ->first();
       $districts = DB::table('districts')->get();


        return view('Youth.edit-family')->with(['family'=> $family,'districts'=>$districts]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $family = Family::find($request->family_id);
              $family->district = $request->district;
              $family->ds_division = $request->ds_division;
              $family->gn_division = $request->gn_division;
              $family->head_of_household = $request->head_of_household;
              $family->nic_head_of_household = $request->nic_head_of_household;
              $family->address = $request->address;
              $family->family_type = $request->family_type;
              $family->total_income = $request->total_income;
              $family->total_members = $request->total_members;
              $family->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function families()
    {
        $branch = auth()->user()->branch;

        if(is_null($branch)){
        $data = DB::table('youths')
                ->join('families','families.id','=','youths.family_id')
                ->join('dsd_office','dsd_office.ID','=','families.ds_division')
                ->join('gn_office','gn_office.GN_ID','=','families.gn_division')
                ->join('branches','branches.id','=','youths.branch_id')
                ->select('youths.*','youths.name as youth_name','families.*','branches.*','families.id as fam','dsd_office.*','gn_office.*','youths.id as youth_id')
                ->get();
        }
        else{
            $data = DB::table('youths')
                ->join('families','families.id','=','youths.family_id')
                ->join('dsd_office','dsd_office.ID','=','families.ds_division')
                ->join('gn_office','gn_office.GN_ID','=','families.gn_division')
                ->join('branches','branches.id','=','youths.branch_id')
                ->select('youths.*','youths.name as youth_name','families.*','branches.*','families.id as fam','dsd_office.*','gn_office.*','youths.id as youth_id')
                ->where('youths.branch_id',$branch)
                ->get();

        }   

   // dd($data);
        return view('Youth.families')->with(['data'=> $data]);
    }
}
