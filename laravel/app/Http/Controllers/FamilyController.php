<?php

namespace App\Http\Controllers;

use App\Family;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Session;

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
                'head_of_household' => 'required',
                'address' => 'required',
                'nic_head_of_household' => 'required|unique:families',
                'family_type' => 'required',
            ]);
        if($validator->passes()){
              $added_by = auth()->user()->name;
              $data = $request->all();
              $family = Family::create($data+['added_by'=>$added_by]);

              $family_id = $family->id;
              Session::put('family_id', $family_id);

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
    public function show(Family $family)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function edit(Family $family)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Family $family)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family $family)
    {
        //
    }
}
