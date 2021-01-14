<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
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
    public function store(Request $request)
    {



        $rules = array(
            'patient_id'    =>  'required|digits:16|exists:patients,patient_no',
            'status'    =>  'required|in:1,2,3,4,5',
            'clinic_id'    =>  'required|exists:clinics,id',
            'date' => ['required','date_format:Y-m-d','after:yesterday'],
            'start_time'    =>  'required|date_format:H:i',
            'end_time'    =>  'required|date_format:H:i|after:start_time',
            'comment'  => 'nullable:string:max:250',
            'cost'=>'required|numeric',

        );


        $error = Validator::make($request->all(), $rules,['patient_no.exist'=>'Patient-NO  NOT Exists please search again']);

        if($error->fails())
        {
            return response()->json(['status'=>false ,'errors' => $error->errors()->all(),'dat'=>$request->all()]);
        }
        $patient  = Patient::where('patient_no',$request->patient_id)->first();
        $order  = $patient->orders()->create($request->all());
        if($order)
        return response()->json(['status'=>true ,'errors' => $error->errors()->all(),'dat'=>$request->all()]);
        return response()->json(['status'=>false ,'errors' => ['errors occures please contact technical support'],'dat'=>$request->all(),'patient'=>$patient]);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}