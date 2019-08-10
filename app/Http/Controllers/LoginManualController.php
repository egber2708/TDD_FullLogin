<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\CreateUserPost;
use App\Http\Requests\UpdateUserPatch;

class LoginManualController extends Controller
{
    use AuthenticatesUsers;

    public $maxAttempts= 3; // Numero de intentos
    public $decayMinutes= 25; // Tiempo de espera despues de los 25 minutos.


    public function create(CreateUserPost $request){
        User::create($request->only('name','email','password'));
    }

    public function update(User $user, UpdateUserPatch $request){
        $user->update($request->only('name','email','password'));
    }

}
