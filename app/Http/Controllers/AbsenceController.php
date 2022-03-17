<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use Illuminate\Http\Request;

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
}
