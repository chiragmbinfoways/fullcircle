<script>
    $(function(){
    $('.select2').select2()
    // datatable 

    $("#customerDataTable").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#customerDataTable_wrapper .col-md-6:eq(0)');

    // Delete customer
    $(".deleteCustomer").on('click', function(e) {
            e.preventDefault();
            let customer_id = $(this).data('id');

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
                        url: '{{ route('delete.customer') }}',
                        data: {
                            'id': customer_id
                        },
                        success: function(data) {

                            if (data.status == "success") {
                                var selector = ".flash-message .messageArea";
                                var message_status = "success";
                                var message_data =
                                    "Branch has been deleted successfully!";
                                alertMessage(selector, message_status,
                                    message_data);
                                $('.dataRow' + customer_id).hide();
                            }
                        }
                    });
                }
            });
        })
        // Customer Status 
        $(".customerStatus").on('change.bootstrapSwitch', function(e) {
            let status = $(this).prop('checked') == true ? 1 : 0;
            let customer_id = $(this).data('id');
            $.ajax({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                type: "POST",
                dataType: "json",
                url: '{{ route('status.change.customer') }}',
                data: {
                    'status': status,
                    'id': customer_id
                },
                success: function(data) {
                    if (data.status == "success") {
                        var selector = ".flash-message .messageArea";
                        var message_status = "success";
                        var message_data = "Employee status has been changed successfully!";
                        alertMessage(selector, message_status, message_data);
                    }
                }
            });
        })

         // Customer Package Status 
         $(".customerPackageStatus").on('change.bootstrapSwitch', function(e) {
            let status = $(this).prop('checked') == true ? 1 : 0;
            let customerPackage_id = $(this).data('id');
            $.ajax({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                type: "POST",
                dataType: "json",
                url: '{{ route('status.change.customerPackage') }}',
                data: {
                    'status': status,
                    'id': customerPackage_id
                },
                success: function(data) {
                    if (data.status == "success") {
                        var selector = ".flash-message .messageArea";
                        var message_status = "success";
                        var message_data = "Employee status has been changed successfully!";
                        alertMessage(selector, message_status, message_data);
                    }
                }
            });
        })
         // Customer Appointment Status 
         $(".visited").on('change.bootstrapSwitch', function(e) {
            let status = $(this).prop('checked') == true ? 1 : 0;
            let customerAppointment_id = $(this).data('id');
            $.ajax({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                type: "POST",
                dataType: "json",
                url: '{{ route('status.appointment.change') }}',
                data: {
                    'status': status,
                    'id': customerAppointment_id
                },
                success: function(data) {
                    if (data.status == "success") {
                        var selector = ".flash-message .messageArea";
                        var message_status = "success";
                        var message_data = "Employee status has been changed successfully!";
                        alertMessage(selector, message_status, message_data);
                    }
                }
            });
        })

         // packages Data
         $('#branch').change(function() {
             let id = $(this).val();
            var package = $("#package");
            package.empty();
            let url = '{{ route('branch.packages') }}';
            $.ajax({
                url: url,
                type: 'get',
                data: {
                    'id': id,
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response != null) {
                        package.append('<option value="" selected disabled>select package</option>')
                        for (var i = 0; i < response.length; i++) {
                            package.append('<option value="' + response[i].id + '">' +
                                response[i].name + '</option>');
                        }
                    }
                }
            });
        });
})
</script>
