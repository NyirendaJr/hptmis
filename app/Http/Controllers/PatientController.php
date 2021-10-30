<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PatientController extends Controller
{
    public function index()
    {
        Return Inertia::render('Patients/Patients');
    }

    public function create()
    {
        return Inertia::render('Patients/RegisterPatient');
    }
}
