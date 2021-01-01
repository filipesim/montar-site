<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CrudController extends BaseController
{

    public function readUser(){

        //Array para armazenar os usuários 
        $users = array();

        //Select para pegar todos os usuários do banco de dados
        $selectUsers = DB::connection('crud')
        ->table('tb_user')
        ->get();

        //Laço de repetição
        foreach($selectUsers as $sl){

            //Armazenando id do usuário
            $cd_user = $sl->cd_user;

            //Armazenando nome do usuário
            $nm_user = $sl->nm_user;

            //Armazenando data no padrão brasileiro
            $dt_last_update = date('H:i d/m/Y', strtotime($sl->dt_last_update));

            //Adicionando usuários ao array
            array_push($users, array('cd_user' => $cd_user, 'nm_user' => $nm_user, 'dt_last_update' => $dt_last_update));

        }

        //Retornando o array de usuários por JSON 
        return json_encode($users);
    	
    }

    public function createUser(request $request){

        $input = $request->all();

        //Ajustando nome para iniciais maiusculas
        $nm_user = strtolower($input['nm_user']);
        $nm_user = ucwords($nm_user);

        //Inserindo o novo usuário no banco de dados
        DB::connection('crud')
        ->table('tb_user')
        ->insert([
            'nm_user' => $nm_user
        ]);
    	
    }

    public function updateUser(request $request){

        $input = $request->all();

        //Ajustando nome para iniciais maiusculas
        $nm_user = strtolower($input['nm_user']);
        $nm_user = ucwords($nm_user);

        //Inserindo o novo usuário no banco de dados
        DB::connection('crud')
        ->table('tb_user')
        ->where('cd_user', $input['cd_user'])
        ->update([
            'nm_user' => $nm_user
        ]);
    	
    }

    public function deleteUser(request $request){

        $input = $request->all();

        //Deletando o usuário do banco de dados
        DB::connection('crud')
        ->table('tb_user')
        ->where('cd_user', $input['cd_user'])
        ->delete();
    	
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

}
