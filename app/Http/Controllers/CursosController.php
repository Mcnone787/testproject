<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
class CursosController extends Controller
{
    
    function createcurso(Request $request){

        $curso=new Curso;
        $curso->nombre=$request["nombre"];
        $curso->etapa=$request["etapa"];
        $curso->descripcion=$request["descripcion"];
        $curso->visible=$request["visible"];
        $curso->save();

        return response()->json([
            'success' => true,
            'message' => $curso,
        ],201);
    }
    
    function getALlCursos(){
        $cursoModel=new Curso;
        $cursos=$cursoModel->all();
        return response()->json([
            'success' => true,
            'message' => $cursos,
        ]);
    }
    
}
