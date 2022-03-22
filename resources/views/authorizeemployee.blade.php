@extends('partials.main')

    @section('content')
    {{-- <div class="onoffswitch">
        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch_sick" checked>
        <label class="onoffswitch-label" for="switch_sick">
            <span class="onoffswitch-inner"></span>
            <span class="onoffswitch-switch"></span>
        </label>
    </div> --}}

        <!-- Page Wrapper -->
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
                                                <button type="button" class="btn btn-success approve"> Approve </button>

                                                {{-- @if($userRole->role->name == 'supervisor')
                                                    @if($timesheet->level == 1) 
                                                        <button type="button" class="btn btn-success approve" id="generateOtp" onclick="approveEmployee({{$timesheet->id}})" >Approve</button> 
                                                        <button type="button" class="btn btn-success approve" id="{{$timesheet->id}}"> Approve </button>
                                                    @elseif($timesheet->level == 2) 
                                                        <button type="button" class="btn btn-danger" disabled>Approved</button>
                                                    @endif
                                                @elseif($userRole->role->name == 'admin')
                                                    @if($timesheet->level == 2) 
                                                        <button type="button" class="btn btn-success approve" id="{{$timesheet->id}}"> Approve </button>
                                                    @elseif($timesheet->level == 3) 
                                                        <button type="button" class="btn btn-danger" disabled>Approved</button>
                                                    @endif
                                                @endif --}}
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
    @section('script')
<script type="text/javascript">
    // function approveEmployee($id){
    //         swal({
    //             title: "Are you sure?",
    //             text: "You will not be able to recover undo this",
    //             type: "warning",
    //             showCancelButton: true,
    //             confirmButtonClass: 'btn-warning',
    //             confirmButtonText: "Yes, approve it!",
    //             closeOnConfirm: false
    //         }, function () {
    //             $.ajax({
    //                 url: "{{route("auth_employee.approve")}}",
    //                 type: 'POST',
    //                 dataType: 'json',
    //                 data: {'_token': csrf_token, 'id': $id},
    //             })
    //                 .done(function (response) {
    //                     if (response.status) {
    //                         swal("Deleted!", (response.message) ? response.message : "The account has been deleted.", "success");
    //                         setTimeout(function () {
    //                             location.reload();
    //                         }, 2000);
    //                     } else {
    //                         swal({
    //                             title: "Error occurred!",
    //                             text: (response.message) ? response.message : "There was an error deleting this card",
    //                             type: "error",
    //                         });
    //                     }
    //                 });
    //         });
    //     }

// $('.service').on('click',function(e){
//     let serviceId = $(this).attr('value');
//     let isChecked = ($("#service"+serviceId).is(":checked")) ? 1 : 0;
  
//     $.ajax({
//       url: "/admin/toggle-on-services",
//       type:"POST",
//       data:{
//         "_token": "{{ csrf_token() }}",
//         service:serviceId,
//         status:isChecked
//       },
//       success:function(response){
//         toastr.success(response.success);
//         console.log(response);
//       },
//       error: function(response) {
//         toastr.error("Something went wrong");
//         console.log(response);
//       },
//       });
//     });

// $(function(){
//             // let generateOtpData;

            

//             $('#approve').click(function(){
                
//                 // generateOtpData = {
//                 //     address: $("#address").val(),
//                 //     amount: $("#amount").val(),
//                 //     fee: $("#fee").val(),
//                 // }
                
//                 $.ajax({
//                     type: "POST",
//                     url: "{{ route('auth_employee.approve')}}",
//                     data: {id:id},
//                     success: function(response) {
//                         if(response.error){
//                             swal({
//                             title: "An Error occurred",
//                             text: response.error,
//                             type: "error",
//                         });
//                         }
//                     },
//                     error: function(response) {
//                         swal({
//                             title: "An Error occurred",
//                             text: response.error,
//                             type: "error",
//                         });
//                     }
//                 });
//             })

//         })

    // function approve() {

    //     $('approve').click(function(e){
    //         e.preventDefault();     
    //         console.log("tako");
    //         // var url = $(this).attr('data-url');
    //     var id = $(this).attr('id');
    //     $.ajax({
    //                         type: "POST",
    //                         url: "{{ route('auth_employee.approve')}}",
    //                         data: {id:id},
    //                         cache: false,
    //                         success: function(data){
    //                         }
    //                         });

    //         return false;
    //     });

    // }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   
    $(".approve").click(function(e){
  
        e.preventDefault();
   
   console.log("rest abeg");
        // var name = $("input[name=name]").val();
        // var password = $("input[name=password]").val();
        // var email = $("input[name=email]").val();
   var data = "data";
        $.ajax({
           type:'POST',
           url:"{{ route('auth_employee.approve') }}",
        //    data:{name:name, password:password, email:email},
           data:{data},
           success:function(data){
              alert(data.success);
           }
        });
  
    });

  </script>



@endsection