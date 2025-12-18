<?php

namespace App\Http\Controllers;

use App\Models\ModelCurso;
use App\Models\ModelComentario;
use App\Models\ModelAreaCategoria;
use App\Models\ModelCategoria;
use Carbon\Carbon;
use App\Models\ModelHistorico;
use Illuminate\Http\Request;

class CursoController extends Controller
{

    public function welcome()
    {
        $categorias = ModelCategoria::all()->take(8);

        return view('welcome', compact('categorias'));
    }

    public function index(Request $request)
    {
        $query = ModelCurso::with(['areaCategoria.categoria', 'plataformas', 'favoritos'])
        ->where('CUR_INT_SITUACAO', 1);
        
        // BUSCA POR TEXTO
        if ($request->filled('busca')) {
            $texto = $request->busca;

            $query->where(function ($q) use ($texto) {
                $q->where('CUR_STR_TITULO', 'LIKE', "%$texto%")
                    ->orWhere('CUR_STR_DESC', 'LIKE', "%$texto%")

                    // Busca por categoria
                    ->orWhereHas('areaCategoria.categoria', function ($cat) use ($texto) {
                        $cat->where('CAT_STR_DESC', 'LIKE', "%$texto%");
                    });
            });
        }

        // BUSCA PELA ÁREA (vinda do teste vocacional)
        if ($request->filled('area')) {
            $area = $request->area;

            $query->whereHas('areaCategoria.categoria', function ($q) use ($area) {
                $q->where('CAT_STR_AREA', $area);
            });
        }

        $cursos = $query->paginate(6)->appends($request->all());
        $categorias = \App\Models\ModelCategoria::all();

        return view('pages.pagesCursos', compact('cursos', 'categorias'));
    }



    public function feedbacksCurso($id)
    {

        $comentarios = ModelComentario::where('CUR_INT_ID', $id)
            ->where('COM_INT_SITUACAO', 1)
            ->orderBy('COM_INT_ID', 'DESC')
            ->get();

        // média
        $media = $comentarios->avg('COM_INT_AVALIACAO');

        // transformando para JSON do JS
        $feedbacks = $comentarios->map(function ($c) {
            return [
                'usuario' => $c->usuario ? $c->usuario->USU_STR_NOME : 'Usuário',
                'texto' => $c->COM_STR_COMENTARIO,
                'nota' => $c->COM_INT_AVALIACAO,
            ];
        });

        return response()->json([
            'feedbacks' => $feedbacks,
            'avaliacao' => $media !== null ? round(floatval($media), 1) : null
        ]);
    }


    public function salvarFeedback(Request $request)
    {
        // Verifica usuário logado — agora bate com o que sua view usa
        if (!$request->session()->has('usuario')) {
            return response()->json(['error' => 'Faça login para comentar!'], 401);
        }

        $user = $request->session()->get('usuario');

        ModelComentario::create([
            'USU_INT_ID' => $user->USU_INT_ID,
            'CUR_INT_ID' => $request->curso_id,
            'COM_STR_COMENTARIO' => $request->comentario,
            'COM_INT_AVALIACAO' => $request->avaliacao,
            'COM_STR_DATAPUBLICACAO' => now(),
            'COM_INT_SITUACAO' => 1
        ]);

        return redirect()->route('cursos.index');
    }



    public function aplicarFiltros(Request $request)
    {

        $query = ModelCurso::with(['areaCategoria.categoria', 'plataformas', 'favoritos'])
        ->where('CUR_INT_SITUACAO', 1);

        // FILTRO POR CATEGORIA
        if ($request->filled('categoria')) {
            $categorias = $request->categoria;

            $query->whereHas('areaCategoria.categoria', function ($q) use ($categorias) {
                $q->whereIn('CAT_INT_ID', $categorias);
            });
        }

        // FILTRO POR CERTIFICAÇÃO
        if ($request->filled('certificacao')) {
            $query->whereIn('CUR_STR_CERTIFICACAO', $request->certificacao);
        }

        // FILTRO POR DURAÇÃO
        if ($request->filled('duracao')) {
            $query->where(function ($q) use ($request) {
                foreach ($request->duracao as $range) {
                    [$min, $max] = explode('-', $range);
                    $q->orWhereBetween('CUR_FLO_QUANTHORA', [$min, $max]);
                }
            });
        }

        // FILTRO POR AVALIAÇÃO
        if ($request->filled('avaliacao')) {
            $notas = $request->avaliacao; // agora é array

            $query->whereHas('feedbacks', function ($q) use ($notas) {
                $q->whereIn('COM_INT_AVALIACAO', $notas);
            });
        }

        // FILTRO POR ÁREA, vindo do teste vocacional
        if ($request->filled('area')) {
            $query->whereHas('areaCategoria.categoria', function ($q) use ($request) {
                $q->where('CAT_STR_AREA', $request->area);
            });
        }

        $cursos = $query->paginate(6)->appends($request->all());

        // categorias} para exibir na view
        $categorias = \App\Models\ModelCategoria::all();

        return view('pages.pagesCursos', compact('cursos', 'categorias'));
    }

