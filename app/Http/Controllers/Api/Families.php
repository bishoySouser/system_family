<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Abstracts\Family\CreateFamily;
use App\Http\Abstracts\Family\EditFamily;
use App\Http\Requests\Family;
use App\Family as Model;
use App\Traits\HttpStatusResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Families extends Controller
{
    use HttpStatusResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $families = Model::orderBy('created_at', "DESC")->paginate();
        foreach($families as $family){
            $family->father;
            $family->mather;
        }
        
        return $families;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Family $request)
    {
        $family = CreateFamily::insert($request);
        $response = [
            "msg" => 'Create New Family.' ,
            "id"  => $family->id
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
        if(is_numeric($id)){
            $family = DB::table('families')
                        ->select('families.family_date_from',
                                DB::raw("CONCAT(F.first_name,' ',F.middle_name,' ',F.last_name) AS father_name"),
                                DB::raw("CONCAT(M.first_name,' ',M.middle_name,' ',M.last_name) AS mother_name"),
                                'F.id As f_id',
                                'M.id As m_id',
                                'F.first_name AS father_first',
                                'F.middle_name AS father_middle',
                        )
                        ->join('individuals AS F', 'families.father_id', '=','F.id')
                        ->join('individuals AS M', 'families.mather_id', '=','M.id')
                        ->where('families.id', $id)
                        ->get();
            $child = DB::table('families')
                        ->select('F.*')
                        ->join('individuals AS F', 'families.father_id', '=','F.id')
                        ->where('families.id', $id)
                        ->get();

            $childern = DB::table('family_members')
                        ->select('Persone.first_name', 'Persone.id')
                        ->join('individuals AS Persone', 'family_members.individual_id', '=','Persone.id')
                        ->where('family_members.family_id', $id)
                        ->get();
        }
        $response = [
            "msg" => 'get family' ,
            "family"  => $family,
            "child_extend" => $child,
            "childern" => $childern
        ];
        return $this->created($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Family $request, $id)
    {
        if(EditFamily::update($request, $id)){
            return $this->ok('Updated successful');
        };
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

    public function destroyAll(Request $request)
    {
        if($request->ids){
            // Get Family Ides
            $family_ids = DB::table("families")
                            ->where("father_id", $request->ids)
                            ->orWhere("mather_id", $request->ids)
                            ->get();
            // Check get ids
            if($family_ids){
                $ids = [];
                foreach($family_ids as $id){
                    array_push($ids, $id->id);
                    // Update to single 
                    // print_r($id);
                    CreateFamily::toBeSingle($id->father_id);
                    CreateFamily::toBeSingle($id->mather_id);
            }
            DB::table('families')->whereIn('id' , $request->ids)->delete();
            DB::table("family_members")
                    ->where("family_id", $request->ids)
                    ->delete();
            }
            // return print_r($request->ids);
            return $this->ok('Deleted successful');
        }else{
            return $this->unprocessableEntity("Input error!");
        }
        
    }
}
