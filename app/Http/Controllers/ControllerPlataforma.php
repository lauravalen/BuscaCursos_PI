<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelPlataforma;
use App\Models\ModelAdministrador;

class ControllerPlataforma extends Controller
{
    
public function index()
    {
        $adms = ModelAdministrador::where('ADM_INT_SITUACAO', 1)->get();
        $plats = ModelPlataforma::orderBy('PLA_STR_NOME')->paginate(4);

        return view('adm.plataformaaAdm', compact('plats', 'adms'));

    }

    public function create()
    {
        $administradores = ModelAdministrador::where('ADM_INT_SITUACAO', 1)->get();

        return view('adm.cadastros.CadPlataforma', compact('administradores'));
    }

    // Salva no banco
    public function store(Request $request)
    {
        $request->validate([
            'ADM_INT_ID' => 'required|exists:ADMINISTRADOR,ADM_INT_ID',
            'PLA_STR_NOME' => 'required|max:80',
            'PLA_STR_URL' => 'required|max:255|url',
            'PLA_STR_DESC' => 'required|max:350',
            'PLA_INT_QUANTCURSO' => 'required|integer|min:0',
        ]);

        ModelPlataforma::create([
            'ADM_INT_ID' => $request->ADM_INT_ID,
            'PLA_STR_NOME' => $request->PLA_STR_NOME,
            'PLA_STR_URL' => $request->PLA_STR_URL,
            'PLA_STR_DESC' => $request->PLA_STR_DESC,
            'PLA_INT_QUANTCURSO' => $request->PLA_INT_QUANTCURSO,
        ]);

    return view('adm.plataformaaAdm');
    }
}
