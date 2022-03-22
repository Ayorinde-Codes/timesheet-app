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

        $user->is_on_leave = 1;
        $user->type_of_leave = $request->leave_id;
        $user->leave_started = $created_day;
        $user->save();

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Successfully apply for leave'
        ]);
    }
}
