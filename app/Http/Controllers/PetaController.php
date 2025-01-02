<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class PetaController extends Controller
{
    public function index()
    {
        $list_province = Province::all();
        return view('peta.index', [
            'title' => 'Peta Indonesia',
            'list_province' => $list_province
        ]);
    }
}
