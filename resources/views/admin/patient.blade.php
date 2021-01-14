@extends('admin.base')


@section('adminbase')

<style>
  .patient_server{
    color: white
  }
</style>
<form class="patientorderform" method="POST" action="{{route('patient.store')}}" >
@csrf
    
    <div class="form-row col-md-12">
        <div class="form-group col-md-6">
            <label for="exampleInputEmail1">Patient NO.</label>
            <input  name="patientNo" type="number" class="form-control form-control-lg" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted"> <span class="patient_server"></span> </small>
          </div>

          <div class="form-group col-md-6">
              <i  class="fa fa-search fa-3x findpatient" aria-hidden="true"></i>

          </div>

    </div>
<div class="patientform">
    <div class="form-row">
        <div class="form-group col-md-4">
          <label for="inputCity">Name</label>
          <input type="text" name="name" class="form-control" id="inputCity">
        </div>
        <div class="form-group col-md-4">
          <label for="inputCity">Age</label>
          <input type="number" name="age" class="form-control" id="inputCity">
        </div>
        <div class="form-group col-md-4">
          <label for="inputState">Mobile</label>
          <input type="text" name="mobile" class="form-control" id="inputCity">

        </div>
        <div class="form-group col-md-12">
          <label for="inputZip">Gender</label>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline1" name="gender" value="male" class="custom-control-input">
            <label class="custom-control-label" for="customRadioInline1">Male</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline2" name="gender" value="female" class="custom-control-input">
            <label class="custom-control-label" for="customRadioInline2">Female</label>
          </div>
                </div>
                
      </div>

      <div class="form-row">
        <div>
          <a class="btn btn-info addoredit">  </a>
        </div>
      </div>

    </div>
      <hr>
<div class="orderForm">

    <div class="form-row">
        <div class="form-group ">
            <label for="exampleInputEmail1">Order Status</label>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="orderstatus" id="status1" value="1">
                <label class="form-check-label" name="status" for="status1">Confirmed</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="orderstatus" id="status2" value="2">
                <label class="form-check-label" name="status" for="status2">To confirm</label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="orderstatus" id="status3" value="3">
                <label class="form-check-label" name="status" for="status3">Closed Patient Treated</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="orderstatus" id="status4" value="4">
                <label class="form-check-label"name="status"  for="status4">Closed  - Visit Skipped</label>
              </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="orderstatus" id="status5" value="5">
                <label class="form-check-label" name="status"  for="status5">Canceled</label>
              </div>


        </div>

    </div>
    <div class="form-group">
      <label for="inputAddress">Clinic</label>
      <select id="inputState" name="clinic_id" class="form-control form-control-lg">
        <option selected>Choose...</option>
        @foreach ($clinics as $key=>$item)
      <option value="{{$key}}">  {{$item}}</option>
        @endforeach
      </select>  
      </div>


      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="date">Date</label>
          <input type="date" name="date" class="form-control" id="date">
        </div>
        <div class="form-group col-md-4">
          <label for="timefrom">From</label>
          <input type="time" name="start_time" class="form-control" id="timefrom">

        </div>
        <div class="form-group col-md-4">
          <label for="timeto">To</label>
          <input type="time" name="end_time" class="form-control" id="timeto">


                </div>
                
      </div>

      <div class="form-row col-md-12">
        <div class="form-group col-md-4">
          <label for="inputCity">Cost <i class="fa fa-money-bill-wave" aria-hidden="true"></i> </label>
          <input type="number"  name="cost" class="form-control" id="">
        </div>

                
      </div>

      <div class="form-row col-md-12">
        <div class="form-group col-md-4">
          <label for="inputCity">Comment <i class="fa fa-file-alt" aria-hidden="true"></i> </label>
          <textarea  name="comment" rows="8" class="form-control" id="inputCity"></textarea>
        </div>

                
      </div>
      <button type="button" class="btn btn-info btn-lg btn-block addordertopatient">ADD ORDER TO PATIENT</button>

</div>
    <div class="form-group">

    </div>
    <button type="submit" onclick="document.querySelector('.patientorderform').reset()" class="btn btn-primary">Reset</button>
  </form>
    
@endsection


@section('scripts')

<script src="{{asset('js/patientorder.js')}}"></script>
@endsection