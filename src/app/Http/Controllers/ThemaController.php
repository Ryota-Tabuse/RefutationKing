<?php

namespace App\Http\Controllers;

use App\Thema;
use App\Http\Requests\CreateThema;

class ThemaController extends Controller
{
    public function index()
    {
        $themes = Thema::all();

        return view('themes/themes', [
            'themes' => $themes,
        ]);
    }

    public function showCreateForm()
    {
        return view('themes/create', []);
    }

    public function createThema(CreateThema $request)
    {
        //インスタンス化
        $thema = new Thema();
        $thema->name = $request->name;
        $thema->option_a = $request->option_a;
        $thema->option_b = $request->option_b;
        $thema->save();

        $themes = $themes = Thema::all();

        return view('themes/themes', [
            'themes' => $themes,
        ]);
    }
}
