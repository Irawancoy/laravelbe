<?php

namespace App\Helpers\Admin\User;

use App\Models\Admin\UserModel;
use App\Repository\CrudInterface;
use Illuminate\Support\Facades\Hash;


class UserHelper 
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function getAll(): object
    {
        return $this->userModel->getAll();
    }

    /**
     * Mengambil 1 data user dari tabel user_auth
     *
     * @param  integer $id id dari tabel user_auth
     *
     * @return object
     */
    public function getById(int $id): object
    {
        return $this->userModel->getById(($id));
    }

   
    public function create(array $payload): array
    {
        try {
            $payload['password'] = Hash::make($payload['password']);
// dd($payload);
            if (!empty($payload['foto'])) {
            
                $payload['foto']->store('/public/upload/fotoUser');
                $fotodb = $payload['foto']->store('/upload/fotoUser');
                // $foto = $payload['foto']->store('public/assets/img');
                $payload['foto'] = $fotodb;

            }


            $user = $this->userModel->store($payload);
            return [
                'status' => true,
                'data' => $user
            ];
        } catch (\Throwable $th) {
            return [
                'status' => false,
                'error' => $th->getMessage()
            ];
        }
    }

    public function update(array $payload, int $id): array
    {
        try {
            if (isset($payload['password']) && !empty($payload['password'])) {
                $payload['password'] = Hash::make($payload['password']) ?: '';
            } else {
                unset($payload['password']);
            }
        
            if (!empty($payload['foto'])) {
              
                 $payload['foto']->store('/public/upload/fotoUser');
                 $fotodb = $payload['foto']->store('/upload/fotoUser');
                $payload['foto'] = $fotodb;
            }



            $this->userModel->edit($payload, $id);
            return [
                'status' => true,
                'data' => $this->getById($id)
            ];
        } catch (\Throwable $th) {
            return [
                'status' => false,
                'error' => $th->getMessage()
            ];
        }
    }

    /**
     * Menghapus data user dengan sistem "Soft Delete"
     * yaitu mengisi kolom deleted_at agar data tsb tidak
     * keselect waktu menggunakan Query
     *
     * @param  integer $id id dari tabel user_auth
     *
     * @return bool
     */
    public function delete(int $id): bool
    {
        try {
            $this->userModel->drop($id);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
