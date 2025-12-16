<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ModelUsuario;

use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\ModelEstado;
use App\Models\ModelCidade;
use App\Models\ModelGenero;
use App\Models\ModelAreaAtuacao;
use App\Models\ModelAdministrador;


class ControllerUsuario extends Controller
{

    public function create()
    {
        $estados = ModelEstado::all();
        $cidades = ModelCidade::all();
        $generos = ModelGenero::all();
        $areas   = ModelAreaAtuacao::all();

        return view('adm.cadastros.CadUser', compact('estados', 'cidades', 'generos', 'areas'));
    }
    public function index()
    {
        $estados = ModelEstado::all();
        $cidades = ModelCidade::all();
        $generos = ModelGenero::all();
        $areas   = ModelAreaAtuacao::all();
        $users = ModelUsuario::orderBy('USU_STR_NOME')->paginate(4);

        return view('adm.UserAdm', compact('estados', 'cidades', 'generos', 'areas', 'users'));
    }

    public function cadastroUser()
    {
        $estados = ModelEstado::all();
        $cidades = ModelCidade::all();
        $generos = ModelGenero::all();
        $areas   = ModelAreaAtuacao::all();
        $users = ModelUsuario::orderBy('USU_STR_NOME')->paginate(4);

        return view('pages.Cadastro', compact('estados', 'cidades', 'generos', 'areas', 'users'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'senha_confirmacao' => 'required|same:USU_STR_SENHA'
        ]);

        $usuario = new ModelUsuario();

        $usuario->USU_STR_NOME       = $request->USU_STR_NOME;
        $usuario->USU_STR_EMAIL      = $request->USU_STR_EMAIL;

        $usuario->EST_INT_ID         = $request->EST_INT_ID;
        $usuario->CID_INT_ID         = $request->CID_INT_ID;
        $usuario->GEN_INT_ID         = $request->GEN_INT_ID;
        $usuario->AAT_INT_ID         = $request->AAT_INT_ID;

        $usuario->USU_STR_SENHA      = Hash::make($request->USU_STR_SENHA);
        $usuario->USU_STR_INSERCAO   = Carbon::now();
        $usuario->USU_INT_SITUACAO   = 1;

        $usuario->save();

        return redirect('/Login')->with('success', 'Cadastro realizado com sucesso!');
    }

    public function storeAdm(Request $request)
    {
        $request->validate([
            'senha_confirmacao' => 'required|same:USU_STR_SENHA'
        ]);

        $usuario = new ModelUsuario();

        $usuario->USU_STR_NOME       = $request->USU_STR_NOME;
        $usuario->USU_STR_EMAIL      = $request->USU_STR_EMAIL;

        $usuario->EST_INT_ID         = $request->EST_INT_ID;
        $usuario->CID_INT_ID         = $request->CID_INT_ID;
        $usuario->GEN_INT_ID         = $request->GEN_INT_ID;
        $usuario->AAT_INT_ID         = $request->AAT_INT_ID;

        $usuario->USU_STR_SENHA      = Hash::make($request->USU_STR_SENHA);
        $usuario->USU_STR_INSERCAO   = Carbon::now();
        $usuario->USU_INT_SITUACAO   = 1;

        $usuario->save();

        return redirect('/CadUser')->with('success', 'Cadastro realizado com sucesso!');
    }

   public function loginUser(Request $request)
{
    // 1. Tenta encontrar um ADMINISTRADOR
    $admin = \App\Models\ModelAdministrador::where('ADM_STR_EMAIL', $request->email)->first();

    if ($admin && Hash::check($request->senha, $admin->ADM_STR_SENHA)) {
        Session::put('admin', $admin);
        return redirect('/CursoAdm'); 
    }

    // 2. Tenta encontrar um USUÁRIO NORMAL
    $usuario = ModelUsuario::where('USU_STR_EMAIL', $request->email)->first();

    if ($usuario && Hash::check($request->senha, $usuario->USU_STR_SENHA)) {
        Session::put('usuario', $usuario);
        return redirect('/perfil');
    }

    // 3. Se não for nem ADM nem usuário comum
    return back()->with('erro', 'Credenciais inválidas!');
}




    // Faz logout
    public function logout()
    {
        Session::forget('usuario');
        Session::forget('admin');
        return redirect('/Login');
    }


    public function desativar(Request $request, $id)
    {
        $user = ModelUsuario::findOrFail($id);

        $user->USU_INT_SITUACAO = 0;

        $user->save();

        return redirect('/CadUser')->with('success', 'Cadastro realizado com sucesso!');
    }
}
