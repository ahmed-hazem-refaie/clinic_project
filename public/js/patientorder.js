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
              return
             }
  
             if (data.status) {
               showmodalsuccess([`Order For ${patientname.val()}  added Successfully`])
               document.querySelector('.patientorderform').reset()
            $('.orderForm').hide(1000)
            $('.patientform').hide(1000)
              }else{
               alert('error occured please contact technical tram')
             }
  
            }
  });
  
  
    }//send ajax to save order to existing patient in database 
  
  })
  
  