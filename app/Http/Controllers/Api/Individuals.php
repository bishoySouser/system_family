<?php

namespace App\Http\Controllers\Api;

use App\Http\Abstracts\Individual\EditIndividual;
use App\Http\Abstracts\Individual\CreateIndividual;
use App\Http\Abstracts\Family\CreateFamily;
use App\Http\Controllers\Controller;
use App\Http\Requests\Individual;
use App\Imports\IndividualsImport;
use App\Individual as Model;
use App\Traits\HttpStatusResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class Individuals extends Controller
{
    use HttpStatusResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $individuals = Model::orderBy('created_at', "DESC")->get();
        return $individuals;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Individual $request)
    {
        $persone = CreateIndividual::insert($request);
        $response = [
            "msg" => 'Create New Individual.' ,
            "id"  => $persone->id
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
        $individual = Model::where('id', $id)->with(['father', 'mather', 'member'])->get();
        

       
        $response = [
            "msg" => 'get Individual' ,
            "individual"  => $individual
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
    public function update(Individual $request, $id)
    {
        // $persone = EditIndividual::update($request , $id);
        
        if(EditIndividual::update($request , $id)){
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
        echo 'delete single record.';
    }

    public function destroyAll(Request $request)
    {
        if($request->ids){
            

            // Get Family Ides
            $family_ids = DB::table("families")
                            ->where("father_id", $request->ids)
                            ->orWhere("mather_id", $request->ids)
                            ->get();
            if( count($family_ids) ){
                $ids = [];
                foreach($family_ids as $id){
                    array_push($ids, $id->id);
                    // Update to single 
                    // print_r($id);
                    CreateFamily::toBeSingle($id->father_id);
                    CreateFamily::toBeSingle($id->mather_id);
                }
                DB::table("families")
                ->where("id", $ids)
                ->delete();
                DB::table("family_members")
                    ->where("family_id", $ids)
                    ->delete();
            }
            // return 'Done';
            // Delete family's id and members's id
            Model::whereIn('id' , $request->ids)->delete();
            return $this->ok('Deleted successful');
        }else{
            return $this->unprocessableEntity("Input error!");
        }
        
    }
    
    public function unmarried($name, $gander = null){
        $individuals = array();
        $row_count = 45;
        // GET Count individuals Table 
        $total = DB::table('individuals')->count();
        $page = ceil($total / $row_count);
        //Loop for Chunck 
        for($i = 1; $i < ($page - 1); $i++){
            $offset = (($i - 1) * $row_count);
            $start = ($offset == 0 ? 0 : ($offset + 1));
            $individual = DB::table('individuals')
                            ->when($gander, function($query, &$gander){
                                return $query->where("gander", $gander);
                            })
                            ->where([
                                ["is_a_married", "=", 0],
                                [DB::raw("CONCAT(first_name,' ',middle_name,' ',last_name)"),"Like", $name."%"]
                            ])
                            ->skip($start)->take($row_count)->get();
            if(count($individual)){
                array_push($individuals, $individual);
            }
        }
        $response = [
            'msg' => "the people by $name",
            'individual' => $individuals
        ];
        return $this->created($response);
        
    }

    public function importExcel(Request $request){
        $import = new IndividualsImport();
        $import->import($request->file('individual'));
        $error = $import->getErrors();
        dd($error);
        Excel::import(new IndividualsImport, request()->file('individual'));
        return request()->file('individual');
    }

    public function individualCount()
    {
        $count = Model::count();
        return $count;
    }
}
