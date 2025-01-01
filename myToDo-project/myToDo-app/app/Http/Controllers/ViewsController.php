<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserAuth;
use Illuminate\Http\Request;
use Auth;

use Illuminate\Support\Facades\Validator;
use Hash;

class ViewsController extends Controller
{
    public function index(){

        if(session()->has('userId')){// verificação se já está logado

            return redirect('/home');
        }

        return view('index');
   
    }

    public function cadastro(){

        return view('cadastro');
    }

    public function home(){

        if(session()->has('userId')){// verificação se já está logado

            $boards_names = [];
            $user_id = session()->get('userId');
            $boards = \DB::table('boards')->where('user_id', $user_id)->get();

            foreach ($boards as $board) { //carregando boards existêntes no BD do usuário
                array_push($boards_names,$board->name);
            }

            return view('home',["boards_names"=>$boards_names,"select_board"=>"", "tasks"=>null]);
        }

        return redirect('/');
        
   }
}
