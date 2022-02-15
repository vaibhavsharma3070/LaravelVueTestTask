<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Column;

class ColumnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $dataFetch = Column::all();
            return response()->json([
                'status'   => true,
                'data' => $dataFetch,
            ]); 
        } catch (Exception $e) {
            return response()->json([
                'status'   => false,
                'message' => 'Opps something went to wrong'
            ]); 
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $columnId = $request->column_id;
            $data_add = new Column();
            $data_add->save();

            return response()->json([
                'status'   => true,
                'data' => $data_add,
            ]); 
        } catch (\Throwable $th) {
            return response()->json([
                'status'   => false,
                'message' => 'Opps something went to wrong'
            ]); 
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function destroy(Request $request, $id)
    {
        try {
            $id = $id;
            $softDeleteData = Column::find($id)->delete();
            // $softDeleteData->delete();
            return response()->json([
                'status'   => true,
                'data' => $id,
            ]); 
        } catch (Exception $e) {
            return response()->json([
                'status'   => false,
                'message' => 'Opps something went to wrong'
            ]); 
        }
    }
}
