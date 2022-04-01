@extends('partials.main')
    @section('content')

    <div class="page-wrapper">
			
        <!-- Page Content -->
        <div class="content container-fluid">
        
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Absence (Leave)</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Absence</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#create_project"><i class="fa fa-plus"></i> Create Absence</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            
            @if(session()->has('status'))
                        <div class="alert alert-{{ session()->get('status') }}">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> x </button>
                            {{ session()->get('message') }}
                        </div>
                    @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                       

                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th>Absence (Leave)</th>
                                    <th>Description</th>
                                    <th>Time Period (Days)</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absences as $absence )

                                <tr>
                                    <td>
                                        {{$absence->name}}
                                    </td>
                                    <td>
                                        {{$absence->description}}
                                    </td>
                                    <td>
                                        {{$absence->time_period}}
                                    </td>
                                   
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_absence_{{$absence->id}}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                {{-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_project_{{$project->id}}"><i class="fa fa-trash-o m-r-5"></i> Delete</a> --}}
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                        <!-- Edit Project Modal -->
                                <div id="edit_absence_{{$absence->id}}" class="modal custom-modal fade" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Leave Absence</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form  action="{{ route('absence.update') }}" method="POST" >
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Absence Name</label>
                                                                <input class="form-control" name="name" value="{{$absence->name}}"  required type="text">
                                                                <input class="form-control" name="absence_id" value="{{$absence->id}}" type="hidden">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Absence Period</label>
                                                                <input class="form-control" name="time_period" value="{{$absence->time_period}}" required type="text">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <textarea rows="4" class="form-control summernote" name="description" required value="{{$absence->description}}" placeholder="Enter your message here"></textarea>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="submit-section">
                                                        <button class="btn btn-primary submit-btn">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Edit Project Modal -->
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
        
        <!-- Create  Modal -->
        <div id="create_project" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create Leave Absence</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('absence.create') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Absence Name</label>
                                        <input class="form-control" value="name" name="name" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Absence Period</label>
                                        <input class="form-control" name="time_period" value="" required type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea rows="4" class="form-control summernote" name="description" placeholder="Enter your message here"></textarea>
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
        <!-- /Create Project Modal -->
        
        <!-- Delete Project Modal -->
        <div class="modal custom-modal fade" id="delete_project" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Project</h3>
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
        <!-- /Delete Project Modal -->
        
    </div>
    
    @endsection