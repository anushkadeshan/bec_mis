<?php

namespace App\Http\Controllers;

use App\Resourse_person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ResoursePersonController extends Controller
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
        return view('Activities.resourse_person');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
               'name' => 'required',
               'cv' => 'mimes:pdf,doc,docx|max:6000'
            ]);
        if($validator->passes()){
            $input = $request->all();
            $input['cv'] = time().'.'.$request->file('cv')->getClientOriginalExtension();
            $request->cv->move(storage_path('activities/files/mentoring/images'), $input['cv']);
            //dd($input);
            Resourse_person::create($input);
        }

        else{
               return response()->json(['error' => $validator->errors()->all()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Resourse_person  $resourse_person
     * @return \Illuminate\Http\Response
     */
    public function show(Resourse_person $resourse_person)
    {
        $data = Resourse_person::all();

        return view('reports.resource-people')->with(['resources' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Resourse_person  $resourse_person
     * @return \Illuminate\Http\Response
     */
    public function edit(Resourse_person $resourse_person)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Resourse_person  $resourse_person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resourse_person $resourse_person)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Resourse_person  $resourse_person
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        //$file_name = $request->attendance;
        $file = storage_path('activities/files/mentoring/images/'.$id.'');
        //echo "<script>console.log( 'Debug Objects: " . $file_name . "' );</script>";

        $headers = [
                  'Content-Type' => 'application/pdf',
                  'Content-Type' => 'application/msword'
               ];
      // return Storage::download(filePath, Appended Text);
        return response()->file($file,$headers);
    }
}
