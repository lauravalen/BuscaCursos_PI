<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\ModelAdministrador;

use Carbon\Carbon;

class ControllerAdministrador extends Controller
{
public function store(Request $request)
    {
      
        ModelAdministrador::create([
            'ADM_STR_NOME' => $request->ADM_STR_NOME,
            'ADM_STR_EMAIL'        => $request->ADM_STR_EMAIL,
            'ADM_STR_CPF'  => $request->ADM_STR_CPF,
            'ADM_STR_SENHA' => Hash::make($request->ADM_STR_SENHA),
            'ADM_STR_DATAINSERCAO' => now(),
            'ADM_INT_SITUACAO' => 1, // ativo
        ]);

            return view('adm.cadastros.CadAdm');

    }



}
