<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $contents = [
            [
                'title' => 'Crea',
                'description' => 'Scegli i giorni ',
            ],
            [
                'title' => 'Pianifica',
                'description' => 'Registra le tue tappe',
            ],
            [
                'title' => 'Vedi',
                'description' => 'Visualizza tutte le tue tappe',
            ]
        ];

        return view('admin.dashboard', compact('contents'));
    }

}
