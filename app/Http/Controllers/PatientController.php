<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data  =Patient::all();
        dd($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Clinic::all()->pluck('name','id') ; 
        return view('admin.patient',['clinics'=>$data])   ;
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
            'patient_no'    =>  'required|digits:16|unique:patients,patient_no',
            'name'    =>  'required|string',
            'mobile' => ['required','regex:/(011|015|010|012)[0-9]{8}/'],
            'age'    =>  'required|numeric',
            'gender'    =>  'required|in:male,female',

        );


        $error = Validator::make($request->all(), $rules,['patient_no.unique'=>'Patient-NO  Exists please search again','mobile.*'=>'Mobile Field Must Be Egyptian Mobile Nymber']);

        if($error->fails())
        {
            return response()->json(['status'=>false ,'errors' => $error->errors()->all(),'dat'=>$request->all()]);
        }

        $patient =  Patient::create($request->all());
        if ($patient) {
            return response()->json(['status'=>true,'data'=>$patient]);
        }

            return response()->json(['status'=>false,'errors'=>['Error Occurred PLease Call technical support']]);




    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        //
    }

        /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function findpatient(Request $request)
    {
        $rules = array(
            'patientNo'    =>  'required|digits:16|exists:patients,patient_no',

        );

        $error = Validator::make($request->all(), $rules,['patientNo.exists'=>'Pation Not Exist ']);

        if($error->fails())
        {
            return response()->json(['status'=>false ,'errors' => $error->errors()->all(),'dat'=>$request->all()]);
        }
        $patient = Patient::where('patient_no',$request->patientNo)->first();
        if($patient)
         return response()->json(['status'=>true,'data'=>$patient]) ;
         return response()->json(['status'=>false ,'errors' => ['failed please call technical support'],'dat'=>$request->all()]);

        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $rules = array(
            'patient_no'    =>  'required|digits:16|exists:patients,patient_no',
            'name'    =>  'required|string',
            'mobile' => ['required','regex:/(011|015|010|012)[0-9]{8}/'],
            'age'    =>  'required|numeric',
            'gender'    =>  'required|in:male,female',

        );


        $error = Validator::make($request->all(), $rules,['patient_no.exist'=>'Patient-NO  NOT Exists please search again','mobile.*'=>'Mobile Field Must Be Egyptian Mobile Nymber']);

        if($error->fails())
        {
            return response()->json(['status'=>false ,'errors' => $error->errors()->all(),'dat'=>$request->all()]);
        }

        $patient = Patient::where('patient_no',$request->patient_no)->first();
        $patient->update($request->all());
        if ($patient) {
            return response()->json(['status'=>true,'data'=>$patient]);
        }

            return response()->json(['status'=>false,'errors'=>['Error occurred PLease Call technical support']]);




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        //
    }
}
