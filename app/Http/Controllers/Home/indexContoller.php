<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class indexContoller extends Controller
{
    public function Index() {
       return view('layouts.Backend.Index.index');
    }
}
