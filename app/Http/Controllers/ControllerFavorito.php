<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelFavorito;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Models\ModelHistorico;
use App\Models\ModelCurso;


class ControllerFavorito extends Controller{

  public function index()
{
    $usuario = session('usuario');

    // Favoritos
    $favoritos = ModelFavorito::with([
        'curso.areaCategoria.categoria'
    ])
    ->where('USU_INT_ID', $usuario->USU_INT_ID)
    ->where('FAV_INT_ATIVO', 1)
    ->get();

    // Recentes
    $recentes = ModelHistorico::with([
        'curso.areaCategoria.categoria'
    ])
    ->where('USU_INT_ID', $usuario->USU_INT_ID)
    ->where('HIS_STR_DESCRICAO', 'Acessou o curso')
    ->orderBy('HIS_STR_INSERCAO', 'DESC')
    ->limit(8)
    ->get()
    ->pluck('curso')
    ->filter()
    ->values();

    return view('pages.Perfil', compact('favoritos', 'recentes'));
}




    public function toggle($cursoId){
        if (!Session::has('usuario')) {
            return redirect('/Login')->with('error', 'Você precisa estar logado para favoritar cursos.');
        }

        $usuario = Session::get('usuario');

        $favorito = ModelFavorito::where('CUR_INT_ID', $cursoId)
            ->where('USU_INT_ID', $usuario->USU_INT_ID)
            ->first();

        if ($favorito) {
            // alterna entre ativo e inativo
            $novoStatus = $favorito->FAV_INT_ATIVO ? 0 : 1;
            $favorito->update(['FAV_INT_ATIVO' => $novoStatus]);
        } else {
            // cria novo favorito ativo
            ModelFavorito::create([
                'USU_INT_ID' => $usuario->USU_INT_ID,
                'CUR_INT_ID' => $cursoId,
                'FAV_STR_DATAINSERCAO' => Carbon::now()->format('Y-m-d H:i:s'),
                'FAV_INT_ATIVO' => 1
            ]);
        }

        return back();
    }

}
