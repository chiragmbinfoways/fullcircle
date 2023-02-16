<script>
   
    // AJAX FOR PACKAGES 
    $('#customer').change(function() {
        let id = $(this).val();
        var package = $("#package");
        package.empty();
        let url = '{{ route('dashboard.package.data') }}';

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

    // AJAX FOR EMPLOYEES
    $('#package').change(function() {
        let id = $(this).val();
        let branch_id = $('#branch').val();
        var emp = $("#emp");
        emp.empty();
        $.ajax({
            url: '{{ route('dashboard.employee.data') }}',
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

    //Ajax for branch while changing the branch 
    $('#branch').change(function() {
            $('#package').empty();
            $('#emp').empty();
            $('#customer').empty();
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
                        for (var i = 0; i < response.length; i++) {
                            customer.append('<option value="' + response[i].id + '">' +
                            response[i].fname+" "+response[i].lname + '</option>');
                    }
                    } 
                }
            });
        });


        $('#emp').change(function() {
            $("#bookings").empty();
            $('#available').empty();


        });

    // CALENDER CRUD
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
        customButtons: {
         appointment: {
         text: 'Add Appointment!',
            click: function() {
                location.replace("{{route('create.booking')}}")
                }
            }
            },
            droppable: true,
            navLinks: true,
            nowIndicator:true,
            editable: true,
            selectable: true,
            height: 600,
            weekends: false,
            schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
            initialView: 'resourceTimeGridDay',
            headerToolbar: {
                left: 'title',
                center: 'prev,today,next',
                right: 'resourceTimeGridWeek,resourceTimeGridDay,agendaThreeDay,appointment',
            },
            views: {
                agendaThreeDay: {
                    type: 'timeGrid',
                    duration: { days: 3 },
                    buttonText: '3 days'
                    }
            },
            businessHours: {
            daysOfWeek: [ 1, 2, 3, 4,5 ], 
            startTime: '10:00', 
            endTime: '18:00', 
            },

            resources: [
                @foreach ($bookings as $booking)
                { id: '{{$booking->employee_id}}', title: '{{$booking->employee->fname}} {{$booking->employee->lname}}' },
                @endforeach
            ],
            events: [
                @foreach ($bookings as $booking)
                    {
                        id: '{{ $booking->id }}',
                        title: '{{ $booking->customer->fname }} {{ $booking->customer->lname }}',
                        allDay: false,
                        start: '{{ $booking->booking_date }}T{{ $booking->stime }}',
                        end: '{{ $booking->booking_date }}T{{ $booking->etime }}',
                        backgroundColor: '#00a65a', //Success (green)
                        borderColor: '#00a65a', //Success (green)
                        textColor: 'white',
                        description: '{{ $booking->package->packages->name }}',
                        resourceId: '{{$booking->employee_id}}',
                    },
                @endforeach
            ],

            slotDuration: '00:15:00',
            themeSystem: 'bootstrap5',
            select: function(start, end, allDays) {
                var type = start.view.type;
                $('#bookingModal').modal('show');
                $('#bookAppointment').click(function() {
                    var date = start.startStr;
                    var newDate = new Date(date);
                    var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday','Friday', 'Saturday'];
                    var dayName = days[newDate.getDay()];
                    var stime = new Date(start.startStr).toLocaleTimeString('it-IT');
                    var bookingDate = moment(start.startStr).format('YYYY-MM-DD');
                    var customer = $('#customer').val();
                    var package = $('#package').val();
                    var emp = $('#emp').val();
                    var branch = $('#branch').val();
                    console.log(bookingDate,customer,package,emp,branch,stime);  
                    $.ajax({
                        headers: {
                            'X-CSRF-Token': '{{ csrf_token() }}',
                        },
                        url: "{{ route('store.booking.dashboard') }}",
                        type: "POST",
                        dataType: 'json',
                        data: {
                            'customer': customer,
                            'emp': emp,
                            'package': package,
                            'dayName': dayName,
                            'stime': stime,
                            'bookingDate': bookingDate,
                            'branch': branch,

                        },
                        success: function(response) {
                            window.location.reload()
                        },
                        error: function(error) {
                            if (error.responseJSON.errors) {
                                $('#customerError').html(error.responseJSON
                                    .errors
                                    .customer);
                                $('#packageError').html(error.responseJSON
                                    .errors
                                    .package);
                                $('#empError').html(error.responseJSON.errors
                                    .emp);
                                $('#branchError').html(error.responseJSON.errors
                                    .branch);
                            }
                        }
                    });
                })
            },
            eventDrop: function(info,event) {
                var id = info.event.id;
                var date= moment(info.event.start).format('YYYY-MM-DD');
                var startTime= moment(info.event.start).format('HH:mm');
                var endTime= moment(info.event.end).format('HH:mm');
                var type = info.view.type;
                if (type == "resourceTimeGridDay" || type == "resourceTimeGridWeek") {
                    // Employee id for appointment change between the employee 
                    if (info.newResource != null) {
                        var resource_id = info.newResource._resource.id;
                    } 
                    else{
                        var resource_id = null;
                    }
                }
                else{
                    var resource_id = null;
                }
                $.ajax({
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    url: "{{ route('dragupdate.booking.dashboard') }}",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        'id': id,
                        'date': date,
                        'startTime': startTime,
                        'endTime': endTime,
                        'employee_id': resource_id,
                    },
                    success: function(data) {
                        swal("Good job!", "Appointment Details Updated!", "success");
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            },
            eventClick: function(info){
                var _details = $('#DetailsModel')
                var id = info.event.id
                var url="{{route('edit.booking.dashboard','id')}}";
                    url=url.replace('id',id);  
                    _details.find('#title').text(info.event.title)
                    _details.find('#packageName').text(info.event.extendedProps.description)
                    _details.find('#start').text(new Date(info.event.start).toLocaleTimeString())
                    _details.find('#end').text(new Date(info.event.end).toLocaleTimeString())
                    _details.find('#delete').attr('data-id', id)
                    _details.find('#edit').attr('href', url)
                    _details.modal('show')
                
             }
        });

        calendar.render();

    });

    // FUNCTION FOR CLEAR OLD DATA IN MODAL 
    $("#bookingModal").on("hidden.bs.modal",function(){
        $('#bookAppointment').unbind();
    });
    $('.fc').css('background-color','black');

    // DELETE FUNCTION FOR BOOKING
    $("#delete").on('click', function(e) {
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
                        url: '{{ route('delete.booking.dashboard') }}',
                        data: {
                            'id': booking_id
                        },
                        success: function(data) {
                            window.location.reload();
                        }
                    });
                }
            });
    });
    
</script>
