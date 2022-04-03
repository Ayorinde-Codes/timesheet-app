<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Entity;
use App\Models\Role;
use App\Models\Timesheet;
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
    }

    public function details($id)
    {
        // 20th of last month and 30th of next month

        $user = User::where('GenEntityID', $id)->first();

        $entity = User::entity($id);

        $now = Carbon::now();

        $dateStart = Carbon::createFromFormat('Y-m-d', $now->year.'-'.$now->month.'-21')->subMonth();

        $dateEnd = Carbon::createFromFormat('Y-m-d', $now->year.'-'.$now->month.'-20');

        // $dateEnd = Carbon::now()->endOfMonth()->format('Y-m-d');

        // dd( $dateStart, $dateEnd);

        // Declare an empty array
        $dateHeader = array();
        
        // Use strtotime function
        $Variable1 = strtotime($dateStart);
        $Variable2 = strtotime($dateEnd);
        
        // Use for loop to store dates into array
        // 86400 sec = 24 hrs = 60*60*24 = 1 day
        for ($currentDate = $Variable1; $currentDate <= $Variable2; $currentDate += (86400) ) {
                                            
            $Store = date('Y-m-d', $currentDate);
            $dateHeader[] = $Store;
        }
        





        // Display the dates in array format
        $allDateHeader = collect($dateHeader);

        $userTimesheet = Timesheet::where('GenEntityID', $id)->where('status', 'processing')->get();
      
        $getUserTimesheet = $this->filterTimesheetByDate($userTimesheet, $dateStart, $dateEnd);

        $userProject = collect($getUserTimesheet)->unique('project_id')->all();

        $timesheetHeader = collect($getUserTimesheet)->unique('created_at')->all();

        $allleave = Absence::get();


        $userTimesheetDates = $getUserTimesheet->map(function ($timesheet) {
            return date('Y-m-d',strtotime($timesheet->created_at));
        })->toArray();


        for($i =0; $i < count($dateHeader); $i++)
        {
            $itemIndex = array_search($dateHeader[$i], $userTimesheetDates);

            if(!is_numeric($itemIndex)) $itemToShow[] = '-';

            else{
                $itemToShow[] = $getUserTimesheet[$itemIndex];
            }
        }

        // dd($itemToShow);


        return view('view-timesheet', compact('getUserTimesheet', 'user', 'allDateHeader', 'timesheetHeader', 'userProject', 'allleave', 'dateStart', 'dateEnd', 'entity', 'itemToShow'));
    }

    private function filterTimesheetByDate($timesheet, $startDate, $endDate)
    {
        $startDate = Carbon::parse($startDate)->format('Y-m-d H:i:s');
        $endDate = Carbon::parse($endDate)->format('Y-m-d H:i:s');

        return $timesheet->whereBetween('created_at', [$startDate, $endDate]);
    }

    private function isWeekendAndPublicHolidays($date)
    {            
        $date1 = strtotime($date);

        // Get day name from the date
        $date2 = date("l", $date1);
        
        // Convert day name to lower case
        $date3 = strtolower($date2);
        // Check if day name is "saturday" or "sunday"

        if(($date3 == "saturday" )|| ($date3 == "sunday"))
        {
            return 'true';
        } 
        else
        {
            return 'false';
        }    
    }
}