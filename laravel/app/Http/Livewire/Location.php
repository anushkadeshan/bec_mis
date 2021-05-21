<?php

namespace App\Http\Livewire;

use Livewire\Component;
use DB;
class Location extends Component
{
	public $locations; 
	public function mount($locations){
    		$this->locations = DB::table('placement_individual')
    			->join('youths','youths.id','=','placement_individual.youth_id')
    			->join('families','families.id','=','youths.family_id')
    			->join('dsd_office','dsd_office.ID','=','families.ds_division')
    			->select('DSD_Name', DB::raw('count(*) as total'))
    			->groupBy('DSD_Name')
    			->get();
    	}
    public function render()
    {

        return view('livewire.location');
    }
}
