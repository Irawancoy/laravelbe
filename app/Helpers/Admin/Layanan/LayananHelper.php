<?php

namespace App\Helpers\Admin\Layanan;

use App\Models\Admin\LayananModel;
use App\Repository\CrudInterface;

class LayananHelper 
{
    protected $layananModel;

    public function __construct()
    {
        $this->layananModel = new LayananModel();
    }


   
    public function getAll(): object
    {
        return $this->layananModel->getAll();
    }

    /**
     * Mengambil 1 data item dari tabel m_item
     *
     * @param  integer $id id dari tabel m_item
     * @return object
     */
    public function getById(int $id): object
    {
        return $this->layananModel->getById(($id));
    }

    public function create(array $payload): array
    {
        try {
            if(!empty($payload['gambar'])) {
                // $payload['gambar'] = $payload['gambar']->store('/upload/fotoMenu');
                $payload['gambar']->store('/public/upload/fotoLayanan');
                $fotodb = $payload['gambar']->store('/upload/fotoLayanan');
                $payload['gambar'] = $fotodb;

            }
            $newItem = $this->layananModel->store($payload);

            // dd($newItem);

            return [
                'status' => true,
                'data' => $newItem
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
            // dd($payload);
            if(!empty($payload['gambar'])) {
                // $payload['gambar'] = $payload['gambar']->store('/upload/fotoMenu');
                $payload['gambar']->store('/public/upload/fotoLayanan');
                $fotodb = $payload['gambar']->store('/upload/fotoLayanan');
                $payload['gambar'] = $fotodb;

            }

            $this->layananModel->edit($payload, $id);

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
            $this->layananModel->drop($id);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

}

