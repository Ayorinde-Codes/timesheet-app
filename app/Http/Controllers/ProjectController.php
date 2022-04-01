<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        return view('projects', compact('projects'));
    }

    public function create(Request $request)
    {
        $project= [
            'project_name' => $request->project_name,
            'project_code' =>  $request->project_code,
            'status' => $request->project_code
        ];
        
        $createProject = Project::create($project);

        if($createProject)
        {
            return redirect()->back()->with([
                'status' => 'success',
                'message' => 'Successfully created project'
            ]);
        }

        return redirect()->back()->with([
            'status' => 'danger',
            'message' => 'project not found'
        ]); 

    }


    public function update(Request $request)
    {

        $project = Project::where('id', $request->project_id)->first();

        if(is_null($project))
            {
                return redirect()->back()->with([
                    'status' => 'danger',
                    'message' => 'project not found'
                ]); 
            }

            $project->status = $request->status;
            $project->project_code = $request->project_code;
            $project->save();

            return redirect()->back()->with([
                'status' => 'success',
                'message' => 'Successfully updated project'
            ]);
    }

}
