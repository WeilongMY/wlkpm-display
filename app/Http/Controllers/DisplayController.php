<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DisplayController extends Controller
{
    public function index()
    {
        return view('config.display.index');
    }
}
