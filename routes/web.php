<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ControllerAdministrador;
use App\Http\Controllers\ControllerUsuario;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\ControllerFavorito;
use App\Http\Controllers\ControllerPlataforma;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [CursoController::class, 'welcome']);


//Cadastros

Route::post('/CadastroUser', [ControllerUsuario::class, 'store'])->name('cadastro.store');

//logins deslogar
Route::post('/loginUser', [ControllerUsuario::class, 'loginUser'])->name('login.submit');
Route::post('/logout', [ControllerUsuario::class, 'logout'])->name('logout');

//cursos
Route::get('/Cursos', [CursoController::class, 'index'])->name('cursos.index');

Route::get('/cursos/filtrar', [CursoController::class, 'aplicarFiltros'])->name('cursos.filtrar');

Route::get('/cursos/limpar', [CursoController::class, 'limparFiltros'])->name('cursos.limpar');

// Buscar feedbacks de um curso
Route::get('/cursos/{id}/feedbacks', [CursoController::class, 'feedbacksCurso']);

// Salvar feedback
Route::post('/feedbacks/salvar', [CursoController::class, 'salvarFeedback'])
    ->name('cursos.avaliar');


//favoritos
Route::post('/favoritos/{cursoId}/toggle', [ControllerFavorito::class, 'toggle'])->name('favoritos.toggle');

//perfil
Route::get('/perfil', [ControllerFavorito::class, 'index']);


//Links das paginas
Route::get('/quem-somos', function () {
    return view('pages.quemSomos');
});

Route::get('/Login', function () {
    return view('pages.login');
});

// Route::get('/Cadastro', function () {
//     return view('pages.Cadastro');
// });

Route::get('/Cadastro', [ControllerUsuario::class, 'cadastroUser'])->name('cadastro.user');


Route::get('/ApoieProjeto', function () {
    return view('pages.apoieProjeto');
});

Route::get('/faq', function () {
    return view('pages.faq');
});

Route::get('/TesteVocacional', function () {
    return view('pages.testeVocac');
});





// -- Pagina de Administração --//

Route::get('/HomeAdm', function () {
    return view('adm.index');
});

Route::get('/perfilAdm', function () {
    return view('adm.PerfilAdm');
});

// Route::get('/CursoAdm', function () {
//     return view('adm.CursoAdm');
// });



Route::get('/UserAdm', [ControllerUsuario::class, 'index']);



Route::get('/PlataformaAdm', [ControllerPlataforma::class, 'index']);


//pages cadastro

Route::get('/CursoAdm', [CursoController::class, 'indexAdm'])->name('curso.indexadm');

Route::get('/CadCurso', [CursoController::class, 'create'])->name('curso.create');
Route::post('/curso/salvar', [CursoController::class, 'store'])->name('curso.store');

// EDITAR
Route::get('/Curso/{id}/editar', [CursoController::class, 'edit'])->name('curso.edit');
Route::post('/Curso/{id}/editar', [CursoController::class, 'update'])->name('curso.update');

// DESATIVAR
Route::post('/Curso/{id}/desativar', [CursoController::class, 'desativar'])->name('curso.desativar');

//

// Route::get('/CadPlataforma', function () {
//     return view('adm.cadastros.CadPlataforma');
// });

Route::get('CadPlataforma', [ControllerPlataforma::class, 'create'])
    ->name('plataforma.create');

Route::post('/plataforma/salvar', [ControllerPlataforma::class, 'store'])
    ->name('plataforma.store');



// Route::get('/CadUser', function () {
//     return view('adm.cadastros.CadUser');
// });
Route::get('/CadUser', [ControllerUsuario::class, 'create'])->name('cadastro.user');
Route::post('/cadastro/salvar', [ControllerUsuario::class, 'storeAdm'])->name('cadastro.storeAdm');

Route::post('/User/{id}/desativar', [CursoController::class, 'desativar'])->name('user.desativarUser');


Route::get('/CadAdm', function () {
    return view('adm.cadastros.CadAdm');
});

Route::post('/CadastroADM', [ControllerAdministrador::class, 'store'])->name('cadastroAdm.store');


