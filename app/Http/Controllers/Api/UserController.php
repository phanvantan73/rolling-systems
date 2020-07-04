<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\GenerateDataChartTrait;

class UserController extends Controller
{
	use GenerateDataChartTrait;
	
    public function index(Request $request)
    {
    	$year = $request->year ?? '2020';
    	$data = $this->generateDataForChart($year);

    	return response()->json([
    		'data' => $data,
    	]);
    }
}
