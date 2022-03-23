<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use App\Models\UserSupervisor;
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
        $start_date = $request->input('date_from') ? Carbon::createFromFormat('d/m/Y', $request->date_from)->format('Y-m-d H:i:s') : null;
        $end_date = $request->input('date_to') ? Carbon::createFromFormat('d/m/Y', $request->date_to)->format('Y-m-d H:i:s') : null;

        $genEntityID = $request->input('GenEntityID');

        $secondary_supervisor_id = $request->input('secondary_supervisor_id') ?? null;

        $userSupervisor = UserSupervisor::where('GenEntityID', $genEntityID)->first();

        $userEntity = array_filter([
            'LastName' => $request->FirstName,
            'LastName' => $request->LastName,
            'EmailAddress' => $request->Email,
            'CellNumber' => $request->Phone,
        ]);

        $entity = Entity::where('GenEntityID', $genEntityID)->update($userEntity);

        $vipUser = array_filter([
            'VIPUserName' =>  $request->UserName,
        ]);

        $vip = User::where('GenEntityID', $genEntityID)->update($vipUser);

        $userRole = UserRole::updateOrCreate([
            'GenEntityID' => $genEntityID],
            [
            'role_id' => $request->role_id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $createSupervisor = UserSupervisor::updateOrCreate([
            'GenEntityID' => $genEntityID],
            [
            'primary_supervisor' => $request->supervisor_id,
            'primary_supervisor' => $request->supervisor_id,
            'secondary_supervisor' => $secondary_supervisor_id,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Successfully created a new timesheet'
        ]);


        //update


                // 'FirstName' => '',   
        // 'LastName' => '',
        // 'UserName' => '',
        // 'Email' => '', 
        // 'Phone' => '', CellNumber
        // 'role_id' => '', .\// user role



        // 'supervisor_id' => '',
        // 'secondary_supervisor_id' => '',
        // 'date_from' => '',
        // 'date_to' => '',
        // $created_day = Carbon::createFromFormat('d/m/Y', $request->leave_started)->format('Y-m-d H:i:s');

        // $user = User::where('GenEntityID', Auth()->user()->GenEntityID)->first();

        // if(is_null($user))
        // {
        //     return redirect()->back()->with([
        //         'status' => 'failed',
        //         'message' => 'User not found'
        //     ]); 
        // }

        // $user->is_on_leave = 1;
        // $user->type_of_leave = $request->leave_id;
        // $user->leave_started = $created_day;
        // $user->save();

        // return redirect()->back()->with([
        //     'status' => 'success',
        //     'message' => 'Successfully apply for leave'
        // ]);




        // $user = User::where('GenEntityID', Auth()->user()->GenEntityID)->first();

        // if(is_null($user))
        // {
        //     return redirect()->back()->with([
        //         'status' => 'failed',
        //         'message' => 'User not found'
        //     ]); 
        // }

        // $user->is_on_leave = 1;
        // $user->type_of_leave = $request->leave_id;
        // $user->leave_started = $created_day;
        // $user->save();

        // return redirect()->back()->with([
        //     'status' => 'success',
        //     'message' => 'Successfully apply for leave'
        // ]);



        
        
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

