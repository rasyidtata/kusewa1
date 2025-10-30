<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function beranda()
    {
        return view("home.beranda");
    }

    public function form_pendaftaran()
    {
        return view("pendaftaran.form_data_diri");
    }

    public function list_data()
    {
        return view("pendaftaran.list_data");
    }

    public function list_perjanjian()
    {
        return view("pendaftaran.list_perjanjian");
    }

    public function perjanjian()
    {
        return view("pendaftaran.perjanjian");
    }
}

