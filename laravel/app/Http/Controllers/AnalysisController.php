<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class AnalysisController extends Controller
{
    public function job(){

    	$branches = DB::table('branches')->get();
    	return view('Analysis.dashboard')->with(['branches'=>$branches]);		
    }

    public function fetch_job(Request $request){
    	$branch_id = Auth::user()->branch;
    	//if click filter button
    	if($request->ajax()){
    		if($request->dateStart != '' && $request->dateEnd != ''){
    			if($request->branch!=''){
    				switch ($branch_id) {
    					case  null:
    					$male_individuals = DB::table('placement_individual')
		    			->join('youths','youths.id','=','placement_individual.youth_id')
		    			->where('gender','male')
		    			->where('youths.branch_id',$request->branch)
		    			->whereBetween('placement_individual.program_date', [$request->dateStart, $request->dateEnd])
		    			->count();

		    			$awaraness = DB::table('awareness')
					    			->where('awareness.branch_id',$request->branch)
					    			->whereBetween('awareness.program_date', [$request->dateStart, $request->dateEnd])
					    			->count();

					    $assesments = DB::table('assesments')
					    			->where('assesments.branch_id',$request->branch)
					    			->whereBetween('assesments.program_date', [$request->dateStart, $request->dateEnd])
					    			->count();

				    	$male_fair = DB::table('placements_youths')
				    			->join('placements','placements.id','=','placements_youths.placements_id')
				    			->join('youths','youths.id','=','placements_youths.youth_id')
				    			->where('gender','male')
				    			->where('placements.branch_id',$request->branch)
				    			->whereBetween('placements.program_date', array($request->dateStart, $request->dateEnd))
				    			->count();

				    	$female_individuals = DB::table('placement_individual')
				    			->join('youths','youths.id','=','placement_individual.youth_id')
				    			->whereBetween('placement_individual.program_date', array($request->dateStart, $request->dateEnd))
				    			->where('gender','female')
				    			->where('youths.branch_id',$request->branch)
				    			->count();

				    	$female_fair = DB::table('placements_youths')
				    			->join('placements','placements.id','=','placements_youths.placements_id')
				    			->join('youths','youths.id','=','placements_youths.youth_id')
				    			->where('gender','female')
				    			->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
				    			->where('placements.branch_id',$request->branch)
				    			->count();


				    	$male = $male_individuals+$male_fair;
				    	$female = $female_individuals+$female_fair;

				    	$locations_i = DB::table('placement_individual')
				    			->join('youths','youths.id','=','placement_individual.youth_id')
				    			->join('families','families.id','=','youths.family_id')
				    			->join('dsd_office','dsd_office.ID','=','families.ds_division')
				    			->whereBetween('program_date', [new Carbon($request->dateStart), new Carbon($request->dateEnd)])
				    			->where('placement_individual.branch_id',$request->branch)
				    			->select('DSD_Name', DB::raw('count(*) as total'))
				    			->groupBy('DSD_Name')->get();

				    	$locations2 = DB::table('placements_youths')
				    			->join('placements','placements.id','=','placements_youths.placements_id')
				    			->join('youths','youths.id','=','placements_youths.youth_id')
				    			->join('families','families.id','=','youths.family_id')
				    			->join('dsd_office','dsd_office.ID','=','families.ds_division')
				    			->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
				    			->where('placements.branch_id',$request->branch)
				    			->select('DSD_Name', DB::raw('count(*) as total'))
				    			->groupBy('DSD_Name')
				    			//->union($locations_i)
				    			->get();
			    		$locations = $locations_i->merge($locations2);

				    	$salary1 = DB::table('placements_youths')  
			                      ->join('placements','placements.id','=','placements_youths.placements_id') 
			                      ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
			                      ->where('placements.branch_id','=',$request->branch) 
			                       ->whereBetween('salary',[0, 4999])
			                       ->count()+(DB::table('placement_individual')
			                       	->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
			                       ->where('placement_individual.branch_id','=',$request->branch)   
			                       ->whereBetween('salary',[0, 4999])
			                       ->count());  

			            $salary2 = DB::table('placements_youths')   
			                      ->join('placements','placements.id','=','placements_youths.placements_id') 
			                      ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
			                      ->where('placements.branch_id','=',$request->branch) 
			                       ->whereBetween('salary',[5000, 9999])
			                       ->count()+(DB::table('placement_individual')   
			                       	->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
			                       ->where('placement_individual.branch_id','=',$request->branch)   
			                       ->whereBetween('salary',[5000, 9999])
			                       ->count()); 

			            $salary3 = DB::table('placements_youths')   
			                      ->join('placements','placements.id','=','placements_youths.placements_id') 
			                      ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
			                      ->where('placements.branch_id','=',$request->branch) 
			                       ->whereBetween('salary',[10000, 14999])
			                       ->count()+(DB::table('placement_individual')   
			                       ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
			                       ->where('placement_individual.branch_id','=',$request->branch)   
			                       ->whereBetween('salary',[10000, 14999])
			                       ->count()); 

			            $salary4 = DB::table('placements_youths')   
			                      ->join('placements','placements.id','=','placements_youths.placements_id') 
			                      ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
			                      ->where('placements.branch_id','=',$request->branch) 
			                       ->whereBetween('salary',[15000, 19999])
			                       ->count()+(DB::table('placement_individual')   
			                       ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
			                       ->where('placement_individual.branch_id','=',$request->branch)   
			                       ->whereBetween('salary',[15000, 19999])
			                       ->count());  

			            $salary5 = DB::table('placements_youths')   
			                      ->join('placements','placements.id','=','placements_youths.placements_id') 
			                      ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
			                      ->where('placements.branch_id','=',$request->branch) 
			                       ->whereBetween('salary',[20000, 24999])
			                       ->count()+(DB::table('placement_individual')   
			                       ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
			                       ->where('placement_individual.branch_id','=',$request->branch)   
			                       ->whereBetween('salary',[20000, 24999])
			                       ->count()); 

			            $salary6 = DB::table('placements_youths')   
			                      ->join('placements','placements.id','=','placements_youths.placements_id')
			                      ->whereBetween('program_date', array($request->dateStart, $request->dateEnd)) 
			                      ->where('placements.branch_id','=',$request->branch) 
			                       ->where('salary','>=', 25000)
			                       ->count()+(DB::table('placement_individual')   
			                       	->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
			                       ->where('placement_individual.branch_id','=',$request->branch)   
			                       ->where('salary','>=', 25000)
			                       ->count());
			            $employer_i = DB::table('placement_individual')
				    			->join('employers','employers.id','=','placement_individual.employer_id')
				    			->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
				    			->where('placement_individual.branch_id','=',$request->branch)
				    			->select('name', DB::raw('count(*) as total'))
				    			->groupBy('name')->get();

				    	$employers2 = DB::table('placements_youths')
				    			->join('employers','employers.id','=','placements_youths.employer')
				    			->join('placements','placements.id','=','placements_youths.placements_id')
				    			->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
				    			->where('placements.branch_id','=',$request->branch) 
				    			->select('name', DB::raw('count(*) as total'))
				    			->groupBy('name')
				    			->orderBy('total', 'DESC')
				    			->get();  

				    	$employers = $employer_i->merge($employers2);

				    	$types1 = DB::table('placement_individual')
	        		->join('employers','employers.id','=','placement_individual.employer_id')
				    ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
	        		->where('placement_individual.branch_id','=',$request->branch)
	        		->select('company_type', DB::raw('count(*) as total'))
	        		->groupBy('company_type')->get();

	        		$types2 = DB::table('placements_youths')
	        		->join('employers','employers.id','=','placements_youths.employer')
				    ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
	        		->join('placements','placements.id','=','placements_youths.placements_id')
	        		->where('placements.branch_id','=',$request->branch) 
	        		->select('company_type', DB::raw('count(*) as total'))
	        		->groupBy('company_type')
	        		->orderBy('total', 'DESC')
	        		->get();  

	        		$types = $types1->merge($types2);

	        		$industry1 = DB::table('placement_individual')
	        		->join('employers','employers.id','=','placement_individual.employer_id')
				    ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
	        		->where('placement_individual.branch_id','=',$request->branch)
	        		->select('industry', DB::raw('count(*) as total'))
	        		->groupBy('industry')->get();

	        		$industry2 = DB::table('placements_youths')
	        		->join('employers','employers.id','=','placements_youths.employer')
				    ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
	        		->join('placements','placements.id','=','placements_youths.placements_id')
	        		->where('placements.branch_id','=',$request->branch) 
	        		->select('industry', DB::raw('count(*) as total'))
	        		->groupBy('industry')
	        		->orderBy('total', 'DESC')
	        		->get();  

	        		$industries = $industry1->merge($industry2);
    						break;
    					
    					default:

    					$awaraness = DB::table('awareness')
					    			->whereBetween('awareness.program_date', [$request->dateStart, $request->dateEnd])
					    			->count();

					    $assesments = DB::table('assesments')
					    			->whereBetween('assesments.program_date', [$request->dateStart, $request->dateEnd])
					    			->count();

    					$male_individuals = DB::table('placement_individual')
    					->join('youths','youths.id','=','placement_individual.youth_id')
    					->where('gender','male')
    					//->where('youths.branch_id',$request->branch)
    					->whereBetween('placement_individual.program_date', [$request->dateStart, $request->dateEnd])
    					->count();


    					$male_fair = DB::table('placements_youths')
    					->join('placements','placements.id','=','placements_youths.placements_id')
    					->join('youths','youths.id','=','placements_youths.youth_id')
    					->where('gender','male')
    					//->where('placements.branch_id',$request->branch)
    					->whereBetween('placements.program_date', array($request->dateStart, $request->dateEnd))
    					->count();

    					$female_individuals = DB::table('placement_individual')
    					->join('youths','youths.id','=','placement_individual.youth_id')
    					->whereBetween('placement_individual.program_date', array($request->dateStart, $request->dateEnd))
    					->where('gender','female')
    				//	->where('youths.branch_id',$request->branch)
    					->count();

    					$female_fair = DB::table('placements_youths')
    					->join('placements','placements.id','=','placements_youths.placements_id')
    					->join('youths','youths.id','=','placements_youths.youth_id')
    					->where('gender','female')
    					->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    				//	->where('placements.branch_id',$request->branch)
    					->count();


    					$male = $male_individuals+$male_fair;
    					$female = $female_individuals+$female_fair;

    					$locations_i = DB::table('placement_individual')
    					->join('youths','youths.id','=','placement_individual.youth_id')
    					->join('families','families.id','=','youths.family_id')
    					->join('dsd_office','dsd_office.ID','=','families.ds_division')
    					->whereBetween('program_date', [new Carbon($request->dateStart), new Carbon($request->dateEnd)])
    				//	->where('placement_individual.branch_id',$request->branch)
    					->select('DSD_Name', DB::raw('count(*) as total'))
    					->groupBy('DSD_Name')->get();

    					$locations2 = DB::table('placements_youths')
    					->join('placements','placements.id','=','placements_youths.placements_id')
    					->join('youths','youths.id','=','placements_youths.youth_id')
    					->join('families','families.id','=','youths.family_id')
    					->join('dsd_office','dsd_office.ID','=','families.ds_division')
    					->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    				//	->where('placements.branch_id',$request->branch)
    					->select('DSD_Name', DB::raw('count(*) as total'))
    					->groupBy('DSD_Name')
				    			//->union($locations_i)
    					->get();
    					$locations = $locations_i->merge($locations2);

    					$salary1 = DB::table('placements_youths')  
    					->join('placements','placements.id','=','placements_youths.placements_id') 
    					->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    					//->where('placements.branch_id','=',$request->branch) 
    					->whereBetween('salary',[0, 4999])
    					->count()+(DB::table('placement_individual')
    						->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    					//	->where('placement_individual.branch_id','=',$request->branch)   
    						->whereBetween('salary',[0, 4999])
    						->count());  

    					$salary2 = DB::table('placements_youths')   
    					->join('placements','placements.id','=','placements_youths.placements_id') 
    					->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    					//->where('placements.branch_id','=',$request->branch) 
    					->whereBetween('salary',[5000, 9999])
    					->count()+(DB::table('placement_individual')   
    						->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    						//->where('placement_individual.branch_id','=',$request->branch)   
    						->whereBetween('salary',[5000, 9999])
    						->count()); 

    					$salary3 = DB::table('placements_youths')   
    					->join('placements','placements.id','=','placements_youths.placements_id') 
    					->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    					//->where('placements.branch_id','=',$request->branch) 
    					->whereBetween('salary',[10000, 14999])
    					->count()+(DB::table('placement_individual')   
    						->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    					//	->where('placement_individual.branch_id','=',$request->branch)   
    						->whereBetween('salary',[10000, 14999])
    						->count()); 

    					$salary4 = DB::table('placements_youths')   
    					->join('placements','placements.id','=','placements_youths.placements_id') 
    					->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    				//	->where('placements.branch_id','=',$request->branch) 
    					->whereBetween('salary',[15000, 19999])
    					->count()+(DB::table('placement_individual')   
    						->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    				//		->where('placement_individual.branch_id','=',$request->branch)   
    						->whereBetween('salary',[15000, 19999])
    						->count());  

    					$salary5 = DB::table('placements_youths')   
    					->join('placements','placements.id','=','placements_youths.placements_id') 
    					->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    				//	->where('placements.branch_id','=',$request->branch) 
    					->whereBetween('salary',[20000, 24999])
    					->count()+(DB::table('placement_individual')   
    						->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    					//	->where('placement_individual.branch_id','=',$request->branch)   
    						->whereBetween('salary',[20000, 24999])
    						->count()); 

    					$salary6 = DB::table('placements_youths')   
    					->join('placements','placements.id','=','placements_youths.placements_id')
    					->whereBetween('program_date', array($request->dateStart, $request->dateEnd)) 
    				//	->where('placements.branch_id','=',$request->branch) 
    					->where('salary','>=', 25000)
    					->count()+(DB::table('placement_individual')   
    						->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    				//		->where('placement_individual.branch_id','=',$request->branch)   
    						->where('salary','>=', 25000)
    						->count());
    					$employer_i = DB::table('placement_individual')
    					->join('employers','employers.id','=','placement_individual.employer_id')
    					->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    				//	->where('placement_individual.branch_id','=',$request->branch)
    					->select('name', DB::raw('count(*) as total'))
    					->groupBy('name')->get();

    					$employers2 = DB::table('placements_youths')
    					->join('employers','employers.id','=','placements_youths.employer')
    					->join('placements','placements.id','=','placements_youths.placements_id')
    					->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    				//	->where('placements.branch_id','=',$request->branch) 
    					->select('name', DB::raw('count(*) as total'))
    					->groupBy('name')
    					->orderBy('total', 'DESC')
    					->get();  

    					$employers = $employer_i->merge($employers2);

    					$types1 = DB::table('placement_individual')
	        		->join('employers','employers.id','=','placement_individual.employer_id')
    				->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
	        		->where('placement_individual.branch_id','=',$branch_id)
	        		->select('company_type', DB::raw('count(*) as total'))
	        		->groupBy('company_type')->get();

	        		$types2 = DB::table('placements_youths')
	        		->join('employers','employers.id','=','placements_youths.employer')
	        		->join('placements','placements.id','=','placements_youths.placements_id')
    				->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
	        		->where('placements.branch_id','=',$branch_id) 
	        		->select('company_type', DB::raw('count(*) as total'))
	        		->groupBy('company_type')
	        		->orderBy('total', 'DESC')
	        		->get();  

	        		$types = $types1->merge($types2);

	        		$industry1 = DB::table('placement_individual')
	        		->join('employers','employers.id','=','placement_individual.employer_id')
				    ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
	        		->where('placement_individual.branch_id','=',$branch_id)
	        		->select('industry', DB::raw('count(*) as total'))
	        		->groupBy('industry')->get();

	        		$industry2 = DB::table('placements_youths')
	        		->join('employers','employers.id','=','placements_youths.employer')
				    ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
	        		->join('placements','placements.id','=','placements_youths.placements_id')
	        		->where('placements.branch_id','=',$branch_id) 
	        		->select('industry', DB::raw('count(*) as total'))
	        		->groupBy('industry')
	        		->orderBy('total', 'DESC')
	        		->get();  

	        		$industries = $industry1->merge($industry2);
    						break;
    				}
    			}

    			//if filter date is null
    			else{
    				switch ($branch_id) {
    					case  null:

    					$awaraness = DB::table('awareness')
					    			->whereBetween('awareness.program_date', [$request->dateStart, $request->dateEnd])
					    			->count();

					    $assesments = DB::table('assesments')
					    			->whereBetween('assesments.program_date', [$request->dateStart, $request->dateEnd])
					    			->count();

    						$male_individuals = DB::table('placement_individual')
    					->join('youths','youths.id','=','placement_individual.youth_id')
    					->where('gender','male')
    					//->where('youths.branch_id',$request->branch)
    					->whereBetween('placement_individual.program_date', [$request->dateStart, $request->dateEnd])
    					->count();

    					$male_fair = DB::table('placements_youths')
    					->join('placements','placements.id','=','placements_youths.placements_id')
    					->join('youths','youths.id','=','placements_youths.youth_id')
    					->where('gender','male')
    					//->where('placements.branch_id',$request->branch)
    					->whereBetween('placements.program_date', array($request->dateStart, $request->dateEnd))
    					->count();

    					$female_individuals = DB::table('placement_individual')
    					->join('youths','youths.id','=','placement_individual.youth_id')
    					->whereBetween('placement_individual.program_date', array($request->dateStart, $request->dateEnd))
    					->where('gender','female')
    				//	->where('youths.branch_id',$request->branch)
    					->count();

    					$female_fair = DB::table('placements_youths')
    					->join('placements','placements.id','=','placements_youths.placements_id')
    					->join('youths','youths.id','=','placements_youths.youth_id')
    					->where('gender','female')
    					->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    				//	->where('placements.branch_id',$request->branch)
    					->count();


    					$male = $male_individuals+$male_fair;
    					$female = $female_individuals+$female_fair;

    					$locations_i = DB::table('placement_individual')
    					->join('youths','youths.id','=','placement_individual.youth_id')
    					->join('families','families.id','=','youths.family_id')
    					->join('dsd_office','dsd_office.ID','=','families.ds_division')
    					->whereBetween('program_date', [new Carbon($request->dateStart), new Carbon($request->dateEnd)])
    				//	->where('placement_individual.branch_id',$request->branch)
    					->select('DSD_Name', DB::raw('count(*) as total'))
    					->groupBy('DSD_Name')->get();

    					$locations2 = DB::table('placements_youths')
    					->join('placements','placements.id','=','placements_youths.placements_id')
    					->join('youths','youths.id','=','placements_youths.youth_id')
    					->join('families','families.id','=','youths.family_id')
    					->join('dsd_office','dsd_office.ID','=','families.ds_division')
    					->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    				//	->where('placements.branch_id',$request->branch)
    					->select('DSD_Name', DB::raw('count(*) as total'))
    					->groupBy('DSD_Name')
				    			//->union($locations_i)
    					->get();
    					$locations = $locations_i->merge($locations2);

    					$salary1 = DB::table('placements_youths')  
    					->join('placements','placements.id','=','placements_youths.placements_id') 
    					->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    					//->where('placements.branch_id','=',$request->branch) 
    					->whereBetween('salary',[0, 4999])
    					->count()+(DB::table('placement_individual')
    						->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    					//	->where('placement_individual.branch_id','=',$request->branch)   
    						->whereBetween('salary',[0, 4999])
    						->count());  

    					$salary2 = DB::table('placements_youths')   
    					->join('placements','placements.id','=','placements_youths.placements_id') 
    					->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    					//->where('placements.branch_id','=',$request->branch) 
    					->whereBetween('salary',[5000, 9999])
    					->count()+(DB::table('placement_individual')   
    						->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    						//->where('placement_individual.branch_id','=',$request->branch)   
    						->whereBetween('salary',[5000, 9999])
    						->count()); 

    					$salary3 = DB::table('placements_youths')   
    					->join('placements','placements.id','=','placements_youths.placements_id') 
    					->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    					//->where('placements.branch_id','=',$request->branch) 
    					->whereBetween('salary',[10000, 14999])
    					->count()+(DB::table('placement_individual')   
    						->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    					//	->where('placement_individual.branch_id','=',$request->branch)   
    						->whereBetween('salary',[10000, 14999])
    						->count()); 

    					$salary4 = DB::table('placements_youths')   
    					->join('placements','placements.id','=','placements_youths.placements_id') 
    					->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    				//	->where('placements.branch_id','=',$request->branch) 
    					->whereBetween('salary',[15000, 19999])
    					->count()+(DB::table('placement_individual')   
    						->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    				//		->where('placement_individual.branch_id','=',$request->branch)   
    						->whereBetween('salary',[15000, 19999])
    						->count());  

    					$salary5 = DB::table('placements_youths')   
    					->join('placements','placements.id','=','placements_youths.placements_id') 
    					->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    				//	->where('placements.branch_id','=',$request->branch) 
    					->whereBetween('salary',[20000, 24999])
    					->count()+(DB::table('placement_individual')   
    						->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    					//	->where('placement_individual.branch_id','=',$request->branch)   
    						->whereBetween('salary',[20000, 24999])
    						->count()); 

    					$salary6 = DB::table('placements_youths')   
    					->join('placements','placements.id','=','placements_youths.placements_id')
    					->whereBetween('program_date', array($request->dateStart, $request->dateEnd)) 
    				//	->where('placements.branch_id','=',$request->branch) 
    					->where('salary','>=', 25000)
    					->count()+(DB::table('placement_individual')   
    						->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    				//		->where('placement_individual.branch_id','=',$request->branch)   
    						->where('salary','>=', 25000)
    						->count());
    					$employer_i = DB::table('placement_individual')
    					->join('employers','employers.id','=','placement_individual.employer_id')
    					->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    				//	->where('placement_individual.branch_id','=',$request->branch)
    					->select('name', DB::raw('count(*) as total'))
    					->groupBy('name')->get();

    					$employers2 = DB::table('placements_youths')
    					->join('employers','employers.id','=','placements_youths.employer')
    					->join('placements','placements.id','=','placements_youths.placements_id')
    					->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    				//	->where('placements.branch_id','=',$request->branch) 
    					->select('name', DB::raw('count(*) as total'))
    					->groupBy('name')
    					->orderBy('total', 'DESC')
    					->get();  

    					$employers = $employer_i->merge($employers2);

    					$types1 = DB::table('placement_individual')
	        		->join('employers','employers.id','=','placement_individual.employer_id')
	        		->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
	        		//->where('placement_individual.branch_id','=',$branch_id)
	        		->select('company_type', DB::raw('count(*) as total'))
	        		->groupBy('company_type')->get();

	        		$types2 = DB::table('placements_youths')
	        		->join('employers','employers.id','=','placements_youths.employer')
	        		->join('placements','placements.id','=','placements_youths.placements_id')
	        		->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
	        		//->where('placements.branch_id','=',$branch_id) 
	        		->select('company_type', DB::raw('count(*) as total'))
	        		->groupBy('company_type')
	        		->orderBy('total', 'DESC')
	        		->get();  

	        		$types = $types1->merge($types2);

	        		$industry1 = DB::table('placement_individual')
	        		->join('employers','employers.id','=','placement_individual.employer_id')
				    ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
	        		->select('industry', DB::raw('count(*) as total'))
	        		->groupBy('industry')->get();

	        		$industry2 = DB::table('placements_youths')
	        		->join('employers','employers.id','=','placements_youths.employer')
				    ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
	        		->join('placements','placements.id','=','placements_youths.placements_id')
	        		->select('industry', DB::raw('count(*) as total'))
	        		->groupBy('industry')
	        		->orderBy('total', 'DESC')
	        		->get();  

	        		$industries = $industry1->merge($industry2);
    						break;
    					
    					default:

    					$awaraness = DB::table('awareness')
					    			->where('awareness.branch_id',$branch_id)
					    			->whereBetween('awareness.program_date', [$request->dateStart, $request->dateEnd])
					    			->count();

					    $assesments = DB::table('assesments')
					    			->where('assesments.branch_id',$branch_id)
					    			->whereBetween('assesments.program_date', [$request->dateStart, $request->dateEnd])
					    			->count();

    						$male_individuals = DB::table('placement_individual')
    					->join('youths','youths.id','=','placement_individual.youth_id')
    					->where('gender','male')
    					->where('youths.branch_id',$branch_id)
    					->whereBetween('placement_individual.program_date', [$request->dateStart, $request->dateEnd])
    					->count();

    					$male_fair = DB::table('placements_youths')
    					->join('placements','placements.id','=','placements_youths.placements_id')
    					->join('youths','youths.id','=','placements_youths.youth_id')
    					->where('gender','male')
    					->where('placements.branch_id',$branch_id)
    					->whereBetween('placements.program_date', array($request->dateStart, $request->dateEnd))
    					->count();

    					$female_individuals = DB::table('placement_individual')
    					->join('youths','youths.id','=','placement_individual.youth_id')
    					->whereBetween('placement_individual.program_date', array($request->dateStart, $request->dateEnd))
    					->where('gender','female')
    					->where('youths.branch_id',$branch_id)
    					->count();

    					$female_fair = DB::table('placements_youths')
    					->join('placements','placements.id','=','placements_youths.placements_id')
    					->join('youths','youths.id','=','placements_youths.youth_id')
    					->where('gender','female')
    					->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    				    ->where('placements.branch_id',$branch_id)
    					->count();


    					$male = $male_individuals+$male_fair;
    					$female = $female_individuals+$female_fair;

    					$locations_i = DB::table('placement_individual')
    					->join('youths','youths.id','=','placement_individual.youth_id')
    					->join('families','families.id','=','youths.family_id')
    					->join('dsd_office','dsd_office.ID','=','families.ds_division')
    					->whereBetween('program_date', [new Carbon($request->dateStart), new Carbon($request->dateEnd)])
    					->where('placement_individual.branch_id',$branch_id)
    					->select('DSD_Name', DB::raw('count(*) as total'))
    					->groupBy('DSD_Name')->get();

    					$locations2 = DB::table('placements_youths')
    					->join('placements','placements.id','=','placements_youths.placements_id')
    					->join('youths','youths.id','=','placements_youths.youth_id')
    					->join('families','families.id','=','youths.family_id')
    					->join('dsd_office','dsd_office.ID','=','families.ds_division')
    					->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    					->where('placements.branch_id',$branch_id)
    					->select('DSD_Name', DB::raw('count(*) as total'))
    					->groupBy('DSD_Name')
				    			//->union($locations_i)
    					->get();
    					$locations = $locations_i->merge($locations2);

    					$salary1 = DB::table('placements_youths')  
    					->join('placements','placements.id','=','placements_youths.placements_id') 
    					->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    					->where('placements.branch_id','=',$branch_id) 
    					->whereBetween('salary',[0, 4999])
    					->count()+(DB::table('placement_individual')
    						->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    						->where('placement_individual.branch_id','=',$branch_id)   
    						->whereBetween('salary',[0, 4999])
    						->count());  

    					$salary2 = DB::table('placements_youths')   
    					->join('placements','placements.id','=','placements_youths.placements_id') 
    					->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    					->where('placements.branch_id','=',$branch_id) 
    					->whereBetween('salary',[5000, 9999])
    					->count()+(DB::table('placement_individual')   
    						->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    						->where('placement_individual.branch_id','=',$branch_id)   
    						->whereBetween('salary',[5000, 9999])
    						->count()); 

    					$salary3 = DB::table('placements_youths')   
    					->join('placements','placements.id','=','placements_youths.placements_id') 
    					->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    					->where('placements.branch_id','=',$branch_id) 
    					->whereBetween('salary',[10000, 14999])
    					->count()+(DB::table('placement_individual')   
    						->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    						->where('placement_individual.branch_id','=',$branch_id)   
    						->whereBetween('salary',[10000, 14999])
    						->count()); 

    					$salary4 = DB::table('placements_youths')   
    					->join('placements','placements.id','=','placements_youths.placements_id') 
    					->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    					->where('placements.branch_id','=',$branch_id) 
    					->whereBetween('salary',[15000, 19999])
    					->count()+(DB::table('placement_individual')   
    						->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    						->where('placement_individual.branch_id','=',$branch_id)   
    						->whereBetween('salary',[15000, 19999])
    						->count());  

    					$salary5 = DB::table('placements_youths')   
    					->join('placements','placements.id','=','placements_youths.placements_id') 
    					->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    					->where('placements.branch_id','=',$branch_id) 
    					->whereBetween('salary',[20000, 24999])
    					->count()+(DB::table('placement_individual')   
    						->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    						->where('placement_individual.branch_id','=',$branch_id)   
    						->whereBetween('salary',[20000, 24999])
    						->count()); 

    					$salary6 = DB::table('placements_youths')   
    					->join('placements','placements.id','=','placements_youths.placements_id')
    					->whereBetween('program_date', array($request->dateStart, $request->dateEnd)) 
    					->where('placements.branch_id','=',$branch_id) 
    					->where('salary','>=', 25000)
    					->count()+(DB::table('placement_individual')   
    						->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    						->where('placement_individual.branch_id','=',$branch_id)   
    						->where('salary','>=', 25000)
    						->count());
    					$employer_i = DB::table('placement_individual')
    					->join('employers','employers.id','=','placement_individual.employer_id')
    					->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    					->where('placement_individual.branch_id','=',$branch_id)
    					->select('name', DB::raw('count(*) as total'))
    					->groupBy('name')->get();

    					$employers2 = DB::table('placements_youths')
    					->join('employers','employers.id','=','placements_youths.employer')
    					->join('placements','placements.id','=','placements_youths.placements_id')
    					->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
    					->where('placements.branch_id','=',$branch_id) 
    					->select('name', DB::raw('count(*) as total'))
    					->groupBy('name')
    					->orderBy('total', 'DESC')
    					->get();  

    					$employers = $employer_i->merge($employers2);

    					$types1 = DB::table('placement_individual')
	        		->join('employers','employers.id','=','placement_individual.employer_id')
	        		->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
	        		->where('placement_individual.branch_id','=',$branch_id)
	        		->select('company_type', DB::raw('count(*) as total'))
	        		->groupBy('company_type')->get();

	        		$types2 = DB::table('placements_youths')
	        		->join('employers','employers.id','=','placements_youths.employer')
	        		->join('placements','placements.id','=','placements_youths.placements_id')
	        		->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
	        		->where('placements.branch_id','=',$branch_id) 
	        		->select('company_type', DB::raw('count(*) as total'))
	        		->groupBy('company_type')
	        		->orderBy('total', 'DESC')
	        		->get();  

	        		$types = $types1->merge($types2);

	        		$industry1 = DB::table('placement_individual')
	        		->join('employers','employers.id','=','placement_individual.employer_id')
				    ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
	        		->where('placement_individual.branch_id','=',$branch_id)
	        		->select('industry', DB::raw('count(*) as total'))
	        		->groupBy('industry')->get();

	        		$industry2 = DB::table('placements_youths')
	        		->join('employers','employers.id','=','placements_youths.employer')
				    ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
	        		->where('placements.branch_id','=',$branch_id) 
	        		->join('placements','placements.id','=','placements_youths.placements_id')
	        		->select('industry', DB::raw('count(*) as total'))
	        		->groupBy('industry')
	        		->orderBy('total', 'DESC')
	        		->get();  

	        		$industries = $industry1->merge($industry2);
    						break;
    				}
    			}
    		}
    		//if  null dates
    		else{
    			switch ($branch_id) {
    				case null:

    				    $awaraness = DB::table('awareness')
					    			->count();

					    $assesments = DB::table('assesments')
					    			->count();
    					$male_individuals = DB::table('placement_individual')
		    			->join('youths','youths.id','=','placement_individual.youth_id')
		    			->where('gender','male')
		    			->count();

				    	$male_fair = DB::table('placements_youths')
				    			->join('placements','placements.id','=','placements_youths.placements_id')
				    			->join('youths','youths.id','=','placements_youths.youth_id')
				    			->where('gender','male')
				    			->count();

				    	$female_individuals = DB::table('placement_individual')
				    			->join('youths','youths.id','=','placement_individual.youth_id')
				    			->where('gender','female')
				    			->count();

				    	$female_fair = DB::table('placements_youths')
				    			->join('placements','placements.id','=','placements_youths.placements_id')
				    			->join('youths','youths.id','=','placements_youths.youth_id')
				    			->where('gender','female')
				    			->count();


				    	$male = $male_individuals+$male_fair;
				    	$female = $female_individuals+$female_fair;

				    	$locations_i = DB::table('placement_individual')
				    			->join('youths','youths.id','=','placement_individual.youth_id')
				    			->join('families','families.id','=','youths.family_id')
				    			->join('dsd_office','dsd_office.ID','=','families.ds_division')
				    			->select('DSD_Name', DB::raw('count(*) as total'))
				    			->groupBy('DSD_Name');

				    	$locations = DB::table('placements_youths')
				    			->join('youths','youths.id','=','placements_youths.youth_id')
				    			->join('families','families.id','=','youths.family_id')
				    			->join('dsd_office','dsd_office.ID','=','families.ds_division')
				    			->select('DSD_Name', DB::raw('count(*) as total'))
				    			->groupBy('DSD_Name')
				    			->union($locations_i)
				    			->get();

				    	$salary1 = (DB::table('placements_youths')   
			                       ->whereBetween('salary',[0, 4999])
			                       ->count())+(DB::table('placement_individual')   
			                       ->whereBetween('salary',[0, 4999])
			                       ->count());  

			            $salary2 = DB::table('placements_youths')   
			                       ->whereBetween('salary',[5000, 9999])
			                       ->count()+(DB::table('placement_individual')   
			                       ->whereBetween('salary',[5000, 9999])
			                       ->count()); 

			            $salary3 = DB::table('placements_youths')   
			                       ->whereBetween('salary',[10000, 14999])
			                       ->count()+(DB::table('placement_individual')   
			                       ->whereBetween('salary',[10000, 14999])
			                       ->count()); 

			            $salary4 = DB::table('placements_youths')   
			                       ->whereBetween('salary',[15000, 19999])
			                       ->count()+(DB::table('placement_individual')   
			                       ->whereBetween('salary',[15000, 19999])
			                       ->count());  

			            $salary5 = DB::table('placements_youths')   
			                       ->whereBetween('salary',[20000, 24999])
			                       ->count()+(DB::table('placement_individual')   
			                       ->whereBetween('salary',[20000, 24999])
			                       ->count()); 

			            $salary6 = DB::table('placements_youths')   
			                       ->where('salary','>=', 25000)
			                       ->count()+(DB::table('placement_individual')   
			                       ->where('salary','>=', 25000)
			                       ->count()); 

			            $employer_i = DB::table('placement_individual')
				    			->join('employers','employers.id','=','placement_individual.employer_id')
				    			->select('name', DB::raw('count(*) as total'))
				    			->groupBy('name');

				    	$employers = DB::table('placements_youths')
				    			->join('employers','employers.id','=','placements_youths.employer')
				    			->select('name', DB::raw('count(*) as total'))
				    			->groupBy('name')
				    			->union($employer_i)
				    			->orderBy('total', 'DESC')
				    			->get(); 

				    	$types1 = DB::table('placement_individual')
	        		->join('employers','employers.id','=','placement_individual.employer_id')
	        		->select('company_type', DB::raw('count(*) as total'))
	        		->groupBy('company_type')->get();

	        		$types2 = DB::table('placements_youths')
	        		->join('employers','employers.id','=','placements_youths.employer')
	        		->join('placements','placements.id','=','placements_youths.placements_id')
	        		->select('company_type', DB::raw('count(*) as total'))
	        		->groupBy('company_type')
	        		->orderBy('total', 'DESC')
	        		->get();  

	        		$types = $types1->merge($types2);

	        		$industry1 = DB::table('placement_individual')
	        		->join('employers','employers.id','=','placement_individual.employer_id')
	        		->select('industry', DB::raw('count(*) as total'))
	        		->groupBy('industry')->get();

	        		$industry2 = DB::table('placements_youths')
	        		->join('employers','employers.id','=','placements_youths.employer')
	        		->join('placements','placements.id','=','placements_youths.placements_id')
	        		->select('industry', DB::raw('count(*) as total'))
	        		->groupBy('industry')
	        		->orderBy('total', 'DESC')
	        		->get();  

	        		$industries = $industry1->merge($industry2);
				    	
    					break;
    				
    				default:

    				$awaraness = DB::table('awareness')
					    			->where('awareness.branch_id',$branch_id)
					    			->count();

					    $assesments = DB::table('assesments')
					    			->where('assesments.branch_id',$branch_id)
					    			->count();
    					$male_individuals = DB::table('placement_individual')
		    			->join('youths','youths.id','=','placement_individual.youth_id')
		    			->where('gender','male')
		    			->where('placement_individual.branch_id',$branch_id)
		    			->count();

				    	$male_fair = DB::table('placements_youths')
				    			->join('placements','placements.id','=','placements_youths.placements_id')
				    			->join('youths','youths.id','=','placements_youths.youth_id')
				    			->where('placements.branch_id',$branch_id)
				    			->where('gender','male')
				    			->count();

				    	$female_individuals = DB::table('placement_individual')
				    			->join('youths','youths.id','=','placement_individual.youth_id')
				    			->where('placement_individual.branch_id',$branch_id)
				    			->where('gender','female')
				    			->count();

				    	$female_fair = DB::table('placements_youths')
				    			->join('placements','placements.id','=','placements_youths.placements_id')
				    			->join('youths','youths.id','=','placements_youths.youth_id')
				    			->where('placements.branch_id',$branch_id)
				    			->where('gender','female')
				    			->count();


				    	$male = $male_individuals+$male_fair;
				    	$female = $female_individuals+$female_fair;

				    	$locations_i = DB::table('placement_individual')
				    			->join('youths','youths.id','=','placement_individual.youth_id')
				    			->join('families','families.id','=','youths.family_id')
				    			->join('dsd_office','dsd_office.ID','=','families.ds_division')
				    			->where('placement_individual.branch_id',$branch_id)
				    			->select('DSD_Name', DB::raw('count(*) as total'))
				    			->groupBy('DSD_Name')->get();

				    	$locations2 = DB::table('placements_youths')
				    			->join('placements','placements.id','=','placements_youths.placements_id')
				    			->join('youths','youths.id','=','placements_youths.youth_id')
				    			->join('families','families.id','=','youths.family_id')
				    			->join('dsd_office','dsd_office.ID','=','families.ds_division')
				    			->where('placements.branch_id',$branch_id)
				    			->select('DSD_Name', DB::raw('count(*) as total'))
				    			->groupBy('DSD_Name')
				    			//->union($locations_i)
				    			->get();
			    	$locations = $locations_i->merge($locations2);

			    	$salary1 = DB::table('placements_youths')  
			                      ->join('placements','placements.id','=','placements_youths.placements_id') 
			                      ->where('placements.branch_id','=',$branch_id) 
			                       ->whereBetween('salary',[0, 4999])
			                       ->count()+(DB::table('placement_individual')
			                       ->where('placement_individual.branch_id','=',$branch_id)   
			                       ->whereBetween('salary',[0, 4999])
			                       ->count());  

			            $salary2 = DB::table('placements_youths')   
			                      ->join('placements','placements.id','=','placements_youths.placements_id') 
			                      ->where('placements.branch_id','=',$branch_id) 
			                       ->whereBetween('salary',[5000, 9999])
			                       ->count()+(DB::table('placement_individual')   
			                       ->where('placement_individual.branch_id','=',$branch_id)   
			                       ->whereBetween('salary',[5000, 9999])
			                       ->count()); 

			            $salary3 = DB::table('placements_youths')   
			                      ->join('placements','placements.id','=','placements_youths.placements_id') 
			                      ->where('placements.branch_id','=',$branch_id) 
			                       ->whereBetween('salary',[10000, 14999])
			                       ->count()+(DB::table('placement_individual')   
			                       ->where('placement_individual.branch_id','=',$branch_id)   
			                       ->whereBetween('salary',[10000, 14999])
			                       ->count()); 

			            $salary4 = DB::table('placements_youths')   
			                      ->join('placements','placements.id','=','placements_youths.placements_id') 
			                      ->where('placements.branch_id','=',$branch_id) 
			                       ->whereBetween('salary',[15000, 19999])
			                       ->count()+(DB::table('placement_individual')   
			                       ->where('placement_individual.branch_id','=',$branch_id)   
			                       ->whereBetween('salary',[15000, 19999])
			                       ->count());  

			            $salary5 = DB::table('placements_youths')   
			                      ->join('placements','placements.id','=','placements_youths.placements_id') 
			                      ->where('placements.branch_id','=',$branch_id) 
			                       ->whereBetween('salary',[20000, 24999])
			                       ->count()+(DB::table('placement_individual')   
			                       ->where('placement_individual.branch_id','=',$branch_id)   
			                       ->whereBetween('salary',[20000, 24999])
			                       ->count()); 

			            $salary6 = DB::table('placements_youths')   
			                      ->join('placements','placements.id','=','placements_youths.placements_id') 
			                      ->where('placements.branch_id','=',$branch_id) 
			                       ->where('salary','>=', 25000)
			                       ->count()+(DB::table('placement_individual')   
			                       ->where('placement_individual.branch_id','=',$branch_id)   
			                       ->where('salary','>=', 25000)
			                       ->count());
			            $employer_i = DB::table('placement_individual')
				    			->join('employers','employers.id','=','placement_individual.employer_id')
				    			->where('placement_individual.branch_id','=',$branch_id)
				    			->select('name', DB::raw('count(*) as total'))
				    			->groupBy('name')->get();

				    	$employers2 = DB::table('placements_youths')
				    			->join('employers','employers.id','=','placements_youths.employer')
				    			->join('placements','placements.id','=','placements_youths.placements_id')
				    			->where('placements.branch_id','=',$branch_id) 
				    			->select('name', DB::raw('count(*) as total'))
				    			->groupBy('name')
				    			->orderBy('total', 'DESC')
				    			->get();  

				    	$employers = $employer_i->merge($employers2);

				    	$types1 = DB::table('placement_individual')
	        		->join('employers','employers.id','=','placement_individual.employer_id')
	        		->where('placement_individual.branch_id','=',$branch_id)
	        		->select('company_type', DB::raw('count(*) as total'))
	        		->groupBy('company_type')->get();

	        		$types2 = DB::table('placements_youths')
	        		->join('employers','employers.id','=','placements_youths.employer')
	        		->join('placements','placements.id','=','placements_youths.placements_id')
	        		->where('placements.branch_id','=',$branch_id) 
	        		->select('company_type', DB::raw('count(*) as total'))
	        		->groupBy('company_type')
	        		->orderBy('total', 'DESC')
	        		->get();  

	        		$types = $types1->merge($types2);

	        		$industry1 = DB::table('placement_individual')
	        		->join('employers','employers.id','=','placement_individual.employer_id')
	        		->where('placement_individual.branch_id','=',$branch_id)
	        		->select('industry', DB::raw('count(*) as total'))
	        		->groupBy('industry')->get();

	        		$industry2 = DB::table('placements_youths')
	        		->join('employers','employers.id','=','placements_youths.employer')
	        		->where('placements.branch_id','=',$branch_id) 
	        		->join('placements','placements.id','=','placements_youths.placements_id')
	        		->select('industry', DB::raw('count(*) as total'))
	        		->groupBy('industry')
	        		->orderBy('total', 'DESC')
	        		->get();  

	        		$industries = $industry1->merge($industry2);
    					break;
    			}
    		}
        }

        else{

        	switch ($branch_id) {
        		case null:

        		$awaraness = DB::table('awareness')
					    			->count();

					    $assesments = DB::table('assesments')
					    			->count();

        			$male_individuals = DB::table('placement_individual')
			    			->join('youths','youths.id','=','placement_individual.youth_id')
			    			->where('gender','male')
			    			->count();

			    	$male_fair = DB::table('placements_youths')
			    			->join('placements','placements.id','=','placements_youths.placements_id')
			    			->join('youths','youths.id','=','placements_youths.youth_id')
			    			->where('gender','male')
			    			->count();

			    	$female_individuals = DB::table('placement_individual')
			    			->join('youths','youths.id','=','placement_individual.youth_id')
			    			->where('gender','female')
			    			->count();

			    	$female_fair = DB::table('placements_youths')
			    			->join('placements','placements.id','=','placements_youths.placements_id')
			    			->join('youths','youths.id','=','placements_youths.youth_id')
			    			->where('gender','female')
			    			->count();


			    	$male = $male_individuals+$male_fair;
			    	$female = $female_individuals+$female_fair;

			    	$locations_i = DB::table('placement_individual')
			    			->join('youths','youths.id','=','placement_individual.youth_id')
			    			->join('families','families.id','=','youths.family_id')
			    			->join('dsd_office','dsd_office.ID','=','families.ds_division')
			    			->select('DSD_Name', DB::raw('count(*) as total'))
			    			->groupBy('DSD_Name');

			    	$locations = DB::table('placements_youths')
			    			->join('youths','youths.id','=','placements_youths.youth_id')
			    			->join('families','families.id','=','youths.family_id')
			    			->join('dsd_office','dsd_office.ID','=','families.ds_division')
			    			->select('DSD_Name', DB::raw('count(*) as total'))
			    			->groupBy('DSD_Name')
			    			->union($locations_i)
			    			->get();

			    	$salary1 = (DB::table('placements_youths')   
		                       ->whereBetween('salary',[0, 4999])
		                       ->count())+(DB::table('placement_individual')   
		                       ->whereBetween('salary',[0, 4999])
		                       ->count());  

		            $salary2 = DB::table('placements_youths')   
		                       ->whereBetween('salary',[5000, 9999])
		                       ->count()+(DB::table('placement_individual')   
		                       ->whereBetween('salary',[5000, 9999])
		                       ->count()); 

		            $salary3 = DB::table('placements_youths')   
		                       ->whereBetween('salary',[10000, 14999])
		                       ->count()+(DB::table('placement_individual')   
		                       ->whereBetween('salary',[10000, 14999])
		                       ->count()); 

		            $salary4 = DB::table('placements_youths')   
		                       ->whereBetween('salary',[15000, 19999])
		                       ->count()+(DB::table('placement_individual')   
		                       ->whereBetween('salary',[15000, 19999])
		                       ->count());  

		            $salary5 = DB::table('placements_youths')   
		                       ->whereBetween('salary',[20000, 24999])
		                       ->count()+(DB::table('placement_individual')   
		                       ->whereBetween('salary',[20000, 24999])
		                       ->count()); 

		            $salary6 = DB::table('placements_youths')   
		                       ->where('salary','>=', 25000)
		                       ->count()+(DB::table('placement_individual')   
		                       ->where('salary','>=', 25000)
		                       ->count()); 

		            $employer_i = DB::table('placement_individual')
			    			->join('employers','employers.id','=','placement_individual.employer_id')
			    			->select('name', DB::raw('count(*) as total'))
			    			->groupBy('name');

			    	$employers = DB::table('placements_youths')
			    			->join('employers','employers.id','=','placements_youths.employer')
			    			->select('name', DB::raw('count(*) as total'))
			    			->groupBy('name')
			    			->union($employer_i)
			    			->orderBy('total', 'DESC')
			    			->get(); 

			        $types1 = DB::table('placement_individual')
	        		->join('employers','employers.id','=','placement_individual.employer_id')
	        		->select('company_type', DB::raw('count(*) as total'))
	        		->groupBy('company_type')->get();

	        		$types2 = DB::table('placements_youths')
	        		->join('employers','employers.id','=','placements_youths.employer')
	        		->join('placements','placements.id','=','placements_youths.placements_id')
	        		->select('company_type', DB::raw('count(*) as total'))
	        		->groupBy('company_type')
	        		->orderBy('total', 'DESC')
	        		->get();  

	        		$types = $types1->merge($types2);

	        		$industry1 = DB::table('placement_individual')
	        		->join('employers','employers.id','=','placement_individual.employer_id')
	        		->select('industry', DB::raw('count(*) as total'))
	        		->groupBy('industry')->get();

	        		$industry2 = DB::table('placements_youths')
	        		->join('employers','employers.id','=','placements_youths.employer')
	        		->join('placements','placements.id','=','placements_youths.placements_id')
	        		->select('industry', DB::raw('count(*) as total'))
	        		->groupBy('industry')
	        		->orderBy('total', 'DESC')
	        		->get();  

	        		$industries = $industry1->merge($industry2);
        			break;
        		
        		default:
        		$awaraness = DB::table('awareness')
					    			->where('awareness.branch_id',$branch_id)
					    			->count();

					    $assesments = DB::table('assesments')
					    			->where('assesments.branch_id',$branch_id)
					    			->count();
	        		$male_individuals = DB::table('placement_individual')
	        		->join('youths','youths.id','=','placement_individual.youth_id')
	        		->where('gender','male')
	        		->where('placement_individual.branch_id',$branch_id)
	        		->count();

	        		$male_fair = DB::table('placements_youths')
	        		->join('placements','placements.id','=','placements_youths.placements_id')
	        		->join('youths','youths.id','=','placements_youths.youth_id')
	        		->where('placements.branch_id',$branch_id) ->where('gender','male')
	        		->count();

	        		$female_individuals = DB::table('placement_individual')
	        		->join('youths','youths.id','=','placement_individual.youth_id')
	        		->where('placement_individual.branch_id',$branch_id)
	        		->where('gender','female') ->count();

	        		$female_fair = DB::table('placements_youths')
	        		->join('placements','placements.id','=','placements_youths.placements_id')
	        		->join('youths','youths.id','=','placements_youths.youth_id')
	        		->where('placements.branch_id',$branch_id)
	        		->where('gender','female') ->count();


	        		$male = $male_individuals+$male_fair; $female =
	        		$female_individuals+$female_fair;

	        		$locations_i = DB::table('placement_individual')
	        		->join('youths','youths.id','=','placement_individual.youth_id')
	        		->join('families','families.id','=','youths.family_id')
	        		->join('dsd_office','dsd_office.ID','=','families.ds_division')
	        		->where('placement_individual.branch_id',$branch_id)
	        		->select('DSD_Name', DB::raw('count(*) as total'))
	        		->groupBy('DSD_Name')->get();

	        		$locations2 = DB::table('placements_youths')
->join('placements','placements.id','=','placements_youths.placements_id')
->join('youths','youths.id','=','placements_youths.youth_id')
->join('families','families.id','=','youths.family_id')
->join('dsd_office','dsd_office.ID','=','families.ds_division')
->where('placements.branch_id',$branch_id) ->select('DSD_Name',
DB::raw('count(*) as total')) ->groupBy('DSD_Name') //->union($locations_i)
->get(); $locations = $locations_i->merge($locations2);

	        		$salary1 = DB::table('placements_youths')  
	        		->join('placements','placements.id','=','placements_youths.placements_id')
	        		 ->where('placements.branch_id','=',$branch_id) 
	        		->whereBetween('salary',[0, 4999])
	        		->count()+(DB::table('placement_individual')
	        		->where('placement_individual.branch_id','=',$branch_id)   
	        		->whereBetween('salary',[0, 4999]) ->count());  

	        		$salary2 = DB::table('placements_youths')   
	        		->join('placements','placements.id','=','placements_youths.placements_id')
	        		 ->where('placements.branch_id','=',$branch_id) 
	        		->whereBetween('salary',[5000, 9999])
	        		->count()+(DB::table('placement_individual')   
	        		->where('placement_individual.branch_id','=',$branch_id)   
	        		->whereBetween('salary',[5000, 9999]) ->count()); 

	        		$salary3 = DB::table('placements_youths')   
	        		->join('placements','placements.id','=','placements_youths.placements_id')
	        		 ->where('placements.branch_id','=',$branch_id) 
	        		->whereBetween('salary',[10000, 14999])
	        		->count()+(DB::table('placement_individual')   
	        		->where('placement_individual.branch_id','=',$branch_id)   
	        		->whereBetween('salary',[10000, 14999]) ->count()); 

	        		$salary4 = DB::table('placements_youths')   
	        		->join('placements','placements.id','=','placements_youths.placements_id')
	        		 ->where('placements.branch_id','=',$branch_id) 
	        		->whereBetween('salary',[15000, 19999])
	        		->count()+(DB::table('placement_individual')   
	        		->where('placement_individual.branch_id','=',$branch_id)   
	        		->whereBetween('salary',[15000, 19999]) ->count());  

	        		$salary5 = DB::table('placements_youths')   
	        		->join('placements','placements.id','=','placements_youths.placements_id')
	        		 ->where('placements.branch_id','=',$branch_id) 
	        		->whereBetween('salary',[20000, 24999])
	        		->count()+(DB::table('placement_individual')   
	        		->where('placement_individual.branch_id','=',$branch_id)   
	        		->whereBetween('salary',[20000, 24999]) ->count()); 

	        		$salary6 = DB::table('placements_youths')   
	        		->join('placements','placements.id','=','placements_youths.placements_id')
	        		 ->where('placements.branch_id','=',$branch_id) 
	        		->where('salary','>=', 25000)
	        		->count()+(DB::table('placement_individual')   
	        		->where('placement_individual.branch_id','=',$branch_id)   
	        		->where('salary','>=', 25000) ->count());

	        		$employer_i = DB::table('placement_individual')
	        		->join('employers','employers.id','=','placement_individual.employer_id')
	        		->where('placement_individual.branch_id','=',$branch_id)
	        		->select('name', DB::raw('count(*) as total'))
	        		->groupBy('name')->get();

	        		$employers2 = DB::table('placements_youths')
	        		->join('employers','employers.id','=','placements_youths.employer')
	        		->join('placements','placements.id','=','placements_youths.placements_id')
	        		->where('placements.branch_id','=',$branch_id)  ->select('name',
	        		DB::raw('count(*) as total')) ->groupBy('name') ->orderBy('total',
	        		'DESC') ->get();  

	        		$employers = $employer_i->merge($employers2);

	        		$types1 = DB::table('placement_individual')
	        		->join('employers','employers.id','=','placement_individual.employer_id')
	        		->where('placement_individual.branch_id','=',$branch_id)
	        		->select('company_type', DB::raw('count(*) as total'))
	        		->groupBy('company_type')->get();

	        		$types2 = DB::table('placements_youths')
	        		->join('employers','employers.id','=','placements_youths.employer')
	        		->join('placements','placements.id','=','placements_youths.placements_id')
	        		->where('placements.branch_id','=',$branch_id) 
	        		->select('company_type', DB::raw('count(*) as total'))
	        		->groupBy('company_type') ->orderBy('total', 'DESC') ->get();  

	        		$types = $types1->merge($types2);

	        		$industry1 = DB::table('placement_individual')
	        		->join('employers','employers.id','=','placement_individual.employer_id')
	        		->where('placement_individual.branch_id','=',$branch_id)
	        		->select('industry', DB::raw('count(*) as total'))
	        		->groupBy('industry')->get();

	        		$industry2 = DB::table('placements_youths')
	        		->join('employers','employers.id','=','placements_youths.employer')
	        		->where('placements.branch_id','=',$branch_id) 
	        		->join('placements','placements.id','=','placements_youths.placements_id')
	        		->select('industry', DB::raw('count(*) as total'))
	        		->groupBy('industry')
	        		->orderBy('total', 'DESC')
	        		->get();  

	        		$industries = $industry1->merge($industry2);
        			break;
        	}
        }
       //dd($locations);
        return response()->json(array(
            'male'=>$male,
            'female'=>$female,
            'locations'=>$locations,
            'salary1'=>$salary1,
            'salary2'=>$salary2,
            'salary3'=>$salary3,
            'salary4'=>$salary4,
            'salary5'=>$salary5,
            'salary6'=>$salary6,
            'employers'=>$employers,
            'date1' => $request->dateStart,
            'date2' => $request->dateEnd,
            'branch2' => $request->branch,
            'types' => $types,
            'industries' => $industries,
            'awaraness' => $awaraness,
            'assesments' => $assesments
	    ));

    }

    public function cg(){
    	$branches = DB::table('branches')->get();
    	return view('Analysis.cg')->with(['branches'=>$branches]);		
    }

    public function fetch_cg(Request $request){
    	$branch_id = Auth::user()->branch;
    	//if click filter button
    	if($request->ajax()){
    		if($request->dateStart != '' && $request->dateEnd != ''){
    			if($request->branch!=''){
    				switch ($branch_id) {
    					case  null:
    					$stake = DB::table('stake_holder_meetings')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(id) as count"))
					    	->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    	->where('stake_holder_meetings.branch_id',$request->branch)
                        	->first();  

					    $kickoffs = DB::table('kickoffs')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(id) as count"))
					    	->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    	->where('branch_id',$request->branch)
                        	->first();

                        $households = DB::table('households')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(id) as count"))
					    	->whereBetween('meeting_date', [$request->dateStart, $request->dateEnd])
					    	->where('branch_id',$request->branch)
                        	->first();

    					$tot_cg = DB::table('tot_cg_participants')
    							->join('tot_cg','tot_cg.id','=','tot_cg_participants.tot_cg_id')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(tot_cg_participants.id) as count"))
					    	->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    	->where('branch_id',$request->branch)
                        	->first();
                        	
                        $tot_count = DB::table('tot_cg')
					    	->where('branch_id',$request->branch)
                        	->count();
    					
    					$cg_trainings = DB::table('cg_trainings')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(id) as count"))
					    	->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    	->where('branch_id',$request->branch)
                        	->first();
    					
    					$cg_male = DB::table('cg_youths')
    							->join('youths','youths.id','=','cg_youths.youth_id')
    							->join('career_guidances','career_guidances.id','=','cg_youths.career_guidances_id')
    							->where('gender','male')
					    	    ->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    		->where('career_guidances.branch_id',$request->branch)
    							->count();

    					$cg_female = DB::table('cg_youths')
    							->join('youths','youths.id','=','cg_youths.youth_id')
    							->join('career_guidances','career_guidances.id','=','cg_youths.career_guidances_id')
    							->where('gender','female')
					    		->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    		->where('career_guidances.branch_id',$request->branch)
    							->count();

    					$cg_count = DB::table('career_guidances')
					    		->where('career_guidances.branch_id',$request->branch)
					    		->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
    							->count();

                        $requirement = DB::table('cg_youth_selected') 
                        		->join('career_guidances','career_guidances.id', '=' ,'cg_youth_selected.career_guidances_id')
                        		->select('cg_youth_selected.*',DB::raw("SUM(male) as total_male"),DB::raw("SUM(female) as total_female"))
                        		->groupBy('requirement')
                        		//->where('career_guidances.branch_id','=',$branch_id)
                       			->orderBy('cg_youth_selected.id','asc')
					    		->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    		->where('career_guidances.branch_id',$request->branch)
                        		->get();

                        $locations = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
                        	->join('career_guidances','career_guidances.id', '=' ,'cg_youths.career_guidances_id')
	    					->join('families','families.id','=','youths.family_id')
	    					->join('dsd_office','dsd_office.ID','=','families.ds_division')
	    					->select('DSD_Name', DB::raw('count(*) as total'))
					    		->where('youths.branch_id',$request->branch)
					    		->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
	    					->groupBy('DSD_Name')->get();

	    				$career_field = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
                        	->join('career_guidances','career_guidances.id', '=' ,'cg_youths.career_guidances_id')
	    					->select('career_field1', DB::raw('count(*) as total'))
					    		->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    	->where('career_guidances.branch_id',$request->branch)
	    					->groupBy('career_field1')->get();

	    				$family_type = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
	    					->join('families','families.id','=','youths.family_id')
                        	->join('career_guidances','career_guidances.id', '=' ,'cg_youths.career_guidances_id')
	    					->select('family_type', DB::raw('count(*) as total'))
					    		->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    	->where('career_guidances.branch_id',$request->branch)
	    					->groupBy('family_type')->get();

	    				$marital = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
                        	->join('career_guidances','career_guidances.id', '=' ,'cg_youths.career_guidances_id')
	    					->select('maritial_status', DB::raw('count(*) as total'))
					    	->where('youths.branch_id',$request->branch)
					    		->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
	    					->groupBy('maritial_status')->get();

	    				$race = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
                        	->join('career_guidances','career_guidances.id', '=' ,'cg_youths.career_guidances_id')
	    					->select('nationality', DB::raw('count(*) as total'))
					    		->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    	->where('youths.branch_id',$request->branch)
	    					->groupBy('nationality')->get();

		    			
    					break;
    					
    					default:

    					$stake = DB::table('stake_holder_meetings')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(id) as count"))
					    	->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    	//->where('stake_holder_meetings.branch_id',$branch_id)
                        	->first();  

					    $kickoffs = DB::table('kickoffs')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(id) as count"))
					    	->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    	//->where('branch_id',$branch_id)
                        	->first();

                        $households = DB::table('households')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(id) as count"))
					    	->whereBetween('meeting_date', [$request->dateStart, $request->dateEnd])
					    	//->where('branch_id',$branch_id)
                        	->first();

    					$tot_cg = DB::table('tot_cg_participants')
    							->join('tot_cg','tot_cg.id','=','tot_cg_participants.tot_cg_id')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(tot_cg_participants.id) as count"))
					    	->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    	//->where('branch_id',$branch_id)
                        	->first();
                        	
                        $tot_count = DB::table('tot_cg')
					    	//->where('branch_id',$branch_id)
                        	->count();
    					
    					$cg_trainings = DB::table('cg_trainings')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(id) as count"))
					    	->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    	//->where('branch_id',$branch_id)
                        	->first();
    					
    					$cg_male = DB::table('cg_youths')
    							->join('youths','youths.id','=','cg_youths.youth_id')
    							->join('career_guidances','career_guidances.id','=','cg_youths.career_guidances_id')
    							->where('gender','male')
					    	    ->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    		//->where('career_guidances.branch_id',$branch_id)
    							->count();

    					$cg_female = DB::table('cg_youths')
    							->join('youths','youths.id','=','cg_youths.youth_id')
    							->join('career_guidances','career_guidances.id','=','cg_youths.career_guidances_id')
    							->where('gender','female')
					    		->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    	//	->where('career_guidances.branch_id',$branch_id)
    							->count();

    					$cg_count = DB::table('career_guidances')
					    		//->where('career_guidances.branch_id',$branch_id)
					    		->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
    							->count();

                        $requirement = DB::table('cg_youth_selected') 
                        		->join('career_guidances','career_guidances.id', '=' ,'cg_youth_selected.career_guidances_id')
                        		->select('cg_youth_selected.*',DB::raw("SUM(male) as total_male"),DB::raw("SUM(female) as total_female"))
                        		->groupBy('requirement')
                        		//->where('career_guidances.branch_id','=',$branch_id)
                       			->orderBy('cg_youth_selected.id','asc')
					    		->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    		//->where('career_guidances.branch_id',$branch_id)
                        		->get();

                        $locations = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
                        		->join('career_guidances','career_guidances.id', '=' ,'cg_youths.career_guidances_id')
	    					->join('families','families.id','=','youths.family_id')
	    					->join('dsd_office','dsd_office.ID','=','families.ds_division')
	    					->select('DSD_Name', DB::raw('count(*) as total'))
					    		//->where('youths.branch_id',$branch_id)
					    		->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
	    					->groupBy('DSD_Name')->get();

	    				$career_field = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
                        	->join('career_guidances','career_guidances.id', '=' ,'cg_youths.career_guidances_id')
	    					->select('career_field1', DB::raw('count(*) as total'))
					    		->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    	//->where('career_guidances.branch_id',$branch_id)
	    					->groupBy('career_field1')->get();

	    				$family_type = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
	    					->join('families','families.id','=','youths.family_id')
                        	->join('career_guidances','career_guidances.id', '=' ,'cg_youths.career_guidances_id')
	    					->select('family_type', DB::raw('count(*) as total'))
					    		->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    	//->where('career_guidances.branch_id',$branch_id)
	    					->groupBy('family_type')->get();

	    				$marital = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
                        	->join('career_guidances','career_guidances.id', '=' ,'cg_youths.career_guidances_id')
	    					->select('maritial_status', DB::raw('count(*) as total'))
					    	//->where('youths.branch_id',$branch_id)
					    		->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
	    					->groupBy('maritial_status')->get();

	    				$race = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
                        	->join('career_guidances','career_guidances.id', '=' ,'cg_youths.career_guidances_id')
	    					->select('nationality', DB::raw('count(*) as total'))
					    		->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    	//->where('youths.branch_id',$branch_id)
	    					->groupBy('nationality')->get();

    					
    					break;
    				}
    			}

    			//if filter date is null
    			else{
    				switch ($branch_id) {
    					case  null:

    					$stake = DB::table('stake_holder_meetings')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(id) as count"))
					    	->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    	//->where('stake_holder_meetings.branch_id',$branch_id)
                        	->first();  

					    $kickoffs = DB::table('kickoffs')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(id) as count"))
					    	->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    	//->where('branch_id',$branch_id)
                        	->first();

                        $households = DB::table('households')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(id) as count"))
					    	->whereBetween('meeting_date', [$request->dateStart, $request->dateEnd])
					    	//->where('branch_id',$branch_id)
                        	->first();

    					$tot_cg = DB::table('tot_cg_participants')
    							->join('tot_cg','tot_cg.id','=','tot_cg_participants.tot_cg_id')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(tot_cg_participants.id) as count"))
					    	->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    	//->where('branch_id',$branch_id)
                        	->first();
                        	
                        $tot_count = DB::table('tot_cg')
					    	//->where('branch_id',$branch_id)
                        	->count();
    					
    					$cg_trainings = DB::table('cg_trainings')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(id) as count"))
					    	->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    	//->where('branch_id',$branch_id)
                        	->first();
    					
    					$cg_male = DB::table('cg_youths')
    							->join('youths','youths.id','=','cg_youths.youth_id')
    							->join('career_guidances','career_guidances.id','=','cg_youths.career_guidances_id')
    							->where('gender','male')
					    	    ->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    		//->where('career_guidances.branch_id',$branch_id)
    							->count();

    					$cg_female = DB::table('cg_youths')
    							->join('youths','youths.id','=','cg_youths.youth_id')
    							->join('career_guidances','career_guidances.id','=','cg_youths.career_guidances_id')
    							->where('gender','female')
					    		->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    	//	->where('career_guidances.branch_id',$branch_id)
    							->count();

    					$cg_count = DB::table('career_guidances')
					    		//->where('career_guidances.branch_id',$branch_id)
					    		->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
    							->count();

                        $requirement = DB::table('cg_youth_selected') 
                        		->join('career_guidances','career_guidances.id', '=' ,'cg_youth_selected.career_guidances_id')
                        		->select('cg_youth_selected.*',DB::raw("SUM(male) as total_male"),DB::raw("SUM(female) as total_female"))
                        		->groupBy('requirement')
                        		//->where('career_guidances.branch_id','=',$branch_id)
                       			->orderBy('cg_youth_selected.id','asc')
					    		->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    		//->where('career_guidances.branch_id',$branch_id)
                        		->get();

                        $locations = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
                        		->join('career_guidances','career_guidances.id', '=' ,'cg_youths.career_guidances_id')
	    					->join('families','families.id','=','youths.family_id')
	    					->join('dsd_office','dsd_office.ID','=','families.ds_division')
	    					->select('DSD_Name', DB::raw('count(*) as total'))
					    		//->where('youths.branch_id',$branch_id)
					    		->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
	    					->groupBy('DSD_Name')->get();

	    				$career_field = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
                        	->join('career_guidances','career_guidances.id', '=' ,'cg_youths.career_guidances_id')
	    					->select('career_field1', DB::raw('count(*) as total'))
					    		->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    	//->where('career_guidances.branch_id',$branch_id)
	    					->groupBy('career_field1')->get();

	    				$family_type = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
	    					->join('families','families.id','=','youths.family_id')
                        	->join('career_guidances','career_guidances.id', '=' ,'cg_youths.career_guidances_id')
	    					->select('family_type', DB::raw('count(*) as total'))
					    		->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    	//->where('career_guidances.branch_id',$branch_id)
	    					->groupBy('family_type')->get();

	    				$marital = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
                        	->join('career_guidances','career_guidances.id', '=' ,'cg_youths.career_guidances_id')
	    					->select('maritial_status', DB::raw('count(*) as total'))
					    	//->where('youths.branch_id',$branch_id)
					    		->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
	    					->groupBy('maritial_status')->get();

	    				$race = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
                        	->join('career_guidances','career_guidances.id', '=' ,'cg_youths.career_guidances_id')
	    					->select('nationality', DB::raw('count(*) as total'))
					    		->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    	//->where('youths.branch_id',$branch_id)
	    					->groupBy('nationality')->get();


    						
    					break;
    					
    					default:


					    $stake = DB::table('stake_holder_meetings')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(id) as count"))
					    	->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    	->where('stake_holder_meetings.branch_id',$branch_id)
                        	->first();  

					    $kickoffs = DB::table('kickoffs')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(id) as count"))
					    	->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    	->where('branch_id',$branch_id)
                        	->first();

                        $households = DB::table('households')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(id) as count"))
					    	->whereBetween('meeting_date', [$request->dateStart, $request->dateEnd])
					    	->where('branch_id',$branch_id)
                        	->first();

    					$tot_cg = DB::table('tot_cg_participants')
    							->join('tot_cg','tot_cg.id','=','tot_cg_participants.tot_cg_id')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(tot_cg_participants.id) as count"))
					    	->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    	->where('branch_id',$branch_id)
                        	->first();
                        	
                        $tot_count = DB::table('tot_cg')
					    	->where('branch_id',$branch_id)
                        	->count();
    					
    					$cg_trainings = DB::table('cg_trainings')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(id) as count"))
					    	->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    	->where('branch_id',$branch_id)
                        	->first();
    					
    					$cg_male = DB::table('cg_youths')
    							->join('youths','youths.id','=','cg_youths.youth_id')
    							->join('career_guidances','career_guidances.id','=','cg_youths.career_guidances_id')
    							->where('gender','male')
					    	    ->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    		->where('career_guidances.branch_id',$branch_id)
    							->count();

    					$cg_female = DB::table('cg_youths')
    							->join('youths','youths.id','=','cg_youths.youth_id')
    							->join('career_guidances','career_guidances.id','=','cg_youths.career_guidances_id')
    							->where('gender','female')
					    		->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    		->where('career_guidances.branch_id',$branch_id)
    							->count();

    					$cg_count = DB::table('career_guidances')
					    		->where('career_guidances.branch_id',$branch_id)
					    		->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
    							->count();

                        $requirement = DB::table('cg_youth_selected') 
                        		->join('career_guidances','career_guidances.id', '=' ,'cg_youth_selected.career_guidances_id')
                        		->select('cg_youth_selected.*',DB::raw("SUM(male) as total_male"),DB::raw("SUM(female) as total_female"))
                        		->groupBy('requirement')
                        		//->where('career_guidances.branch_id','=',$branch_id)
                       			->orderBy('cg_youth_selected.id','asc')
					    		->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    		->where('career_guidances.branch_id',$branch_id)
                        		->get();

                        $locations = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
                        		->join('career_guidances','career_guidances.id', '=' ,'cg_youths.career_guidances_id')
	    					->join('families','families.id','=','youths.family_id')
	    					->join('dsd_office','dsd_office.ID','=','families.ds_division')
	    					->select('DSD_Name', DB::raw('count(*) as total'))
					    		->where('youths.branch_id',$branch_id)
					    		->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
	    					->groupBy('DSD_Name')->get();

	    				$career_field = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
                        	->join('career_guidances','career_guidances.id', '=' ,'cg_youths.career_guidances_id')
	    					->select('career_field1', DB::raw('count(*) as total'))
					    		->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    	->where('career_guidances.branch_id',$branch_id)
	    					->groupBy('career_field1')->get();

	    				$family_type = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
	    					->join('families','families.id','=','youths.family_id')
                        	->join('career_guidances','career_guidances.id', '=' ,'cg_youths.career_guidances_id')
	    					->select('family_type', DB::raw('count(*) as total'))
					    		->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    	->where('career_guidances.branch_id',$branch_id)
	    					->groupBy('family_type')->get();

	    				$marital = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
                        	->join('career_guidances','career_guidances.id', '=' ,'cg_youths.career_guidances_id')
	    					->select('maritial_status', DB::raw('count(*) as total'))
					    	->where('youths.branch_id',$branch_id)
					    		->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
	    					->groupBy('maritial_status')->get();

	    				$race = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
                        	->join('career_guidances','career_guidances.id', '=' ,'cg_youths.career_guidances_id')
	    					->select('nationality', DB::raw('count(*) as total'))
					    		->whereBetween('program_date', [$request->dateStart, $request->dateEnd])
					    	->where('youths.branch_id',$branch_id)
	    					->groupBy('nationality')->get();

    					
    					break;
    				}
    			}
    		}
    		//if  null dates
    		else{
    			switch ($branch_id) {
    				case null:

    					$stake = DB::table('stake_holder_meetings')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(id) as count"))
                        	->first();  

					    $kickoffs = DB::table('kickoffs')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(id) as count"))
                        	->first();

                        $households = DB::table('households')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(id) as count"))
                        	->first();

    					$tot_cg = DB::table('tot_cg_participants')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(id) as count"))
                        	->first();

                        $tot_count = DB::table('tot_cg')->count();
    					
    					$cg_trainings = DB::table('cg_trainings')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(id) as count"))
                        	->first();
    					
    					$cg_male = DB::table('cg_youths')
    							->join('youths','youths.id','=','cg_youths.youth_id')
    							->join('career_guidances','career_guidances.id','=','cg_youths.career_guidances_id')
    							->where('gender','male')
    							->count();

    					$cg_female = DB::table('cg_youths')
    							->join('youths','youths.id','=','cg_youths.youth_id')
    							->join('career_guidances','career_guidances.id','=','cg_youths.career_guidances_id')
    							->where('gender','female')
    							->count();

    					$cg_count = DB::table('career_guidances')->count();
 
                        $requirement = DB::table('cg_youth_selected') 
                        		->join('career_guidances','career_guidances.id', '=' ,'cg_youth_selected.career_guidances_id')
                        		->select('cg_youth_selected.*',DB::raw("SUM(male) as total_male"),DB::raw("SUM(female) as total_female"))
                        		->groupBy('requirement')
                        		//->where('career_guidances.branch_id','=',$branch_id)
                       			->orderBy('cg_youth_selected.id','asc')
                        		->get();

                        $locations = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
	    					->join('families','families.id','=','youths.family_id')
	    					->join('dsd_office','dsd_office.ID','=','families.ds_division')
	    					->select('DSD_Name', DB::raw('count(*) as total'))
	    					->groupBy('DSD_Name')->get();

	    				$career_field = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
	    					->select('career_field1', 'youths.*', DB::raw('count(*) as total'))
	    					->groupBy('career_field1')->get();

	    			    $family_type = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
	    					->join('families','families.id','=','youths.family_id')
	    					->select('family_type', DB::raw('count(*) as total'))
	    					->groupBy('family_type')->get();

	    				$marital = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
	    					->select('maritial_status', DB::raw('count(*) as total'))
	    					->groupBy('maritial_status')->get();

	    				$race = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
	    					->select('nationality', DB::raw('count(*) as total'))
	    					->groupBy('nationality')->get();

    				break;
    				
    				default:

    				
					   $stake = DB::table('stake_holder_meetings')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(id) as count"))
					    	->where('stake_holder_meetings.branch_id',$branch_id)
                        	->first();  

					    $kickoffs = DB::table('kickoffs')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(id) as count"))
					    	->where('branch_id',$branch_id)
                        	->first();

                        $households = DB::table('households')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(id) as count"))
					    	->where('branch_id',$branch_id)
                        	->first();

    					$tot_cg = DB::table('tot_cg_participants')
    							->join('tot_cg','tot_cg.id','=','tot_cg_participants.tot_cg_id')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(tot_cg_participants.id) as count"))
					    	->where('branch_id',$branch_id)
                        	->first();
                        	
                        $tot_count = DB::table('tot_cg')
					    	->where('branch_id',$branch_id)
                        	->count();
    					
    					$cg_trainings = DB::table('cg_trainings')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(id) as count"))
					    	->where('branch_id',$branch_id)
                        	->first();
    					
    					$cg_male = DB::table('cg_youths')
    							->join('youths','youths.id','=','cg_youths.youth_id')
    							->join('career_guidances','career_guidances.id','=','cg_youths.career_guidances_id')
    							->where('gender','male')
					    		->where('career_guidances.branch_id',$branch_id)
    							->count();

    					$cg_female = DB::table('cg_youths')
    							->join('youths','youths.id','=','cg_youths.youth_id')
    							->join('career_guidances','career_guidances.id','=','cg_youths.career_guidances_id')
    							->where('gender','female')
					    		->where('career_guidances.branch_id',$branch_id)
    							->count();

    					$cg_count = DB::table('career_guidances')
					    		->where('career_guidances.branch_id',$branch_id)
    							->count();

                        $requirement = DB::table('cg_youth_selected') 
                        		->join('career_guidances','career_guidances.id', '=' ,'cg_youth_selected.career_guidances_id')
                        		->select('cg_youth_selected.*',DB::raw("SUM(male) as total_male"),DB::raw("SUM(female) as total_female"))
                        		->groupBy('requirement')
                        		//->where('career_guidances.branch_id','=',$branch_id)
                       			->orderBy('cg_youth_selected.id','asc')
					    		->where('career_guidances.branch_id',$branch_id)
                        		->get();

                        $locations = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
	    					->join('families','families.id','=','youths.family_id')
	    					->join('dsd_office','dsd_office.ID','=','families.ds_division')
	    					->select('DSD_Name', DB::raw('count(*) as total'))
					    		->where('youths.branch_id',$branch_id)
	    					->groupBy('DSD_Name')->get();

	    				$career_field = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
                        	->join('career_guidances','career_guidances.id', '=' ,'cg_youths.career_guidances_id')
	    					->select('career_field1', DB::raw('count(*) as total'))
					    	->where('career_guidances.branch_id',$branch_id)
	    					->groupBy('career_field1')->get();

	    				$family_type = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
	    					->join('families','families.id','=','youths.family_id')
                        	->join('career_guidances','career_guidances.id', '=' ,'cg_youths.career_guidances_id')
	    					->select('family_type', DB::raw('count(*) as total'))
					    	->where('career_guidances.branch_id',$branch_id)
	    					->groupBy('family_type')->get();

	    				$marital = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
	    					->select('maritial_status', DB::raw('count(*) as total'))
					    	->where('youths.branch_id',$branch_id)
	    					->groupBy('maritial_status')->get();

	    				$race = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
	    					->select('nationality', DB::raw('count(*) as total'))
					    	->where('youths.branch_id',$branch_id)
	    					->groupBy('nationality')->get();
    					
    				break;
    			}
    		}
        }

        else{

        	switch ($branch_id) {
        		case null:

        				$stake = DB::table('stake_holder_meetings')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(id) as count"))
                        	->first();  

					    $kickoffs = DB::table('kickoffs')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(id) as count"))
                        	->first();

                        $households = DB::table('households')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(id) as count"))
                        	->first();

    					$tot_cg = DB::table('tot_cg_participants')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(id) as count"))
                        	->first();
                        	
                        $tot_count = DB::table('tot_cg')->count();
    					
    					$cg_trainings = DB::table('cg_trainings')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(id) as count"))
                        	->first();
    					
    					$cg_male = DB::table('cg_youths')
    							->join('youths','youths.id','=','cg_youths.youth_id')
    							->join('career_guidances','career_guidances.id','=','cg_youths.career_guidances_id')
    							->where('gender','male')
    							->count();

    					$cg_female = DB::table('cg_youths')
    							->join('youths','youths.id','=','cg_youths.youth_id')
    							->join('career_guidances','career_guidances.id','=','cg_youths.career_guidances_id')
    							->where('gender','female')
    							->count();

    					$cg_count = DB::table('career_guidances')->count();

                        $requirement = DB::table('cg_youth_selected') 
                        		->join('career_guidances','career_guidances.id', '=' ,'cg_youth_selected.career_guidances_id')
                        		->select('cg_youth_selected.*',DB::raw("SUM(male) as total_male"),DB::raw("SUM(female) as total_female"))
                        		->groupBy('requirement')
                        		//->where('career_guidances.branch_id','=',$branch_id)
                       			->orderBy('cg_youth_selected.id','asc')
                        		->get();

                        $locations = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
	    					->join('families','families.id','=','youths.family_id')
	    					->join('dsd_office','dsd_office.ID','=','families.ds_division')
	    					->select('DSD_Name', DB::raw('count(*) as total'))
	    					->groupBy('DSD_Name')->get();

	    				$career_field = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
	    					->select('career_field1', DB::raw('count(*) as total'))
	    					->groupBy('career_field1')->get();

	    				$family_type = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
	    					->join('families','families.id','=','youths.family_id')
	    					->select('family_type', DB::raw('count(*) as total'))
	    					->groupBy('family_type')->get();

	    				$marital = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
	    					->select('maritial_status', DB::raw('count(*) as total'))
	    					->groupBy('maritial_status')->get();

	    				$race = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
	    					->select('nationality', DB::raw('count(*) as total'))
	    					->groupBy('nationality')->get();

        			
        		break;
        		
        		default:
        		

					   $stake = DB::table('stake_holder_meetings')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(id) as count"))
					    	->where('stake_holder_meetings.branch_id',$branch_id)
                        	->first();  

					    $kickoffs = DB::table('kickoffs')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(id) as count"))
					    	->where('branch_id',$branch_id)
                        	->first();

                        $households = DB::table('households')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(id) as count"))
					    	->where('branch_id',$branch_id)
                        	->first();

    					$tot_cg = DB::table('tot_cg_participants')
    							->join('tot_cg','tot_cg.id','=','tot_cg_participants.tot_cg_id')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(tot_cg_participants.id) as count"))
					    	->where('branch_id',$branch_id)
                        	->first();
                        	
                        $tot_count = DB::table('tot_cg')
					    	->where('branch_id',$branch_id)
                        	->count();
    					
    					$cg_trainings = DB::table('cg_trainings')
                            ->select(DB::raw("SUM(total_male) as total_male"),DB::raw("SUM(total_female) as total_female"),DB::raw("count(id) as count"))
					    	->where('branch_id',$branch_id)
                        	->first();
    					
    					$cg_male = DB::table('cg_youths')
    							->join('youths','youths.id','=','cg_youths.youth_id')
    							->join('career_guidances','career_guidances.id','=','cg_youths.career_guidances_id')
    							->where('gender','male')
					    		->where('career_guidances.branch_id',$branch_id)
    							->count();

    					$cg_female = DB::table('cg_youths')
    							->join('youths','youths.id','=','cg_youths.youth_id')
    							->join('career_guidances','career_guidances.id','=','cg_youths.career_guidances_id')
    							->where('gender','female')
					    		->where('career_guidances.branch_id',$branch_id)
    							->count();

    					$cg_count = DB::table('career_guidances')
					    		->where('career_guidances.branch_id',$branch_id)
    							->count();

                        $requirement = DB::table('cg_youth_selected') 
                        		->join('career_guidances','career_guidances.id', '=' ,'cg_youth_selected.career_guidances_id')
                        		->select('cg_youth_selected.*',DB::raw("SUM(male) as total_male"),DB::raw("SUM(female) as total_female"))
                        		->groupBy('requirement')
                        		//->where('career_guidances.branch_id','=',$branch_id)
                       			->orderBy('cg_youth_selected.id','asc')
					    		->where('career_guidances.branch_id',$branch_id)
                        		->get();

                        $locations = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
	    					->join('families','families.id','=','youths.family_id')
	    					->join('dsd_office','dsd_office.ID','=','families.ds_division')
	    					->select('DSD_Name', DB::raw('count(*) as total'))
					    		->where('youths.branch_id',$branch_id)
	    					->groupBy('DSD_Name')->get();

	    				$career_field = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
                        	->join('career_guidances','career_guidances.id', '=' ,'cg_youths.career_guidances_id')
	    					->select('career_field1', DB::raw('count(*) as total'))
					    	->where('career_guidances.branch_id',$branch_id)
	    					->groupBy('career_field1')->get();

	    				$family_type = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
	    					->join('families','families.id','=','youths.family_id')
                        	->join('career_guidances','career_guidances.id', '=' ,'cg_youths.career_guidances_id')
	    					->select('family_type', DB::raw('count(*) as total'))
					    	->where('career_guidances.branch_id',$branch_id)
	    					->groupBy('family_type')->get();

	    				$marital = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
	    					->select('maritial_status', DB::raw('count(*) as total'))
					    	->where('youths.branch_id',$branch_id)
	    					->groupBy('maritial_status')->get();

	    				$race = DB::table('cg_youths')
	    					->join('youths','youths.id','=','cg_youths.youth_id')
	    					->select('nationality', DB::raw('count(*) as total'))
					    	->where('youths.branch_id',$branch_id)
	    					->groupBy('nationality')->get();
	        		
        		break;
        	}
        }
      // dd($career_field);
        return response()->json(array(
            'stake'=>$stake,
            'cg_male'=>$cg_male,
            'cg_female'=>$cg_female,
            'cg_count' => $cg_count,
            'cg_trainings'=>$cg_trainings,
            'kickoffs'=>$kickoffs,
            'tot_cg'=>$tot_cg,
            'households'=>$households,
            'count_tot' => $tot_count,
            'date1' => $request->dateStart,
            'date2' => $request->dateEnd,
            'requirement'=> $requirement,
            'locations' => $locations,
            'career_field' => $career_field,
            'family_type' => $family_type,
            'marital' => $marital,
            'race' => $race
	    ));

    }

public function gvt(){

	$branches = DB::table('branches')->get();
	return view('Analysis.gvt')->with(['branches'=>$branches]);		
}

public function fetch_gvt(Request $request){
        if($request->ajax())
        {
            $branch_id = Auth::user()->branch;

            if($request->dateStart != '' && $request->dateEnd != '')
            {
                if($request->branch !=''){
                    $gender = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->select('course_supports.*','gender',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN course_supports_youth.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN course_supports_youth.youth_id END ) ) AS female"))
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('course_supports.branch_id', $request->branch)
                        ->first();

                $marital = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->select('maritial_status',DB::raw('count(*) as total'))
                        ->groupBy('maritial_status')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('course_supports.branch_id', $request->branch)
                        ->get();

                $race = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->select('nationality',DB::raw('count(*) as total'))
                        ->groupBy('nationality')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('course_supports.branch_id', $request->branch)
                        ->get();

                $courses = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->join('courses','courses.id','=','course_supports.course_id')
                        ->select('course_supports.*','gender','courses.name as course_name',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN course_supports_youth.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN course_supports_youth.youth_id END ) ) AS female"))
                        ->groupBy('courses.name')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('course_supports.branch_id', $request->branch)
                        ->get();

                $institutes = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->join('institutes','institutes.id','=','course_supports.institute_id')
                        ->select('course_supports.*','gender','institutes.name as institute_name',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN course_supports_youth.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN course_supports_youth.youth_id END ) ) AS female"))
                        ->groupBy('institutes.name')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('course_supports.branch_id', $request->branch)
                        ->get();

                $family_types = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->join('families','families.id','=','youths.family_id')
                        ->select('course_supports.*','gender','family_type',DB::raw('count(*) as total'))
                        ->groupBy('family_type')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('course_supports.branch_id', $request->branch)
                        ->get();

                $locations = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->join('families','families.id','=','youths.family_id')
	    				->join('dsd_office','dsd_office.ID','=','families.ds_division')
                        ->select('DSD_Name',DB::raw('count(*) as total'))
                        ->groupBy('DSD_Name')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('course_supports.branch_id', $request->branch)
                        ->get();

                $course_types = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('courses','courses.id','=','course_supports.course_id')
                        ->select('course_type',DB::raw('count(*) as total'))
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('course_supports.branch_id', $request->branch)
                        ->groupBy('course_type')
                        ->get();

                }
                else{
                    if(is_null($branch_id)){
              			$gender = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->select('course_supports.*','gender',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN course_supports_youth.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN course_supports_youth.youth_id END ) ) AS female"))
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->first();

                $marital = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->select('maritial_status',DB::raw('count(*) as total'))
                        ->groupBy('maritial_status')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->get();

                $race = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->select('nationality',DB::raw('count(*) as total'))
                        ->groupBy('nationality')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->get();

                $courses = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->join('courses','courses.id','=','course_supports.course_id')
                        ->select('course_supports.*','gender','courses.name as course_name',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN course_supports_youth.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN course_supports_youth.youth_id END ) ) AS female"))
                        ->groupBy('courses.name')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->get();

                $institutes = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->join('institutes','institutes.id','=','course_supports.institute_id')
                        ->select('course_supports.*','gender','institutes.name as institute_name',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN course_supports_youth.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN course_supports_youth.youth_id END ) ) AS female"))
                        ->groupBy('institutes.name')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->get();

                $family_types = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->join('families','families.id','=','youths.family_id')
                        ->select('course_supports.*','gender','family_type',DB::raw('count(*) as total'))
                        ->groupBy('family_type')
                        ->get();

                $locations = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->join('families','families.id','=','youths.family_id')
	    				->join('dsd_office','dsd_office.ID','=','families.ds_division')
                        ->select('DSD_Name',DB::raw('count(*) as total'))
                        ->groupBy('DSD_Name')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->get();

                $course_types = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('courses','courses.id','=','course_supports.course_id')
                        ->select('course_type',DB::raw('count(*) as total'))
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->groupBy('course_type')
                        ->get();
                    }
                    else{

                    $gender = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->select('course_supports.*','gender',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN course_supports_youth.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN course_supports_youth.youth_id END ) ) AS female"))
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('course_supports.branch_id', $branch_id)
                        ->first();

                $marital = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->select('maritial_status',DB::raw('count(*) as total'))
                        ->groupBy('maritial_status')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('course_supports.branch_id', $branch_id)
                        ->get();

                $race = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->select('nationality',DB::raw('count(*) as total'))
                        ->groupBy('nationality')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('course_supports.branch_id', $branch_id)
                        ->get();

                $courses = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->join('courses','courses.id','=','course_supports.course_id')
                        ->select('course_supports.*','gender','courses.name as course_name',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN course_supports_youth.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN course_supports_youth.youth_id END ) ) AS female"))
                        ->groupBy('courses.name')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('course_supports.branch_id', $branch_id)
                        ->get();

                $institutes = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->join('institutes','institutes.id','=','course_supports.institute_id')
                        ->select('course_supports.*','gender','institutes.name as institute_name',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN course_supports_youth.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN course_supports_youth.youth_id END ) ) AS female"))
                        ->groupBy('institutes.name')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('course_supports.branch_id', $branch_id)
                        ->get();

                $family_types = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->join('families','families.id','=','youths.family_id')
                        ->select('course_supports.*','gender','family_type',DB::raw('count(*) as total'))
                        ->groupBy('family_type')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('course_supports.branch_id', $branch_id)
                        ->get();

                $locations = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->join('families','families.id','=','youths.family_id')
	    				->join('dsd_office','dsd_office.ID','=','families.ds_division')
                        ->select('DSD_Name',DB::raw('count(*) as total'))
                        ->groupBy('DSD_Name')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('course_supports.branch_id', $branch_id)
                        ->get();

                $course_types = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('courses','courses.id','=','course_supports.course_id')
                        ->select('course_type',DB::raw('count(*) as total'))
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('course_supports.branch_id', $branch_id)
                        ->groupBy('course_type')
                        ->get();

                    }
                }
                
            }
        else
            {
                if(is_null($branch_id)){
                
               $gender = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->select('course_supports.*','gender',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN course_supports_youth.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN course_supports_youth.youth_id END ) ) AS female"))
                        ->first();

                $marital = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->select('maritial_status',DB::raw('count(*) as total'))
                        ->groupBy('maritial_status')
                        ->get();

                $race = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->select('nationality',DB::raw('count(*) as total'))
                        ->groupBy('nationality')
                        ->get();

                $courses = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->join('courses','courses.id','=','course_supports.course_id')
                        ->select('course_supports.*','gender','courses.name as course_name',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN course_supports_youth.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN course_supports_youth.youth_id END ) ) AS female"))
                        ->groupBy('courses.name')
                        ->get();

                $institutes = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->join('institutes','institutes.id','=','course_supports.institute_id')
                        ->select('course_supports.*','gender','institutes.name as institute_name',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN course_supports_youth.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN course_supports_youth.youth_id END ) ) AS female"))
                        ->groupBy('institutes.name')
                        ->get();

                $family_types = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->join('families','families.id','=','youths.family_id')
                        ->select('course_supports.*','gender','family_type',DB::raw('count(*) as total'))
                        ->groupBy('family_type')
                        ->get();

                $locations = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->join('families','families.id','=','youths.family_id')
	    				->join('dsd_office','dsd_office.ID','=','families.ds_division')
                        ->select('DSD_Name',DB::raw('count(*) as total'))
                        ->groupBy('DSD_Name')
                        ->get();

                $course_types = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('courses','courses.id','=','course_supports.course_id')
                        ->select('course_type',DB::raw('count(*) as total'))
                        ->groupBy('course_type')
                        ->get();


                }
                else{
                 $gender = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->select('course_supports.*','gender',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN course_supports_youth.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN course_supports_youth.youth_id END ) ) AS female"))
                        ->where('course_supports.branch_id', $branch_id)
                        ->first();

                $marital = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->select('maritial_status',DB::raw('count(*) as total'))
                        ->groupBy('maritial_status')
                        ->where('course_supports.branch_id', $branch_id)
                        ->get();

                $race = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->select('nationality',DB::raw('count(*) as total'))
                        ->groupBy('nationality')
                        ->where('course_supports.branch_id', $branch_id)
                        ->get();

                $courses = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->join('courses','courses.id','=','course_supports.course_id')
                        ->select('course_supports.*','gender','courses.name as course_name',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN course_supports_youth.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN course_supports_youth.youth_id END ) ) AS female"))
                        ->groupBy('courses.name')
                        ->where('course_supports.branch_id', $branch_id)
                        ->get();

                $institutes = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->join('institutes','institutes.id','=','course_supports.institute_id')
                        ->select('course_supports.*','gender','institutes.name as institute_name',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN course_supports_youth.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN course_supports_youth.youth_id END ) ) AS female"))
                        ->groupBy('institutes.name')
                        ->where('course_supports.branch_id', $branch_id)
                        ->get();

                $family_types = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->join('families','families.id','=','youths.family_id')
                        ->select('course_supports.*','gender','family_type',DB::raw('count(*) as total'))
                        ->groupBy('family_type')
                        ->where('course_supports.branch_id', $branch_id)
                        ->get();

                $locations = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('youths','youths.id','=','course_supports_youth.youth_id')
                        ->join('families','families.id','=','youths.family_id')
	    				->join('dsd_office','dsd_office.ID','=','families.ds_division')
                        ->select('DSD_Name',DB::raw('count(*) as total'))
                        ->groupBy('DSD_Name')
                        ->where('course_supports.branch_id', $branch_id)
                        ->get();

                $course_types = DB::table('course_supports_youth') 
                        ->join('course_supports','course_supports.id','=','course_supports_youth.course_support_id')
                        ->join('courses','courses.id','=','course_supports.course_id')
                        ->select('course_type',DB::raw('count(*) as total'))
                        ->where('course_supports.branch_id', $branch_id)
                        ->groupBy('course_type')
                        ->get();


                }
            }

                return response()->json(array( 
                    'gender' => $gender,
                    'marital' => $marital,
                    'courses' => $courses,
                    'race' => $race,
                    'institutes' => $institutes,
                    'family_types' => $family_types,
                    'locations' => $locations,
                    'date1' => $request->dateStart,
            		'date2' => $request->dateEnd,
            		'course_types' => $course_types
                 
                ));
        }
    }


