<?php

namespace App\Http\Controllers;

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

        $user =Entity::where('GenEntityID', $id)->first();

        $now = Carbon::now();

        $dateStart = Carbon::createFromFormat('Y-m-d', $now->year.'-'.$now->month.'-21')->subMonth();

        // $dateEnd = Carbon::now()->format('Y-m-d');
        $dateEnd = Carbon::now()->endOfMonth()->format('Y-m-d');
        // dd($dateStart);
        // $transactions = $this->filterDate($transactions, $request->input('date'));



        // $Date1 = '01-10-2010';
        // $Date2 = '31-11-2010';
        
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
        // dd($dateHeader);
        
        $allDateHeader = collect($dateHeader);

    // dd( $allDateHeader); date('Y-m-d',strtotime($value->created_at))

    // $resultMontly = array_filter($data, function($element) use ($start_month_date, $end_date){

    //     return $element['PostingDate'] <= $end_date && $element['PostingDate'] >= $start_month_date;
    // });

        $userSheet = [];

        $getUserTimesheet = Timesheet::where('GenEntityID', $id)->whereBetween('timesheets.created_at', [$dateStart, $dateEnd])->orderBy('created_at', 'asc')->get();
        
        $newTimesheet = $getUserTimesheet->toArray();

        $userSheet = call_user_func_array("array_merge", $newTimesheet);

        

// dd($userSheet);
// dd(($userSheet['created_at']));
// dd(date_create($userSheet['created_at']), 'Y-m-d');

        // $keys = array_values($allDateHeader);


        // $diff = array_diff($keys, $userSheet);

        // dd($allDateHeader);


//         foreach ($keys as $k)
//         {
//             // dd(gettype($k));
//             // dd(gettype( date('Y-m-d',strtotime($userSheet['created_at']))));

//             // $date = date('Y-m-d',strtotime($userSheet['created_at']));

//             dd($k);
//             // dd(array_values($userSheet));
//             // dd(date_create($userSheet['created_at']), 'Y-m-d');

//             if (!isset(date_format(date_create($userSheet['created_at']), 'Y-m-d')[$k] )) date_format(date_create($userSheet['created_at']), 'Y-m-d')[$k] = '0';
//             // if (!isset($userSheet['created_at'][$k])) $userSheet['created_at'][$k] = '0';

//             // dd($getUserTimesheet);
// //             foreach ($getUserTimesheet as $key => $value) {
// // dd($k);
// //                 dd(date('Y-m-d',strtotime($value->created_at)));
// //                 if (!is_null(date('Y-m-d',strtotime($value->created_at))[$k])) date('Y-m-d',strtotime($value->created_at))[$k] = '0';

// //             }
//         }


        // foreach ($getUserTimesheet as $key => $value) {
            
        //     if(!isset($allDateHeader[date('Y-m-d',strtotime($value->created_at))])) $value = 0;
        // }

        // dd(gettype($allDateHeader));




        // dd( array_values() $getUserTimesheet->toArray());

        // $newTimesheet = $getUserTimesheet->toArray();

        // $arrayColumn = array_column($newTimesheet, 'created_at');

        // dd(array_column($newTimesheet, 'created_at'));

        // dd(date('Y-m-d',strtotime($arrayColumn)));
        // $dt = [];

        // foreach ($arrayColumn as $key => $value) {
            
        //     array_push($dt, date('Y-m-d',strtotime($value)));
        // }
        // dd($dt);


        // dd( array_diff($allDateHeader, $dt) );
        // $keys = array_keys($allDateHeader);
        // foreach ($allDateHeader as $k)
        // {
        //     if (!isset($a2[$k])) $a2[$k] = '0';
        // }
        // print_r($a2);



        // foreach ($getUserTimesheet as $key => $value) {
            

        //     // dd($value);

        //     $result = array_filter($allDateHeader, function($element) use ($value){

        //         // return $element['PostingDate'] <= $end_date && $element['PostingDate'] >= $start_month_date;
        //     });




        //   $data =  in_array(date('Y-m-d',strtotime($value->created_at)),  $allDateHeader)  ? $value->time_worked : '-';

        //     array_push($userSheet, $data);
        // }
        // dd($userSheet);

        // dd(gettype($getUserTimesheet));

        return view('view-timesheet', compact('getUserTimesheet', 'user', 'allDateHeader'));

        dd($getUserTimesheet);

        // $getUserTimesheet = Timesheet::where('GenEntityID', $id)->get();
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

