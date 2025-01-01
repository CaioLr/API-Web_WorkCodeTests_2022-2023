<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
     /**
     * @OA\Get(
     *      path="/api/restaurants",
     *      operationId="find_all",
     *      tags={"CRUD"},
     *      description="Busca todos os registros. É necessário o token de autentificação.",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      )
     * )
     */
    public function index(){
        try {
            $response = Restaurant::get();
        } catch (\Throwable $th) {
            return "Erro ao realizar a busca.";
        }
        return $response;
    }
    /**
     * @OA\Get(
     *      path="/api/restaurants/find",
     *      operationId="find",
     *      tags={"CRUD"},
     *      description="Busca 1 ou mais resgistros específicos. É necessário o token de autentificação.",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      )
     * )
     */
    public function find(Request $req){

        try {
            $body = $req->get('restaurant');

            $whereStatement = [];

            foreach ($body as $key => $value) {
                foreach ($value as $condition => $content) {
                    array_push($whereStatement,["$key","$condition","$content"]);
                }
                
            }

        
            $response = Restaurant::where($whereStatement)->get();
        } catch (\Throwable $th) {
            return "Erro ao realizar a(s) busca(s).";
        }
        return $response;

    }

    /**
     * @OA\Post(
     *      path="/api/restaurants",
     *      operationId="store",
     *      tags={"CRUD"},
     *      description="Adiciona 1 ou mais registros no banco de dados. É necessário o token de autentificação.",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      )
     * )
     */
    public function store(Request $req){
        try {

            $body = $req->all();

            $whereStatement = [];

            foreach ($body as $restaurant) {
                array_push($whereStatement,[
                    "name" => $restaurant["name"],
                    "city" => $restaurant["city"],
                    "region" => $restaurant["region"],
                    "cuisine" => $restaurant["cuisine"],
                    "url" => $restaurant["url"]
                ]);
            }
            
            Restaurant::insert($whereStatement);
        } catch (\Throwable $th) {
            return "Erro ao inserir registro(s).";
        }
        
        return "Registro(s) inseridos com sucesso!";
    }
    /**
     * @OA\Delete(
     *      path="/api/restaurants",
     *      operationId="delete",
     *      tags={"CRUD"},
     *      description="Deleta 1 ou mais resgistros específicos. É necessário o token de autentificação.",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      )
     * )
     */
    public function delete(Request $req){

        try {

            $body = $req->get('restaurant');

            $whereStatement = [];

            foreach ($body as $key => $value) {
                foreach ($value as $condition => $content) {
                    array_push($whereStatement,["$key","$condition","$content"]);
                }
                
            }
        

            if (Restaurant::where($whereStatement)->get() == '[]') return "Erro ao deletar o(s) registro(s).";

            Restaurant::where($whereStatement)->delete();

        } catch (\Throwable $th) {
            return "Erro ao deletar o(s) registro(s).";
        }
        return "Registro(s) deletados com sucesso!";
    }

}
