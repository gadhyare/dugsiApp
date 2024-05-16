<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\FamilyNumber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UsersResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\UsersApiResponeTrait;

class UsersController extends Controller
{

    use UsersApiResponeTrait;

    function index(){


        $users =   UsersResource::collection(FamilyNumber::get());






        return $this->apiResponse($users , 'ok' , 200) ;

    }


    function show($fnumber){
        $users = new UsersResource(FamilyNumber::where('fnumber', $fnumber)->first()) ;




        if($users){
            return $this->apiResponse($users, 'ok', 200);
        }

    }


    function store(Request  $request){


        $validator  = Validator::make($request->all() ,[
            'fnumber' => 'required',
            'active' => 'required'
         ]) ;



         if($validator->fails()){
            return $this->apiResponse(null, $validator->errors(), 400);
         }

        $user = FamilyNumber::create($request->all());


        if($user){
            return $this->apiResponse($user, 'ok', 200);
        }

        return $this->apiResponse( null, 'not saved data', 400);

    }
}
