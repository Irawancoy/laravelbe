<?php

namespace App\Helpers\Admin\Menu;

use App\Models\Admin\MenuModel;
use App\Repository\CrudInterface;

class MenuHelper 
{
    protected $menuModel;

    public function __construct()
    {
        $this->menuModel = new MenuModel();
    }


    public function getAll(): object
    {
        return $this->menuModel->getAll();
    }

    /**
     * Mengambil 1 data item dari tabel m_item
     *
     * @param  integer $id id dari tabel m_item
     * @return object
     */
    public function getById(int $id): object
    {
        return $this->menuModel->getById(($id));
    }

    public function create(array $payload): array
    {
        // dd($payload);
        try {

        if(!empty($payload['gambar'])) {
            // $payload['gambar'] = $payload['gambar']->store('/upload/fotoMenu');
            $payload['gambar']->store('/public/upload/fotoMenu');
            $fotodb = $payload['gambar']->store('/upload/fotoMenu');
            $payload['gambar'] = $fotodb;

        }
        $createItem = $this->menuModel->store($payload);
        return [
            'status' => true,
            'data' => $createItem
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
        try{
            if(!empty($payload['gambar'])) {
                // $payload['gambar'] = $payload['gambar']->store('/upload/fotoMenu');
                $payload['gambar']->store('/public/upload/fotoMenu');
                $fotodb = $payload['gambar']->store('/upload/fotoMenu');
                $payload['gambar'] = $fotodb;
    
            }
            else{
                unset($payload['gambar']);
            }
            // $updateItem = $this->menuModel->edit($payload, $id);
            $this->menuModel->edit($payload, $id);

                // $dataItem = $this->getById($updateItem);
                $dataItem = $this->getById($id);
    
    
                return [
                    'status' => true,
                    'data' => $dataItem
                ];
            } catch (\Throwable $th) {
                return [
                    'status' => false,
                    'error' => $th->getMessage()
                ];
            }

    }

    public function delete(int $id): bool
    {
        try {
            $this->menuModel->drop($id);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

}

