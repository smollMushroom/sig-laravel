<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        $list_province = Province::all();
        return view('beranda.index', [
            'title' => 'Peta Indonesia',
            'list_province' => $list_province
        ]);
    }
}
