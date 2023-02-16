<script>
    $(function(){
        $('.select2').select2()
        // datatable 

        $("#employeeDataTable").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#employeeDataTable_wrapper .col-md-6:eq(0)');

        // STATUS CHANGE 
        $(".employeeStatus").on('change.bootstrapSwitch', function(e) {
            let status = $(this).prop('checked') == true ? 1 : 0;
            let employee_id = $(this).data('id');
            $.ajax({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                type: "POST",
                dataType: "json",
                url: '{{ route('status.change.employee') }}',
                data: {
                    'status': status,
                    'id': employee_id
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


         // Delete Employees
         $(".deleteEmployee").on('click', function(e) {
            e.preventDefault();
            let employee_id = $(this).data('id');

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
                        url: '{{ route('delete.employee') }}',
                        data: {
                            'id': employee_id
                        },
                        success: function(data) {

                            if (data.status == "success") {
                                var selector = ".flash-message .messageArea";
                                var message_status = "success";
                                var message_data =
                                    "Employee has been deleted successfully!";
                                alertMessage(selector, message_status,
                                    message_data);
                                $('.dataRow' + employee_id).hide();
                            }
                        }
                    });
                }
            });
        })
         // Delete Avl
         $(".deleteAvl").on('click', function(e) {
            e.preventDefault();
            let avl_id = $(this).data('id');

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
                        url: '{{ route('delete.availability') }}',
                        data: {
                            'id': avl_id
                        },
                        success: function(data) {

                            if (data.status == "success") {
                                var selector = ".flash-message .messageArea";
                                var message_status = "success";
                                var message_data =
                                    "Employee has been deleted successfully!";
                                alertMessage(selector, message_status,
                                    message_data);
                                $('.dataRow' + avl_id).hide();
                            }
                        }
                    });
                }
            });
        })
    });
</script>