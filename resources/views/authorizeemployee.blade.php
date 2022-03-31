@extends('partials.main')

    @section('content')
        <div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Department</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Department</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_department"><i class="fa fa-plus"></i> Add Department</a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <table class="table table-striped custom-table mb-0 datatable">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Email</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($getTimesheet) < 1)
                                <tr>
                                    <td><b> No matching records </b></td>
                                </tr>
                                @else 
                                    @foreach($getTimesheet as $timesheet)

                                        @php
                                            $entity = \App\Models\User::entity($timesheet->GenEntityID);
                                            // $userRole = \App\Models\User::userRole($employee->GenEntityID);
                                        @endphp
                                        <tr>
                                            <td>{{ optional($entity)->FirstName.' '. optional($entity)->LastName }}</td>
                                            <td>{{ optional($entity)->EmailAddress }}</td>
                                            {{-- <td>
                                                <div class="onoffswitch">
                                                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch_sick" checked>
                                                    <label class="onoffswitch-label" for="switch_sick">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </td> --}}
                                            <td>

                                                @if($userRole->role->name == 'supervisor')
                                                    @if($timesheet->level == 1) 
                                                        {{-- <button type="button" class="btn btn-success approve" data-id="{{$request->id}}" id="generateOtp" onclick="approveEmployee({{$timesheet->id}})" >Approve</button>  --}}
                                                        <button type="button" class="btn btn-success approve" data-id="{{$timesheet->id}}"> Approve </button>
                                                    @elseif($timesheet->level == 2) 
                                                        <button type="button" class="btn btn-danger" disabled>Approved</button>
                                                    @endif
                                                @elseif($userRole->role->name == 'admin')
                                                    @if($timesheet->level == 2) 
                                                        <button type="button" class="btn btn-success approve" data-id="{{$timesheet->id}}"> Approve </button>
                                                    @elseif($timesheet->level == 3) 
                                                        <button type="button" class="btn btn-danger" disabled>Approved</button>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->

        </div>
        <!-- /Page Wrapper -->
    @endsection
    @section('scripts')
        <script type="text/javascript">

            $('.approve').on('click',function(e){

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