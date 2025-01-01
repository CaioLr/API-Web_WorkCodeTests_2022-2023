<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Hash;
use Session;

class UserAuth extends Controller
{
    
    public function newCadastro(Request $request){

        $request->validate([ //validação
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'conf_email' => 'required',
            'password' => 'required|min:5|max:20'
        ]);
        
        if($request->email != $request->conf_email){ //retorno especifico de erro
            return redirect('/new')->with('fail','Confirmação de e-mail diferente!');
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $res = $user->save();

        if($res){
            return redirect('/');
        }
        return redirect('/')->with('fail','Erro ao registrar!'); //caso ocorra erro ao inserir no BD

    }

    public function login(Request $request){


        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:20'
        ]);

        $user = User::where('email','=',$request->email)->first();


        if($user){ //verificação da existência do usuário e validação da senha
            if(Hash::check($request->password,$user->password)){
                $request->session()->put('userId',$user->id);
                return redirect('/home');
            }else{
                return redirect('/')->with('fail','Usuário ou senha inválidos!');
            }
        }else{
            return redirect('/')->with('fail','Usuário ou senha inválidos!');
        }

    }

    public function logout(Request $request): RedirectResponse{ 

        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
