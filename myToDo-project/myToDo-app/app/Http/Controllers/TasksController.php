<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function newTask(Request $request){

        \DB::table('tasks')->insert([ //nova task
            'board_id'  => $request->session()->get('boardId'),
            'checked' => 0,
            'text' => ""
        ]);
    }

    public function deleteTask(String $board_name, Int $id_order, Request $request){

        $board_id = $request->session()->get('boardId');
        $tasks = \DB::table('tasks')->where('board_id', $board_id)->get();

        $id_task = $tasks[$id_order]->id; //a task referente ao usuario que foi excluida

        \DB::table('tasks')->where('id', '=', $id_task)->delete(); //remove no BD

    }

    public function updateTask(Request $request){ //update do conteudo das tasks

        $board_id = $request->session()->get('boardId');
        $tasks = \DB::table('tasks')->where('board_id', $board_id)->get();
        $count = 0;
        foreach ($tasks as $task) {
            if($request->tasks[$count] != $task->text){ //caso tenha mudança de fato

                //se diferente de nulo recebe o texto, se nulo recebe vazio ("")
                $text_val = "";
                if ($request->tasks[$count] != "" || $request->tasks[$count] != null) $text_val = $request->tasks[$count];

                \DB::table('tasks')
                    ->where('id',$task->id)
                    ->update([
                        'text' => $text_val
                ]);
                
            }

            $count++;
        }

    }

    public function updateTaskChecked(Request $request){ //update da marcação das tasks

   

        $board_id = $request->session()->get('boardId');
        $tasks = \DB::table('tasks')->where('board_id', $board_id)->get();
        $count = 0;
        foreach ($tasks as $task) {
            //altera se true e 0 || false e 1 
            if( ($request->tasksChecked[$count] && $task->checked == 0) || (!$request->tasksChecked[$count] && $task->checked == 1)){

                $request->tasksChecked[$count] ? $checked_val = 1 : $checked_val = 0; //request vem como true ou false, transforma em int

                \DB::table('tasks')
                    ->where('id',$task->id)
                    ->update([
                        'checked' => $checked_val
                ]);
                
            }

            $count++;
        }

    }
}

