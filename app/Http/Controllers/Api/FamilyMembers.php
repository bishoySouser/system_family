<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FamilyMember;
use App\FamilyMember As Model;
use Illuminate\Support\Facades\DB;
use App\Traits\HttpStatusResponse;

class FamilyMembers extends Controller
{
    use HttpStatusResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(FamilyMember $request)
    {
        //Create New Individual 
        $member = Model::create($request->all());
        $response = [
            "msg" => 'Create New Family\'s Member.' ,
            "id"  => $member->id
        ];
        return $this->created($response);
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
        if($id){
            DB::table('family_members')->where('id' , $id)->delete();
            return $this->ok('Deleted successful');
        }else{
            return $this->unprocessableEntity("Input error!");
        }
    }

    public function showFamilyMembers($family_id)
    {
        $family_members = DB::table('family_members')
                            ->select('individuals.*')
                            ->join('individuals', 'family_members.individual_id', '=', 'individuals.id')
                            ->where('family_members.family_id', '=', $family_id)
                            ->get();
        $response = [
            "msg" => 'get family\'s memebrs' ,
            "members"  => $family_members
        ];
        return $this->created($response);
    }
}
