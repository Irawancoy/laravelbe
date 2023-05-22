<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Admin\User\UserHelper;
use App\Http\Resources\Admin\User\UserResource;
use App\Http\Resources\Admin\User\UserCollection;
use App\Http\Requests\admin\User\CreateRequest;
use App\Http\Requests\admin\User\UpdateRequest;
use App\Http\Resources\admin\User\DetailResource;

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

 
    public function store(CreateRequest $request)
    {
        /**
         * Menampilkan pesan error ketika validasi gagal
         * pengaturan validasi bisa dilihat pada class app/Http/request/User/CreateRequest
         */
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->failed($request->validator->errors());
        }

        $dataInput = $request->only(['email', 'nama', 'password', 'foto']);
        $dataUser = $this->user->create($dataInput);

        if (!$dataUser['status']) {
            return response()->failed($dataUser['error']);
        }

        return response()->success(new UserResource($dataUser['data']), 'Data user berhasil disimpan');
    }


    public function show($id)
    {
        $dataUser = $this->user->getById($id);

        if (empty($dataUser)) {
            return response()->failed(['Data user tidak ditemukan']);
        }

        return response()->success(new DetailResource($dataUser));
    }

   
    public function update(UpdateRequest $request)
    {
        /**
         * Menampilkan pesan error ketika validasi gagal
         * pengaturan validasi bisa dilihat pada class app/Http/request/User/UpdateRequest
         */
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->failed($request->validator->errors());
        }

        $dataInput = $request->only(['email', 'nama', 'password', 'id', 'foto']);
        $dataUser = $this->user->update($dataInput, $dataInput['id']);

        if (!$dataUser['status']) {
            return response()->failed($dataUser['error']);
        }

        return response()->success(new UserResource($dataUser['data']), 'Data user berhasil disimpan');
    }


    public function destroy($id)
    {
        $dataUser = $this->user->delete($id);

        if (!$dataUser) {
            return response()->failed(['Mohon maaf data pengguna tidak ditemukan']);
        }

        return response()->success($dataUser, 'Data user telah dihapus');
    }
}