public function soft(){

$branches = DB::table('branches')->get();
return view('Analysis.soft')->with(['branches'=>$branches]);		
}

public function fetch_soft(Request $request){
        if($request->ajax())
        {
            $branch_id = Auth::user()->branch;

            if($request->dateStart != '' && $request->dateEnd != '')
            {
                if($request->branch !=''){
                    $gender = DB::table('provide_soft_skills_youths') 
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                        ->select('provide_soft_skills.*','gender',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN provide_soft_skills_youths.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN provide_soft_skills_youths.youth_id END ) ) AS female"))
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('provide_soft_skills.branch_id', $request->branch)
                        ->first();

                $marital = DB::table('provide_soft_skills_youths') 
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                        ->select('maritial_status',DB::raw('count(*) as total'))
                        ->groupBy('maritial_status')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('provide_soft_skills.branch_id', $request->branch)
                        ->get();

                $race = DB::table('provide_soft_skills_youths') 
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                        ->select('nationality',DB::raw('count(*) as total'))
                        ->groupBy('nationality')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('provide_soft_skills.branch_id', $request->branch)
                        ->get();

                

                $institutes = DB::table('provide_soft_skills_youths') 
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                        ->join('institutes','institutes.id','=','provide_soft_skills.institute_id')
                        ->select('provide_soft_skills.*','gender','institutes.name as institute_name',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN provide_soft_skills_youths.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN provide_soft_skills_youths.youth_id END ) ) AS female"))
                        ->groupBy('institutes.name')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('provide_soft_skills.branch_id', $request->branch)
                        ->get();

                $family_types = DB::table('provide_soft_skills_youths') 
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                        ->join('families','families.id','=','youths.family_id')
                        ->select('provide_soft_skills.*','gender','family_type',DB::raw('count(*) as total'))
                        ->groupBy('family_type')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('provide_soft_skills.branch_id', $request->branch)
                        ->get();

                $locations = DB::table('provide_soft_skills_youths') 
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                        ->join('families','families.id','=','youths.family_id')
	    				->join('dsd_office','dsd_office.ID','=','families.ds_division')
                        ->select('DSD_Name',DB::raw('count(*) as total'))
                        ->groupBy('DSD_Name')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('provide_soft_skills.branch_id', $request->branch)
                        ->get();

               
                }
                else{
                    if(is_null($branch_id)){
              			$gender = DB::table('provide_soft_skills_youths') 
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                        ->select('provide_soft_skills.*','gender',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN provide_soft_skills_youths.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN provide_soft_skills_youths.youth_id END ) ) AS female"))
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->first();

                $marital = DB::table('provide_soft_skills_youths') 
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                        ->select('maritial_status',DB::raw('count(*) as total'))
                        ->groupBy('maritial_status')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->get();

                $race = DB::table('provide_soft_skills_youths') 
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                        ->select('nationality',DB::raw('count(*) as total'))
                        ->groupBy('nationality')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->get();

               

                $institutes = DB::table('provide_soft_skills_youths') 
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                        ->join('institutes','institutes.id','=','provide_soft_skills.institute_id')
                        ->select('provide_soft_skills.*','gender','institutes.name as institute_name',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN provide_soft_skills_youths.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN provide_soft_skills_youths.youth_id END ) ) AS female"))
                        ->groupBy('institutes.name')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->get();

                $family_types = DB::table('provide_soft_skills_youths') 
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                        ->join('families','families.id','=','youths.family_id')
                        ->select('provide_soft_skills.*','gender','family_type',DB::raw('count(*) as total'))
                        ->groupBy('family_type')
                        ->get();

                $locations = DB::table('provide_soft_skills_youths') 
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                        ->join('families','families.id','=','youths.family_id')
	    				->join('dsd_office','dsd_office.ID','=','families.ds_division')
                        ->select('DSD_Name',DB::raw('count(*) as total'))
                        ->groupBy('DSD_Name')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->get();

               
                    }
                    else{

                    $gender = DB::table('provide_soft_skills_youths') 
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                        ->select('provide_soft_skills.*','gender',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN provide_soft_skills_youths.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN provide_soft_skills_youths.youth_id END ) ) AS female"))
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('provide_soft_skills.branch_id', $branch_id)
                        ->first();

                $marital = DB::table('provide_soft_skills_youths') 
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                        ->select('maritial_status',DB::raw('count(*) as total'))
                        ->groupBy('maritial_status')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('provide_soft_skills.branch_id', $branch_id)
                        ->get();

                $race = DB::table('provide_soft_skills_youths') 
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                        ->select('nationality',DB::raw('count(*) as total'))
                        ->groupBy('nationality')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('provide_soft_skills.branch_id', $branch_id)
                        ->get();

               

                $institutes = DB::table('provide_soft_skills_youths') 
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                        ->join('institutes','institutes.id','=','provide_soft_skills.institute_id')
                        ->select('provide_soft_skills.*','gender','institutes.name as institute_name',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN provide_soft_skills_youths.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN provide_soft_skills_youths.youth_id END ) ) AS female"))
                        ->groupBy('institutes.name')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('provide_soft_skills.branch_id', $branch_id)
                        ->get();

                $family_types = DB::table('provide_soft_skills_youths') 
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                        ->join('families','families.id','=','youths.family_id')
                        ->select('provide_soft_skills.*','gender','family_type',DB::raw('count(*) as total'))
                        ->groupBy('family_type')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('provide_soft_skills.branch_id', $branch_id)
                        ->get();

                $locations = DB::table('provide_soft_skills_youths') 
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                        ->join('families','families.id','=','youths.family_id')
	    				->join('dsd_office','dsd_office.ID','=','families.ds_division')
                        ->select('DSD_Name',DB::raw('count(*) as total'))
                        ->groupBy('DSD_Name')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('provide_soft_skills.branch_id', $branch_id)
                        ->get();


                    }
                }
                
            }
        else
            {
                if(is_null($branch_id)){
                
               $gender = DB::table('provide_soft_skills_youths') 
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                        ->select('provide_soft_skills.*','gender',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN provide_soft_skills_youths.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN provide_soft_skills_youths.youth_id END ) ) AS female"))
                        ->first();

                $marital = DB::table('provide_soft_skills_youths') 
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                        ->select('maritial_status',DB::raw('count(*) as total'))
                        ->groupBy('maritial_status')
                        ->get();

                $race = DB::table('provide_soft_skills_youths') 
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                        ->select('nationality',DB::raw('count(*) as total'))
                        ->groupBy('nationality')
                        ->get();

                

                $institutes = DB::table('provide_soft_skills_youths') 
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                        ->join('institutes','institutes.id','=','provide_soft_skills.institute_id')
                        ->select('provide_soft_skills.*','gender','institutes.name as institute_name',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN provide_soft_skills_youths.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN provide_soft_skills_youths.youth_id END ) ) AS female"))
                        ->groupBy('institutes.name')
                        ->get();

                $family_types = DB::table('provide_soft_skills_youths') 
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                        ->join('families','families.id','=','youths.family_id')
                        ->select('provide_soft_skills.*','gender','family_type',DB::raw('count(*) as total'))
                        ->groupBy('family_type')
                        ->get();

                $locations = DB::table('provide_soft_skills_youths') 
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                        ->join('families','families.id','=','youths.family_id')
	    				->join('dsd_office','dsd_office.ID','=','families.ds_division')
                        ->select('DSD_Name',DB::raw('count(*) as total'))
                        ->groupBy('DSD_Name')
                        ->get();


                }
                else{
                 $gender = DB::table('provide_soft_skills_youths') 
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                        ->select('provide_soft_skills.*','gender',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN provide_soft_skills_youths.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN provide_soft_skills_youths.youth_id END ) ) AS female"))
                        ->where('provide_soft_skills.branch_id', $branch_id)
                        ->first();

                $marital = DB::table('provide_soft_skills_youths') 
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                        ->select('maritial_status',DB::raw('count(*) as total'))
                        ->groupBy('maritial_status')
                        ->where('provide_soft_skills.branch_id', $branch_id)
                        ->get();

                $race = DB::table('provide_soft_skills_youths') 
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                        ->select('nationality',DB::raw('count(*) as total'))
                        ->groupBy('nationality')
                        ->where('provide_soft_skills.branch_id', $branch_id)
                        ->get();


                $institutes = DB::table('provide_soft_skills_youths') 
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                        ->join('institutes','institutes.id','=','provide_soft_skills.institute_id')
                        ->select('provide_soft_skills.*','gender','institutes.name as institute_name',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN provide_soft_skills_youths.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN provide_soft_skills_youths.youth_id END ) ) AS female"))
                        ->groupBy('institutes.name')
                        ->where('provide_soft_skills.branch_id', $branch_id)
                        ->get();

                $family_types = DB::table('provide_soft_skills_youths') 
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                        ->join('families','families.id','=','youths.family_id')
                        ->select('provide_soft_skills.*','gender','family_type',DB::raw('count(*) as total'))
                        ->groupBy('family_type')
                        ->where('provide_soft_skills.branch_id', $branch_id)
                        ->get();

                $locations = DB::table('provide_soft_skills_youths') 
                        ->join('provide_soft_skills','provide_soft_skills.id','=','provide_soft_skills_youths.provide_softskill_id')
                        ->join('youths','youths.id','=','provide_soft_skills_youths.youth_id')
                        ->join('families','families.id','=','youths.family_id')
	    				->join('dsd_office','dsd_office.ID','=','families.ds_division')
                        ->select('DSD_Name',DB::raw('count(*) as total'))
                        ->groupBy('DSD_Name')
                        ->where('provide_soft_skills.branch_id', $branch_id)
                        ->get();



                }
            }

                return response()->json(array( 
                    'gender' => $gender,
                    'marital' => $marital,
                    'race' => $race,
                    'institutes' => $institutes,
                    'family_types' => $family_types,
                    'locations' => $locations,
                    'date1' => $request->dateStart,
            		'date2' => $request->dateEnd,
                 
                ));
        }
    }

