<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\Column;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $dataFetch = Column::with('ColumnCardData')->get();
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
    public function create1(Request $request)
    {
        try {
            $columnId = $request->column_id;
            $data_add = new Card();
            $data_add->title = $request->title;
            $data_add->description = $request->description;
            $data_add->column_id = $columnId;
            $data_add->save();

            return response()->json([
                'status'   => true,
                'mesage' => "Card is successfully added....!!",
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
        try {
            $data = Card::where('id',$id)->get();
            return response()->json([
                'status'   => true,
                'mesage' => "Card is successfully added....!!",
                'data' => $data[0],
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status'   => false,
                'message' => 'Opps something went to wrong'
            ]); 
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        try {
            $data = Card::find($id);
            if($request->title){
                $data->title = $request->title;    
            } else {
                $data->title = $data->title; 
            }
            
            if($request->description){
                $data->description = $request->description;    
            } else {
                $data->description = $data->description; 
            }

            $data->save();

            return response()->json([
                'status'   => true,
                'mesage' => "Card is successfully added....!!",
                'data' => $data,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status'   => false,
                'message' => 'Opps something went to wrong'
            ]); 
        }
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

    public function dbExport()
    {
        \Spatie\DbDumper\Databases\MySql::create()
            ->setDbName('TestTaskVue')
            ->setUserName('root')
            ->setPassword('')
            ->dumpToFile('dump.sql');
    }
}
