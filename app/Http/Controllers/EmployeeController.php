<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Carbon\Carbon;
class EmployeeController extends Controller
{
    public function index()
    {
        $account = User::query();

        $employees = $account->get();

        $roles = Role::all();

        $supervisors = UserRole::whereIn('GenEntityID', array_values(array_filter($account->pluck('GenEntityID')->toArray())))->where('role_id', 2)->get();

        return view('employee', compact('employees', 'roles', 'supervisors'));
    }

    public function create(Request $request)
    {
        $this->validate($request, [

        ]);
        
    }

    public function editEmployee(Request $request)
    {
        $date_from = $request->input('date_from') ?? null;
        $date_to = $request->input('date_to') ?? null;

        // if($request->filled('date_from')){
        //     $date_from = Carbon::createFromFormat('d/m/Y', $request->date_from)->format('Y-m-d H:i:s');

        // }

        // if($request->filled('date_to')){
        //     $date_to = Carbon::createFromFormat('d/m/Y', $request->date_to)->format('Y-m-d H:i:s');
        // }


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

        // 'FirstName' => '',
        // 'LastName' => '',
        // 'UserName' => '',
        // 'Email' => '',
        // 'Phone' => '',
        // 'role_id' => '',
        // 'supervisor_id' => '',
        // 'secondary_supervisor_id' => '',
        // 'date_from' => '',
        // 'date_to' => '',

        
        
    }
}

// FirstName
// LastName
// UserName
// Email
// Phone
// role_id
// supervisor_id
// secondary_supervisor_id
// date_from
// date_to

