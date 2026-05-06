<?php
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('usuario', [AuthController::class, 'usuario']);
    
    Route::get('empresa', function() {
        $user = auth('api')->user();
        $usuarios = \App\Models\User::where('tenant_id', $user->tenant_id)->get();
        return response()->json([
            'mi_tenant' => $user->tenant_id,
            'usuarios_de_mi_empresa' => $usuarios
        ]);
    });
});