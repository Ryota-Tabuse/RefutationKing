<?php

namespace App\Http\Controllers;

use App\Thema;
use Illuminate\Http\Request;

class ThemaController extends Controller
{
    public function index()
    {   
        $themes = Thema::all();

        return view('themes',[
            'themes' => $themes,
        ]);
    }
}
