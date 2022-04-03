@extends('partials.main')
    @section('content')

        <!-- Page Wrapper -->
        <div class="page-wrapper">
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Attendance</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Attendance</li>
                            </ul>
                        </div>
                        <br>
                        <div>
                            <h5 class="page-title">
                                APPROVE WORK FOR {{$entity->FirstName}} FOR {{ date_format(date_create($dateStart),"F j, Y h:i A") }} TO {{ date_format(date_create($dateEnd),"F j, Y h:i A") }}
                            </h5>
                        </div>

                        <div class="col-auto float-right ml-auto">
                            {{-- <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_todaywork"><i class="fa fa-plus"></i> Add Today Work</a> --}}
                            {{-- <a href="#" class="btn btn-success btn-block"> Approve </a> --}}
                            <button type="button" class="btn btn-success approve_timesheet" data-id="{{$entity->GenEntityID}}"> Approve </button>

                        </div>
                    </div>
                </div>

                {{-- <button type="button" class="btn btn-success approve" data-id="{{$timesheet->id}}"> Approve </button> --}}

                <!-- /Page Header -->
                
                <!-- Search Filter -->
                {{-- <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">  
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating">
                            <label class="focus-label">Employee Name</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3"> 
                        <div class="form-group form-focus select-focus">
                            <select class="select floating"> 
                                <option>-</option>
                                <option>Jan</option>
                                <option>Feb</option>
                                <option>Mar</option>
                                <option>Apr</option>
                                <option>May</option>
                                <option>Jun</option>
                                <option>Jul</option>
                                <option>Aug</option>
                                <option>Sep</option>
                                <option>Oct</option>
                                <option>Nov</option>
                                <option>Dec</option>
                            </select>
                            <label class="focus-label">Select Month</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3"> 
                        <div class="form-group form-focus select-focus">
                            <select class="select floating"> 
                                <option>-</option>
                                <option>2019</option>
                                <option>2018</option>
                                <option>2017</option>
                                <option>2016</option>
                                <option>2015</option>
                            </select>
                            <label class="focus-label">Select Year</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">  
                        <a href="#" class="btn btn-success btn-block"> Search </a>  
                    </div>     
                </div> --}}
                <!-- /Search Filter       'dateStart', 'dateEnd' -->



                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table table-nowrap mb-0">
                                <thead>
                                    <tr style="background: lightyellow">
                                       
                                        {{-- {{dd(array_combine($getUserTimesheet->toArray(), $allDateHeader->toArray()))}} --}}
                                        {{-- <th> - </th> --}}

                                        @foreach (array_unique($allDateHeader->toArray()) as $item)

                                        <th> {{date('d', strtotime($item)) }} </th>

                                        @endforeach

                                        {{-- @foreach (array_unique($allDateHeader->toArray()) as $item) --}}

                                        {{-- @foreach ($timesheetHeader as $item)

                                        <th> {{date('d', strtotime($item->created_at)) }} </th>

                                        @endforeach --}}

                                        {{-- <th> Total   date('Y-m-d',strtotime($date1)) </th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        {{-- @foreach($getUserTimesheet as $key => $value) --}}
                                        @foreach($itemToShow as $timesheet)
                                            @if($timesheet == '-')
                                                <td> - </td>
                                            @else
                                                <td> {{$timesheet->time_worked}} </td>
                                            @endif
                                        {{-- {{dd(date('Y-m-d',strtotime($value->created_at)))}} --}}
                                        @endforeach
                                        {{-- {{dd($getUserTimesheet['created_at']->toArray())}} --}}
                                        {{-- @php

                                            for($i =0; $i < count($dateHeader); $i++)
                                            {
                                                $itemIndex = array_search($dateHeader[$i], $getUserTimesheet['created_at']->toArray());

                                                if(!is_numeric($itemIndex)) $itemToShow[] = '-';

                                                else{
                                                    $itemToShow[] = $getUserTimesheet[$itemIndex];
                                                }
                                            }
                                            dd($itemToShow);

                                        @endphp --}}

                                    </tr>

                                    

                                    {{-- <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a class="avatar avatar-xs" href="profile.html"><img alt="" src="assets/img/profiles/avatar-09.jpg"></a>
                                                <a href="profile.html">John Doe</a>
                                            </h2>
                                        </td>
                                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i class="fa fa-check text-success"></i></a></td>
                                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i class="fa fa-check text-success"></i></a></td>
                                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i class="fa fa-check text-success"></i></a></td>
                                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i class="fa fa-check text-success"></i></a></td>
                                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i class="fa fa-check text-success"></i></a></td>
                                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i class="fa fa-check text-success"></i></a></td>
                                        <td>
                                            <div class="half-day">
                                                <span class="first-off"><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i class="fa fa-check text-success"></i></a></span> 
                                                <span class="first-off"><i class="fa fa-close text-danger"></i></span>
                                            </div>
                                        </td>
                                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i class="fa fa-check text-success"></i></a></td>
                                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i class="fa fa-check text-success"></i></a></td>
                                        <td><i class="fa fa-close text-danger"></i> </td>
                                        <td><i class="fa fa-close text-danger"></i> </td>
                                        <td><i class="fa fa-close text-danger"></i> </td>
                                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i class="fa fa-check text-success"></i></a></td>
                                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i class="fa fa-check text-success"></i></a></td>
                                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i class="fa fa-check text-success"></i></a></td>
                                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i class="fa fa-check text-success"></i></a></td>
                                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i class="fa fa-check text-success"></i></a></td>
                                        <td><i class="fa fa-close text-danger"></i> </td>
                                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i class="fa fa-check text-success"></i></a></td>
                                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i class="fa fa-check text-success"></i></a></td>
                                        <td>
                                            <div class="half-day">
                                                <span class="first-off"><i class="fa fa-close text-danger"></i></span> 
                                                <span class="first-off"><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i class="fa fa-check text-success"></i></a></span>
                                            </div>
                                        </td>
                                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i class="fa fa-check text-success"></i></a></td>
                                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i class="fa fa-check text-success"></i></a></td>
                                        <td><i class="fa fa-close text-danger"></i> </td>
                                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i class="fa fa-check text-success"></i></a></td>
                                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i class="fa fa-check text-success"></i></a></td>
                                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i class="fa fa-check text-success"></i></a></td>
                                        <td><i class="fa fa-close text-danger"></i> </td>
                                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i class="fa fa-check text-success"></i></a></td>
                                        <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i class="fa fa-check text-success"></i></a></td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->
            
            <!-- Attendance Modal -->
            <div class="modal custom-modal fade" id="attendance_info" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Attendance Info</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card punch-status">
                                        <div class="card-body">
                                            <h5 class="card-title">Timesheet <small class="text-muted">11 Mar 2019</small></h5>
                                            <div class="punch-det">
                                                <h6>Punch In at</h6>
                                                <p>Wed, 11th Mar 2019 10.00 AM</p>
                                            </div>
                                            <div class="punch-info">
                                                <div class="punch-hours">
                                                    <span>3.45 hrs</span>
                                                </div>
                                            </div>
                                            <div class="punch-det">
                                                <h6>Punch Out at</h6>
                                                <p>Wed, 20th Feb 2019 9.00 PM</p>
                                            </div>
                                            <div class="statistics">
                                                <div class="row">
                                                    <div class="col-md-6 col-6 text-center">
                                                        <div class="stats-box">
                                                            <p>Break</p>
                                                            <h6>1.21 hrs</h6>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6 text-center">
                                                        <div class="stats-box">
                                                            <p>Overtime</p>
                                                            <h6>3 hrs</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card recent-activity">
                                        <div class="card-body">
                                            <h5 class="card-title">Activity</h5>
                                            <ul class="res-activity-list">
                                                <li>
                                                    <p class="mb-0">Punch In at</p>
                                                    <p class="res-activity-time">
                                                        <i class="fa fa-clock-o"></i>
                                                        10.00 AM.
                                                    </p>
                                                </li>
                                                <li>
                                                    <p class="mb-0">Punch Out at</p>
                                                    <p class="res-activity-time">
                                                        <i class="fa fa-clock-o"></i>
                                                        11.00 AM.
                                                    </p>
                                                </li>
                                                <li>
                                                    <p class="mb-0">Punch In at</p>
                                                    <p class="res-activity-time">
                                                        <i class="fa fa-clock-o"></i>
                                                        11.15 AM.
                                                    </p>
                                                </li>
                                                <li>
                                                    <p class="mb-0">Punch Out at</p>
                                                    <p class="res-activity-time">
                                                        <i class="fa fa-clock-o"></i>
                                                        1.30 PM.
                                                    </p>
                                                </li>
                                                <li>
                                                    <p class="mb-0">Punch In at</p>
                                                    <p class="res-activity-time">
                                                        <i class="fa fa-clock-o"></i>
                                                        2.00 PM.
                                                    </p>
                                                </li>
                                                <li>
                                                    <p class="mb-0">Punch Out at</p>
                                                    <p class="res-activity-time">
                                                        <i class="fa fa-clock-o"></i>
                                                        7.30 PM.
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Attendance Modal -->
            
        </div>
        <!-- Page Wrapper -->

    @endsection
    @section('scripts')
    <script type="text/javascript">

        $('.approve_timesheet').on('click',function(e){

            var id = $(this).attr("data-id");

            $.ajax({
                url: "{{ route('auth_employee.approve')}}",
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                id:id
            },
            success:function(response){

                toastr.success(response.success);
                // setTimeout(function(){location.reload()}, 2000);
            },
            error: function(response) {
                toastr.error("Something went wrong");
                // setTimeout(function(){location.reload()}, 2000);
            },
            });
        });
</script>
@endsection