<script>
    // service Data Table 
       $(function() {
        $("#serviceDataTable").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#serviceDataTable_wrapper .col-md-6:eq(0)');


        // STATUS CHANGE 
        $(".serviceStatus").on('change.bootstrapSwitch', function(e) {
            let status = $(this).prop('checked') == true ? 1 : 0;
            let service_id = $(this).data('id');
            $.ajax({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                type: "POST",
                dataType: "json",
                url: '{{ route("status.change.services") }}',
                data: {
                    'status': status,
                    'id': service_id
                },
                success: function(data) {
                    if (data.status == "success") {
                        var selector = ".flash-message .messageArea";
                        var message_status = "success";
                        var message_data = "service status has been changed successfully!";
                        alertMessage(selector, message_status, message_data);
                    }
                }
            });
        })

        // Delete Services
        $(".deleteService").on('click', function(e) {
            e.preventDefault();
            let service_id = $(this).data('id');

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
                        url: '{{ route("delete.services") }}',
                        data: {
                            'id': service_id
                        },
                        success: function(data) {

                            if (data.status == "success") {
                                var selector = ".flash-message .messageArea";
                                var message_status = "success";
                                var message_data =
                                    "Service has been deleted successfully!";
                                alertMessage(selector, message_status,
                                    message_data);
                                $('.dataRow' + service_id).hide();
                            }
                        }
                    });
                }
            });
        })

       });
</script>