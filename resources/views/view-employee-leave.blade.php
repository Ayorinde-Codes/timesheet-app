@extends('partials.main')

    @section('content')

            <!-- Page Wrapper -->
            <div class="page-wrapper">
        
                <!-- Page Content -->
                <div class="content container-fluid">
                
                    <!-- Page Header -->
                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="page-title">Leave Settings</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Leave Settings</li>
                                </ul>
                            </div>
                            <div class="col-auto float-right ml-auto">
                                {{-- <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_custom_policy"><i class="fa fa-plus"></i> Apply Leave</a> --}}
                                {{-- <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#add_custom_policy"><i class="fa fa-plus"></i> Add custom policy</button> --}}
                            </div>
                        </div>
                    </div>
                    
                    <!-- /Page Header -->
                    <div class="row">
                        <div class="col-md-12">
                        @foreach($absence_leave as $leave)
                            @php
                                $userLeave = \App\Models\Absence::leave($leave->type_of_leave);
                            @endphp

                            <div class="card leave-box" id="leave_sick">
                                <div class="card-body">
                                    <div class="h3 card-title with-switch">
                                        {{$userLeave->name}} 											
                                        <div class="onoffswitch">
                                            {{-- <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch_sick_{{$userLeave->id}}" checked> --}}
                                            <button type="button" class="btn btn-success approve" data-id="{{$leave->GenEntityID}}"> Approve </button>
                                            {{-- <button onClick=""> </button> --}}
                                            {{-- <label class="onoffswitch-label" for="switch_sick_{{$userLeave->id}}">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label> --}}
                                        </div>
                                    </div>
                                    <div class="leave-item">
                                        <div class="leave-row">
                                            <div class="leave-left">
                                                <div class="input-box">
                                                    <div class="form-group">
                                                        <label>Days</label>
                                                        <input type="text" class="form-control" value="{{$userLeave->time_period}} days" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
                <!-- /Page Wrapper -->
    
    @endsection
    {{-- @section('script')
        <script>
            $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
            });
        </script>
    @endsection --}}

    @section('scripts')
    <script type="text/javascript">

        $('.approve').on('click',function(e){

            var id = $(this).attr("data-id");

            $.ajax({
                url: "{{ route('approve.leave')}}",
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