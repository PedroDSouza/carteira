<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AtivosFinanceirosController;
use App\Http\Controllers\AtivoController;
use Illuminate\Support\Facades\DB;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// rota para o Controller AtivosFinanceirosController
Route::get('dashboard', [AtivosFinanceirosController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');




//Route::get('dashboard', function () {
//    $data = DB::table('ativos_financeiros')->get();

//     return view('dashboard', ["data" => $data]);
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', function () {
    return view('auth.login');
});

 //Route::get('/dashboard', function () {
 //   return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');



Route::get('/ativo', function () {
    return view('ativo');
})->middleware(['auth', 'verified'])->name('ativo'); 

Route::get('criarativo', [AtivoController::class, 'create'])->middleware(['auth', 'verified'])->name('criarativo');

Route::match(['get', 'post'], 'deletarativo', [AtivoController::class, 'destroy'])->middleware(['auth', 'verified'])->name('deletarativo');

Route::post('editarativo', [AtivoController::class, 'update'])->middleware(['auth', 'verified'])->name('editarativo');




Route::get('/deletar', function () {
    return view('deletar');
})->middleware(['auth', 'verified'])->name('deletar'); 


Route::get('/transação', function () {
    return view('transacao');
})->middleware(['auth', 'verified'])->name('transacao');


//Rotas da API (Ela deve suportar os métodos GET para abrir, e POST para pesquisar os preços)
Route::get('/api',function () {
    return view('api');
})->middleware(['auth', 'verified'])->name('api');

Route::post('/api', function () {
        return view('api');
})->middleware(['auth', 'verified'])->name('api');
//-------------------------------------------------------------------------------------------

// ...

Route::post('/wallet/update-name', function(Request $request) {
    // Obtenha o ID da carteira e o novo nome da carteira
    $id = $request->input('id');
    $name = $request->input('name');

    // Atualize o nome da carteira no banco de dados
    DB::table('wallet')
        ->where('id', $id)
        ->update(['nome' => $name]);

    // Retorne o novo nome da carteira para a página
    return response()->json(['name' => $name]);
});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__.'/auth.php';
