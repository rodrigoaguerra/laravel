<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/request', function (\Illuminate\Http\Request $request) {
    $r = $request->query("keyword");

    // if($r) {
    //     dd('Faça alguma coisa');
    // }
    
    dd($r);
    return 'x';
});

Route::get('/user/{user:email}', function (App\Models\User $user) {
    return $user;
});

Route::prefix('usuarios')->group(function(){
    Route::get("", function(){
        return 'Usuários';
    })->name('usuarios');

    Route::get("/{id}", function($id){
        return 'Mostrar detalhes: '. $id;
    })->name('usuarios.show');

    Route::get("/{id}/tags", function($id){
        return 'Tags usuário: '. $id;
    })->name('usuarios-tags');
});

Route::get('/a-empresa/{string?}', function ($string = null) {
    return $string;
    // return view('welcome');
});

Route::get('/users/{paramA}/{paramB}', function ($paramB, $paramA) {
    return $paramA . '-' . $paramB;
});
