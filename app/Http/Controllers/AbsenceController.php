<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\User;
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
        $this->validate($request, [

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
                'status' => 'failed',
                'message' => 'User not found'
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

    public function supervisorpproveLeave(Request $request)
    {
        // $created_day = Carbon::createFromFormat('d/m/Y', $request->leave_started)->format('Y-m-d H:i:s');

        // $user = User::where('GenEntityID', Auth()->user()->GenEntityID)->first();

        $leave = User::where('approved_by', 'employee')->first();

        if(is_null($leave))
        {
            return redirect()->back()->with([
                'status' => 'failed',
                'message' => 'leave not found'
            ]); 
        }

        // $user->is_on_leave = 1;
        // $leave->type_of_leave = $request->leave_id;
        $leave->approved_by = 'supervisor';
        // $leave->leave_started = $created_day;
        $leave->save();

        // send hr mail

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Successfully apply for leave'
        ]);
    }


    public function adminApproveLeave(Request $request)
    {
        // $created_day = Carbon::createFromFormat('d/m/Y', $request->leave_started)->format('Y-m-d H:i:s');

        // $user = User::where('GenEntityID', Auth()->user()->GenEntityID)->first();

        $leave = User::where('approved_by', 'supervisor')->first();

        if(is_null($leave))
        {
            return redirect()->back()->with([
                'status' => 'failed',
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
