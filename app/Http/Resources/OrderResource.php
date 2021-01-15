<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'patient_name'=> $this->patient->name,
            'patient_no' => $this->patient->patient_no,
            'date'=>$this->date,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'clinic' => $this->clinic->name,
            'status'=> $this->knowstatus( $this->status)
        ];
    }

    public function knowstatus($status=null)
    {

        if(!$status)
        return "UNKNOWN STATUS";
        if($status == '1')
        $status = "Confirmed";

        if($status == '2')
        $status = "To confirm";

        if($status == '3')
        $status = "Closed Patient Treated";

        if($status == '4')
        $status = "Closed  - Visit Skipped";

        if($status == '5')
        $status = "Canceled";

        return $status;
    }
}



