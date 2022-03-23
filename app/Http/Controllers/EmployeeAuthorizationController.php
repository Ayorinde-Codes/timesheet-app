<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use App\Models\UserRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmployeeAuthorizationController extends Controller
{
    // show all unauthorized data from employee and supervisor 
    public function index()
    {
        $userRole = UserRole::where('GenEntityID', Auth()->user()->GenEntityID)->first();
        
        $getTimesheet = [];

        if($userRole->role->name == 'employee'){ //employee
            return redirect()->back()->with([
                'status' => 'failed',
                'message' => 'Employee not allowed'
            ]);
        }
        elseif ($userRole->role->name == 'supervisor') { //supervisor

            $getTimesheet = Timesheet::where('level', 1)->get();
        }
        elseif ($userRole->role->name == 'admin') { //admin

            $getTimesheet = Timesheet::where('level', 2)->get();
        }

        return view('authorizeemployee', compact('getTimesheet', 'userRole'));
    }

    public function approve(Request $request)
    {
        $userRole = UserRole::where('GenEntityID', Auth()->user()->GenEntityID)->first();

        $getTimesheet = Timesheet::where('id', $request->id)->first();

        if ($userRole->role->name == 'supervisor') { //supervisor

            $getTimesheet->level = 2;
            $getTimesheet->save();

            // send hr mail 

            $user = UserRole::where('role_id', 1)->first();

            $hrUser = User::entity($user->GenEntityID);
    
            Mail::send('emails.approval', ['username' =>  $hrUser], function($message) use($request, $hrUser){
                $message->to($hrUser->EmailAddress);
                // $message->from('Wale from Handiwork');
                $message->from($address = 'noreply@apin.com', $name = 'Wale from Apin');
                $message->subject('Approval');
            });

            return redirect()->back()->with([
                'status' => 'success',
                'message' => 'Successfully approve a new timesheet'
            ]);
        }
        elseif($userRole->role->name == 'admin')
        {
            $getTimesheet->level = 3;
            $getTimesheet->status = 'successful';
            $getTimesheet->save();

            return redirect()->back()->with([
                'status' => 'success',
                'message' => 'Successfully approve a new timesheet'
            ]);
        }
    }
}
