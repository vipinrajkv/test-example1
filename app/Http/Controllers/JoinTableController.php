<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class JoinTableController extends Controller
{
    function index(){
        $data = DB::table('cities')
        ->join('states','cities.state_id' ,'=', 'states.states_id')
        ->join('countries','countries.countries_id', '=', 'states.country_id')
        ->select('cities.name','states.states_name','countries.countries_name')->get();

      return view('join_table',compact('data'));
    }
}
