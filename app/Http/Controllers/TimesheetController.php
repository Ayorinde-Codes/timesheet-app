<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\Project;
use App\Models\Timesheet;
use App\Models\UserSupervisor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Mail;
use DateTime;

class TimesheetController extends Controller
{
    private $overwork = 8;

    public function index()
    {
        $timesheets = Timesheet::all();

        $projects = Project::all();

        return view('timesheet', compact('timesheets', 'projects'));
    }

    public function create(Request $request)
    {
        // $end = Carbon::parse($request->input('end_date'));


        // $endDate = Carbon::today()->addDays(1);

        // $diff = now()->diffInDays($endDate);

        // dd($diff);
        
        // if( $diff < 1) {
        //     dd("yes");
        // }
        // else{
        //     dd("no");
        // }
        // dd($diff);

        // $this->validateTimesheetTimeEntry();
        $created_day = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d H:i:s');

        $over_time = $request->time_worked > $this->overwork ? $request->time_worked - $this->overwork : 0;

        $timeSheet= [
            'project_id' => $request->project_id,
            'GenEntityID' => Auth()->user()->GenEntityID,
            'level' => 1,
            'status' => Timesheet::PROCESSING,
            'description' => $request->description,
            'time_worked' => $request->time_worked,
            'standard_time' => $request->time_worked,
            'over_time' => $over_time,
            'created_at' => $created_day,
            'updated_at' => $created_day,
        ];
        
        Timesheet::create($timeSheet);

        // $supervisor = Entity::where('GenEntityID', Auth()->user()->GenEntityID)->first();

        // send mail here to supervisor 
        $supervisor = UserSupervisor::where('GenEntityID', Auth()->user()->GenEntityID)->first();
        // dd($supervisor);
        $supervisorUser = User::entity($supervisor->primary_supervisor);

        // dd($supervisorUser->EmailAddress);
        // $supervisorEmail = $supervisorUser->EmailAddress;

        Mail::send('emails.approval', ['username' =>  $supervisorUser], function($message) use($request, $supervisorUser){
            $message->to($supervisorUser->EmailAddress);
            // $message->from('Wale from Handiwork');
            $message->from($address = 'noreply@apin.com', $name = 'Wale from Apin');
            $message->subject('Approval');
        });

        
        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Successfully created a new timesheet'
        ]);

        
    }

            
    private function validateTimesheetTimeEntry()
    {
        $endDate = Carbon::today()->addDays(1);

        //validate that user can create for the next day 
        // if()
        // {
        //     // return 
        // }
        dd($endDate);
        $now = Carbon::now();

        $dateStart = Carbon::createFromFormat('Y-m-d', $now->year.'-'.$now->month.'-21')->subMonth();
        
        $dateEnd = Carbon::now()->format('Y-m-d');

        dd($dateStart, $dateEnd);
    }
}


// {{-- $table->increments('id');
//     $table->string('name');
//     $table->unsignedInteger('project_id');
//     $table->unsignedInteger('GenEntityID');
//     $table->enum('level', [1, 2, 3]);
//     $table->enum('status', ['processing', 'successful']);
//     $table->timestamp('time_worked')->nullable();
//     $table->timestamp('standard_time')->nullable();
//     $table->timestamp('over_time')->nullable();
//     $table->timestamps(); --}}


        // dd($request->all());

    //     "VIPUserID" => 6
    // "VIPUserName" => "OAtayero"
    // "HashPassword" => "a95f57edff9082390a9366c60f5915fb"
    // "HashType" => 1
    // "SaltKey" => "f43967dc0ba24b92b84c2c4be32f9d92"
    // "Status" => "A"
    // "StartDate" => null
    // "EndDate" => null
    // "LastPasswordSet" => "2016-08-25 10:38:16"
    // "LastLogonDate" => "2017-01-19 15:07:47"
    // "LastFailedLogon" => "2016-08-01 14:02:13"
    // "FailedLogonCount" => 0
    // "MustChangePassword" => 0
    // "GenEntityID" => 5
    // "ThirdPartyLogonStr" => null
    // "CanDelete" => 0
    // "FinancialAccess" => 1
    // "Comment" => null
    // "UserID" => "VIPSecure"
    // "LastChanged" => "2017-01-19 15:07:47"
    // "TMStamp" => b"\x00\x00\x00\x00\x01ê[C"
    // "email" => null
    // "email_verified_at" => null
    // "password" => "$2y$10$Er.esr8vjk7Z5JuM1T0HdOO2vGNyXe3wqsL3ngJO.wpwthTJbqe4S"
    // "remember_token" => null
    // "created_at" => null
    // "updated_at" => null

       

//         processing
// time_worked
// standard_time
// over_time

// dd($request->all());


// $table->string('name');
//             $table->unsignedInteger('project_id');
//             $table->unsignedInteger('GenEntityID');
//             $table->enum('level', [1, 2, 3]);
//             $table->enum('status', ['processing', 'successful']);
//             $table->timestamp('time_worked')->nullable();
//             $table->timestamp('standard_time')->nullable();
//             $table->timestamp('over_time')->nullable();

        // $this->validate($request, [
        //     'project_id' => 'required',
        //     'crypto_to_id' => 'required|numeric',
        //     'fee' => 'required|min:1|max:10000',
        // ]);

        // "supervisor_id" => "1" 
        // "date" => "17/03/2022"
        // "time_worked" => "45"
        // "description" => "fdsvx sf"   5
