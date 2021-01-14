<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Order;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str; 



class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $rules = array(
                // 'patient_id'    =>  'digits:16|exists:patients,patient_no',
                // 'status'    =>  'required|in:1,2,3,4,5',
                'clinic_id'    =>  'nullable|exists:clinics,id',
                'datefrom' => ['nullable','date_format:Y-m-d'],
                'dateto' => ['nullable','date_format:Y-m-d'],

                // 'start_time'    =>  'required|date_format:H:i',
                // 'end_time'    =>  'required|date_format:H:i|after:start_time',
                // 'comment'  => 'nullable:string:max:250',
                // 'cost'=>'required|numeric',
    
            );
    
    
            $error = Validator::make($request->all(), $rules);
    

              
            $data = Order::latest();

            // dd('ssss',$error->errors()->all(),$request->all());

            if(!$error->fails())
            {
                if($request->clinic_id)
                $data->where('clinic_id',$request->clinic_id);

            }
   
            $data = $data->get();
      
            return DataTables::of($data)
                    ->addIndexColumn()
                    // ->filter(function ($instance) use ($request) {
                    //     // if (!empty($request->get('email'))) {
                    //     //     $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    //     //         return Str::contains($row['email'], $request->get('email')) ? true : false;
                    //     //     });
                    //     // }
   
                    //     // if (!empty($request->get('search'))) {
                    //     //     $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    //     //         if (Str::contains(Str::lower($row['email']), Str::lower($request->get('search')))){
                    //     //             return true;
                    //     //         }else if (Str::contains(Str::lower($row['name']), Str::lower($request->get('search')))) {
                    //     //             return true;
                    //     //         }
   
                    //     //         return false;
                    //     //     });
                    //     // }
   
                    // })
                    ->addColumn('action', function($row){
  
                           $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
  
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $data = Clinic::all()->pluck('name','id') ; 

    
        return view('admin.orders',['clinics'=>$data]);
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
