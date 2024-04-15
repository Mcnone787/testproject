<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Curso;
use App\Models\Recurso;


class RecursoController extends Controller
{
    

    function recursoIndex($id){
        $curso = Curso::with('recursos')->findOrFail($id);
        $recursosRelacionados = $curso->recursos;
        return Inertia::render('Recursos', [
            'recursosRelacionados' => $recursosRelacionados,
            'id_curso'=>$id
            
        ]);
    }
    function createrecurso(Request $request){
        $curso = Curso::findOrFail($request["id_curso"]);

        $recursoData = [
            'nombre' => $request->nombre,
            // otros campos del recurso
        ];
      
        $recursoData = [
            'titulo' => $request["titulo"],
            'contenido'=>$request["contenido"],
            'visible'=>$request["visible"]
        ];
        $recurso = $curso->recursos()->create($recursoData);

        return response()->json([
            'success' => true,
            'message' => $request->all(),
        ]);
    }
    function getALlRecursos(Request $request){
        $curso = Curso::with('recursos')->findOrFail($request["id_curso"]);
        $recursosRelacionados = $curso->recursos;
        return response()->json([
            'success' => true,
            'message' => $recursosRelacionados,
        ]);

    }
    function editRecurso(Request $request){
        $item = Recurso::findOrFail($request["idRecurso_"]); // Asegúrate de usar el modelo correcto
        $item->titulo=$request["titulo"];
        $item->contenido=$request["contenido"];
        $item->visible=$request["visible"];
        $item->save();
        return response()->json([
            'success' => true,
            'message' => $request->all(),
        ]);
    }

    function loadRecruso(Request $request){
        $recurso=Recurso::find($request["idRecurso"]);
        return response()->json([
            'success' => true,
            'message' => $recurso,
        ]);
    }
function Recursos_Users($id){
    
    $curso = Curso::with(['recursos' => function ($query) {
        $query->where('visible', 1);
    }])->findOrFail($id);
    
    $recursosVisibles = $curso->recursos;
    return Inertia::render('Recursos_Users', [
        'recursosRelacionados' => $recursosVisibles,
        'id_curso'=>$id
        
    ]);
}

function infoRecurso($id){
    
    $recurso = Recurso::find($id);
    
    return Inertia::render('infoRecursoUser', [
        'recurso' => $recurso,
        
    ]);
}

    function deleteRecurso(Request $request){        

        $recurso = Recurso::find($request["idRecurso_"]); // Encuentra el recurso por su ID
      
        $recurso->delete();
        return response()->json([
            'success' => true,
            'message' => "bien",
        ]);
    }
}
