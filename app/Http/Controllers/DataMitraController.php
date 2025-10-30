<?php

namespace App\Http\Controllers;

use App\Models\DataMitra; 
use Illuminate\Http\Request;

class DataMitraController extends Controller
{
    public function list_data_mitra()
    {
        $datadm = DataMitra :: all();
        return view('pendaftaran.list_data', compact('datadm'));

    }
    
}
