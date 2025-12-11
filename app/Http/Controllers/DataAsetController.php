<?php

namespace App\Http\Controllers;

use App\Models\DataAset;
use Illuminate\Http\Request;

class DataAsetController extends Controller
{
    public function list_data_aset()
    {
        $datada = DataAset::all();
        return view('pendaftaran.list_data', compact('datada'));

    }

}

