<script>
    $(function() {
        $("#bookingDataTable").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#bookingDataTable_wrapper .col-md-6:eq(0)');

        // Package Data
        $('#customer').change(function() {
            let id = $(this).val();
            $("#bookings").empty();
            $('#available').empty();
            var package = $("#package");
            package.empty();
            let url = '{{ route('package.data') }}';

            $.ajax({
                url: url,
                type: 'get',
                data: {
                    'id': id,
                },
                dataType: 'json',
                success: function(response) {
                    if (response != null) {
                        package.append('<option value="" selected disabled>select package</option>')

                        for (var i = 0; i < response.length; i++) {
                            package.append('<option value="' + response[i].id + '">' +
                                response[i].package_name + '</option>');
                        }
                    }
                }
            });
        });

        // Employee Data
        $('#package').change(function() {
            let id = $(this).val();
            let branch_id = $('#branch').val();
            $("#bookings").empty();
            $('#available').empty();
            var emp = $("#emp");
            emp.empty();

            $.ajax({
                url:'{{ route('employee.data') }}',
                type: 'get',
                data: {
                    'id': id,
                    'branch_id': branch_id
                },
                dataType: 'json',
                success: function(response) {
                    if (response != null) {
                        emp.append('<option value="" selected disabled>select Employee</option>')
                        for (var i = 0; i < response.listofEmpName.length; i++) {
                            emp.append('<option value="' + response.listofEmpId[i] + '">' +
                                response.listofEmpName[i] + '</option>');
                        }
                    }
                    $('#time').val(response.Service_time);
                   
                }
            });
        });

        $('#branch').change(function() {
            $('#package').empty();
            $('#emp').empty();
            var customer =$('#customer')
            $.ajax({
                url:'{{ route('customer.data') }}',
                type: 'get',
                data: {
                   
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response != null) {
                        console.log(response);
                        customer.append('<option value="" selected disabled>select Customer</option>')
                    } 
                }
            });
        });

        // SLOTS FUNCTION 
        $('#date').change(function() {
            var date = $(this).val();
            var dateEntered = new Date(date);
            var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            var dayName = days[dateEntered.getDay()];

            $('#day').val(dayName);
            let service_id = $('#service').val();
            let emp_id = $('#emp').val();
        });

                    // Booking List 
        // Payment CHANGE 
        $(".paymentStatus").on('change.bootstrapSwitch', function(e) {
            let status = $(this).prop('checked') == true ? 1 : 0;
            let booking_id = $(this).data('id');
            $.ajax({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                type: "POST",
                dataType: "json",
                url: '{{ route('status.change.payment') }}',
                data: {
                    'status': status,
                    'id': booking_id
                },
                success: function(data) {
                    if (data.status == "success") {
                        var selector = ".flash-message .messageArea";
                        var message_status = "success";
                        var message_data = "Payment status has been changed successfully!";
                        alertMessage(selector, message_status, message_data);
                    }
                }
            });
        })

        // Work CHANGE 
        $(".workStatus").on('change.bootstrapSwitch', function(e) {
            let status = $(this).prop('checked') == true ? 1 : 0;
            let booking_id = $(this).data('id');
            $.ajax({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                type: "POST",
                dataType: "json",
                url: '{{ route('status.change.work') }}',
                data: {
                    'status': status,
                    'id': booking_id
                },
                success: function(data) {
                    if (data.status == "success") {
                        var selector = ".flash-message .messageArea";
                        var message_status = "success";
                        var message_data = "Training status has been changed successfully!";
                        alertMessage(selector, message_status, message_data);
                    }
                }
            });
        });

         // Delete Booking
         $(".deleteBooking").on('click', function(e) {
            e.preventDefault();
            let booking_id = $(this).data('id');

            swal({
                title: `Are you sure you want to delete this record?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        headers: {
                            'X-CSRF-Token': '{{ csrf_token() }}',
                        },
                        type: "POST",
                        dataType: "json",
                        url: '{{ route('delete.booking') }}',
                        data: {
                            'id': booking_id
                        },
                        success: function(data) {

                            if (data.status == "success") {
                                var selector = ".flash-message .messageArea";
                                var message_status = "success";
                                var message_data =
                                    "Booking has been deleted successfully!";
                                alertMessage(selector, message_status,
                                    message_data);
                                $('.dataRow' + booking_id).hide();
                            }
                        }
                    });
                }
            });
        });

        
        // const sTime = document.getElementById("stime");
        // const eTime = document.getElementById("etime");
        // const interval = document.getElementById("time");

        // sTime.addEventListener("input", () => {
        // startTime = sTime.value ;
        // eTime.value = startTime ;

        //  let dt = new Date();
        //  dt = new Date(dt.getTime() + 30 * 60 * 1000)
        //  eTime.value = "Updated Time : " + dt.toLocaleTimeString();
        // })



    });
</script>
