    $(document).ready(function() {


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#user_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "/admin/clinic",
            },
            columns: [
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'image',
                    name: 'image',
                    render: function(data, type, full, meta) {
                        return "<img src=\"/" + data + "\" height=\"50\"/>";
                    },
                },

                {
                    data: 'status',
                    name: 'status',
                },
                {
                    data: 'location_lng',
                    name: 'location_lng',
                },
                {
                    data: 'location_lat',
                    name: 'location_lat',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                },

            ],
            pageLength: 5,
            lengthMenu: [
                [5, 10, 20, -1],
                [5, 10, 20, 'Todos']
            ]
        }); //table handle


        $('#create_record').click(function() {
            $('.modal-title-form').text('Add New Record');
            $('#action_button').val('Add');
            $('#action').val('Add');
            $('#form_result').html('');

            $('#formModal').modal('show');
        }); //open form modal

        function initMap(lat=-25.344,lng=-25.344) {
            // The location of Uluru
            var uluru = {lat:lat , lng: lng};
            // The map, centered at Uluru
            var map = new google.maps.Map(
                document.getElementById('mymap'), {zoom: 4, center: uluru});
            // The marker, positioned at Uluru
            var marker = new google.maps.Marker({position: uluru, map: map});
          };//handle map show

        $('#sample_form').on('submit', function(event) {
            event.preventDefault();
            var action_url = '';

            if ($('#action').val() == 'Add') {
                action_url = "/admin/clinic";
            }

            if ($('#action').val() == 'Edit') {
                id = $('#hidden_id').val();
                action_url = "/admin/clinic/update/" + id;
            } //
            var myform = new FormData();
            myform.append('_token', this.elements[0].value)
            myform.append('name', this.elements[1].value)
            // myform.append('l_name', this.elements[2].value)
            if (this.elements[2].files.length)
                myform.append('image', this.elements[2].files[0])
            myform.append('desc', this.elements[3].value)
            myform.append('active', this.elements[4].checked)
            myform.append('location_lat', this.elements[14].value)
            myform.append('location_lng', this.elements[15].value)




            $.ajax({
                url: action_url,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: myform, // Setting the data attribute of ajax with file_data
                type: 'POST',
                success: function(data) {
                    console.log(data);
                    
                    var html = '';

                    if (data.errors) {
                        console.log(data.dat);

                        html = '<div class="alert alert-danger">';
                        for (var count = 0; count < data.errors.length; count++) {
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                    }
                    if (data.success) {
                        console.log(data.data)
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $('#sample_form')[0].reset();
                        $('#user_table').DataTable().ajax.reload();
                    }
                    $('#form_result').html(html);
                }
            });




        }); //form data handle

        $(document).on('click', '.edit', function() {
            // console.log(this);
            var id = $(this).attr('id');

            $('#form_result').html('');
            $('.modal-title-form').text('Edit Record');
            $('#action_button').val('Edit');
            $('#action').val('Edit');
            $('#formModal').modal('show');
            $.ajax({
                url: "/admin/clinic/" + id + "/edit",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    if (data.status) {
                        $('#hidden_id').val(id)
                        $('#form_result').html('');
                        $('.modal-title-form').text('Edit Record');
                        $('#action_button').val('Edit');
                        $('#action').val('Edit');
                        $('#formModal').modal('show');
                        $('#lat').val(data.data.location_lat) ;
                        $('#lng').val(data.data.location_lng)  ;
                        var editform = document.getElementById('sample_form')
                        editform.elements[1].value = data.data.name;
                        editform.elements[3].value = data.data.description;



                        if (data.data.status == 'active') {
                            editform.elements[4].checked = true;

                        } else {
                            editform.elements[4].checked = false;
                        }


                    } else {
                        $('#form_result').html(data.errors[0]);
                        $('.modal-title-form').text('Edit Record');
                        $('#action_button').val('Add New ');
                        $('#action').val('Add');
                        $('#formModal').modal('show');
                    }


                }
            });

        }); //edit form handle

        var user_id = 0;

        $(document).on('click', '.delete', function() {
            user_id = $(this).attr('id');
            $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function() {
            console.log('rererere');

            $.ajax({
                url: "/admin/clinic/destroy/" + user_id,
                beforeSend: function() {
                    $('#ok_button').text('Deleting...');
                },
                success: function(data) {
                    console.log(data);
                    
                    setTimeout(function() {
                        $('#confirmModal').modal('hide');
                        $('#user_table').DataTable().ajax.reload();
                        alert('Data Deleted');
                    }, 2000);

                }
            });
        });
        //handle delete

        $(document).on('click', '.location', function() {
            $('#location').modal('show');
            lat =parseFloat( $(this).attr('lat'));
            lng = parseFloat( $(this).attr('lng'));
            if(lat)
            {
                initMap(lat,lng);

            }else
            {
                initMap();

            }

        });//handle map




        $('.paging_simple_numbers').css("text-align", 'left')
        $(".dataTables_empty").css({
            height:"400px!important"
        })


    }) //end scrript
