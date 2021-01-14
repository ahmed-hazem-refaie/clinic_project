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

<script>
$('document').ready(function(){

  $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

  $('.patientorderform').submit(e=>e.preventDefault())

  $('.orderForm').hide();
  $('.patientform').hide();

  patientNo =  $('[name=patientNo]');
  patientgender = $('input[name=gender]')
  patientname = $('input[name=name]')
  patientmobile = $('input[name=mobile]')
  patientage = $('input[name=age]')

  orderstatus = $('input[name=orderstatus]')
  clinic =  $('select[name=clinic_id]')
  date  = $('input[name=date]')
  ordertimefrom  = $('input[name=start_time]')
  ordertimeto  = $('input[name=end_time]')
  ordercost = $('input[name=cost]')
  ordercomment = $('textarea[name=comment]')




  // $('input:radio[name="gender"]').filter('[value="female"]').attr('checked', true);


  $(document).on('click','.findpatient',function(){

findpatient(patientNo.val());

  })// end findpatient handle

  $('.addoredit').on('click',function(){

    addorupdatepatient();

  });


  $('.addordertopatient').on('click',function(){

    
    addordertopatient();


  });
  ////////////////////////////////////////////////////functions////////////////////////////////////////////////////

  function showmodalerror(errors) {

text = "";
errors.forEach(element => {
  text  =text+element ;
  text = text+"<br>"
});
$('#modalerrormsg').html(text);
$('#modalerror').modal('show')


}// show modal error

function showmodalsuccess(msgs) {

text = "";
msgs.forEach(element => {
  text  =text+element ;
  text = text+"<br>"
});
$('#modalsuccesmsg').html(text);
$('#modalsucces').modal('show')


}// show modal success

function findpatient(valpatientno) {

$.ajax({
        url: '/admin/findpatient',
        type: 'get',
        dataType: 'json',
        contentType: 'application/json',
        
        success: function (data) {
            console.log((data));
            if(data.status == false)
            {
              errors  =data.errors
              errors.push('<h3>YOU CAN ADD NEW OR SEARCH AGAIN</h3>');
              showmodalerror(errors);
              $('.patientform').show(1000)
              $('.addoredit').html('ADD PATIENT')
              document.querySelector('.patientorderform').reset()
            }

            if(data.status == true)
            {

              patientfound(data.data);
            }
        },
        error:function(e){
          alert('error occures plz call technical support')
          window.location.reload();
        },
        beforeSend:function(){
          document.querySelector('.patientorderform').reset()
          $('.orderForm').hide(1000)
          $('.patientform').hide(1000)


        },
        data:{patientNo:valpatientno}
    });

}//end find patient it is used to send ajax to find patien if found call patienfound func if not called show error msg and show  anf reset form patient and order patient form only with add buttom 


  function patientfound(patient) {
    patientNo.val(patient.patient_no)
    patientgender.filter(`[value=${patient.gender}]`).prop("checked", true);    patientname.val()
    patientmobile.val(patient.mobile)
    patientage.val(patient.age)
    patientname.val(patient.name)

    $('.addoredit').html('EDIT PATIENT')
    $('.orderForm').show(1000)
    $('.patientform').show(1000)
    
  }//end found patient it is used to  open 2 forms patient with data and order

  function addorupdatepatient(){

    url = "/admin/patient"
    if($('.addoredit').html()   ==  "EDIT PATIENT")
    url = '/admin/patient/updatepatient'

    formData = new FormData();
    formData.append('patient_no',patientNo.val())
    formData.append('gender',patientgender.filter(':checked').val())
    formData.append('name',patientname.val())
    formData.append('mobile',patientmobile.val())
    formData.append('age',patientage.val())

    $.ajax({
       url : url,
       type : 'post',
       data : formData,
       processData: false,  // tell jQuery not to process the data
       contentType: false,  // tell jQuery not to set contentType
       success : function(data) {
           console.log(data);
           if (data.status==false) {
            showmodalerror(data.errors)
           }

           if (data.status) {
             showmodalsuccess([$('.addoredit').html()+'Successfully'])
             patientfound(data.data)
           }

          }
});


  }//update patient if patient no exist if not create new one 


  function addordertopatient() {
    



    url = '/admin/order'
    formData = new FormData();
    formData.append('patient_id',patientNo.val())
    formData.append('status',orderstatus.filter(':checked').val())
    formData.append('clinic_id',clinic.val())
    formData.append('date',date.val())
    formData.append('from_time',ordertimeto.val())
    formData.append('start_time',ordertimefrom.val())
    formData.append('cost',ordercost.val())
    formData.append('end_time',ordertimeto.val())

    formData.append('comment',ordercomment.val())

    $.ajax({
       url : url,
       type : 'post',
       data : formData,
       processData: false,  // tell jQuery not to process the data
       contentType: false,  // tell jQuery not to set contentType
       success : function(data) {
           console.log(data);
           if (data.status==false) {
            showmodalerror(data.errors)
           }

           if (data.status) {
             showmodalsuccess([`Order For ${patientname.val()}  added Successfully`])
            //  patientfound(data.)
           }else{
             alert('error occured please contact technical tram')
           }

          }
});


  }//send ajax to save order to existing patient in database 

})


</script>
@endsection