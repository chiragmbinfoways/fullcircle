<script>
    $(function(){
    $('.select2').select2()
    // datatable 

    $("#packageDataTable").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#packageDataTable_wrapper .col-md-6:eq(0)');

    // Delete Employees
    $(".deletePackage").on('click', function(e) {
            e.preventDefault();
            let package_id = $(this).data('id');

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
                        url: '{{ route('delete.package') }}',
                        data: {
                            'id': package_id
                        },
                        success: function(data) {

                            if (data.status == "success") {
                                var selector = ".flash-message .messageArea";
                                var message_status = "success";
                                var message_data =
                                    "package has been deleted successfully!";
                                alertMessage(selector, message_status,
                                    message_data);
                                $('.dataRow' + package_id).hide();
                            }
                        }
                    });
                }
            });
        })
})
</script>