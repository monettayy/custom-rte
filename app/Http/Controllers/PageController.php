<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.dashboard');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function customRTE()
    {
        return view('pages.custom.rte');
    }
}
