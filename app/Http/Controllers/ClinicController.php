<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Clinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\SaveImage ;
class ClinicController extends Controller
{
    use SaveImage  ;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Clinic::latest()->get();
            return DataTables::of($data)

                    ->addColumn('action', function($data){
                        $button = '&nbsp;&nbsp;&nbsp;<button type="button" name="location" id="'.$data->id.'"  lat="'.$data->location_lat.'" lng="'.$data->location_lng.'"  class="location btn btn-info btn-sm">Location</button>';
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';

                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.clinic');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'name'    =>  'required|string|max:155',
            'image'=>'required|image',
            'active'=>'in:"true","false"',

        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all(),'dat'=>$request->all()]);
        }


        $form_data = array(
            'name'        =>  $request->name,
            'description'         =>  $request->desc,
            'location_lat'=> $request->location_lat,
            'location_lng'=>$request->location_lat

        );
        if($request->active == 'true')
        {
         $form_data['status']='active';
        }else{
            $form_data['status']='Not_active';
        }
        if ($files = $request->file('image'))
        {
            $img=$this->get_img_path($files);
            $form_data['image']= $img;

        }

        $clinic = Clinic::create($form_data);
        return response()->json(['success'=>true,'data'=>$clinic]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function show(Clinic $clinic)
    {
        // dd($clinic);
        $data = OrderResource::collection( $clinic->orders);
$data =  $data->toArray($clinic->orders);
        
        return view('admin.showclinic',['clinic'=>$clinic,'orders'=>$data]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function edit( $clinic)
    {
        if( $clinic = Clinic::find($clinic))
        return response()->json(['status'=>true,'data'=>$clinic]);
        return response()->json(['status'=>false,'errors'=>['employer not foun in your account please create one ']]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clinic $clinic)
    {
        
        $rules = array(
            'name'    =>  'required|string|max:155',
            'active'=>'in:"true","false"',

        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all(),'dat'=>$request->all()]);
        }


        $form_data = array(
            'name'        =>  $request->name,
            'description'         =>  $request->desc,
            'location_lat'=> $request->location_lat,
            'location_lng'=>$request->location_lat

        );
        if($request->active == 'true')
        {
         $form_data['status']='active';
        }else{
            $form_data['status']='Not_active';
        }
        if ($files = $request->file('image'))
        {
            $img=$this->get_img_path($files);
            $form_data['image']= $img;

        }

        $clinic = $clinic->update($form_data);
        return response()->json(['success'=>true,'data'=>$clinic]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {

        $data = Clinic::find($id)->delete();
        if(  $data )
        {
                     return response()->json(['status'=>true]);

        }else{
            return response()->json(['status'=>false]);

        }
    }
}