    public function buscar(Request $request)
    {
        $texto = $request->get('q');

        $resultadosTitulo = ModelCurso::where('CUR_STR_TITULO', 'LIKE', "%$texto%")
            ->limit(5)
            ->pluck('CUR_STR_TITULO');

        $resultadosCategoria = \App\Models\ModelAreaCategoria::where('ACA_STR_NOME', 'LIKE', "%$texto%")
            ->limit(5)
            ->pluck('ACA_STR_NOME');

        return response()->json($resultadosTitulo->merge($resultadosCategoria));
    }


    public function limparFiltros()
    {
        return redirect()->route('cursos.index');
    }


    public function show($id)
    {
        $curso = ModelCurso::with(['areaCategoria', 'plataformas', 'favoritos'])->findOrFail($id);
        return response()->json($curso);
    }

    /*------adm-------*/

    public function indexAdm()
{
    $cursos = ModelCurso::orderBy('CUR_STR_TITULO')->paginate(5);

    // Quantidade total de cursos ativos
    $totalCursos = ModelCurso::count();

    // Quantidade de cursos desativados
    $cursosDesativados = ModelCurso::where('CUR_INT_SITUACAO', 0)->count();

    return view('adm.CursoAdm', compact('cursos', 'totalCursos', 'cursosDesativados'));
}


    public function create()
    {
        $areasCategorias = ModelAreaCategoria::with('categoria')
            ->where('ACA_INT_SITUACAO', 1)
            ->get();

        return view('adm.cadastros.CadCurso', compact('areasCategorias'));
    }

    public function store(Request $request)
    {

        ModelCurso::create([
            'CUR_STR_TITULO'       => $request->CUR_STR_TITULO,
            'CUR_STR_URL'          => $request->CUR_STR_URL,
            'ACA_INT_ID'           => $request->ACA_INT_ID,
            'CUR_STR_CERTIFICACAO' => $request->CUR_STR_CERTIFICACAO,
            'CUR_FLO_QUANTHORA'    => $request->CUR_FLO_QUANTHORA,
            'CUR_STR_DESC'         => $request->CUR_STR_DESC,
            'CUR_STR_DATAINICIO'   => $request->CUR_STR_DATAINICIO,
            'CUR_STR_NIVELENSINO'  => $request->CUR_STR_NIVELENSINO,
            'CUR_STR_INSERCAO'     => Carbon::now(),
            'CUR_INT_SITUACAO'  => 1,
        ]);

        return redirect()->route('/CursoAdm')->with('success', 'Curso cadastrado com sucesso!');
    }


    public function edit($id)
    {
        $curso = ModelCurso::findOrFail($id);
        return view('adm.editar.CursoEdit', compact('curso'));
    }


    public function update(Request $request, $id)
    {
        $curso = ModelCurso::findOrFail($id);

        $curso->CUR_STR_TITULO = $request->CUR_STR_TITULO;
        $curso->CUR_STR_URL = $request->CUR_STR_URL;
        $curso->CUR_STR_CERTIFICACAO = $request->CUR_STR_CERTIFICACAO;
        $curso->CUR_FLO_QUANTHORA = $request->CUR_FLO_QUANTHORA;
        $curso->CUR_STR_DESC = $request->CUR_STR_DESC;
        $curso->CUR_STR_DATAINICIO = $request->CUR_STR_DATAINICIO;
        $curso->CUR_STR_NIVELENSINO = $request->CUR_STR_NIVELENSINO;
        $curso->CUR_STR_INSERCAO = $request->CUR_STR_INSERCAO;

        $curso->save();

        return redirect('/CursoAdm')->with('success', 'Curso atualizado com sucesso!');
    }



    public function desativar($id)
    {
        $curso = ModelCurso::findOrFail($id);
        $curso->CUR_INT_SITUACAO = 0; // desativa
        $curso->save();

        return redirect('/CursoAdm')->with('success', 'Curso desativado com sucesso!');
    }

    public function registrarAcesso($id)
    {
        $curso = ModelCurso::findOrFail($id);

        // puxa o usuário corretamente da sessão
        $usuario = session('usuario');
        $usuarioId = $usuario ? $usuario->USU_INT_ID : null;

        if (!$usuarioId) {
            return redirect()->away($curso->CUR_STR_URL);
        }

        ModelHistorico::create([
            'HIS_STR_DESCRICAO' => 'Acessou o curso',
            'HIS_STR_INSERCAO' => now(),

            'PLC_INT_ID' => $curso->PLC_INT_ID ?: 1,
            'USU_INT_ID' => $usuarioId,
            'CUR_INT_ID' => $curso->CUR_INT_ID,
            'ACA_INT_ID' => $curso->ACA_INT_ID ?: 1,
        ]);

        return redirect()->away($curso->CUR_STR_URL);
    }
}
