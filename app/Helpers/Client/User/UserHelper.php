<?php

namespace App\Helpers\Client\User;

use App\Models\Client\UserModel;
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
    public function update(array $payload, int $id): array
    {
        try {
            if (isset($payload['password']) && !empty($payload['password'])) {
                $payload['password'] = Hash::make($payload['password']) ?: '';
            } else {
                unset($payload['password']);
            }
        
            if (!empty($payload['foto'])) {
              
                 $payload['foto']->store('/public/upload/fotoClient');
                 $fotodb = $payload['foto']->store('/upload/fotoClient');
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

}
