<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Insurance;
use App\Models\clientInsurance;
use App\Models\Profile;

class InsuranceController extends Controller
{

    //
    public function index(){
        $user_session= Auth::user();
        if($user_session->rol==3){
            $insurance=ClientInsurance::where('user_id',$user_session->id)->get();
            return view('insurance.index')->with('insurance',$insurance);
        }
        if($user_session->rol==1){
            $insurance=ClientInsurance::all()->get();
            return view('insurance.index')->with('insurance',$insurance);
        }

    }

    public function show($id){
        $insurance=ClientInsurance::find($id);
        $dataInsurance=Insurance::find($insurance->insurance_id);
        return view('insurance.show')->with('insurance',$dataInsurance);

    }

    public function create(){

    }

    public function store(Request $request){
        $input=$request->all();
        
    }

    public function edit($id){

    }

    public function update(Request $request, $id){

    }

    public function destroy($id){

    }
    
}
