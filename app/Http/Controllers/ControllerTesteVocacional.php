<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelCurso;
use App\Models\ModelCategoria;
use App\Models\ModelTesteVocacional;

class ControllerTesteVocacional extends Controller
{
    public function processarResultado(Request $request)
    {
        $area = $request->area;
        $pontuacao = $request->pontuacao ?? 0;

        $usuarioId = session('usuario')->USU_INT_ID;

        // Encontrar a categoria
        $categoria = ModelCategoria::where('CAT_STR_AREA', $area)->first();

        if (!$categoria) {
            return response()->json(['erro' => 'Categoria não encontrada'], 404);
        }

        // Salvar no banco TESTE_VOCACIONAL
        ModelTesteVocacional::create([
            'USU_INT_ID' => $usuarioId,
            'CAT_INT_ID' => $categoria->CAT_INT_ID,
            'TES_INT_PONTUACAO' => $pontuacao,
        ]);

        return redirect()->route('cursos.filtrar', ['area' => $area]);

    }
}
