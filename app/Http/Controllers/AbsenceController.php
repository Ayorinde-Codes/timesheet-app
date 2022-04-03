<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Timesheet;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AbsenceController extends Controller
{
    public function index()
    {
        $absences = Absence::all();

        return view('absence', compact('absences'));
    }


    public function create(Request $request)
    {
        // $this->validate($request, [

        // ]);

        $leave= [
            'name' => $request->name,
            'time_period' =>  $request->time_period,
            'description' => $request->description
        ];
        
        $createLeave = Absence::create($leave);

        if($createLeave)
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
        $leave = Absence::where('id', $request->absence_id)->first();

        if(is_null($leave))
            {
                return redirect()->back()->with([
                    'status' => 'danger',
                    'message' => 'Leave not found'
                ]); 
            }

            $leave->name = $request->name;
            $leave->time_period = $request->time_period;
            $leave->description = $request->description;
            $leave->save();
            
            return redirect()->back()->with([
                'status' => 'success',
                'message' => 'Successfully updated Leave'
            ]);
    }

    public function userLeave()
    {
        $user = User::where('GenEntityID', Auth()->user()->GenEntityID)->first();

        $absences = Absence::all();

        return view('leave', compact('absences', 'user'));
    }

    public function userLeaveApply(Request $request)
    {
        $created_day = Carbon::createFromFormat('d/m/Y', $request->leave_started)->format('Y-m-d H:i:s');

        $user = User::where('GenEntityID', Auth()->user()->GenEntityID)->first();

        if(is_null($user))
        {
            return redirect()->back()->with([
                'status' => 'danger',
                'message' => 'Leave not found'
            ]); 
        }

        // $user->is_on_leave = 1;
        $user->type_of_leave = $request->leave_id;
        $user->approved_by = 'employee';
        $user->leave_started = $created_day;
        $user->save();

        // send supervisor mail

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Successfully apply for leave'
        ]);
    }

    public function viewLeave()
    {
        $userRole = UserRole::where('GenEntityID', Auth()->user()->GenEntityID)->first();

        $absence_leave = [];

        if($userRole->role->name == 'employee'){ //employee
            return redirect()->back()->with([
                'status' => 'danger',
                'message' => 'Employee not allowed'
            ]);
        }

        elseif ($userRole->role->name == 'supervisor') { //supervisor

            $absence_leave = User::where('approved_by', 'employee')->get();

        }
        elseif ($userRole->role->name == 'admin') { //admin

            $absence_leave = User::where('approved_by', 'supervisor')->get();
        }

        return view('view-employee-leave', compact('absence_leave', 'userRole'));
    }

    public function approveLeave(Request $request)
    {
        $userRole = UserRole::where('GenEntityID', Auth()->user()->GenEntityID)->first();

        if ($userRole->role->name == 'supervisor') {

            $leave = User::where('GenEntityID', $request->id)->where('approved_by', 'employee')->first();

            if(is_null($leave))
            {
                return redirect()->back()->with([
                    'status' => 'danger',
                    'message' => 'leave not found'
                ]); 
            }
            
            $leave->is_on_leave = 1;
            $leave->approved_by = 'supervisor';
            $leave->save();
    
            // send hr mail
    
            return redirect()->back()->with([
                'status' => 'success',
                'message' => 'Successfully apply for leave'
            ]);
        }

        elseif ($userRole->role->name == 'admin'){

            $leave = User::where('GenEntityID', $request->id)->where('approved_by', 'supervisor')->first();

            if(is_null($leave))
            {
                return redirect()->back()->with([
                    'status' => 'danger',
                    'message' => 'leave not found'
                ]); 
            }

            $leave->is_on_leave = 1;
            $leave->approved_by = 'admin';
            $leave->save();

            // send users mail approve
            return redirect()->back()->with([
                'status' => 'success',
                'message' => 'Successfully apply for leave'
            ]);
        }  
    }


    public function adminApproveLeave(Request $request)
    {

        $leave = User::where('GenEntityID', $request->id)->where('approved_by', 'supervisor')->first();

        if(is_null($leave))
        {
            return redirect()->back()->with([
                'status' => 'danger',
                'message' => 'leave not found'
            ]); 
        }

        $leave->is_on_leave = 1;
        // $leave->type_of_leave = $request->leave_id;
        $leave->approved_by = 'admin';
        // $leave->leave_started = $created_day;
        $leave->save();

        // send users mail approve
        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Successfully apply for leave'
        ]);
    }

}
