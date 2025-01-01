<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class BoardsController extends Controller
{
    public function newBoard(Request $request){

        $board_name = $request->board_name;

        $boards_names = [];
        $user_id = session()->get('userId');
        $boards = \DB::table('boards')->where('user_id', $user_id)->get();

        foreach ($boards as $board) {
            array_push($boards_names,$board->name);
        }


        if(in_array($board_name,$boards_names)){ //caso já exista do mesmo usuário
            return view('home',["boards_names"=>$boards_names,"select_board"=>$board_name, "tasks"=>null]);
        }
        //inserindo novo board no BD
        \DB::table('boards')->insert([
            'user_id'  => $user_id,
            'name' => $board_name,
        ]);

        return view('home',["boards_names"=>$boards_names,"select_board"=>$board_name, "tasks"=>null]);

    }

    public function deleteBoard(Request $request){

        $board_id = $request->session()->get('boardId');
        //deletando board e tasks vinculadas no BD
        \DB::table('boards')->where('id', '=', $board_id)->delete();

    }

    public function getBoard(String $board_name, Request $request){

        $boards_names = [];
        $user_id = session()->get('userId');
        $boards = \DB::table('boards')->where('user_id', $user_id)->get();

        //carrega os boards vindos do BD e coloca informação necessária na session
        foreach ($boards as $board) {
            array_push($boards_names,$board->name);
            if($board_name == $board->name){
                $request->session()->put('boardId',$board->id);
                $request->session()->put('boardName',$board->name);
            }
        }

        $board_id = $request->session()->get('boardId');
        $tasks = \DB::table('tasks')->where('board_id', $board_id)->get();

        if(in_array($board_name,$boards_names)){ //caso o board exista no BD
            return view('home',["boards_names"=>$boards_names, "select_board"=>$board_name, "tasks"=>$tasks]);
        }
        //caso o board não exista no BD
        return view('home',["boards_names"=>$boards_names,"select_board"=>"", "tasks"=>null]);
    }
}
