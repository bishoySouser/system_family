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
            $family = [];
            Model::chunk(100, function ($rows) use (&$family, $id ) {
                foreach ($rows as $row) {
                    if($row->id == $id){
                        $family = $row;
                        return false;
                    }
                }
            });
        }
        $response = [
            "msg" => 'get Individual' ,
            "individual"  => $family
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
            DB::table('families')->whereIn('id' , $request->ids)->delete();
            return $this->ok('Deleted successful');
        }else{
            return $this->unprocessableEntity("Input error!");
        }
        
    }
}
