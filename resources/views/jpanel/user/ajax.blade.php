<script>
    $(function(){
        // DATA TABLE
        $("#userDataTable").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#userDataTable_wrapper .col-md-6:eq(0)');
        $("#dataTable").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf"]
        }).buttons().container().appendTo('#roleDataTable_wrapper .col-md-6:eq(0)');
    
        //STATUS SWITCH ON CHANGE EVENT
        $(".userStatus").on('change.bootstrapSwitch', function(e){
            let status = $(this).prop('checked') == true ? 1 : 0; 
            let user_id = $(this).data('id');
            $.ajax({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                type: "POST",
                dataType: "json",
                url: '{{route("status.change.user")}}',
                data: {'status': status, 'user_id': user_id},
                success: function(data){
                  if(data.status=="success"){
                    var selector=".flash-message .messageArea";
                    var message_status="success";
                    var message_data="User status has been changed successfully!";
                    alertMessage(selector,message_status,message_data);
                  }
                }
            });
        })
        //DELETE USER
        $(".delete").on('click', function(e){
            e.preventDefault(); 
            let user_id = $(this).data('id');
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
                    url: '{{route("user.delete")}}',
                    data: {'user_id': user_id},
                    success: function(data){
                        if(data.status=="success"){
                            var selector=".flash-message .messageArea";
                            var message_status="success";
                            var message_data="User has been deleted successfully!";
                            alertMessage(selector,message_status,message_data);
                            $('.dataRow'+user_id).hide();
                        }
                    }
                });
            }
          });
        })
        //Role Permission SWITCH ON CHANGE EVENT
        $(".user_role").on('change.bootstrapSwitch', function(e){
            let status = $(this).prop('checked') == true ? 1 : 0; 
            let role_id = $(this).data('id');
            let user_id = $(this).data('user');
            $.ajax({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                type: "POST",
                dataType: "json",
                url: "{{route('user.role')}}",
                data: {'status': status, 'user_id': user_id, 'role_id': role_id},
                success: function(data){
                   
                  if(data.status=="success"){
                    var selector=".flash-message .messageArea";
                    var message_status="success";
                    var message_data="Role has been changed successfully!";
                    alertMessage(selector,message_status,message_data);
                  }
                }
                
            });
        })
        //DELETE Role
        $(".deleteRole").on('click', function(e){
            e.preventDefault(); 
            let role_id = $(this).data('id');
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
                    url: '{{route("role.delete")}}',
                    data: {'role_id': role_id},
                    success: function(data){
                        if(data.status=="success"){
                            var selector=".flash-message .messageArea";
                            var message_status="success";
                            var message_data="Role has been deleted successfully!";
                            alertMessage(selector,message_status,message_data);
                            $('.dataRow'+role_id).hide();
                        }
                    }
                });
            }
          });
        })
        //Role Module SWITCH ON CHANGE EVENT
        $(".role_module").on('change.bootstrapSwitch', function(e){
            let status = $(this).prop('checked') == true ? 1 : 0; 
            let module_id = $(this).data('id');
            let role_id = $(this).data('role');
            $.ajax({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                type: "POST",
                dataType: "json",
                url: "{{route('role.module')}}",
                data: {'status': status, 'module_id': module_id, 'role_id': role_id},
                success: function(data){
                  if(data.status=="success"){
                    var selector=".flash-message .messageArea";
                    var message_status="success";
                    var message_data="Module has been changed successfully!";
                    alertMessage(selector,message_status,message_data);
                  }
                }
            });
        })
        //User Permission SWITCH ON CHANGE EVENT
        $(".user_permission").on('change.bootstrapSwitch', function(e){
            let status = $(this).prop('checked') == true ? 1 : 0; 
            let module_id = $(this).data('id');
            let user_id = $(this).data('user');
            let action_id = $(this).data('action');
            $.ajax({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                type: "POST",
                dataType: "json",
                url: "{{route('user.permissionsUpdate')}}",
                data: {'status': status, 'module_id': module_id, 'user_id': user_id, 'action_id': action_id},
                success: function(data){
                if(data.status=="success"){
                    var selector=".flash-message .messageArea";
                    var message_status="success";
                    var message_data="Module has been changed successfully!";
                    alertMessage(selector,message_status,message_data);
                }
                }
            });
        })
        
        //DELETE Module
        $(".deleteModule").on('click', function(e){
            e.preventDefault(); 
            let module_id = $(this).data('id');
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
                    url: '{{route("module.delete")}}',
                    data: {'module_id': module_id},
                    success: function(data){
                        if(data.status=="success"){
                            var selector=".flash-message .messageArea";
                            var message_status="success";
                            var message_data="Module has been deleted successfully!";
                            alertMessage(selector,message_status,message_data);
                            $('.dataRow'+module_id).hide();
                        }
                    }
                });
            }
          });
        })


        //DELETE Language
        $(".deleteLanguage").on('click', function(e){
            e.preventDefault(); 
            let lang_id = $(this).data('id');
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
                    url: '{{route("language.delete")}}',
                    data: {'lang_id': lang_id},
                    success: function(data){
                        if(data.status=="success"){
                            var selector=".flash-message .messageArea";
                            var message_status="success";
                            var message_data="Language has been deleted successfully!";
                            alertMessage(selector,message_status,message_data);
                            $('.dataRow'+lang_id).hide();
                        }
                    }
                });
            }
          });
        })
    });
    </script>