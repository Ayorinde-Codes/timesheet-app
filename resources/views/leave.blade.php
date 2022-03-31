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
                                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_custom_policy"><i class="fa fa-plus"></i> Apply Leave</a>
                                    {{-- <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#add_custom_policy"><i class="fa fa-plus"></i> Add custom policy</button> --}}
                                </div>
                            </div>
                           
                        </div>
                        
                        @if(session()->has('status'))
                            <div class="alert alert-{{ session()->get('status') }}">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> x </button>
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        <!-- /Page Header -->
                        
                        <div class="row">
                            <div class="col-md-12">
                            {{-- @foreach($absences as $leave) --}}
                                <!-- Sick Leave -->
                                @if($user->is_on_leave)

                                @php
                                    $userLeave = \App\Models\Absence::leave($user->type_of_leave);
                                @endphp

                                <div class="card leave-box" id="leave_sick">
                                    <div class="card-body">
                                        <div class="h3 card-title with-switch">
                                            {{$userLeave->name}} 											
                                            <div class="onoffswitch">
                                                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch_sick_{{$userLeave->id}}" checked>
                                                <label class="onoffswitch-label" for="switch_sick_{{$userLeave->id}}">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
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
                                @endif
                                <!-- /Sick Leave -->
                                {{-- @endforeach --}}
                            </div>
                        </div>
                            
                    </div>
                    <!-- /Page Content -->
                    
                    <!-- Add Custom Policy Modal -->
                    <div id="add_custom_policy" class="modal custom-modal fade" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Custom Policy</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('user.leave.apply') }}" method="POST">
                                        @csrf
                                        {{-- @foreach($absences as $leave)  user.leave.apply --}}
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label>Leave Name</label>
                                                <select  name="leave_id" id="leave_id" class="select">
                                                    <option></option>
                                                    @foreach($absences as $leave)
                                                        <option value={{ $leave->id }}>{{optional($leave)->name . ' ('. $leave->time_period.' days)' }} </option>
                                                    @endforeach
                                                </select> 
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label>Leave Starts <span class="text-danger">*</span></label>
                                            <div class="cal-icon">
                                                <input class="form-control datetimepicker" name="leave_started" type="text">
                                            </div>
                                        </div>
                                        
                                        <div class="submit-section">

                                            <button class="btn btn-primary submit-btn" {{$user->is_on_leave ? 'disabled' : ''}}>@if($user->is_on_leave) <a href="#" data-toggle="tooltip" title="cannot apply already on leave!"> Apply</a> @else Apply @endif </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Add Custom Policy Modal -->
                    
                    <!-- Edit Custom Policy Modal -->
                    <div id="edit_custom_policy" class="modal custom-modal fade" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Custom Policy</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <label>Policy Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="LOP">
                                        </div>
                                        <div class="form-group">
                                            <label>Days <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="4">
                                        </div>
                                        <div class="form-group leave-duallist">
                                            <label>Add employee</label>
                                            <div class="row">
                                                <div class="col-lg-5 col-sm-5">
                                                    <select name="edit_customleave_from" id="edit_customleave_select" class="form-control" size="5" multiple="multiple">
                                                        <option value="1">Bernardo Galaviz </option>
                                                        <option value="2">Jeffrey Warden</option>
                                                        <option value="2">John Doe</option>
                                                        <option value="2">John Smith</option>
                                                        <option value="3">Mike Litorus</option>
                                                    </select>
                                                </div>
                                                <div class="multiselect-controls col-lg-2 col-sm-2">
                                                    <button type="button" id="edit_customleave_select_rightAll" class="btn btn-block btn-white"><i class="fa fa-forward"></i></button>
                                                    <button type="button" id="edit_customleave_select_rightSelected" class="btn btn-block btn-white"><i class="fa fa-chevron-right"></i></button>
                                                    <button type="button" id="edit_customleave_select_leftSelected" class="btn btn-block btn-white"><i class="fa fa-chevron-left"></i></button>
                                                    <button type="button" id="edit_customleave_select_leftAll" class="btn btn-block btn-white"><i class="fa fa-backward"></i></button>
                                                </div>
                                                <div class="col-lg-5 col-sm-5">
                                                    <select name="customleave_to" id="edit_customleave_select_to" class="form-control" size="8" multiple="multiple"></select>
                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="submit-section">
                                            <button class="btn btn-primary submit-btn">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Edit Custom Policy Modal -->
                    
                    <!-- Delete Custom Policy Modal -->
                    <div class="modal custom-modal fade" id="delete_custom_policy" role="dialog">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="form-header">
                                        <h3>Delete Custom Policy</h3>
                                        <p>Are you sure want to delete?</p>
                                    </div>
                                    <div class="modal-btn delete-action">
                                        <div class="row">
                                            <div class="col-6">
                                                <a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
                                            </div>
                                            <div class="col-6">
                                                <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Delete Custom Policy Modal -->
                    
                </div>
                <!-- /Page Wrapper -->
    
    @endsection
    @section('script')
        <script>
            $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
            });
        </script>
    @endsection