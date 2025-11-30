<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function form_pendaftaran()
    {
        return view("pendaftaran.form_data_diri");
    }

    public function list_data()
    {
        return view("pendaftaran.list_data");
    }

    public function edit()
    {
        return view("pendaftaran.form_edit");
    }

    public function perjanjian()
    {
        return view("pendaftaran.perjanjian_event"); 
    }
    public function data_perjanjian()
    {
        return view("list_data.data_perjanjian");
    }
}

