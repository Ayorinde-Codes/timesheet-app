{{-- @include('partials.header') --}}
@extends('partials.main')

@section('content')

    <!-- Page Wrapper -->
    <div class="page-wrapper">
    
        <!-- Page Content -->
        <div class="content container-fluid">
        
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Timesheet</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Timesheet</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_todaywork"><i class="fa fa-plus"></i> Add Today Work</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

 {{-- $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('project_id');
            $table->unsignedInteger('GenEntityID');
            $table->enum('level', [1, 2, 3]);
            $table->enum('status', ['processing', 'successful']);
            $table->timestamp('time_worked')->nullable();
            $table->timestamp('standard_time')->nullable();
            $table->timestamp('over_time')->nullable();
            $table->timestamps(); --}}

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    {{-- <th>Employee</th> --}}
                                    <th>Projects</th>
                                    <th class="text-center"> Time Worked (Hours)</th>
                                    <th class="text-center"> Standard Time (Hours)</th>
                                    <th class="text-center">Over Time (Hours)</th>
                                    <th class="d-none d-sm-table-cell">Description</th>
                                    <th>Created Date</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @if (count($timesheets) !== 0)
                                <tr>
                                    <td> <p align="center"> <b> No matching records </b> </p></td>
                                </tr>
                            @else  --}}
                            {{-- projects --}}
                                    @foreach($timesheets as $timesheet)
                                    @php
                                        $entity = \App\Models\User::entity($timesheet->GenEntityID);
                                        $project = \App\Models\Project::where('id', $timesheet->project_id)->first();
                                    @endphp
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                {{$project->name}}
                                            </h2>
                                        </td>
                                        <td>{{$timesheet->time_worked}}</td>
                                        <td>{{$timesheet->standard_time}}</td>
                                        <td>{{$timesheet->over_time}}</td>
                                        <td>{{$timesheet->description}}</td>
                                        <td>{{$timesheet->created_at}}</td>
                                        {{-- <td>{{$timesheet->2019</td> --}}
                                        {{-- <td>
                                            <h2>Office Management</h2>
                                        </td>
                                        <td class="text-center">20</td>
                                        <td class="text-center">7</td>
                                        <td class="d-none d-sm-table-cell col-md-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel elit neque.</td> --}}
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_todaywork"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    {{-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_workdetail"><i class="fa fa-trash-o m-r-5"></i> Delete</a> --}}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                {{-- @endif --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
        
        <!-- Add Today Work Modal -->
        <div id="add_todaywork" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Today Work details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('timesheet.create') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Projects</label>
                                        <select id="project_id"  name="project_id"  class="select">
                                            <option></option>
                                            @foreach($projects as $project)
                                                <option value={{ $project->id }}>{{ $project->name }}</option>
                                            @endforeach
                                        </select> 
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>Date <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker" name="date" type="text">
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Total Hours <span class="text-danger">*</span></label>
                                    <input class="form-control" name="time_worked" type="number" min="1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Description <span class="text-danger">*</span></label>
                                <textarea rows="4" name="description" class="form-control"></textarea>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add Today Work Modal -->
        
        <!-- Edit Today Work Modal -->
        <div id="edit_todaywork" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Work Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>Project <span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Office Management</option>
                                        <option>Project Management</option>
                                        <option>Video Calling App</option>
                                        <option>Hospital Administration</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label>Deadline <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input class="form-control" type="text" value="5 May 2019" readonly>
                                    </div>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>Total Hours <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" value="100" readonly>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>Remaining Hours <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" value="60" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>Date <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker" value="03/03/2019" type="text">
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Hours <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" value="9">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Description <span class="text-danger">*</span></label>
                                <textarea rows="4" class="form-control">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel elit neque.</textarea>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Today Work Modal -->
        
        <!-- Delete Today Work Modal -->
        <div class="modal custom-modal fade" id="delete_workdetail" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Work Details</h3>
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
        <!-- Delete Today Work Modal -->
        
    </div>
@endsection
    <!-- /Page Wrapper -->
{{-- @include('partials.footer') --}}
