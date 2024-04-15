<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class RecursoController extends Controller
{
    function recursoIndex(Request $request){
        return Inertia::render('Recursos');
    }
}
