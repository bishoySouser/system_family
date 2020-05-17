<?php
namespace App\Traits;

trait HttpStatusResponse {

    /**
     * @param $response
     * @return mixed \Illuminate\Http\Response
     */
    public function created(array $response)
    {
        return response()->json($response, 201);
    }

    /**
     * @param $errors
     * @return \Illuminate\Http\Response
     */
    public function unprocessableEntity($errors)
    {
        return response()->json(["errors" => $errors ], 422);
    }

    /**
     * @param $msg
     * @return \Illuminate\Http\Response
     */
    public function ok($msg)
    {
        return response()->json(['msg' => $msg], 200);
    }
}