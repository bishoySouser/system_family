<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Individual;
use Validator;
use DB;

class IndividualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 12 input
    private $rules = [
        "first_name" => 'required|string',
        "middle_name" => 'required|string',
        "last_name" => 'required|string',
        "gander" => 'required|string',
        "date_of_birth" => 'required|date',
        "place_of_birth" => 'required',
        "area" => 'required|string',
        "address" => 'required|string',
        "home_phone" => 'required',
        "mobile_phone1" => 'required',
        "job" => 'required',
        "social_status" => 'required',
    ];

    public function index()
    {
        $individuals = Individual::all();
        return response()->json(['individuals' => $individuals], 200);
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
        //validation
        $validate = Validator::make($request->all(), $this->rules);
            //check validation
            if ($validate->fails()) {
                return response()->json( ['errors'=> $validate->messages()],401);
            }
        //create new individual
        $individual = Individual::create([
            "first_name" => $request->get('first_name'),
            "middle_name" => $request->get('middle_name'),
            "last_name" => $request->get('last_name'),
            "gander" => $request->get('gander'),
            "date_of_birth" => $request->get('date_of_birth'),
            "place_of_birth" => $request->get('place_of_birth'),
            "email" => $request->get('email'),
            "area" =>  $request->get('area'),
            "address" => $request->get('address'),
            "home_phone" => $request->get('home_phone'),
            "mobile_phone1" => $request->get('mobile_phone1'),
            "mobile_phone2" => $request->get('mobile_phone2'),
            "social_status" => $request->get('social_status'),
            "special" => 0,
        ]);
        //return response
        $response = [
            'msg' => 'The persone added!.'
        ];

        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    //search keywork with table individual
    public function search($q = null){
        if(!$q){
            $this->index();
        }else{
            $individuals = Individual::select("*")
            ->where(DB::raw("CONCAT(individuals.first_name,' ',individuals.middle_name)"),'like', '%'.$q.'%')
            ->get();
            return response()->json(compact('individuals'));
        }
    }
}
