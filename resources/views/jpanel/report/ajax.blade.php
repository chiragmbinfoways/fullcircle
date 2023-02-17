<script>
    $(function(){
    $('.select2').select2()
    // datatable 
       //Date range picker
       $('#date').daterangepicker();

    $("#branchDataTable").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#branchDataTable_wrapper .col-md-6:eq(0)');

    $("#trainerDataTable").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#trainerDataTable_wrapper .col-md-6:eq(0)');
    $("#customerDataTable").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#customerDataTable_wrapper .col-md-6:eq(0)');

    // BRANCH FILTER 
    $("#branchFilter").on('click', function() {
        let branch = $('#branch').val();
        let date = $('#date').val();
        let sDate = moment(date.substring(0, 10)).format('YYYY-MM-DD');
        let eDate = moment(date.substring(13, 23)).format('YYYY-MM-DD');
            $.ajax({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                type: "POST",
                dataType: "json",
                url: '{{ route('report.branchFilter') }}',
                data: {
                    'branch': branch,
                    'sDate': sDate,
                    'eDate': eDate,
                },
                success: function(data) {
                  $(".filterBranches").html('');
                  var table = $('#branchDataTable');
                  if (data != "") {
                      for (let i = 0; i < data.length; i++) {
                        var row = ' <tr class="dataRow'+data[i].id+' filterBranches"><td>'+(i+1)+'</td> <td>'+data[i].booking_date+'</td><td>'+data[i].branch+'</td> <td>'+data[i].customer_name+'</td> <td>'+data[i].emp_name+'</td> <td>'+data[i].package_name+' </td> <td>'+data[i].time+'</td>  </tr>';
                        table.append(row);
                      }
                  }
                  else{
                    table.append('<tr class="filterBranches"><td colspan="7"><center>No Bookings Available</center></td></tr>');
                  }
                }
            });
    })
})
// TRAINER FILTER 
$("#trainerFilter").on('click', function() {
    let trainer = $('#trainer').val();
    let date = $('#date').val();
    let sDate = moment(date.substring(0, 10)).format('YYYY-MM-DD');
    let eDate = moment(date.substring(13, 23)).format('YYYY-MM-DD');
        $.ajax({
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            },
            type: "POST",
            dataType: "json",
            url: '{{ route('report.trainerFilter') }}',
            data: {
                'trainer': trainer,
                'sDate': sDate,
                'eDate': eDate,
            },
            success: function(data) {
              $(".filterTrainer").html('');
              var table = $('#trainerDataTable');
              if (data != "") {
                  for (let i = 0; i < data.length; i++) {
                    var row = ' <tr class="dataRow'+data[i].id+' filterTrainer"><td>'+(i+1)+'</td><td>'+data[i].emp_name+'</td>  <td>'+data[i].booking_date+'</td><td>'+data[i].branch+'</td> <td>'+data[i].customer_name+'</td> <td>'+data[i].package_name+' </td> <td>'+data[i].time+'</td>  </tr>';
                    table.append(row);
                  }
              }
              else{
                table.append('<tr class="filterTrainer"><td colspan="7"><center>No Bookings Available</center></td></tr>');
              }
            }
        });
})
// Customer FILTER 
$("#customerFilter").on('click', function() {
    let customer = $('#customer').val();
    let date = $('#date').val();
    let sDate = moment(date.substring(0, 10)).format('YYYY-MM-DD');
    let eDate = moment(date.substring(13, 23)).format('YYYY-MM-DD');
        $.ajax({
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            },
            type: "POST",
            dataType: "json",
            url: '{{ route('report.customerFilter') }}',
            data: {
                'customer': customer,
                'sDate': sDate,
                'eDate': eDate,
            },
            success: function(data) {
                console.log(data);
              $(".filterCustomer").html('');
              var table = $('#customerDataTable');
              if (data != "") {
                  for (let i = 0; i < data.length; i++) {
                    var row = ' <tr class="dataRow'+data[i].id+' filterCustomer"><td>'+(i+1)+'</td> <td>'+data[i].customer_name+'</td> <td>'+data[i].booking_date+'</td><td>'+data[i].branch+'</td> <td>'+data[i].emp_name+'</td>  <td>'+data[i].package_name+' </td> <td>'+data[i].time+'</td>  </tr>';
                    table.append(row);
                  }
              }
              else{
                table.append('<tr class="filterCustomer"><td colspan="7"><center>No Bookings Available</center></td></tr>');
              }
            }
        });
})
</script>