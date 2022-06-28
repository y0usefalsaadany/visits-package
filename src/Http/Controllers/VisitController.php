<?php

namespace Yousef\Visits\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yousef\Visits\Models\Visit;
use Illuminate\Support\Facades\Http;

class VisitController extends Controller
{
    function countVisit(Request $request){
        $api = Http::get('http://ipwho.is/'. $request->ip());  
        $data = json_decode($api, true); 
        $visitTable =  new Visit;
        $visitTable->ip = $request->ip();
        $visitTable->city = $data['city'];
        $visitTable->save();
        $countVisits = count(Visit::all());
        return $countVisits;
    }

    function index(){
        Visit::all();
        return Request();
    }
}