public function financial(){

	$branches = DB::table('branches')->get();
	
	return view('Analysis.financial')->with(['branches'=>$branches]);		
}

public function fetch_financial(Request $request){
        if($request->ajax())
        {
            $branch_id = Auth::user()->branch;

            if($request->dateStart != '' && $request->dateEnd != '')
            {
                if($request->branch !=''){
                    $gender = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->select('finacial_supports.*','gender',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN finacial_supports_youths.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN finacial_supports_youths.youth_id END ) ) AS female"))
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('finacial_supports.branch_id', $request->branch)
                        ->first();

                $marital = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->select('maritial_status',DB::raw('count(*) as total'))
                        ->groupBy('maritial_status')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('finacial_supports.branch_id', $request->branch)
                        ->get();

                $race = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->select('nationality',DB::raw('count(*) as total'))
                        ->groupBy('nationality')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('finacial_supports.branch_id', $request->branch)
                        ->get();

                $courses = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->join('courses','courses.id','=','finacial_supports.course_id')
                        ->select('finacial_supports.*','gender','courses.name as course_name',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN finacial_supports_youths.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN finacial_supports_youths.youth_id END ) ) AS female"))
                        ->groupBy('courses.name')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('finacial_supports.branch_id', $request->branch)
                        ->get();

                $institutes = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->join('institutes','institutes.id','=','finacial_supports.institute_id')
                        ->select('finacial_supports.*','gender','institutes.name as institute_name',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN finacial_supports_youths.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN finacial_supports_youths.youth_id END ) ) AS female"))
                        ->groupBy('institutes.name')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('finacial_supports.branch_id', $request->branch)
                        ->get();

                $family_types = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->join('families','families.id','=','youths.family_id')
                        ->select('finacial_supports.*','gender','family_type',DB::raw('count(*) as total'))
                        ->groupBy('family_type')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('finacial_supports.branch_id', $request->branch)
                        ->get();

                $locations = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->join('families','families.id','=','youths.family_id')
                        ->join('dsd_office','dsd_office.ID','=','families.ds_division')
                        ->select('DSD_Name',DB::raw('count(*) as total'))
                        ->groupBy('DSD_Name')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('finacial_supports.branch_id', $request->branch)
                        ->get();

                $course_types = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('courses','courses.id','=','finacial_supports.course_id')
                        ->select('course_type',DB::raw('count(*) as total'))
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('finacial_supports.branch_id', $request->branch)
                        ->groupBy('course_type')
                        ->get();

                }
                else{
                    if(is_null($branch_id)){
                        $gender = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->select('finacial_supports.*','gender',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN finacial_supports_youths.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN finacial_supports_youths.youth_id END ) ) AS female"))
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->first();

                $marital = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->select('maritial_status',DB::raw('count(*) as total'))
                        ->groupBy('maritial_status')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->get();

                $race = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->select('nationality',DB::raw('count(*) as total'))
                        ->groupBy('nationality')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->get();

                $courses = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->join('courses','courses.id','=','finacial_supports.course_id')
                        ->select('finacial_supports.*','gender','courses.name as course_name',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN finacial_supports_youths.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN finacial_supports_youths.youth_id END ) ) AS female"))
                        ->groupBy('courses.name')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->get();

                $institutes = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->join('institutes','institutes.id','=','finacial_supports.institute_id')
                        ->select('finacial_supports.*','gender','institutes.name as institute_name',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN finacial_supports_youths.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN finacial_supports_youths.youth_id END ) ) AS female"))
                        ->groupBy('institutes.name')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->get();

                $family_types = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->join('families','families.id','=','youths.family_id')
                        ->select('finacial_supports.*','gender','family_type',DB::raw('count(*) as total'))
                        ->groupBy('family_type')
                        ->get();

                $locations = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->join('families','families.id','=','youths.family_id')
                        ->join('dsd_office','dsd_office.ID','=','families.ds_division')
                        ->select('DSD_Name',DB::raw('count(*) as total'))
                        ->groupBy('DSD_Name')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->get();

                $course_types = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('courses','courses.id','=','finacial_supports.course_id')
                        ->select('course_type',DB::raw('count(*) as total'))
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->groupBy('course_type')
                        ->get();
                    }
                    else{

                    $gender = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->select('finacial_supports.*','gender',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN finacial_supports_youths.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN finacial_supports_youths.youth_id END ) ) AS female"))
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('finacial_supports.branch_id', $branch_id)
                        ->first();

                $marital = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->select('maritial_status',DB::raw('count(*) as total'))
                        ->groupBy('maritial_status')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('finacial_supports.branch_id', $branch_id)
                        ->get();

                $race = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->select('nationality',DB::raw('count(*) as total'))
                        ->groupBy('nationality')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('finacial_supports.branch_id', $branch_id)
                        ->get();

                $courses = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->join('courses','courses.id','=','finacial_supports.course_id')
                        ->select('finacial_supports.*','gender','courses.name as course_name',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN finacial_supports_youths.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN finacial_supports_youths.youth_id END ) ) AS female"))
                        ->groupBy('courses.name')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('finacial_supports.branch_id', $branch_id)
                        ->get();

                $institutes = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->join('institutes','institutes.id','=','finacial_supports.institute_id')
                        ->select('finacial_supports.*','gender','institutes.name as institute_name',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN finacial_supports_youths.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN finacial_supports_youths.youth_id END ) ) AS female"))
                        ->groupBy('institutes.name')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('finacial_supports.branch_id', $branch_id)
                        ->get();

                $family_types = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->join('families','families.id','=','youths.family_id')
                        ->select('finacial_supports.*','gender','family_type',DB::raw('count(*) as total'))
                        ->groupBy('family_type')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('finacial_supports.branch_id', $branch_id)
                        ->get();

                $locations = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->join('families','families.id','=','youths.family_id')
                        ->join('dsd_office','dsd_office.ID','=','families.ds_division')
                        ->select('DSD_Name',DB::raw('count(*) as total'))
                        ->groupBy('DSD_Name')
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('finacial_supports.branch_id', $branch_id)
                        ->get();

                $course_types = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('courses','courses.id','=','finacial_supports.course_id')
                        ->select('course_type',DB::raw('count(*) as total'))
                        ->whereBetween('program_date', array($request->dateStart, $request->dateEnd))
                        ->where('finacial_supports.branch_id', $branch_id)
                        ->groupBy('course_type')
                        ->get();

                    }
                }
                
            }
        else
            {
                if(is_null($branch_id)){
                
               $gender = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->select('finacial_supports.*','gender',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN finacial_supports_youths.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN finacial_supports_youths.youth_id END ) ) AS female"))
                        ->first();

                $marital = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->select('maritial_status',DB::raw('count(*) as total'))
                        ->groupBy('maritial_status')
                        ->get();

                $race = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->select('nationality',DB::raw('count(*) as total'))
                        ->groupBy('nationality')
                        ->get();

                $courses = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->join('courses','courses.id','=','finacial_supports.course_id')
                        ->select('finacial_supports.*','gender','courses.name as course_name',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN finacial_supports_youths.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN finacial_supports_youths.youth_id END ) ) AS female"))
                        ->groupBy('courses.name')
                        ->get();

                $institutes = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->join('institutes','institutes.id','=','finacial_supports.institute_id')
                        ->select('finacial_supports.*','gender','institutes.name as institute_name',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN finacial_supports_youths.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN finacial_supports_youths.youth_id END ) ) AS female"))
                        ->groupBy('institutes.name')
                        ->get();

                $family_types = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->join('families','families.id','=','youths.family_id')
                        ->select('finacial_supports.*','gender','family_type',DB::raw('count(*) as total'))
                        ->groupBy('family_type')
                        ->get();

                $locations = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->join('families','families.id','=','youths.family_id')
                        ->join('dsd_office','dsd_office.ID','=','families.ds_division')
                        ->select('DSD_Name',DB::raw('count(*) as total'))
                        ->groupBy('DSD_Name')
                        ->get();

                $course_types = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('courses','courses.id','=','finacial_supports.course_id')
                        ->select('course_type',DB::raw('count(*) as total'))
                        ->groupBy('course_type')
                        ->get();


                }
                else{
                 $gender = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->select('finacial_supports.*','gender',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN finacial_supports_youths.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN finacial_supports_youths.youth_id END ) ) AS female"))
                        ->where('finacial_supports.branch_id', $branch_id)
                        ->first();

                $marital = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->select('maritial_status',DB::raw('count(*) as total'))
                        ->groupBy('maritial_status')
                        ->where('finacial_supports.branch_id', $branch_id)
                        ->get();

                $race = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->select('nationality',DB::raw('count(*) as total'))
                        ->groupBy('nationality')
                        ->where('finacial_supports.branch_id', $branch_id)
                        ->get();

                $courses = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->join('courses','courses.id','=','finacial_supports.course_id')
                        ->select('finacial_supports.*','gender','courses.name as course_name',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN finacial_supports_youths.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN finacial_supports_youths.youth_id END ) ) AS female"))
                        ->groupBy('courses.name')
                        ->where('finacial_supports.branch_id', $branch_id)
                        ->get();

                $institutes = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->join('institutes','institutes.id','=','finacial_supports.institute_id')
                        ->select('finacial_supports.*','gender','institutes.name as institute_name',DB::raw("COUNT( ( CASE WHEN gender = 'male' THEN finacial_supports_youths.youth_id END ) ) AS male"),DB::raw("COUNT( ( CASE WHEN gender = 'female' THEN finacial_supports_youths.youth_id END ) ) AS female"))
                        ->groupBy('institutes.name')
                        ->where('finacial_supports.branch_id', $branch_id)
                        ->get();

                $family_types = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->join('families','families.id','=','youths.family_id')
                        ->select('finacial_supports.*','gender','family_type',DB::raw('count(*) as total'))
                        ->groupBy('family_type')
                        ->where('finacial_supports.branch_id', $branch_id)
                        ->get();

                $locations = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('youths','youths.id','=','finacial_supports_youths.youth_id')
                        ->join('families','families.id','=','youths.family_id')
                        ->join('dsd_office','dsd_office.ID','=','families.ds_division')
                        ->select('DSD_Name',DB::raw('count(*) as total'))
                        ->groupBy('DSD_Name')
                        ->where('finacial_supports.branch_id', $branch_id)
                        ->get();

                $course_types = DB::table('finacial_supports_youths') 
                        ->join('finacial_supports','finacial_supports.id','=','finacial_supports_youths.finacial_support_id')
                        ->join('courses','courses.id','=','finacial_supports.course_id')
                        ->select('course_type',DB::raw('count(*) as total'))
                        ->where('finacial_supports.branch_id', $branch_id)
                        ->groupBy('course_type')
                        ->get();


                }
            }

                return response()->json(array( 
                    'gender' => $gender,
                    'marital' => $marital,
                    'courses' => $courses,
                    'race' => $race,
                    'institutes' => $institutes,
                    'family_types' => $family_types,
                    'locations' => $locations,
                    'date1' => $request->dateStart,
            		'date2' => $request->dateEnd,
            		'course_types' => $course_types
                 
                ));
        }
    }

}
