<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Client\User\UserHelper;
use App\Http\Resources\Client\User\UserResource;
use App\Http\Resources\Client\User\DetailResource;
use App\Http\Resources\Client\User\UserCollection;
use App\Http\Requests\Client\User\UpdateRequest;

class UserController extends Controller
{
    private $user;
    public function __construct()
    {
        $this->user = new UserHelper();
    }

   public function index()
   {
         $users = $this->user->getAll();
    
         return response()->success(new UserCollection($users));
   }

   public function show($id){
        $dataUser = $this->user->getById($id);

        if (empty($dataUser)) {
            return response()->failed(['Data user tidak ditemukan']);
        }

        return response()->success(new DetailResource($dataUser));
   }

   public function update(UpdateRequest $request){
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->failed($request->validator->errors());
        }

        $dataInput = $request->only(['email', 'nama', 'password', 'foto', 'no_hp','id']);
        $dataUser = $this->user->update($dataInput, $dataInput['id']);

        if (!$dataUser['status']) {
            return response()->failed($dataUser['error']);
        }

        return response()->success(new UserResource($dataUser['data']), 'Data user berhasil diupdate');
   }




}
