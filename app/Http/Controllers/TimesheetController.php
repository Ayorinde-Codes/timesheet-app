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
use Illuminate\Support\Facades\Mail;
use DateTime;
use Session;

class TimesheetController extends Controller
{
    private $overwork = 8;

    public function index()
    {
        $timesheets = Timesheet::orderBy('created_at', 'desc')->get();

        $projects = Project::get();

        return view('timesheet', compact('timesheets', 'projects'));
    }

    public function userTimesheet()
    {
        $user = User::where('GenEntityID', Auth()->user()->GenEntityID)->first();

        $timesheets = Timesheet::where('GenEntityID', $user->GenEntityID)->orderBy('created_at', 'desc')->get();

        $projects = Project::get();

        return view('view-user-timesheet', compact('timesheets', 'projects'));

    }

    public function create(Request $request)
    {
        $today = Carbon::today();

        $created_day = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d H:i:s');

        // $now = Carbon::now();

        // $dateStart = Carbon::createFromFormat('Y-m-d', $now->year.'-'.$now->month.'-21')->subMonth();

        // $dateEnd = $now->endOfMonth()->subMonth(2);

        // $dateEnd = Carbon::now()->format('Y-m-d')->endOfMonth()->subMonth();

        // $dateEnd = $today->endOfMonth()
        //                 ->format('Y-m-d')->subMonth(2);

                        // dd($dateEnd);

        // valdate not to make post of days between 21first and lastday of current month    ->endOfMonth()

        if( Timesheet::where('project_id', $request->project_id)->whereDate('created_at', Carbon::today())->exists())
        {
            return redirect()->back()->with([
                'status' => 'danger',
                'message' => 'you cannot create time sheet for a project that exist'
            ]);
        }

        if(date('Y-m-d', strtotime($today)) < date('Y-m-d', strtotime($created_day)))
        {
            return redirect()->back()->with([
                'status' => 'danger',
                'message' => 'you cannot create time sheet for a day above today'
            ]);
        }

        $over_time = $request->time_worked > $this->overwork ? $request->time_worked - $this->overwork : 0;

        $timeSheet= [
            'project_id' => $request->project_id,
            'GenEntityID' => Auth()->user()->GenEntityID,
            'level' => 1,
            'status' => Timesheet::PROCESSING,
            'description' => $request->description,
            'time_worked' => $request->time_worked,
            'standard_time' => $this->overwork,
            'over_time' => $over_time,
            'created_at' => $created_day,
            'updated_at' => $created_day,
        ];
        
        $createTimesheet = Timesheet::create($timeSheet);

        // send mail here to supervisor 
        // $supervisor = UserSupervisor::where('GenEntityID', Auth()->user()->GenEntityID)->first();

        // $userSupervisor = '';

        // if($supervisor->secondary_supervisor && $today->gt($supervisor->end_date) == false )
        // {
        //     $userSupervisor = $supervisor->secondary_supervisor;
        // }
        // else{
        //     $userSupervisor = $supervisor->primary_supervisor;
        // }

        // $supervisorUser = User::entity($userSupervisor);

        // Mail::send('emails.approval', ['username' =>  $supervisorUser], function($message) use($request, $supervisorUser){
        //     $message->to($supervisorUser->EmailAddress);
        //     $message->from($address = 'noreply@apin.com', $name = 'Shola from Apin');
        //     $message->subject('Approval');
        // });

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Successfully created a new timesheet'
        ]);
    }

    public function details($id)
    {
        // 20th of last month and 30th of next month

        $now = Carbon::now();

        $dateStart = Carbon::createFromFormat('Y-m-d', $now->year.'-'.$now->month.'-21')->subMonth();

        $dateEnd = Carbon::now()->format('Y-m-d');

        $getUserTimesheet = Timesheet::where('GenEntityID', $id)->whereBetween('timesheets.created_at', [$dateStart, $dateEnd])->latest();

        dd($getUserTimesheet);
    }

    private function filterDate($timeSheet, $dates)
    {
        $dates = htmlspecialchars_decode($dates);
        $dates = explode('-', $dates);

        return $timeSheet->where('timesheets.created_at', '>=', Carbon::parse($dates[0])->format('Y-m-d H:i:s'))
            ->where('timesheets.created_at', '<=', Carbon::parse($dates[1])->format('Y-m-d H:i:s'));
    }
            
    private function validateTimesheetTimeEntry()
    {
        $endDate = Carbon::today()->addDays(1);

        $now = Carbon::now();

        $dateStart = Carbon::createFromFormat('Y-m-d', $now->year.'-'.$now->month.'-21')->subMonth();
        
        $dateEnd = Carbon::now()->format('Y-m-d');

        dd($dateStart, $dateEnd);
    }
}
