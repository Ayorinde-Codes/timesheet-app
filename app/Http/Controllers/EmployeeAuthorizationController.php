<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use App\Models\UserRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class EmployeeAuthorizationController extends Controller
{
    public function index()
    {
        $userRole = UserRole::where('GenEntityID', Auth()->user()->GenEntityID)->first();
        
        $getTimesheet = [];

        // if($userRole->role->name == 'employee'){ //employee
        //     return redirect()->back()->with([
        //         'status' => 'failed',
        //         'message' => 'Employee not allowed'
        //     ]);
        // }

        if ($userRole->role->name == 'supervisor') { //supervisor

            $getTimesheet = Timesheet::where('status', 'processing')->get();

            return view('authorizeemployee', compact('getTimesheet', 'userRole'));

        }
        elseif ($userRole->role->name == 'admin') { //admin

            $getTimesheet = Timesheet::where('level', 2)->get();

            return view('authorizeemployee', compact('getTimesheet', 'userRole'));

        }
        else{
            return redirect()->back()->with([
                'status' => 'failed',
                'message' => 'Employee not allowed'
            ]);
        }
    }

    public function approve(Request $request)
    {
        $userRole = UserRole::where('GenEntityID', Auth()->user()->GenEntityID)->first();
        
        $now = Carbon::now();

        $dateStart = Carbon::createFromFormat('Y-m-d', $now->year.'-'.$now->month.'-21')->subMonth();

        $dateEnd = Carbon::now()->format('Y-m-d');

        $getTimesheets = Timesheet::where('status', 'processing')->whereBetween('timesheets.created_at', [$dateStart, $dateEnd])->get();

        if ($userRole->role->name == 'supervisor') { //supervisor

            // $getTimesheet->level = 2;
            // $getTimesheet->save();


            // approve all pending timesheets all at once

            foreach ($getTimesheets as $getTimesheet) {

                $getTimesheet->level = 3;
                $getTimesheet->status = 'successful';
                // $getTimesheet->save();
                $getTimesheet->push();
            }


            // send hr mail 

            // send users mail and hr
            $user = UserRole::where('role_id', 1)->first();

            $hrUser = User::entity($user->GenEntityID);
    
            Mail::send('emails.approval', ['username' =>  $hrUser], function($message) use($request, $hrUser){
                $message->to($hrUser->EmailAddress);
                $message->from($address = 'noreply@apin.com', $name = 'Wale from Apin');
                $message->subject('Approval');
            });

            return redirect()->back()->with([
                'status' => 'success',
                'message' => 'Successfully approve a new timesheet'
            ]);
        }

        // elseif($userRole->role->name == 'admin')
        // {
        //     $getTimesheet->level = 3;
        //     $getTimesheet->status = 'successful';
        //     $getTimesheet->save();

        //     return redirect()->back()->with([
        //         'status' => 'success',
        //         'message' => 'Successfully approve a new timesheet'
        //     ]);
        // }
    }
}
