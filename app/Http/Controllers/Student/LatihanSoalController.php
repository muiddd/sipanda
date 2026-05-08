<?php
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

class LatihanSoalController extends Controller
{
    public function index()
    {
        return view('student.latihansoal');
    }
}