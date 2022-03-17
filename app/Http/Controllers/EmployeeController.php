<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;

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
}
