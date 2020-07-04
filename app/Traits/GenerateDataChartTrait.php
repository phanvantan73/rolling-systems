<?php

namespace App\Traits;

use Carbon\Carbon;
use App\Models\Diary;

trait GenerateDataChartTrait
{
	
	public function generateDataForChart($year = '2020')
    {
    	$data = [];

    	for ($i = 1; $i <= 12; $i++) { 
    		$checkInLate = Diary::select('idNv')
    			->whereYear('day', $year)
    			->whereMonth('day', $i)
    			->whereTime('timein', '>', Carbon::parse('09:00:00'))
    			->groupBy('idNv')
    			->get();
	    	$checkOutEarly = Diary::select('idNv')
	    		->whereYear('day', $year)
	    		->whereMonth('day', $i)
	    		->whereTime('timeout', '<', Carbon::parse('17:00:00'))
	    		->groupBy('idNv')
	    		->get();
	    	$overThirtySevenDegreesCelsius = Diary::select('idNv')
	    		->whereYear('day', $year)
	    		->whereMonth('day', $i)->where('temp', '>', 37.00)
	    		->groupBy('idNv')
	    		->get();
	    	array_push($data, [
	    		'in_late' => $checkInLate->count(),
	    		'out_early' => $checkOutEarly->count(),
	    		'over_temp' => $overThirtySevenDegreesCelsius->count(),
	    	]);
    	}

    	return $data;
    }
}
