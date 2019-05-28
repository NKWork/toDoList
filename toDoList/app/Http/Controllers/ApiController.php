<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index()
    {
        return DB::table('tasks')->get();
    }
}
