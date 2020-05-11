<?php

namespace App\Http\Livewire;
use DB;

use Livewire\Component;

class Gender extends Component
{
	public $male;
	public $female;

    public function render()
    {

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


    	$this->male = $male_individuals+$male_fair;
    	$this->female = $female_individuals+$female_fair;

        return view('livewire.gender');
    }
}
