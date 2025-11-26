<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelFavorito;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class ControllerFavorito extends Controller{

   public function index(){
        $usuario = session('usuario');

        // Busca apenas os favoritos do usuário logado
    $favoritos = ModelFavorito::with('curso')
        ->where('USU_INT_ID', $usuario->USU_INT_ID)
        ->where('FAV_INT_ATIVO', 1)
        ->get();

        return view('pages.Perfil', compact('favoritos'));
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
