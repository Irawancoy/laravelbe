<?php

namespace App\Helpers\Admin\TentangKami;

use App\Models\Admin\TentangKamiModel;
use App\Repository\CrudInterface;

class TentangKamiHelper 
{
    protected $tentangKamiModel;

    public function __construct()
    {
        $this->tentangKamiModel= new TentangKamiModel();
    }


    public function getAll(): object
    {
        return $this->tentangKamiModel->getAll();
    }

    /**
     * Mengambil 1 data item dari tabel m_item
     *
     * @param  integer $id id dari tabel m_item
     * @return object
     */
    public function getById(int $id): object
    {
        return $this->tentangKamiModel->getById(($id));
    }

    public function create(array $payload): array
    {
        // dd($payload);
        try {

        if(!empty($payload['gambar'])) {
            // $payload['gambar'] = $payload['gambar']->store('/upload/fotoMenu');
            $payload['gambar']->store('/public/upload/fotoTentangKami');
            $fotodb = $payload['gambar']->store('/upload/fotoTentangKami');
            $payload['gambar'] = $fotodb;

        }
        $createItem = $this->tentangKamiModel->store($payload);
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
                $payload['gambar']->store('/public/upload/fotoTentangKami');
                $fotodb = $payload['gambar']->store('/upload/fotoTentangKami');
                $payload['gambar'] = $fotodb;
    
            }
            else{
                unset($payload['gambar']);
            }
            // $updateItem = $this->menuModel->edit($payload, $id);
            $this->tentangKamiModel->edit($payload, $id);

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
            $this->tentangKamiModel->drop($id);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}

