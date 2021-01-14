@extends('admin.base')



@section('adminbase')
    

    <h1>Custom filter/Search with Laravel Datatables Example</h1>
   
    <div class="form-row ">
        <div class="  col-md-6">
            <label for="my-input">Date From</label>
            <input id="my-input" class="form-control updatesearch" type="date" name="datefrom">
        </div>

            <div class=" col-md-6">
                <label for="my-input">Date TO</label>
                <input id="my-input" class="form-control updatesearch" type="date" name="dateto">
            </div>
    
    </div>
 
      <div class="form-group">
        <label for="inputAddress">Clinic</label>
        <select id="inputState" name="clinic_id" class="form-control form-control-lg updatesearch">
          <option value="" selected>Choose...</option>
          @foreach ($clinics as $key=>$item)
        <option value="{{$key}}">  {{$item}}</option>
          @endforeach
        </select>  
    </div>
    <br>
   
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th width="100px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
  
</body>
  
<script type="text/javascript">
  $(function () {
   
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "/admin/order",
          data: {
              clinic_id:function() { return $('[name=clinic_id]').val()},
              datefrom:function() { return $('[name=datefrom]').val()},
              dateto: function() { return $('[name=dateto]').val()}
            }
        
        //   data: function (d) {
        //         d.email = $('.searchEmail').val(),
        //         d.search = $('input[type="search"]').val()
        //     }
        },
        columns: [
            {data: 'patient_id', name: 'DT_RowIndex'},
            {data: 'clinic_id', name: 'name'},
            {data: 'comment', name: 'email'},
            {data: 'created_at', name: 'action', orderable: false, searchable: false},
        ]
    });
   
    $(".updatesearch").on('change',function(){
            // console.log(table.ajax.reload());
            var table = $('.data-table').DataTable().ajax.reload();

        // table.draw();
    });
  
  });
</script>
@endsection