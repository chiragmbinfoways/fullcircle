<script>
    $(function(){
    $('.select2').select2()
    // datatable 

    $("#branchDataTable").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#branchDataTable_wrapper .col-md-6:eq(0)');

    // Delete Employees
    $(".deleteBranch").on('click', function(e) {
            e.preventDefault();
            let branch_id = $(this).data('id');

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
                        url: '{{ route('delete.branch') }}',
                        data: {
                            'id': branch_id
                        },
                        success: function(data) {

                            if (data.status == "success") {
                                var selector = ".flash-message .messageArea";
                                var message_status = "success";
                                var message_data =
                                    "Branch has been deleted successfully!";
                                alertMessage(selector, message_status,
                                    message_data);
                                $('.dataRow' + branch_id).hide();
                            }
                        }
                    });
                }
            });
        })
})
</script>
