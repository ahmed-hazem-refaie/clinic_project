@extends('admin.base')

@push('locationpicker')
<script type="text/javascript"
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDItHS2YEL3vKXVoB2OcPEzGy5flMJ7N0A"></script>
<script src="https://unpkg.com/location-picker/dist/location-picker.min.js"></script>
<script>

$(function() {


//

 // Get element references
 var confirmBtn = document.getElementById('confirmPosition');
  var lat = document.getElementById('lat');

  var lng = document.getElementById('lng');
  var onIdlePositionView = document.getElementById('onIdlePositionView');

  // Initialize locationPicker plugin
  var lp = new locationPicker('map', {
    setCurrentPosition: true, // You can omit this, defaults to true
  }, {
    zoom: 15 // You can set any google map options here, zoom defaults to 15
  }
  );


  // Listen to button onclick event
  confirmBtn.onclick = function () {
    // Get current location and show it in HTML
    var location = lp.getMarkerPosition();
    lat.value = location.lat ;
    lng.value = location.lng ;

};

  // Listen to map idle event, listening to idle event more accurate than listening to ondrag event
  google.maps.event.addListener(lp.map, 'idle', function (event) {
    // Get current location and show it in HTML
    var location = lp.getMarkerPosition();
    onIdlePositionView.innerHTML = 'The chosen location is ' + location.lat + ',' + location.lng;
  });

//

});

</script>
<style>
        #map {
      width: 100%;
      height: 180px;
      padding-right: 68px;
    }
</style>
@endpush

@section('adminbase')




<br />

<br />
<div class="" style="overflow: auto">
    <table id="user_table" class="table table-dark" style="width: 100%">
        <thead>
            <tr>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">image</th>
                <th scope="col">status</th>
                <th scope="col">location_lat</th>
                <th scope="col">location_lng</th>

                <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title modal-title-form">Add New Record</h4>
            </div>
            <div class="modal-body">
                <span id="form_result"></span>
                <form method="post" id="sample_form" class="form-horizontal">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-4">Clinic Name : </label>
                        <div class="col-md-8">
                            <input type="text" name="first_name" id="first_name" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4">Image : </label>
                        <div class="col-md-8">
                            <input type="file" name="image" id="image" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4">Clinic Desc : </label>
                        <div class="col-md-8">
                            <input type="text" name="desc" id="desc" class="form-control" />
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-4">Active : </label>
                        <div class="col-md-8">
                            <!-- Material unchecked -->
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="materialUnchecked">
                            </div>
                        </div>
                    </div>

                    <br />

                    <div class="col-sm-offset-2 col-sm-10 "style="    text-align: center;
                    ">
                               <div id="map"></div>


                      <a class="btn btn-default btn btn-outline-secondary" id="confirmPosition">Confirm Position</a>
                      <br>

                      <p style='display:inline-block'>current: <span id="onIdlePositionView"></span></p>
                      &ensp;&ensp;&ensp;

                    </div>

                    <div class="form-group" align="center">
                        <input type="hidden" name="action" id="action" value="Add" />
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <input type="hidden" name="location_lat" id="lat" />
                        <input type="hidden" name="location_lng" id="lng" />

                        <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Confirmation</h2>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div id="location" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Location On Map</h2>
            </div>
            <div class="modal-body">

<div id="mymap"></div>
<style>
    #mymap {
      width: 100%;
      height: 400px;
      background-color: grey;
    }
   </style>


                {{-- , --}}
            </div>

        </div>
    </div>
</div>

<script src="/js/employee/datatablehandle.js"></script>



@endsection
