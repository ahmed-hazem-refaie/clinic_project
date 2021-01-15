@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

<center> Clinic INFO</center>
<center>
<div class="row text-center">
<h2>{{$clinic->name}}  Clinic</h2>
<img style="width: 60%;border-radius: 10%;" src="{{asset($clinic->image)}}" alt="">



</div>

<div class="row text-center">
<h2>Show All PAtients That Visit THis Clinic</h2>


<table class="table table-light">
    <thead>
        <tr>

            <th>
                No
            </th>

            <th>
                Patient name
            </th>
            <th>
                Patient Code
            </th>
            <th>
                Patient age
            </th>
            <th>
                Patient Mobile
            </th>
        </tr>
    </thead>
    <tbody>
        @forelse ($clinic->patients as $item)
            
        <tr>

        <td>{{$loop->index+1}}</td>
        <td>{{$item->name}}</td>
        <td>{{$item->patient_no}}</td>
        <td>{{$item->age}}</td>

        <td>{{$item->mobile}}</td>

        </tr>
        @empty
            
        <tr>
            <td></td>
        </tr>
        @endforelse
    </tbody>
</table>
</div>




<br>
<br>
<div class="row text-center">
    <h2>Show All Orders That Attatched To This  Clinic </h2>
    
    
    <table class="table table-light">
        <thead>
            <tr>

      
    
                <th>
                    No
                </th>
    
                <th>
                    Order Patient Name
                </th>
                <th>
                    Order Patient Code
                </th>
                <th>
                    Order Date
                </th>
                <th>
                    Order Clinic
                </th>


                <th>
                    Order Time From
                </th>
                <th>
                    Order Time To
                </th>
                <th>
                    Order Status
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $item)
                
            <tr>
    
            <td>{{$loop->index+1}}</td>
            <td>{{$item['date']}}</td>
            <td>{{$item['patient_name']}}</td>
            <td>{{$item['patient_no']}}</td>
    
            <td>{{$item['clinic']}}</td>
            <td>{{$item['start_time']}}</td>
            <td>{{$item['end_time']}}</td>
            <td>{{$item['status']}}</td>
    



 
            </tr>
            @empty
                
            <tr>
                <td></td>
            </tr>
            @endforelse
        </tbody>
    </table>
    </div>






</center>

    </div>
</div>
@endsection
